<?php

namespace App\Http\Controllers;

use App\Models\Idea\Idea;
use App\Models\Idea\IdeaFiles;
use App\Models\Idea\IdeaApproval;
use App\Models\Idea\IdeaLikes;
use App\Models\Idea\teamMember;
use App\Models\Master\Category;
use App\Models\Master\Approver;
use App\Notifications\IdeaNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
        $query = Idea::query()->where('status', 'Published');

        // Pencarian berdasarkan judul dan deskripsi
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Pagination
        $ideas = $query->paginate(12); // Menampilkan 10 ide per halaman
        $categories = Category::all();

        return view('page.idea.index', compact('ideas', 'categories'));
    }

    public function create()
    {
        $users = DB::table('users')->select('id', 'name')->orderBy('name','asc')->get();
        return view('page.idea.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // \dd($request->all());
        // Validasi data yang diinput
        $request->validate([
            'title' => 'required|string|unique:ideas,title',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'files.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Siapkan data umum
        $ideaData = [
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'In Approval',
        ];

        // Proses input berdasarkan kategori
        switch ($request->input('category_id')) {
            case '1':
                $ideaData['before'] = $request->input('before');
                $ideaData['after'] = $request->input('after');
                $ideaData['benefit'] = $request->input('benefit');
                break;
            case '2':
                $ideaData['before'] = $request->input('before');
                $ideaData['after'] = $request->input('after');
                $ideaData['sumber_best_practice'] = $request->input('sumber_best_practice');
                break;
            case '3':
                $ideaData['proses_improve'] = $request->input('proses_improve');
                $ideaData['before'] = $request->input('before');
                $ideaData['after'] = $request->input('after');
                break;
            case '4':
                $ideaData['before'] = $request->input('before');
                $ideaData['after'] = $request->input('after');
                $ideaData['nama_ai'] = $request->input('nama_ai');
                break;
        }

        // Ambil section_id dari user yang sedang login
        $sectionId = auth()->user()->section_id;
        $currentLevel = 1; // Level awal untuk ide baru
        $approvalPath = $this->getApprovalPath($sectionId, $currentLevel);
        $ideaData['approval_path'] = json_encode($approvalPath);

        // Simpan data ke tabel ideas
        $idea = Idea::create($ideaData);

        // Kirim notifikasi ke approver pertama
        $firstApprover = $approvalPath[0];
        $user = User::where('nik', $firstApprover['approver_nik'])->first();
        if ($user) {
            $data = [
                'title' => 'New Idea for Approval',
                'message' => $idea->title . ' needs your approval.',
                'user_id' => $idea->user_id,
            ];
            $user->notify(new IdeaNotification($data));
        }

        // Proses upload file jika ada
        if ($request->hasFile('files')) {
            $user = Auth::user();
            $slug = Str::slug($request->title);

            foreach ($request->file('files') as $file) {
                $increment = 1;
                $extension = $file->getClientOriginalExtension();
                $filename = "{$user->nik}-{$slug}-{$increment}.{$extension}";

                // Cek apakah file dengan nama yang sama sudah ada
                while (Storage::disk('public')->exists("uploads/ideas/{$filename}")) {
                    $increment++;
                    $filename = "{$user->nik}-{$slug}-{$increment}.{$extension}";
                }

                $path = $file->storeAs('uploads/ideas', $filename, 'public');

                // Simpan data file ke tabel ideasFiles
                IdeaFiles::create([
                    'idea_id' => $idea->id,
                    'file' => $path,
                ]);
            }
        }

        if($request->input('members')){
            $members = $request->input('members');
            foreach($members as $member){
                teamMember::Create([
                    'idea_id' => $idea->id,
                    'leader_id' => auth()->id(),
                    'member_id' => $member
                ]);
            }
        }

        Alert::toast('Successfully Created Idea', 'success');
        return redirect()->route('ideas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idea = Idea::with(['user.position', 'user.department', 'user.section', 'category', 'ideaFile'])->findOrFail($id);

        return response()->json($idea);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        // Cek jika idea ini punya file, hapus juga
        if ($idea->files) {
            foreach ($idea->files as $file) {
                Storage::disk('public')->delete($file->file);
                $file->delete();
            }
        }

        // Cek jika idea ini punya file di IdeaFiles, hapus juga
        if ($idea->ideaFiles) {
            foreach ($idea->ideaFiles as $ideaFile) {
                $ideaFile->delete();
            }
        }

        $idea->delete();
        Alert::toast('Successfully Deleted Idea', 'success');
        return redirect()->route('ideas.index');
    }

    public function toggleLike(Idea $idea)
    {
        $user = auth()->user();
        $liked = $idea->likes()->toggle($user->id);

        // Determine if the user liked the idea
        $isLiked = in_array($user->id, $liked['attached']);

        // Notify the user that the idea has been liked
        if ($isLiked) {
            $data = [
                'title' => 'Idea Liked',
                'message' => $idea->title . ' has been liked by ' . $user->name
            ];
            $idea->user->notify(new IdeaNotification($data));
        }

        return response()->json([
            'liked' => $isLiked,
            'likes_count' => $idea->likes()->count() // Return the updated like count
        ]);
    }

    public function approvalIndex()
    {

        return view('page.idea-approval.index');
    }

    public function approveIdea(Request $request, $ideaId)
    {
        Log::info('Approve Idea called for ideaId: ' . $ideaId);

        try {
            $request->validate([
                'note' => 'nullable|string',
            ]);

            $idea = Idea::findOrFail($ideaId);
            Log::info('Idea found: ', $idea->toArray());

            $approvalPath = json_decode($idea->approval_path, true);
            Log::info('Approval Path: ', $approvalPath);

            if (empty($approvalPath)) {
                return response()->json(['message' => 'No approvers available', 'status' => 'error'], 400);
            }

            $currentApprover = current($approvalPath);
            $currentUserNik = auth()->user()->nik;

            if ($currentApprover['approver_nik'] != $currentUserNik) {
                return response()->json(['message' => 'You are not authorized to approve this idea', 'status' => 'error'], 403);
            }

            $this->saveApprovalOrReject($ideaId, $currentApprover, 'approved', $request->input('note'));

            array_shift($approvalPath);
            $idea->approval_path = json_encode($approvalPath);

            if (empty($approvalPath)) {
                $idea->status = 'Published';
            }

            $idea->save();

            // Get the name of the current approver
            $approverUser = User::where('nik', $currentUserNik)->first();
            $approverName = $approverUser ? $approverUser->name : 'Unknown';

            // Notify the user who created the idea
            $data = [
                'title' => 'Idea Approved',
                'message' => $idea->title . ' has been approved by ' . $approverName,
                'user_id' => $idea->user_id,
            ];

            $idea->user->notify(new IdeaNotification($data));

            // Notify the first approver in the remaining approval path
            if (!empty($approvalPath)) {
                $nextApprover = $approvalPath[0];
                $approverNik = $nextApprover['approver_nik'];
                $nextApproverUser = User::where('nik', $approverNik)->first();
                if ($nextApproverUser) {
                    $nextApproverData = [
                        'title' => 'New Idea Approval Required',
                        'message' => 'You have a new idea to approve: ' . $idea->title,
                        'user_id' => $nextApproverUser->id,
                    ];
                    $nextApproverUser->notify(new IdeaNotification($nextApproverData));
                }
            }

            return response()->json(['message' => 'Idea approved successfully', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('Error approving idea: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'status' => 'error'], 500);
        }
    }

    public function rejectIdea(Request $request, $ideaId)
    {
        $request->validate([
            'note' => 'nullable|string',
        ]);

        $idea = Idea::findOrFail($ideaId);
        $approvalPath = json_decode($idea->approval_path, true);

        if (empty($approvalPath)) {
            return response()->json(['message' => 'No approvers available', 'status' => 'error'], 400);
        }

        $currentApprover = current($approvalPath);
        $currentUserNik = auth()->user()->nik;

        if ($currentApprover['approver_nik'] != $currentUserNik) {
            return response()->json(['message' => 'You are not authorized to reject this idea', 'status' => 'error'], 403);
        }

        $this->saveApprovalOrReject($ideaId, $currentApprover, 'rejected', $request->input('note'));

        $idea->approval_path = json_encode([]);
        $idea->status = 'Rejected';
        $idea->save();

        // Notify users associated with the idea
        $data = [
            'title' => 'Idea Rejected',
            'message' => $idea->title . ' has been rejected by ' . auth()->user()->name,
            'user_id' => $idea->user_id,
        ];

        $idea->user->notify(new IdeaNotification($data));


        return response()->json(['message' => 'Idea rejected successfully', 'status' => 'success'], 200);
    }

    private function saveApprovalOrReject($ideaId, $currentApprover, $status, $note = null)
    {
        $ideaApproval = new IdeaApproval();
        $ideaApproval->idea_id = $ideaId;
        $ideaApproval->approval_id = $currentApprover['approver_nik'];
        $ideaApproval->status = $status;
        $ideaApproval->note = $note;
        $ideaApproval->approval_stage = 'Level ' . $currentApprover['level'];
        $ideaApproval->save();
    }

    private function getApprovalPath($sectionId, $currentLevel)
    {
        $approvers = Approver::where('section_id', $sectionId)
            ->orderBy('level')
            ->get();

        $approvalPath = [];
        $creatorNik = auth()->user()->nik;
        $skipLevel = null;

        foreach ($approvers as $approver) {
            if ($approver->approver_nik == $creatorNik && $approver->is_special) {
                // Jika pembuat ide adalah approver dan is_special, gunakan skip_to_level jika ada
                $skipLevel = $approver->skip_to_level ?? $approver->level;
                break; // Keluar dari loop setelah menemukan approver yang sesuai
            }
        }

        foreach ($approvers as $approver) {
            // Jika skipLevel diatur, mulai dari level tersebut
            if ($skipLevel !== null && $approver->level < $skipLevel) {
                continue;
            }

            // Tambahkan approver normal atau special yang bukan pembuat ide
            if ($approver->level >= $currentLevel) {
                $approvalPath[] = [
                    'approver_nik' => $approver->approver_nik,
                    'level' => $approver->level
                ];
            }
        }

        return array_values($approvalPath);
    }

    public function myIdeas()
    {
        $userId = auth()->id();
        $ideas = Idea::where('user_id', $userId)
            ->with(['category', 'ideaFiles', 'approvals'])
            ->get();

        // Hitung jumlah like untuk setiap idea
        $ideasWithLikes = $ideas->map(function ($idea) {
            $idea->likes_count = IdeaLikes::where('idea_id', $idea->id)->count();
            return $idea;
        });
        // \dd($ideasWithLikes);

        return view('page.idea.my_ideas', compact('ideasWithLikes'));
    }

    public function getLikeCounts()
    {
        // Group by idea_id and count the likes
        $likeCounts = IdeaLikes::select('idea_id', DB::raw('count(*) as likes_count'))
            ->groupBy('idea_id')
            ->get();

        // Prepare the response
        return response()->json(['ideas' => $likeCounts]);
    }

    public function getIdeaFavorites()
    {
        $userId = auth()->id();
        $ideas = Idea::where('user_id', $userId)
            ->with(['category', 'ideaFiles', 'approvals'])
            ->get();
        return view('page.idea.my_ideas', compact('ideas'));
    }

    public function my_ideaLikes()
    {
        $userId = auth()->id();
        $ideas = Idea::whereHas('likes', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['category', 'ideaFiles', 'approvals'])
            ->paginate(12);

        $categories = Category::all();

        return view('page.idea.my_ideaLikes', compact('ideas', 'categories'));
    }


    // ==============================================================Notification===========================================================
    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $currentUser = Auth::user();

        if ($notificationId) {
            // Tandai satu notifikasi sebagai dibaca
            $notification = $currentUser->notifications()->find($notificationId);
            if ($notification) {
                $notification->markAsRead();
                $notification->update(['read_at' => now()]);
                return response()->json(['success' => true, 'message' => 'Notification marked as read.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Notification not found.'], 404);
            }
        } else {
            // Tandai semua notifikasi sebagai dibaca
            $currentUser->unreadNotifications->markAsRead();
            $currentUser->unreadNotifications()->update(['read_at' => now()]);
            return response()->json(['success' => true, 'message' => 'All notifications marked as read.']);
        }
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }

    public function clearAll()
    {
        try {
            DB::table('notifications')->truncate(); // Hapus semua notifikasi
            return response()->json(['message' => 'All notifications deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete notifications.'], 500);
        }
    }
}

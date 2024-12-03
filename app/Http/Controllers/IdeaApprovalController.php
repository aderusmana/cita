<?php

namespace App\Http\Controllers;

use App\Models\Idea\Idea;
use App\Models\Master\Category;
use App\Models\Idea\IdeaApproval;
use Illuminate\Http\Request;

class IdeaApprovalController extends Controller
{
    public function index()
    {
        $currentUserNik = auth()->user()->nik; // Ambil NIK dari pengguna yang sedang login

        // Dapatkan ide yang statusnya 'Pending' dan pengguna login adalah approver yang sesuai
        $ideas = Idea::where('status', 'In Approval')
            ->whereJsonContains('approval_path', [['approver_nik' => $currentUserNik]])
            ->get()
            ->filter(function ($idea) use ($currentUserNik) {
                $approvalPath = json_decode($idea->approval_path, true); // Decode JSON menjadi array
                $ideaApproval = IdeaApproval::where('idea_id', $idea->id)->get();

                // Selalu tampilkan data pertama dari approval_path
                return $approvalPath[0]['approver_nik'] === $currentUserNik;
            });

        $categories = Category::all();
        return view('page.idea-approval.index', compact('ideas', 'categories'));
    }
}

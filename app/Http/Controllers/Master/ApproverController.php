<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Approver;
use App\Models\Master\Section;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApproverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $approvers = Approver::with(['section', 'user'])->get();
        $sections = Section::all();
        $users = User::all();

        // Dialog Sweet Alert
        $title = 'Delete Approver!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('page.master.approver.index', compact('approvers', 'sections', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $sections = $data['section_id'];
        $approvers = $data['approver_nik'];
        $levels = $data['level'];
        $is_specials = $data['is_special'];
        $skip_to_levels = $data['skip_to_level'];

        foreach($sections as $key => $section) {
            $approver = new Approver;
            $approver->section_id = $section;
            $approver->approver_nik = $approvers[$key];
            $approver->level = $levels[$key];
            $approver->is_special = $is_specials[$key];
            $approver->skip_to_level = $skip_to_levels[$key];
            $approver->save();
        }

        Alert::toast('Approver created successfully', 'success');
        return redirect()->route('approvers.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'approver_id' => 'required|exists:users,id',
            'level' => 'required|integer|min:1',
        ]);

        $approver = Approver::findOrFail($id);
        $approver->update($request->all());
        Alert::toast('Approver updated successfully', 'success');
        return redirect()->route('approvers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $approver = Approver::findOrFail($id);
        $approver->delete();
        Alert::toast('Approver deleted successfully', 'success');
        return redirect()->route('approvers.index');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sujet;
use App\Models\ReplaySujet;
use Illuminate\Support\Facades\Auth;

class ReplayController extends Controller
{
    public function index()
    {
        $replays = ReplaySujet::where('user_id', Auth::id())->get();

       
        return view('TemplateForum/replay' , compact('replays')); 
    }

    public function delete($id)
    {
        // Find the subject by ID
        $sujet = ReplaySujet::findOrFail($id);

        if ($sujet->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        $sujet->delete();

        return redirect()->route('posts.index')->with('success', 'replay deleted successfully.');
    }

    public function show(Request $request, $id)
    {
        // Find the subject by ID
        $sujet = Sujet::findOrFail($id);
    
        // Check if the request method is POST (for adding a replay)
        if ($request->isMethod('post')) {
            // Validate the replay content
            $request->validate([
                'content' =>  ['required'],
            ]);
    
            // Create the new replay for the subject
            ReplaySujet::create([
                'content' => $request->input('content'),
                'sujet_id' => $sujet->id,  // Associate with the specific subject
                'user_id' => Auth::id(),   // Associate with the authenticated user
            ]);
            // Redirect to the same subject page with a success message
            return redirect()->route('show.index', $sujet->id)->with('success', 'Replay added successfully.');
        }
    
        // Return the subject details and replays to the view
        return view('Front.pages.forumFront.ReplaySujet', compact('sujet'));
    }
    
    public function comments()
    {
        return view('Front/pages/forumFront/ReplaySujet'); 
    }

    public function edit($id)
    {
        // Find the subject by ID
        $replay = ReplaySujet::findOrFail($id);

        // Ensure that the user owns the subject
        if ($replay->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post.');
        }

        // Return the edit view with the subject
        return view('TemplateForum.EditReplay', compact('replay'));
    }

    // Handle the update request for the subject
    public function update(Request $request, $id)
    {
        // Validate the form inputs
        $request->validate([
            'content' => 'required',
          
        ]);

        // Find the subject by ID
        $replay = ReplaySujet::findOrFail($id);

        // Ensure that the user owns the subject
        if ($replay->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this post.');
        }

        // Update the subject with new values
        $replay->content = $request->input('content');

       
        // Save the changes
        $replay->save();

        // Redirect to a relevant page with a success message
        return redirect()->route('replays.index')->with('success', 'Subject updated successfully.');
    }
}

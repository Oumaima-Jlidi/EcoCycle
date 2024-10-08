<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sujet;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    public function index()
    {
        $sujets = Sujet::where('user_id', Auth::id())->get();

        return view('TemplateForum/dashPosts' , compact('sujets')); 
    }
    public function delete($id)
    {
        // Find the subject by ID
        $sujet = Sujet::findOrFail($id);

        if ($sujet->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        $sujet->delete();

        return redirect()->route('posts.index')->with('success', 'Subject deleted successfully.');
    }

    public function Forum()
    {
        $sujets = Sujet::all();
        return view ('Front/pages/forumFront/ListeSujet', compact('sujets'));
   
    }
    public function create()
    {
        return view('TemplateForum/AddSujet'); 

    }
   
    public function AddPost(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'content' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Handle the image upload if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sujets_images', 'public');
        }

        // Create new Sujet
        $sujet = Sujet::create([
            'content' => $request->input('content'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'statut' => 'non_resolu', // Default statut
            'user_id' => Auth::id(),   // Associate with the logged-in user
        ]);

        // Redirect or return a success response
        return redirect()->route('forum.index')->with('success', 'Sujet added successfully!');
    }
    public function edit($id)
    {
        // Find the subject by ID
        $sujet = Sujet::findOrFail($id);

        // Ensure that the user owns the subject
        if ($sujet->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post.');
        }

        // Return the edit view with the subject
        return view('TemplateForum.EditPost', compact('sujet'));
    }

    // Handle the update request for the subject
    public function update(Request $request, $id)
    {
        // Validate the form inputs
        $request->validate([
            'content' => 'required|string|max:255',
            'description' => 'required|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Find the subject by ID
        $sujet = Sujet::findOrFail($id);

        // Ensure that the user owns the subject
        if ($sujet->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this post.');
        }

        // Update the subject with new values
        $sujet->content = $request->input('content');
        $sujet->description = $request->input('description');
        $sujet->statut = $request->input('statut');
        // Handle the image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sujets_images', 'public');
            $sujet->image = $imagePath;
        }

        // Save the changes
        $sujet->save();

        // Redirect to a relevant page with a success message
        return redirect()->route('posts.index')->with('success', 'Subject updated successfully.');
    }
   
}

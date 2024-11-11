<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sujet;
use App\Models\ReplaySujet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 
use App\Models\Notification;

class ReplayController extends Controller
{
    public function index()
    {
        $replays = ReplaySujet::where('user_id', Auth::id())->get();
        $notifications = Notification::where('is_read', false)->get();

        return view('TemplateForum/replay', compact('replays','notifications'));
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

        // Get all replays for the subject
        $replays = $sujet->replays;

        // Add sentiment analysis for each replay
        foreach ($replays as $replay) {
            $label = $this->analyzeSentiment($replay->content);
            $replay->sentiment = $label;
            $replay->emoji = $this->getEmojiForSentiment($label);

        }

        // Return the subject details and replays to the view
        return view('Front.pages.forumFront.ReplaySujet', compact('sujet', 'replays'));
    }

    public function analyzeSentiment($text)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer  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' ,
        ])->post('https://api-inference.huggingface.co/models/distilbert-base-uncased-finetuned-sst-2-english', [
            'inputs' => $text,
        ]);

        $result = json_decode($response->body(), true);

        
        // Vérifiez si la réponse contient une erreur ou si elle est vide
     // Vérifiez si la réponse contient une erreur ou est vide
     if (!is_array($result) || isset($result['error']) || empty($result)) {
        // Log the error for debugging purposes
        Log::error('Hugging Face API Error:', $result);
        return '❓'; // Emoji par défaut si erreur
    }

    // Extraire le sentiment avec le score le plus élevé
    $sentiment = collect($result[0])->sortByDesc('score')->first();
    
    // Obtenir l'emoji correspondant au label du sentiment
    $emoji = $this->getEmojiForSentiment($sentiment['label'] ?? 'unknown');
    
    // Retourner le label avec l'emoji ou juste "❓" si inconnu
    return $sentiment['label'] ? "{$sentiment['label']} {$emoji}" : '❓';
    }

    protected function getEmojiForSentiment($label)
    {
        $emojis = [
            'POSITIVE' => '😊',  
            'NEGATIVE' => '😞',  
            'NEUTRAL' => '😐',   
        ];
     // Normaliser le label pour correspondre aux clés
    $label = strtoupper(trim($label));

    return $emojis[$label] ?? '❓';
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

<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\ReplaySujet;
use App\Models\Sujet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeOrDislike(Request $request, $likeableId, $likeableType)
    {
        $user = Auth::user();

        // Déterminer la classe cible (Subject ou Reply)
        $likeableClass = $likeableType == 'sujet' ? Sujet::class : ReplaySujet::class;

        // Vérifiez si l'utilisateur a déjà aimé ou disliké cet élément
        $existingLike = Like::where('user_id', $user->id)
                            ->where('likeable_id', $likeableId)
                            ->where('likeable_type', $likeableClass)
                            ->first();

        if ($existingLike) {
            // Mettre à jour si l'utilisateur change de type (like/dislike)
            $existingLike->update(['type' => $request->type]);
        } else {
            // Créer un nouveau like/dislike
            Like::create([
                'user_id' => $user->id,
                'likeable_id' => $likeableId,
                'likeable_type' => $likeableClass,
                'type' => $request->type,
            ]);
        }

        return back()->with('success', 'Your feedback has been recorded.');
    }
}

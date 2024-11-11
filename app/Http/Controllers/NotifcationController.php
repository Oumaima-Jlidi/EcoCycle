<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Notification;


class NotifcationController extends Controller
{
    
public function showHeaderNotifications()
{
    $notifications = Notification::where('is_read', false)->get(); 
 
    return view('Back.partials.header')->with('notifications' , $notifications );
    
}

public function markAsRead($id)
{
    $notification = Notification::findOrFail($id);
    $notification->update(['is_read' => true]);
    return redirect()->back();
}


}
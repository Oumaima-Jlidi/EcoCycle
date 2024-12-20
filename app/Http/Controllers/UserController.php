<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Exports\UsersExport; // Créer ce fichier d'export
use PDF;
use App\Models\Notification;

class UserController extends Controller
{
    public function index()
    {  $notifications = Notification::where('is_read', false)->get();
        $users = User::all();
        return view ('Back.pages.users.index')->with(['users'=>$users, 'notifications'=>$notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        // Créer un nouveau user
        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User ajouté avec succès');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); 
        $roles = Role::all(); // Récupérer tous les rôles
        return view('Back.pages.users.editUser', compact('user', 'roles'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'role_id' => 'required', // Ajouter la validation pour le rôle
    ]);

    $user = User::findOrFail($id);
    $user->update($request->all());

    return redirect()->route('users.index')->with('success', 'User mis à jour avec succès');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $users = User::findOrFail($id); 
        $users->delete(); // Supprimer le user

        return redirect()->route('users.index')->with('success', 'User supprimé avec succès');
    }

    public function toggleStatus($id)
{
    $user = User::findOrFail($id);
    $user->is_active = !$user->is_active; // Inverser l'état
    $user->save();

    return redirect()->route('users.index')->with('success', 'Statut de l\'utilisateur mis à jour avec succès');
}



public function exportToPDF()
    {
        $users = User::all();
        $pdf = PDF::loadView('Back.pages.users.pdf', compact('users'));
        return $pdf->download('users.pdf');
    }


}

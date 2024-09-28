<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view ('Back.pages.users.index')->with('users',$users);
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
}

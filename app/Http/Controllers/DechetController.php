<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DechetController extends Controller
{
    public function index()
    {
        //$collectes = Collecte::all();
        // view('Back.pages.collectes.index')->with('collectes', $collectes);
        return view('Back.pages.dechets.index');
    }
}

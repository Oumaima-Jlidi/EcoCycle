<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('TemplateForum/dashPosts'); 
    }

    public function Forum()
    {
        return view('Front/pages/ForumFront/listeSujet'); 

    }

    public function AddPost()
    {
        return view('TemplateForum/AddSujet'); 
    }
}

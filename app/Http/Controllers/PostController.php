<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('TemplateForum/dashPosts'); 
    }



    public function AddPost()
    {
        return view('TemplateForum/AddSujet'); 
    }
}

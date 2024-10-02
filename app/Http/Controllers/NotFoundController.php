<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotFoundController extends Controller
{
    public function index()
    {
        return response()->view('Front.pages.404', [], 404);
    }
}
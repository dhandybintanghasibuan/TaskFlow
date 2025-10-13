<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SplashController extends Controller
{
    /**
     * Menampilkan halaman splash screen.
     */
    public function index()
    {
        return view('splash');
    }
}
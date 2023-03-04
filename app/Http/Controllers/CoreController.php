<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoreController extends Controller
{
    // dashboard
    public function index()
    {
        return view('home');
    }

    // register
    public function register()
    {
        return view('register');
    }

    // login
    public function login()
    {
        return view('login');
    }

    // error 404
    public function error_404()
    {
        return view('error_404');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // By using middleware('auth') in the constructor, we ensure that all methods in this controller require the user to be authenticated.
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.dashboard');
    }

    // If you don't want to protect all methods in the controller, you can apply the middleware to specific methods instead.
    
    // public function singleAuthProtectedMethod()
    // {
    //     This method will be protected by the auth middleware, while other methods in the controller will not require authentication.
    //     middleware('auth');
    // }
}

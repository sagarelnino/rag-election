<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->user_type == User::USER_TYPE_ADMIN) {
            return view('home');
        } elseif (auth()->user()->user_type == User::USER_TYPE_VOTER) {
            return view('user_dashboard');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Election;
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
            $elections = Election::where('is_active', true)->count();
            $admins = User::where('is_approved', true)->where('user_type', User::USER_TYPE_ADMIN)->count();
            $voters = User::where('is_approved', true)->where('user_type', User::USER_TYPE_VOTER)->count();
            $approvals = User::where('is_approved', false)->where('user_type', User::USER_TYPE_VOTER)->count();
            return view('home', ['elections' => $elections, 'admins' => $admins, 'voters' => $voters, 'approvals' => $approvals]);
        } elseif (auth()->user()->user_type == User::USER_TYPE_VOTER) {
            $query = User::query();
            $query->select('users.id', 'users.name', 'users.email', 'users.is_approved', 'user_details.hall', 'user_details.department', 'user_details.address', 'user_details.thumb', 'user_details.home_district', 'user_details.facebook_id');
            $query->join('user_details', 'users.id', '=', 'user_details.user_id');
            $query->where('users.id', '=', auth()->id());
            $user = $query->first();
            return view('users.user_dashboard', ['user' => $user]);
        }
    }
}

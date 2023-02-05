<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hall;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('home');
        } else {
            $halls = Hall::orderBy('hall')->get();
            $departments = Department::orderBy('department')->get();
            return view('auth.register', ['halls' => $halls, 'departments' => $departments]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'hall' => ['required', 'string'],
            'department' => ['required', 'string'],
            'address' => ['required', 'string'],
            'home_district' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'thumb' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
        ]);

        try {
            $filename = '';
            if ($request->has('thumb')) {
                $filename = date('Y_m_d_H_i_s') . '_voter.' . $request->file('thumb')->getClientOriginalExtension();
                $request->file('thumb')->storeAs('public/images/', $filename);
            }
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'user_type' => User::USER_TYPE_VOTER,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            UserDetail::create([
                'user_id' => $user->id,
                'hall' => $request->hall,
                'department' => $request->department,
                'address' => $request->address,
                'thumb' => $filename,
                'home_district' => $request->home_district,
                'facebook_id' => $request->facebook_id,
            ]);
            DB::commit();

            return redirect()->to('/registration_status/' . $user->id);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back();
        }
    }
}

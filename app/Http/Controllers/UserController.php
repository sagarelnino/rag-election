<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function registrationStatus($user_id)
    {
        $user = $this->getUserById($user_id);
        return view('auth.registration_status', ['user' => $user]);
    }

    public function showChangePasswordForm()
    {
        return view('auth.password_change');
    }

    public function passwordChange(Request $request)
    {
        $user = User::find(auth()->id());
        $request->validate([
            'new_password' => 'required|min:7',
            'new_password_confirm' => 'required|same:new_password',
            'password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'Password has been changed');
    }

    public function voters()
    {
        $users = $this->users(true, User::USER_TYPE_VOTER);
        return view('users.voters', ['users' => $users]);
    }

    public function approvals()
    {
        $users = $this->users(false, User::USER_TYPE_VOTER);
        return view('users.approvals', ['users' => $users]);
    }

    protected function users($is_approved = false, $user_type = User::USER_TYPE_VOTER)
    {
        $query = User::query();
        $query->select('users.id', 'users.name', 'users.email', 'users.is_approved', 'user_details.hall', 'user_details.department', 'user_details.address', 'user_details.thumb', 'user_details.home_district', 'user_details.facebook_id');
        $query->join('user_details', 'users.id', '=', 'user_details.user_id');
        $query->where('users.is_approved', $is_approved);
        $query->where('users.user_type', $user_type);
        $users = $query->get();
        return $users;
    }

    public function getUser($id)
    {
        $user = $this->getUserById($id);
        return view('users.user_detail', ['user' => $user]);
    }

    protected function getUserById($id)
    {
        $query = User::query();
        $query->select('users.id', 'users.name', 'users.email', 'users.is_approved', 'user_details.hall', 'user_details.department', 'user_details.address', 'user_details.thumb', 'user_details.home_district', 'user_details.facebook_id');
        $query->join('user_details', 'users.id', '=', 'user_details.user_id');
        $query->where('users.id', '=', $id);
        $user = $query->first();
        return $user;
    }

    public function updateApproval($user_id, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $user = User::find($user_id);
        if ($request->status == 'approve') {
            $user->is_approved = true;
            $message = 'Request Approved';
        } elseif ($request->status == 'decline') {
            $user->is_approved = false;
            $message = 'Request Declined';
        }
        $user->save();

        return back()->with('message', $message);
    }

    public function deleteUser($user_id)
    {
        try {
            DB::beginTransaction();
            $user = $this->getUserById($user_id);
            if (Storage::exists('public/images/' . $user->thumb)) {
                Storage::delete('public/images/' . $user->thumb);
            }
            UserDetail::where('user_id', $user_id)->delete();
            User::where('id', $user_id)->delete();

            DB::commit();
            return redirect()->to('/voters')->with('message', 'User deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong');
        }
    }
}

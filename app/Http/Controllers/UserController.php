<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Hall;
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

    public function voters(Request $request)
    {
        $search_params = $request->all();
        $users = $this->users(true, User::USER_TYPE_VOTER, $search_params);
        $halls = Hall::select('hall')->orderBy('hall')->get();
        $departments = Department::select('department')->orderBy('department')->get();
        return view('users.voters', ['users' => $users, 'halls' => $halls, 'departments' => $departments, 'search' => $search_params]);
    }

    public function approvals(Request $request)
    {
        $search_params = $request->all();
        $users = $this->users(false, User::USER_TYPE_VOTER, $search_params);
        $halls = Hall::select('hall')->orderBy('hall')->get();
        $departments = Department::select('department')->orderBy('department')->get();
        return view('users.approvals', ['users' => $users, 'halls' => $halls, 'departments' => $departments, 'search' => $search_params]);
    }

    protected function users($is_approved = false, $user_type = User::USER_TYPE_VOTER, $search_params)
    {
        $query = User::query();
        $query->select('users.id', 'users.name', 'users.email', 'users.is_approved', 'user_details.hall', 'user_details.department', 'user_details.address', 'user_details.thumb', 'user_details.home_district', 'user_details.facebook_id');
        $query->join('user_details', 'users.id', '=', 'user_details.user_id');
        $query->where('users.is_approved', $is_approved);
        $query->where('users.user_type', $user_type);
        if (isset($search_params['search_name']) && $search_params['search_name'] != '') {
            $query->where('users.name', 'like', '%' . $search_params['search_name'] . '%');
        }
        if (isset($search_params['search_hall']) && $search_params['search_hall']) {
            $query->where('user_details.hall', $search_params['search_hall']);
        }
        if (isset($search_params['search_department']) && $search_params['search_department']) {
            $query->where('user_details.department', $search_params['search_department']);
        }
        if (isset($search_params['search_address']) && $search_params['search_address'] != '') {
            $query->where('user_details.address', 'like', '%' . $search_params['search_address'] . '%');
        }
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

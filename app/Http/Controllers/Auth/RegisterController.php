<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'hall_id' => ['required', 'integer'],
            'department_id' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'home_district' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'thumb' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            $filename = '';
            if (array_key_exists('thumb', $data)) {
                $filename = date('Y-m-d H:i:s') . '_voter.' . $data['thumb']->getClientOriginalExtension();
                $data['thumb']->storeAs('images/', $filename);
            }

            $user = User::create([
                'name' => $data['name'],
                'user_type' => User::USER_TYPE_VOTER,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            UserDetail::create([
                'user_id' => $user->id,
                'hall_id' => $data['hall_id'],
                'department_id' => $data['department_id'],
                'address' => $data['address'],
                'thumb' => $filename,
                'home_district' => $data['home_district'],
            ]);
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}

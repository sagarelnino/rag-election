<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ADMIN',
            'user_type' => User::USER_TYPE_ADMIN,
            'email' => 'admin_rag43@election.com',
            'password' => Hash::make('@dm!n_r@g43'),
            'is_approved' => true
        ]);
    }
}

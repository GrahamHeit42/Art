<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() === 0) {
            User::create([
                'display_name' => config('constants.admin.display_name'),
                'username' => config('constants.admin.username'),
                'email' => config('constants.admin.email'),
                'password' => Hash::make(config('constants.admin.password')),
                'is_admin' => 1,
                'status' => 1,
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}

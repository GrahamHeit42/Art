<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'user'];
        foreach ($roles as $role) {
            Role::create([
                'type' => $role,
                'status' => 1
            ]);
        }
    }
}

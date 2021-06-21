<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@app.com',
            'phone' => '01921577009',
            'address' => 'Dhaka, Bangladesh',
            'status' => 1,
            'password' => Hash::make('admin'),
        ]);
        $role_admin = Role::firstOrCreate(['name' => 'admin', 'description' => 'Admin role']);
        $admin->roles()->attach($role_admin);

        // Normal User
        $user = User::create([
            'name' => 'Normal User',
            'email' => 'user@app.com',
            'phone' => '01921577008',
            'address' => 'Dhaka, Bangladesh',
            'status' => 1,
            'password' => Hash::make('user'),
        ]);
        $role_user = Role::firstOrCreate(['name' => 'user', 'description' => 'Normal User role']);
        $user->roles()->attach($role_user);
    }
}

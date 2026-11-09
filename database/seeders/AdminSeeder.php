<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Admin",
            'user_name' => "admin",
            'email' => "admin@gmail.com",
            'role' => 1,
            'password' => Hash::make("M&m@01883240722"),
        ]);
        $role = Role::create(['name' => 'System Admin']);
        Role::create(['name' => 'Company']);
        $user->assignRole($role);
    }
}

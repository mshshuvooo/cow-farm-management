<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::where('name', 'admin')->first();

        $admin = User::create([
            'name' => 'Shahadat Shuvo',
            'email' => 'shuvo@wardtech.co.uk',
            'user_role' => 'admin',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole($admin_role);

    }
}

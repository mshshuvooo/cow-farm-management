<?php

namespace Database\Seeders;

use App\Enum\UserRoleEnum;
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
        $admin_role = Role::where('name', UserRoleEnum::ADMIN->value)->first();

        $admin = User::create([
            'name' => 'Shahadat Shuvo',
            'email' => 'shuvo@wardtech.co.uk',
            'user_role' => 'admin',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole($admin_role);


        $subscriber_role = Role::where('name', UserRoleEnum::SUBSCRIBER->value)->first();

        $subscriber = User::create([
            'name' => 'Tom',
            'email' => 'tom@wardtech.co.uk',
            'user_role' => 'subscriber',
            'password' => bcrypt('12345678')
        ]);

        $subscriber->assignRole($subscriber_role);


    }
}

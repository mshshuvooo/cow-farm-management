<?php

namespace Database\Seeders;

use App\Enum\UserRoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
            'user_list',
            'user_view',
            'user_create',
            'user_update',
            'user_delete',
            'cow_list',
            'cow_view',
            'cow_create',
            'cow_update',
            'cow_delete'
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());


        Role::create(['name' => UserRoleEnum::SUBSCRIBER->value])
            ->givePermissionTo([
                'user_view',
                'cow_list',
                'cow_view'
            ]);

        Role::create(['name' => UserRoleEnum::ADMIN->value])
        ->givePermissionTo([Permission::all()]);

    }
}

<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserService
{
    public function store($data)
    {
        return(
            DB::transaction(function () use($data) {
                $data['password'] = bcrypt($data['password']);
                $user = User::create($data);
                $user_role = Role::where(['name' => $data['user_role']])->first();

                if($user_role){
                    $user->assignRole($user_role);
                }

                return $user;
            }, 5)
        );

    }


    public function update($data, $user)
    {
        DB::transaction(function () use($data, $user) {
            if(isset($data['password'])){
                $data['password'] = bcrypt($data['password']);
            }
            $user->update($data);
            $user->save();

            if(isset($data['user_role'])){
                $user_role = Role::where(['name' => $data['user_role']])->first();

                if($user_role){
                    $user->syncRoles($user_role);
                }
            }

        }, 5);
    }
}

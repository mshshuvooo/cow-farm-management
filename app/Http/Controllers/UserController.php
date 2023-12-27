<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegisterRequest $request, UserService $userService)
    {
        $this->authorize('validate-role', [array('admin', 'subscriber')]);
        try{
            $user_info = $userService->store($request->validated());
            return $this->success('User created successfully.', new UserResource($user_info));
        }catch (\Exception $ex) {
            return $this->error('Failed to add new user', $ex->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('validate-role', [array('admin', 'subscriber')]);
        return $this->success('User retrieved successfully.', new UserResource($user));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, UserService $userService, User $user)
    {
        $this->authorize('validate-role', [array('admin', 'subscriber')]);
        try{
            $userService->update($request->validated(), $user);
            return $this->success('User updated successfully.', new UserResource($user));
        }catch (\Exception $ex) {
            return $this->error('Failed to update the user', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

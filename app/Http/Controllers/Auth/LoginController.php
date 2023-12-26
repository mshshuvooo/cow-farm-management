<?php

namespace App\Http\Controllers\Auth;
use App\Traits\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use HttpResponse;

    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();
        } catch (ValidationException $ex) {
            return $this->error('Login failed.', $ex->getMessage(), 500);
        }

        $request->session()->regenerate();
        $user = auth()->user();

        return $this->success('Login successful', [
            'user' => new UserResource($user),
        ], 200);
    }

    public function destroy(Request $request)
    {
        //print_r(Auth::user()->tokens());
        Auth::user()->tokens()->delete();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }
}

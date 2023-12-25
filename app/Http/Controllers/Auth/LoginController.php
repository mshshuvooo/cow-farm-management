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

class LoginController extends Controller
{
    use HttpResponse;

    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();
        $user = auth()->user();
        $token = $request->user()->createToken($user->id);
        return $this->success("Login successful",[
            'user' => new UserResource($user),
            'bearer_token' => $token->plainTextToken,
            'expiry' => date("Y-m-d H:i:s",strtotime("+12 hours"))
        ],200);
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

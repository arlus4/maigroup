<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Auth\ApiRegisterRequest;

class Auth_Controller extends Controller
{
    public function register(ApiRegisterRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'users_type' => $request->users_type,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        // Menghasilkan token untuk user yang baru terdaftar
        $token = $user->createToken('API Token of ' . $user->name)->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token, 
            'message' => 'Registered successfully'
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('no_hp', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        // Jika otentikasi berhasil, buat token baru
        $token = $request->user()->createToken('api_token')->plainTextToken;

        $user = User::select('name', 'username', 'no_hp', 'users_type')
        ->where('no_hp', $request->no_hp)
        ->first();

        return response()->json([
            'user' => $user,
            'token' => $token, 
            'message' => 'Logged in successfully'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    public function check(Request $request)
    {
        return response()->json(['message' => 'Sesi masih aktif']);
    }

}

<?php

namespace App\Http\Services;

use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface  $userRepository,
    )
    {
    }

    public function register($request)
    {
        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);
        $user = $this->userRepository->store($data);
        $token = $user->createToken('auth_token')->accessToken;
        return response()->json(['user' => $user,'token' => $token], 201);
    }

    public function login($request)
    {
        $request->validated();
        if (!Auth::attempt($request->only('email', 'password')))
        {
            throw ValidationException::withMessages([
                'credentials' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->accessToken;

        return response()->json(['user' => $user,'token' => $token], 200);
    }

    public function logout($request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }
}

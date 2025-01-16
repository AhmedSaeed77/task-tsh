<?php

namespace App\Http\Services;

use App\Repository\AdminRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminService
{
    public function __construct(
        private readonly AdminRepositoryInterface  $adminRepository,
    )
    {
    }

    public function register($request)
    {
        $admin = $this->adminRepository->get('email', $request->email);
        if ($admin) {
            throw ValidationException::withMessages([
                'email' => ['The provided email is already registered.'],
            ]);
        }
        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);
        $admin = $this->adminRepository->create($data);
        $token = $admin->createToken('auth_token')->accessToken;
        return response()->json(['admin' => $admin,'token' => $token], 201);
    }

    public function login($request)
    {
        $request->validated();
        $admin = $this->adminRepository->get('email', $request->email);
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'credentials' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $admin->createToken('auth_token')->accessToken;
        return response()->json(['admin' => $admin, 'token' => $token], 200);
    }

    public function logout($request)
    {
        $token = $request->user('admin')->token();
        $token->revoke();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}

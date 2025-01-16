<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Services\UserService;

class AuthController extends Controller
{

    public function __construct(private readonly UserService $user)
    {
    }

    public function register(RegisterRequest $request)
    {
        return $this->user->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->user->login($request);
    }

    public function logout(Request $request)
    {
        return $this->user->logout($request);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterAdminRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AdminService;

class AuthAdminController extends Controller
{

    public function __construct(private readonly AdminService $admin)
    {
    }

    public function register(RegisterAdminRequest $request)
    {
        return $this->admin->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->admin->login($request);
    }

    public function logout(Request $request)
    {
        return $this->admin->logout($request);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function register(RegisterRequest $request, RegisterAction $action): \Illuminate\Http\Response
    {
        $user = $action->execute($request->getDTO());

        return response($user);
    }

    /**
     * @throws \Throwable
     */
    public function login(LoginRequest $request, LoginAction $action): \Illuminate\Http\Response
    {
        $user = $action->execute($request->getDTO());

        return response($user);
    }

    /**
     * @throws \Throwable
     */
    public function logout(LogoutRequest $request, LogoutAction $action): \Illuminate\Http\Response
    {
        return response([
            'message' => $action->execute($request),
        ]);
    }
}

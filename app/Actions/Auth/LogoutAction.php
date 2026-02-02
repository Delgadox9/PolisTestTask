<?php

namespace App\Actions\Auth;

use app\Http\Requests\Auth\LogoutRequest;

final class LogoutAction
{
    /**
     * @throws \Throwable
     */
    public function execute(LogoutRequest $request): string
    {
        return $request->user()->tokens()->delete() ? 'Успешный выход' : 'Во время выхода из аккаунта произошла ошибка';
    }
}

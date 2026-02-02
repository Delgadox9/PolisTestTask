<?php

namespace App\Actions\Auth;

use App\DTO\Auth\LoginDTO;
use App\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class LoginAction
{
    /**
     * @throws \Throwable
     */
    public function execute(LoginDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $user = User::where('email', $dto->email)->first();

            if (! $user || ! Hash::check($dto->password, $user->password)) {
                return [
                    'message' => 'Неверные данные для входа',
                ];
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => new UserResource($user),
                'token' => $token,
            ];
        });
    }
}

<?php

namespace App\Actions\Auth;

use App\DTO\Auth\RegisterDTO;
use App\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class RegisterAction
{
    /**
     * @throws \Throwable
     */
    public function execute(RegisterDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $user = User::create([
                'name' => $dto->name,
                'email' => $dto->email,
                'password' => Hash::make($dto->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => new UserResource($user),
                'token' => $token,
            ];
        });
    }
}

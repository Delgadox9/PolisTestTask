<?php

declare(strict_types=1);

namespace App\DTO\Auth;

use Illuminate\Support\Arr;

final readonly class RegisterDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $password_confirmation,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'name'),
            Arr::get($data, 'email'),
            Arr::get($data, 'password'),
            Arr::get($data, 'password_confirmation'),
        );
    }
}

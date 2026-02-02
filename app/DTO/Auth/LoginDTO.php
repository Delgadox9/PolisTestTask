<?php

declare(strict_types=1);

namespace App\DTO\Auth;

use Illuminate\Support\Arr;

final readonly class LoginDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'email'),
            Arr::get($data, 'password'),
        );
    }
}

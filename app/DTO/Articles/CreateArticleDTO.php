<?php

namespace App\DTO\Articles;

use Illuminate\Support\Arr;

class CreateArticleDTO
{
    public function __construct(
        public string $title,
        public string $content,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'title'),
            Arr::get($data, 'content'),
        );
    }
}

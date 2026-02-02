<?php

namespace App\DTO\Articles;

use Illuminate\Support\Arr;

class ShowArticleDTO
{
    public function __construct(
        public int $id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            (int) Arr::get($data, 'article', 1),
        );
    }
}

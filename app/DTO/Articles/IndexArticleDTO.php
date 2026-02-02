<?php

namespace App\DTO\Articles;

use Illuminate\Support\Arr;

class IndexArticleDTO
{
    public function __construct(
        public int $page,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            (int) Arr::get($data, 'page', 1),
        );
    }
}

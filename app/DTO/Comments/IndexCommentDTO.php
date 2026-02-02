<?php

namespace App\DTO\Comments;

use Illuminate\Support\Arr;

class IndexCommentDTO
{
    public function __construct(
        public int $page,
        public int $article,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            (int) Arr::get($data, 'page', 1),
            (int) Arr::get($data, 'article', 1),
        );
    }
}

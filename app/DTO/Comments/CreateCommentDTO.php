<?php

namespace App\DTO\Comments;

use Illuminate\Support\Arr;

/**
 * @property int $article_id
 * @property string $author_name
 * @property string $content
 */
class CreateCommentDTO
{
    public function __construct(
        public int $article_id,
        public string $author_name,
        public string $content,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'article_id'),
            Arr::get($data, 'author_name'),
            Arr::get($data, 'content'),
        );
    }
}

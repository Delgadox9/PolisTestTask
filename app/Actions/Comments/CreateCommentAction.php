<?php

namespace App\Actions\Comments;

use App\DTO\Articles\CreateArticleDTO;
use App\DTO\Comments\CreateCommentDTO;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

final class CreateCommentAction
{
    /**
     * @throws \Throwable
     */
    public function execute(CreateCommentDTO $dto): array|Comment
    {
        return DB::transaction(function () use ($dto) {
            return Comment::create([
                'article_id' => $dto->article_id,
                'author_name' => $dto->author_name,
                'content' => $dto->content,
            ]);
        });
    }
}

<?php

namespace App\Actions\Comments;

use App\DTO\Comments\IndexCommentDTO;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

final class GetCommentsAction
{
    public function execute(IndexCommentDTO $dto): array|\Illuminate\Pagination\LengthAwarePaginator
    {
        return Comment::query()->where('article_id', '=', $dto->article)->
            orderBy('created_at', 'desc')->paginate(
                perPage: 10,
                page: $dto->page
            );
    }
}

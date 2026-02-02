<?php

namespace App\Actions\Article;

use App\DTO\Articles\IndexArticleDTO;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

final class GetArticlesAction
{
    public function execute(IndexArticleDTO $dto): array|\Illuminate\Pagination\LengthAwarePaginator
    {
        return Article::query()->orderBy('updated_at', 'desc')->paginate(
            perPage: 10,
            page: $dto->page
        );
    }
}

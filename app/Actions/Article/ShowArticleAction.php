<?php

namespace App\Actions\Article;

use App\DTO\Articles\ShowArticleDTO;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

final class ShowArticleAction
{
    public function execute(ShowArticleDTO $dto): array|\Illuminate\Pagination\LengthAwarePaginator
    {
        return Article::where('id', '=', $dto->id)->first();
    }
}

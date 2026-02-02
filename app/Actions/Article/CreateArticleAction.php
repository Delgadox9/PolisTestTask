<?php

namespace App\Actions\Article;

use App\DTO\Articles\CreateArticleDTO;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

final class CreateArticleAction
{
    /**
     * @throws \Throwable
     */
    public function execute(CreateArticleDTO $dto): array|Article
    {
        return DB::transaction(function () use ($dto) {
            return Article::create([
                'title' => $dto->title,
                'content' => $dto->content,
            ]);
        });
    }
}

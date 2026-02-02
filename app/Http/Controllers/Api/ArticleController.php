<?php

namespace App\Http\Controllers\Api;

use App\Actions\Article\CreateArticleAction;
use App\Actions\Article\GetArticlesAction;
use App\Actions\Article\ShowArticleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\IndexArticleRequest;
use App\Http\Requests\Articles\ShowArticleRequest;
use App\Http\Requests\Articles\StoreArticleRequest;
use App\Resources\ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexArticleRequest $request, GetArticlesAction $action): \Illuminate\Http\JsonResponse
    {
        $paginator = $action->execute($request->getDTO());

        return ArticleResource::collection($paginator)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws \Throwable
     */
    public function store(StoreArticleRequest $request, CreateArticleAction $action): \Illuminate\Http\JsonResponse
    {
        $product = $action->execute($request->getDTO());

        return (new ArticleResource($product))->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowArticleRequest $request, ShowArticleAction $action): \Illuminate\Http\JsonResponse
    {
        $article = $action->execute($request->getDTO());

        return (new ArticleResource($article))->response();
    }
}

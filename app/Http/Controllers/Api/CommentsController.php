<?php

namespace App\Http\Controllers\Api;

use App\Actions\Comments\CreateCommentAction;
use App\Actions\Comments\GetCommentsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\IndexCommentRequest;
use App\Http\Requests\Comments\StoreCommentsRequest;
use App\Resources\CommentResource;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexCommentRequest $request, GetCommentsAction $action): \Illuminate\Http\JsonResponse
    {
        $paginator = $action->execute($request->getDTO());

        return CommentResource::collection($paginator)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws \Throwable
     */
    public function store(StoreCommentsRequest $request, CreateCommentAction $action): \Illuminate\Http\JsonResponse
    {
        $comment = $action->execute($request->getDTO());

        return (new CommentResource($comment))->response();
    }
}

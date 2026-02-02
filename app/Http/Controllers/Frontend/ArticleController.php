<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('articles/Index');
    }

    public function show(): \Inertia\Response
    {
        return Inertia::render('articles/Show');
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('articles/Create');
    }
}

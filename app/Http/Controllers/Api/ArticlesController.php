<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function show(Article $article)
    {
        return $this->success(new ArticleResource($article));
    }
}

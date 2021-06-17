<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function show(Article $article, Request $request)
    {
        $article = $article->find($request->id);
        return $this->success(!empty($article) ? new ArticleResource($article) : []);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Enums\ArticleType;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function index(Article $article)
    {
        ArticleResource::wrap('data');
        return $this->success(ArticleResource::collection(
            $article::where('type', ArticleType::FAQ)->orderBy('rank', 'asc')->get()
        ));
    }

    public function show(Article $article, Request $request)
    {
        $article = $article->find($request->id);
        return $this->success(!empty($article) ? new ArticleResource($article) : []);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->paginate(10);
        return ArticleResource::collection($articles);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'body' => 'required|min:5'
        ]);
        $article = new Article;

        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return new ArticleResource($article);
        }
    }

    public function show($id)
    {
        // Get article
        $article = Article::findOrFail($id);

        // Return single article as a resource
        return new ArticleResource($article);
    }

    public function update(Request $request, Article $article)
    {
        $this->validate($request->all(), [
            'title' => 'required|min:5',
            'body' => 'required|min:5'
        ]);
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return new ArticleResource($article);
        }
    }

    public function destroy(Article $article)
    {
        if ($article->delete()) {
            return new ArticleResource($article);
        }
    }
}

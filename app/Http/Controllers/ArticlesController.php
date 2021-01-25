<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::latest()->get();
        }

        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article)
    {
        // dd($article->tags->pluck('name'));
        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function create()
    {
        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store()
    {
        // First method:
        // $article = new Article();
        // $article->title = request('title');
        // $article->excerpt = request('excerpt');
        // $article->body = request('body');
        // $article->save();

        // Second method
        // Article::create([
        //     'title' => request('title'),
        //     'excerpt' => request('excerpt'),
        //     'body' => request('body')
        // ]);

        // Third method:
        // dd(request()->all());
        // Article::create($this->validateArticle());
        $this->validateArticle();

        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1; // hardcoded for now, later on use auth()->id()
        $article->save();

        if (request()->has('tags')) {
            $article->tags()->attach(request('tags'));
        }

        return redirect(route('articles.index'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
        $article->update($this->validateArticle());

        return redirect($article->path());
    }

    public function destroy(Article $article)
    {
        Article::destroy($article);

        return redirect('/articles');
    }

    protected function validateArticle()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    }
}

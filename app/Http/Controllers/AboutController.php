<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AboutController extends Controller
{
    public function index()
    {
        return view('about', [
            'articles' => Article::take(3)->latest()->get()
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'excerpt', 'body'];
    // protected $guarded is opposite, empty array is no protection

    public function path()
    {
        return route('articles.show', $this);
    }
}

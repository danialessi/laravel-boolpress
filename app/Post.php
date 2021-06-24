<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    // quando lavoro con i post se voglio leggere i tag si dovrà relazionare con il model Tag
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}

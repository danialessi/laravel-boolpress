<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    // lavorando con i tag se devo andare a leggere i post devo collegarmi al model 'post' 
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}

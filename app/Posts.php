<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = ['author_id', 'title', 'description', 'author_ip'];

    public $timestamps = false;
}

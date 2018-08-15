<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['post_id', 'rating'];

    public $timestamps = false;
}

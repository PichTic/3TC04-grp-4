<?php

namespace App;

use App\Answer;
use App\Visitor;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['body', 'is_published'];

    public function visitor()
    {
        return $this->hasOne('App\Visitor');
    }

    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }
}

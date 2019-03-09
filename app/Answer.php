<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $fillable = ['body'];

     public function question()
    {
        return $this->belongsTo('App\Question');
    }
}

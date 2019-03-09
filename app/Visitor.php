<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['email'];

    public function question()
    {
        return $this->hasOne('App\Question');
    }
}

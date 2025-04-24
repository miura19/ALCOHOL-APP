<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function questionChoices()
    {
        return $this->hasMany('App\Models\QuestionChoice');
    }
}

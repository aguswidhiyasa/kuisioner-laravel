<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOptionModel extends Model
{
    //
    protected $table = 'question_options';

    protected $fillable = ['option_group', 'title', 'weight', 'order'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOptionGroupModel extends Model
{
    //
    protected $table = 'question_option_group';

    protected $fillable = ['name'];

    public function questionOptions()
    {
        return $this->hasMany('App\Models\QuestionOptionModel', 'option_group', 'id');
    }

    public static function getAsSelectOptions() {
        $select = [];
        $options = self::get();
        foreach($options as $option) {
            $select[$option->id] = $option->name;
        }
        return $select;
    }
}

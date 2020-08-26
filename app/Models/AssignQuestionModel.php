<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignQuestionModel extends Model
{
    //
    protected $table = 'assign_question';

    protected $fillable = ['question_id', 'kategori_id', 'user_id'];

    public function jawabanMaster() {
        return $this->hasOne('App\Models\JawabanMasterModel', 'assigned_id', 'id');
    }
}

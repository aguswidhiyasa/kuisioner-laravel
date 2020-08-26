<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanMasterModel extends Model
{
    //
    protected $table = 'jawaban_master';
    protected $fillable = ['user_id', 'assigned_id', 'add_data'];

    public function assignedQuestion()
    {
        return $this->belongsTo('App\Models\AssignQuestionModel', 'id', 'assigned_id');
    }

    public function tandaTangan()
    {
        return $this->hasOne('App\Models\JawabanTandaTanganModel', 'jawaban_id', 'id');
    }

    public function jawabanOption()
    {
        return $this->hasMany('App\Models\JawabanOptionModel', 'jawban_id', 'id');
    }
}

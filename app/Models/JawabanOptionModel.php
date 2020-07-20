<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanOptionModel extends Model
{
    //
    protected $table = 'jawaban_option';
    protected $fillable = ['jawaban_id', 'pertanyaan_id', 'option_id'];
}

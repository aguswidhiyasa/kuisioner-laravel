<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanTandaTanganModel extends Model
{
    //
    protected $table = "jawaban_tanda_tangan";

    protected $fillable = ['jawaban_id', 'tanda_tangan'];
    
}

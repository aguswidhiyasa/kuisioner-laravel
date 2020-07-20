<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanMasterModel extends Model
{
    //
    protected $table = 'jawaban_master';
    protected $fillable = ['user_id', 'assigned_id', 'add_data'];
}

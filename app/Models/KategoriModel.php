<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    //
    protected $table = 'kategori';

    protected $fillable = ['kategori', 'deskripsi', 'option_id', 'judul', 'tambahan_info', 'template'];

    public static function getCategoryAsSelect()
    {
        $res = self::select(['id', 'kategori'])->get();

        $data = [];
        foreach ($res as $kategori) {
            $data[$kategori->id] = $kategori->kategori;
        }
        return $data;
    }

    public function optionGroup()
    {
        return $this->belongsTo('App\Models\QuestionOptionGroupModel', 'option_id', 'id');
    }
}

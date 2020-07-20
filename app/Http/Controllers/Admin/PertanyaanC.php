<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use App\Models\PertanyaanModel;
use Illuminate\Http\Request;

class PertanyaanC extends Controller
{
    //
    public function index() 
    {
        return view('admin.pertanyaan.index');
    }

    public function add()
    {
        $kategori = KategoriModel::getCategoryAsSelect();

        return view('admin.pertanyaan.add', compact('kategori'));
    }

    public function addQuestion($id = 1)
    {
        return view('admin.pertanyaan.pertanyaan-single',compact('id'));
    }

    public function store(Request $request)
    {

        $data = [];
        foreach ($request->pertanyaan as $pertanyaan) {
            $data[] = [
                'kategori_id' => $request->kategori_id,
                'pertanyaan' => $pertanyaan,
                'urutan' => 1
            ];
        }

        $res = PertanyaanModel::insert($data);

        if ($res) {
            Helpers::message('Data Berhasil disimpan');
        } else {
            Helpers::message('Data Gagal disimpan', 'error');
        }
        return response()->redirectToRoute('pertanyaan');
    }
}

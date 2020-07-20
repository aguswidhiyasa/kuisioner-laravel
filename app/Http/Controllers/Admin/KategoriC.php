<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use App\Models\QuestionOptionGroupModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriC extends Controller
{
    //
    public function index()
    {
        return view('admin.kategori.kategori');
    }

    public function data()
    {
        $kategori = KategoriModel::select([ 'id', 'kategori', 'judul' ]);

        return DataTables::of($kategori)
            ->addColumn('action', function($table) {
                return '<a href="'. route('kategori.edit', ['id' => $table->id]) .'" class="btn btn-block btn-primary btn-xs"><i class="nav-icon fas fa-pen"></i> Edit</a>'
                    . '<a href="javascript:void(0)" class="btn btn-block btn-danger btn-xs " onclick="hapus('. $table->id .', \''. $table->name .'\')"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function add()
    {
        $optionGroup = QuestionOptionGroupModel::getAsSelectOptions();

        return view('admin.kategori.add', compact('optionGroup'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required|'
        ]);

        $kategori = KategoriModel::insert([ 'kategori' => $request->kategori, 'deskripsi' => '', 'option_id' => $request->option_group ]);

        if ($kategori) {
            Helpers::message('Data Berhasil disimpan');
        } else {
            Helpers::message('Data Gagal disimpan', 'error');
        }
        return response()->redirectToRoute('kategori');
    }
}

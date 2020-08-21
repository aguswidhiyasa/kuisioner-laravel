<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use App\Models\PertanyaanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PertanyaanC extends Controller
{
    //
    public function index()
    {

        $categories = KategoriModel::getCategoryAsSelect();

        $categories = array_replace(['' => 'Semua'], $categories);

        return view('admin.pertanyaan.index', compact('categories'));
    }

    public function data(Request $request)
    {
        $pertanyaans = PertanyaanModel::select([
            'pertanyaan.id', 'pertanyaan', 'kategori.kategori'
        ])
            ->join('kategori', 'kategori.id', '=', 'pertanyaan.kategori_id');

        if (isset($request->jenis)) {
            $pertanyaans->where('kategori_id', $request->jenis);
        }

        $pertanyaans = $pertanyaans->get();

        return DataTables::of($pertanyaans)
            ->addColumn('action' ,function($table) {
                return '<a href="'. route('pertanyaan.edit', ['id' => $table->id]) .'" class="btn btn-block btn-primary btn-xs"><i class="nav-icon fas fa-pen"></i> Edit</a>'
                    . '<a href="javascript:void(0)" class="btn btn-block btn-danger btn-xs " onclick="hapus('. $table->id .', \''. $table->pertanyaan .'\')"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->rawColumns(['pertanyaan', 'action'])
            ->addIndexColumn()
            ->make(true);
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

    public function edit($id)
    {
        $kategori = KategoriModel::getCategoryAsSelect();

        $pertanyaan = PertanyaanModel::find($id);

        return view('admin.pertanyaan.edit', compact('id', 'kategori', 'pertanyaan'));
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

    public function update(Request $request) 
    {
        $this->validate($request, [
            'kategori_id'   => 'required',
            'pertanyaan'    => 'required'
        ]);

        $pertanyaan = PertanyaanModel::where('id', $request->id)->first();
        if ($pertanyaan) {
            $pertanyaan->update([
                'kategori_id' => $request->kategori_id,
                'pertanyaan' => $request->pertanyaan
            ]);

            Helpers::message('Pertanyaan Berhasil di update');
            return redirect(route('pertanyaan'));
        } else {
            Helpers::message('Pertanyaan Gagal disimpan', 'error');
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, ['id' => 'required']);

        $pertanyaan = PertanyaanModel::where('id', $request->id)->delete();

        if ($pertanyaan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pertanyaan berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Pertanyaan gagal di hapus'
            ], 500);
        }
    }
}

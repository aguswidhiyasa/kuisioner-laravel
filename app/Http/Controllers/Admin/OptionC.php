<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\QuestionOptionGroupModel;
use App\Models\QuestionOptionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OptionC extends Controller
{
    //
    public function index()
    {
        return view('admin.options.options');
    }

    public function data(Request $request)
    {
        $optionsData = QuestionOptionGroupModel::select(['id', 'name']);

        return DataTables::of($optionsData)
            ->addColumn('action', function($table) {
                return '<a href="'. route('options.edit', ['id' => $table->id]) .'" class="btn btn-block btn-primary btn-xs"><i class="nav-icon fas fa-pen"></i> Edit</a>'
                    . '<a href="javascript:void(0)" class="btn btn-block btn-danger btn-xs " onclick="hapus('. $table->id .', \''. $table->title .'\')"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function add()
    {
        return view('admin.options.add');
    }

    public function edit($id) 
    {
        $optionGroup    = QuestionOptionGroupModel::find($id);
        $options        = QuestionOptionGroupModel::find($id)->questionOptions;

        return view('admin.options.add', compact('id', 'optionGroup', 'options'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul'     => 'required'
        ]);

        $options = null;

        if (isset($request->id)) {
            $optionGroup = QuestionOptionGroupModel::find($request->id);
            $optionGroup->name = $request->judul;
            $optionGroup->save();

            $optionsCount = count($request->options);
            for ($i = 0; $i < $optionsCount; $i++) {
                $o = QuestionOptionModel::updateOrCreate([
                    'id' => isset($request->group_id[$i]) ? $request->group_id[$i] : null
                ], [
                    'option_group'  => $request->id,
                    'title'         => $request->options[$i],
                    'short_name'    => $request->short_name[$i],
                    'weight'        => $request->option_value[$i]
                ]);
            }
            // $options = true;
        } else {
            $optionGroupId = DB::table('question_option_group')->insertGetId([
                'name' => $request->judul
            ]);
    
            $optionItems = [];
            $optionSize = count($request->options);
            for ($i = 0; $i < $optionSize; $i++) {
                $optionItems[] = [
                    'option_group'  => $optionGroupId,
                    'title'         => $request->options[$i],
                    'short_name'    => $request->short_name[$i],
                    'weight'        => $request->option_value[$i]
                ];
            }
    
            $options = QuestionOptionModel::insert($optionItems);
        }

        // if ($options) {
        //     Helpers::message('Data Berhasil disimpan');
        // } else {
        //     Helpers::message('Data Gagal disimpan', 'error');
        // }
        // return response()->redirectToRoute('kategori');
    }
}

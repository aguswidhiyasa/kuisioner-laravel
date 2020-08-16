<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserC extends Controller
{
    //
    public function index()
    {
        return view('admin.users.index');
    }

    public function data(Request $request)
    {
        $penggunas = User::select(['id', 'name', 'email', 'temp_password'])
            ->where('tipe_user', '<>', 'ADMIN');

        return DataTables::of($penggunas)
            ->addColumn('mail', function($table) {
                return "<div class=\"monospace\">". $table->email ."</div>";
            })
            ->addColumn('password', function($table) {
                return "<div class=\"password\">". $table->temp_password ."</div>";
            })
            ->rawColumns(['password', 'mail'])
            ->addIndexColumn()
            ->make(true);
    }
}

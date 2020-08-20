<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignQuestionModel;
use App\Models\JawabanMasterModel;
use App\Models\JawabanOptionModel;
use App\Models\JawabanTandaTanganModel;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

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
            ->addColumn('action', function($table) {
                return "<a href=\"javascript:void(0)\" class=\"btn btn-sm btn-danger\" onclick=\"hapus(this, ". $table->id .", '". $table->name ."')\">Delete</a>";
            })
            ->rawColumns(['password', 'mail', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function adduser()
    {
        return view('admin.users.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jumlah' => 'required|numeric|min:1', 
            'jenis' => 'required'
        ]);

        // get last id user
        $lastestUser = User::orderBy('id', 'DESC')->first();
        $lastestUserId = $lastestUser->id;

        if ($request->jenis == 'ADMIN') {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan User'
            ], 501);
        }

        $users = [];
        for ($i = 1; $i <= $request->jumlah; $i++) {
            $namaLower = strtolower($request->jenis);
            $nama = ucfirst($namaLower);

            $randId = $i + $lastestUserId;

            $rand = rand(10, 1000);
            $pass = $nama . $rand;

            $users[] = [
                'name'          => $nama . $randId,
                'tipe_user'     => 'USER',
                'email'         => $nama . $randId . '@mail.com',
                'password'      => Hash::make($pass),
                'temp_password' => $pass
            ];
        }

        $insertUser = User::insert($users);

        if ($insertUser) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan ' . $request->jumlah . ' User'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan User'
            ], 501);
        }
    }

    public function delete(Request $request) 
    {
        $this->validate($request, ['id' => 'required']);

        $user = User::findOrFail($request->id);

        $mAssignQuestion = AssignQuestionModel::where('user_id', $request->id);
        $assignQuestion = $mAssignQuestion->first();

        if ($assignQuestion != null) {
            if ($assignQuestion->answered == '1') {
                $mJawabanMaster = JawabanMasterModel::where('assigned_id', $assignQuestion->id);
                $jawabanMaster = $mJawabanMaster->first();

                // remove ttd,
                $tandaTangan = JawabanTandaTanganModel::where('jawaban_id', $jawabanMaster->id)->delete();

                // remove jawabanOptions
                $jawabanOption = JawabanOptionModel::where('jawaban_id', $jawabanMaster->id)->delete();

                // remove jawaban master
                $mJawabanMaster->delete();   
            }
        }

        $mAssignQuestion->delete();
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User Berhasil di hapus'
        ]);
    }
}

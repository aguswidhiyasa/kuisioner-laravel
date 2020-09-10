<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\AssignQuestionModel;
use App\Models\JawabanMasterModel;
use App\Models\JawabanOptionModel;
use App\Models\JawabanTandaTanganModel;
use App\Models\KategoriModel;
use App\Models\QuestionOptionGroupModel;
use App\Models\QuestionOptionModel;
use App\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class QuestionnaireC extends Controller
{
    //
    public function index()
    {
        $kategori = KategoriModel::get();

        return view('admin.questionnaire.index', compact('kategori'));
    }

    public function assign($id)
    {
        $kategori = KategoriModel::find($id);

        $assignQuestion = AssignQuestionModel::
            join('users', 'assign_question.user_id', 'users.id')
            ->leftJoin('jawaban_master', 'assign_question.id', 'jawaban_master.assigned_id')
            ->where('assign_question.kategori_id', $id)
            ->orderBy('assign_question.answered', 'DESC')
            ->get();

        return view('admin.questionnaire.master', compact('assignQuestion', 'id'));
    }

    public function masterAssign()
    {
        $categories = KategoriModel::get();
        $selectCategories = KategoriModel::getCategoryAsSelect();

        $users = User::select([
            'assign_question.question_id as assign_id',
            'users.id as user_id',
            'assign_question.kategori_id as kategori_id',
            'name',
            'email',
            'answered'
        ])
            ->leftJoin('assign_question', 'users.id', 'assign_question.user_id')
            ->where('tipe_user', 'USER')
            ->where('assign_question.id', NULL)
            ->orderBy('users.id')
            ->get();

        return view('admin.questionnaire.assign', compact('categories', 'users', 'selectCategories'));
    }

    public function assignStore(Request $request)
    {
        if (isset($request->users)) {
            $toInsertUser = [];

            foreach ($request->users as $user) {
                $uid = Uuid::uuid1()->getHex();
                $toInsertUser[] = array(
                    'question_id'   => $uid,
                    'kategori_id'   => $request->jenis,
                    'user_id'       => $user,
                    'answered'      => 0
                );
            }

            $assign = AssignQuestionModel::insert($toInsertUser);

            if ($assign) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Kuisioner berhasil di tambahkan'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak dapat menambahkan kuisioner'
                ], 501);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada user yang dipilih'
            ], 501);
        }

        // if (isset($request->users)) {
        //     $availableAssign = AssignQuestionModel::where('kategori_id', $request->kategori)->get();

        //     // cari pakai bubble short 😬
        //     $dataToDelete = array();
        //     $dataToAdd = array();
        //     foreach ($availableAssign as $avail) {
        //         foreach ($request->users as $user) {
        //             if ($avail->user_id != $user) {
        //                 $dataToDelete[] = $avail->user_id;
        //             }
        //         }
        //     }

        //     $data = [];
        //     foreach ($request->users as $users) {
        //         $uid = Uuid::uuid1()->getHex();

        //         $data[] = [
        //             'question_id' => $uid,
        //             'kategori_id' => $request->kategori,
        //             'user_id' => $users,
        //             'answered' => 0
        //         ];
        //     }

        //     $assignToDelete = AssignQuestionModel::whereIn('user_id', $dataToDelete)->delete();

        //     $assign = AssignQuestionModel::insert($data);


        //     if ($assign) {
        //         Helpers::message('Data Berhasil disimpan');
        //     } else {
        //         Helpers::message('Data Gagal disimpan', 'error');
        //     }
        // } else {
        //     // de;ete
        //     $deleteNonSelectedUser = AssignQuestionModel::where('kategori_id', $request->kategori)->delete();
        //     if ($deleteNonSelectedUser) {
        //         Helpers::message('Semua pengguna berhasil di hapus');
        //     } else {
        //         Helpers::message('Terjadi Kesalahan', 'error');
        //     }
        // }
        return response()->redirectToRoute('kuisioner');
    }

    public function deAssignedQuestionnaire(Request $request)
    {
        $mAssignQuestion = AssignQuestionModel::where('question_id', $request->quisioner);
        $assignQuestion = $mAssignQuestion->first();
        if ($assignQuestion != null) {
            $mJawabanMaster = JawabanMasterModel::where('assigned_id', $assignQuestion->id);
            $jawabanMaster = $mJawabanMaster->first();

            if ($jawabanMaster != null) {
                // remove ttd,
                $tandaTangan = JawabanTandaTanganModel::where('jawaban_id', $jawabanMaster->id)->delete();

                // remove jawabanOptions
                $jawabanOption = JawabanOptionModel::where('jawaban_id', $jawabanMaster->id)->delete();

                // remove jawaban master
                $mJawabanMaster->delete();

                // assign_question update status jadi 0
                $mAssignQuestion->update([ 'answered' => 0 ]);

                Helpers::message('Kuisioner berhasil di hapus');
            } else {
                $mJawabanMaster->delete();
                $mAssignQuestion->delete();
                Helpers::message('Kuisioner berhasil di hapus');
            }
        } else {
            Helpers::message('Kuisioner tidak ditemukan', 'error');
        }
        return response()->redirectToRoute('kuisioner.assign', [ 'id' => $request->id ]);
    }

    public function downloadPDF($id)
    {
        $assignQuestion = AssignQuestionModel::where('question_id', $id)->first();

        $kategori = KategoriModel::find($assignQuestion->kategori_id);

        $optionGroup = QuestionOptionGroupModel::with('questionOptions')->first();

        $jawaban = JawabanMasterModel::select([
            'jawaban_master.id as jawaban_id', 'jawaban_master.add_data', 'jawaban_master.created_at', 'nomor'
        ])->join('assign_question', 'assign_question.id', '=', 'jawaban_master.assigned_id')
            ->where('assign_question.question_id', $id)
            ->first();

        $namaLengkap = "";

        $newInfo = array();
        $addInfo = json_decode($jawaban->add_data, true);
        foreach ($addInfo as $k => $i) {
            if ($k == 'nama_lengkap') {
                $namaLengkap = $i;
            }

            if (isset($i) && (strlen($i) > 0)) {
                //ren
                $titles = explode('_', $k);
                $newTitle = "";
                foreach ($titles as $title) {
                    $newTitle .= " " . ucfirst($title);
                }

                $newInfo[] = ['title' => $newTitle, 'value' => $i];
            }
        }

        $jawabanOption = JawabanOptionModel::join('pertanyaan', 'jawaban_option.pertanyaan_id', 'pertanyaan.id')
            ->where('jawaban_id', $jawaban->jawaban_id)->get();

        $questionOptions = QuestionOptionModel::get();

        $tandaTangan = JawabanTandaTanganModel::where('jawaban_id', $jawaban->jawaban_id)->first();

        $pdf = \PDF::loadView('admin.questionnaire.pdf', compact('assignQuestion', 'kategori', 'jawaban', 'jawabanOption', 'questionOptions', 'tandaTangan', 'newInfo', 'namaLengkap', 'optionGroup'));
        return $pdf->download($namaLengkap . '-'. $kategori->kategori .'.pdf');
    //    return view('admin.questionnaire.pdf', compact('assignQuestion', 'kategori', 'jawaban', 'jawabanOption', 'questionOptions', 'tandaTangan', 'newInfo', 'namaLengkap', 'optionGroup'));
    }

    /*
     * Fungsi untuk edit kuisioner
     * @param int $id Id Kuisioner
     * */
    public function edit($id, $question)
    {
        $assignQuestionnaire = AssignQuestionModel::where('question_id', $question)->first();
        if ($assignQuestionnaire) {
            $jm = $assignQuestionnaire->jawabanMaster;
            $nomor = explode('-', $jm->nomor);
            return response()->json(['nomor' => $nomor[1]]);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 501);
        }
    }

    public function updateNomor(Request $request)
    {
        $assignQuestionnaire = AssignQuestionModel::where('question_id', $request->questionnaireId)->first();
        if ($assignQuestionnaire) {
            $jm = JawabanMasterModel::where('assigned_id', $assignQuestionnaire->id)->first();
            $jm->nomor = $assignQuestionnaire->kategori_id . '-' . $request->idBaru;
            $jm->save();
            return response()->json([
                'message' => 'Nomor berhasil di update',
                'nomorBaru' => $assignQuestionnaire->kategori_id . '-' . $request->idBaru
            ]);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\AssignQuestionModel;
use App\Models\JawabanMasterModel;
use App\Models\JawabanOptionModel;
use App\Models\JawabanTandaTanganModel;
use App\Models\KategoriModel;
use App\Models\QuestionOptionModel;
use App\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

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

        $users = User::select([
            'assign_question.question_id as assign_id',
            'users.id as user_id',
            'name',
            'email',
            'answered'
        ])->leftJoin('assign_question', 'users.id', 'assign_question.user_id')
            ->where('tipe_user', 'USER')
            ->orderBy('users.id')
            ->get();

        return view('admin.questionnaire.assign', compact('kategori', 'id', 'users'));
    }

    public function assignStore(Request $request)
    {
        $this->validate($request, ['users[]', 'required']);

        $data = [];
        foreach ($request->users as $users) {
            $uid = Uuid::uuid1()->getHex();

            $data[] = [
                'question_id' => $uid,
                'kategori_id' => $request->kategori,
                'user_id' => $users,
                'answered' => 0
            ];
        }

        $assign = AssignQuestionModel::insert($data);

        if ($assign) {
            Helpers::message('Data Berhasil disimpan');
        } else {
            Helpers::message('Data Gagal disimpan', 'error');
        }
        return response()->redirectToRoute('kuisioner');
    }

    public function downloadPDF($id)
    {
        $assignQuestion = AssignQuestionModel::where('question_id', $id)->first();

        $kategori = KategoriModel::find($assignQuestion->kategori_id);

        $jawaban = JawabanMasterModel::select([
            'jawaban_master.id as jawaban_id'
        ])->join('assign_question', 'assign_question.id', '=', 'jawaban_master.assigned_id')
            ->where('assign_question.question_id', $id)
            ->first();

        $jawabanOption = JawabanOptionModel::join('pertanyaan', 'jawaban_option.pertanyaan_id', 'pertanyaan.id')
            ->where('jawaban_id', $jawaban->jawaban_id)->get();

        $questionOptions = QuestionOptionModel::get();

        $tandaTangan = JawabanTandaTanganModel::where('jawaban_id', $jawaban->jawaban_id)->first();

        $pdf = \PDF::loadView('admin.questionnaire.pdf', compact('assignQuestion', 'kategori', 'jawaban', 'jawabanOption', 'questionOptions', 'tandaTangan'));
        return $pdf->download('pdf');
//        return view('admin.questionnaire.pdf', compact('assignQuestion', 'kategori', 'jawaban', 'jawabanOption', 'questionOptions', 'tandaTangan'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AssignQuestionModel;
use App\Models\JawabanMasterModel;
use App\Models\JawabanOptionModel;
use App\Models\JawabanTandaTanganModel;
use App\Models\KategoriModel;
use App\Models\PertanyaanModel;
use App\Models\QuestionOptionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurveyC extends Controller
{
    //
    public function index($id)
    {
        $assignQuestion = AssignQuestionModel::where('question_id', $id)->first();

        // check if questionnaire already answered
        if ($assignQuestion->answered == '0') {
            $kategori = KategoriModel::find($assignQuestion->kategori_id);
            $pertanyaans = PertanyaanModel::where('kategori_id', $assignQuestion->kategori_id)->get();
            $questionOptions = QuestionOptionModel::where('option_group', $kategori->option_id)->get();

            return view('survey.index', compact('kategori', 'pertanyaans', 'questionOptions', 'id'));
        } else {
            return abort(404, 'Kuisioner tidak ditemukan');
        }
    }

    public function jawab(Request $request)
    {
        $questionnaireId = $request->questionnaire_id;
        $user = Auth::user();

        /// Check if survey available
        $assignedQuestionRaw = AssignQuestionModel::where('question_id', $questionnaireId);
        $assignedQuestion = $assignedQuestionRaw->first();


        if ($assignedQuestion) {
            // Marks Questionnaire already ansered
            $assignedQuestionRaw->update(['answered' => 1]);

            $jawabanMasterId = DB::table('jawaban_master')->insertGetId([
                'user_id'       => $user->id,
                'assigned_id'   => $assignedQuestion->id,
                'add_data'      => json_encode([
                    'nama_lengkap'  => $request->nama_lengkap,
                    'add_info'      => $request->add_info
                ]) 
            ]);
    
            $jawaban = [];
            foreach ($request->jawaban as $pertanyaanId => $jawab) {
                $jawaban[] = [
                    'jawaban_id' => $jawabanMasterId,
                    'pertanyaan_id' => $pertanyaanId,
                    'option_id' => (int) $jawab
                ];
            }
    
            $jawabanOption = JawabanOptionModel::insert($jawaban);
    
            $tandaTangan = JawabanTandaTanganModel::insert([
                'jawaban_id' => $jawabanMasterId,
                'tanda_tangan' => $request->signature
            ]);
        } else {
            return abort(404, "Survey tidak ditemukan");
        }
    }
}
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

            // generate field untuk additional info
            $kategoriAdditional = array();

            $katTambahan = explode(',', $kategori->tambahan_info);
            foreach ($katTambahan as $tambahan) {
                $tmbExplode = explode('_', $tambahan);
                $text = "";
                foreach ($tmbExplode as $t) {
                    $text .= " " . ucfirst($t);
                }

                $kategoriAdditional[$tambahan] = $text;
            }

            return view('survey.' . $kategori->template, compact('kategori', 'pertanyaans', 'questionOptions', 'id', 'kategoriAdditional'));
        } else {
            return redirect('home');
        // return abort(404, 'Kuisioner tidak ditemukan');
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

            $jawabanM = new JawabanMasterModel;
            $jawabanM->user_id = $user->id;
            $jawabanM->assigned_id = $assignedQuestion->id;
            $jawabanM->add_data = json_encode([
                'nama_lengkap'              => $request->nama_lengkap,
                'guru_mata_pelajaran'       => isset($request->add_info_mapel) ? $request->add_info_mapel : "",
                'kelas'                     => isset($request->add_info_kelas) ? $request->add_info_kelas : "",
                'kompetensi_keahlian'       => isset($request->add_info_kompetensi) ? $request->add_info_kompetensi : "",
            ]);
            $jawabanM->save();

            $jawabanMasterId = $jawabanM->id;

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

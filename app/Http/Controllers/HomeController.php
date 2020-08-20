<?php

namespace App\Http\Controllers;

use App\Models\AssignQuestionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();

        // get assigned questionnaire
        $assignedQuestionnaire = AssignQuestionModel::join('kategori', 'assign_question.kategori_id', '=', 'kategori.id')
            ->where('user_id', $userId)->get();

        // jika kuisioner hanya 1, redirect
        if (count($assignedQuestionnaire) == 1) {
            $questionnaire = $assignedQuestionnaire[0];
            return redirect()->route('survey', [ 'id' => $questionnaire->question_id ]);
        } else {
            return view('home', compact('assignedQuestionnaire'));
        }
    }
}

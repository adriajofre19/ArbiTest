<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;
use App\Models\Exam;

use Inertia\Inertia;

class GetDoItExamsController extends Controller
{
    public function getExamsForTheAuthUser(){

        $exams = Exam::where('user_id', Auth::id())->with('questions')->orderBy('created_at', 'desc')->get();
        
        foreach($exams as $exam){
            $exam->correct_questions = 0;
            foreach($exam->questions as $question){
                if($question->is_correct == 1){
                    $exam->correct_questions++;
                }
            }
        }

        return Inertia::render('MyExams', [
            'exams' => $exams
        ]);

        
    }
}

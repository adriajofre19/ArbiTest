<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question;
use App\Models\Exam;
use App\Models\User;

use Inertia\Inertia;

class GetSolutionsOfExamController extends Controller
{
    public function getExamSolutions($exam_id){

        $exam = Exam::where('id', $exam_id)->with('questions')->first();

        
            $exam->correct_questions = 0;
            $exam->total_questions = count($exam->questions);
            foreach($exam->questions as $question){
                $question->content = Question::getQuestionById($question->question_id);
                if($question->is_correct == 1){
                    $exam->correct_questions++;
                }
            }
        

        

        return Inertia::render('ExamSolutions', [
            'exam' => $exam
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\RedirectResponse;

use App\Models\Question;

use App\Models\Exam;
use App\Models\User;



class StoreExamController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        
        $exam = new Exam();
        $exam->name = $request->name;
        $exam->number_of_questions = $request->number_of_questions;
        $exam->number_of_correct_answers = $request->number_of_correct_answers;
        $exam->user_id = Auth::id();
        $exam->save();

        foreach ($request->preguntas as $pregunta) {
            
            $question = new Question();
            $question->exam_id = $exam->id;
            $question->question_id = $pregunta['id'];
            $question->respuesta_usuario = $pregunta['respuesta_usuario'];
            $question->respuesta_correcta = $pregunta['correcta'];

            if ($pregunta['respuesta_usuario'] == $pregunta['correcta']) {
                $question->is_correct = true;
            } else {
                $question->is_correct = false;
            }

            $question->save();
        }

        return Redirect::route('my-exams');
    }
}

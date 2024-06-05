<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Exam;
use App\Models\Question;

class TeacherController extends Controller
{
    public function index()
    {
        // retornar tots els usuaris amb els seus exàmens i preguntes
        $users = User::where('role', 'user')->with('exams.questions')->get();

        $users->map(function ($user) {
            $user->total_exams = $user->exams->count();
            $user->total_questions = 0;
            $user->correct_questions = 0;
            $user->exams->map(function ($exam) use (&$user) {
            $exam->total_questions = $exam->questions->count();
            $exam->correct_questions = 0;
            $exam->questions->map(function ($question) use (&$exam) {
                $question->content = Question::getQuestionById($question->question_id);
                if ($question->is_correct == 1) {
                $exam->correct_questions++;
                }
            });
            $user->total_questions += $exam->total_questions;
            $user->correct_questions += $exam->correct_questions;
            });
        });

        return Inertia::render('TeacherDashboard', [
            'users' => $users,
        ]);
    }

    public function getExamsFromUser($id)
    {
        $exams = Exam::where('user_id', $id)->with('questions')->get();

        $exams->map(function ($exam) {
            $exam->total_questions = $exam->questions->count();
            $exam->correct_questions = 0;
            $exam->questions->map(function ($question) use (&$exam) {
                $question->content = Question::getQuestionById($question->question_id);
                if ($question->is_correct == 1) {
                    $exam->correct_questions++;
                }
            });
        });

        return Inertia::render('TeacherUserExams', [
            'exams' => $exams,
        ]);
    }
}

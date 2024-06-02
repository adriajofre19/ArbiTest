<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Question;

class DoExamWithRdmQuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::get25Questions();
        return Inertia::render('DoExamWithRdmQuestions',
            ['questions' => $questions]
        );
    }
}

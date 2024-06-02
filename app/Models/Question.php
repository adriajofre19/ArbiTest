<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;
use App\Models\Exam;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['respuesta_usuario', 'respuesta_correcta', 'exam_id', 'question_id', 'is_correct'];

    public static function getQuestions(){
        $questions = file_get_contents((base_path('Questions.json')));
        return json_decode($questions, true);
    }

    public static function get25Questions(){
        $questions = self::getQuestions();
        $questions = collect($questions)->shuffle()->take(25);
        return $questions;
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}

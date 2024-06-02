<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;
use App\Models\User;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'number_of_questions', 'number_of_correct_answers', 'user_id'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

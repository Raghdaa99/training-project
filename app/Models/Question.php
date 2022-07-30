<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function evaluation()
    {
        return $this->hasMany(Evaluation::class, 'question_id', 'id');
    }

    public function getTotalMarksOfTrainer()
    {
        return Question::where('guard', 'trainer')->sum('max_mark');
    }

    public function getTotalMarksOfSupervisor()
    {
        return Question::where('guard', 'supervisor')->sum('max_mark');

    }
}

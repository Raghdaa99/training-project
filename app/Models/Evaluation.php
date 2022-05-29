<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    public function companyField()
    {
        return $this->belongsTo(CompanyField::class, 'company_field_id', 'id');

    }
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}

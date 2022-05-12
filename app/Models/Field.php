<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    public function studentCompanyField()
    {
        return $this->hasMany(StudentCompanyField::class, 'field_id', 'id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, CompanyField::class, 'field_id', 'company_id');
    }
}

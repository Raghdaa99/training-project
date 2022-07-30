<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyField extends Model
{
    use HasFactory;

    protected $table = 'companies_fields';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')->withDefault();
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id', 'id')->withDefault();
    }

    public function studentCompanyField()
    {
        return $this->hasMany(StudentCompanyField::class, 'company_field_id', 'id');
    }
}

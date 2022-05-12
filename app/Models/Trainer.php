<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class Trainer extends Authenticatable
{
    use HasFactory, HasRoles;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}

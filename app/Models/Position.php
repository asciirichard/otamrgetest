<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'company_id',
        'office_id',
        'department_id',
        'recruiting_category_id',
        'name',
        'employment_type_id',
        'seniority_id',
        'schedule_id',
        'years_from',
        'years_to',
        'occupation_id',
        'occupation_category_id',
        'created_at',
        'status'
    ];

}

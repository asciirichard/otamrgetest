<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Position extends Model
{
    use HasFactory, Notifiable;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'email',
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

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function office():BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function recruitingCategory():BelongsTo
    {
        return $this->belongsTo(RecruitingCategory::class, 'recruiting_category_id');
    }

    public function employmentType():BelongsTo
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type_id');
    }

    public function seniority():BelongsTo
    {
        return $this->belongsTo(Seniority::class, 'seniority_id');
    }

    public function schedule():BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function occupation():BelongsTo
    {
        return $this->belongsTo(Occupation::class, 'occupation_id');
    }

    public function occupationCategory():BelongsTo
    {
        return $this->belongsTo(OccupationCategory::class, 'occupation_category_id');
    }

    public function jobDescriptions():HasMany
    {
        return $this->hasMany(JobDescription::class, 'position_id');
    }

    public function jobKeywords():HasMany
    {
        return $this->hasMany(JobKeyword::class, 'position_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitingCategory extends Model
{
    use HasFactory;

    protected $fillable = ['recruiting_category_name'];
}

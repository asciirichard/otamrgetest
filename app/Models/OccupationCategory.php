<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccupationCategory extends Model
{
    use HasFactory;

    protected $fillable = ['occupation_category_name'];
}

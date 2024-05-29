<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobKeyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_id',
        'keyword'
    ];
}

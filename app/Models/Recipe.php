<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
    use SoftDeletes;
    use HasFactory;
}

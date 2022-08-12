<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecipeIngredient extends Model
{
    protected $fillable = [
        'order',
        'kg_quantity',
        'recipe_id',
        'ingredient_id'
    ];
    use SoftDeletes;
    use HasFactory;
}

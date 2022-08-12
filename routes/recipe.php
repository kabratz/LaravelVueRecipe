<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Recipe Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Recipe routes for your frontend. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "recipe" middleware group.
|
*/

Route::get('{path}', RecipeController::class)->where('path', '(.*)');

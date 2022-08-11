<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecipeIngredient;

class RecipeIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipe_ingredients = RecipeIngredient::all();
        return $recipe_ingredients;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        $new_recipe_ingredient = [
            'order'         => $request,
            'kg_quantity'   => 100.00,
            'recipe_id'     => 1,
            'ingredient_id' => 1
        ];

        $recipe_ingredient = new RecipeIngredient($new_recipe_ingredient);
        $recipe_ingredient->save();
        return response()->json($recipe_ingredient->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe_ingredients = RecipeIngredient::find($id);
        return $recipe_ingredients;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recipe_ingredient = RecipeIngredient::where('id', '=', $id)->update([
            'order'         => 5,
            'kg_quantity'   => 100.00,
            'recipe_id'     => 1,
            'ingredient_id' => 1
        ]);

        return $recipe_ingredient;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe_ingredient = RecipeIngredient::where('id', '=', $id)->delete();

        return $recipe_ingredient;
    }
}

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $new_recipe_ingredient = new RecipeIngredient([
            'order'         => $request->name,
            'kg_quantity'   => $request->kg_quantity,
            'recipe_id'     => $request->recipe_id,
            'ingredient_id' => $request->ingredient_id
        ]);

        $new_recipe_ingredient->save();
        return response()->json($new_recipe_ingredient->id);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($recipe_id = null, $ingredient_id = null)
    {
        if ($recipe_id)
        {
            $recipe_ingredients = RecipeIngredient::where('recipe_id', '=', $recipe_id)->get();
        }

        if ($ingredient_id)
        {
            $recipe_ingredients = RecipeIngredient::where('ingredient_id', '=', $ingredient_id)->get();
        }

        if (sizeof($recipe_ingredients))
        {
            foreach ($recipe_ingredients as $recipe_ingredient)
            {
                $ingredientController                = new IngredientController();
                $ingredient                          = $ingredientController->show($recipe_ingredient->ingredient_id);
                $recipe_ingredient->ingredient_name  = $ingredient ? $ingredient->name : 'Item inexistente ou deletado';
            }
            return $recipe_ingredients;
        }
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $recipe_ingredient = RecipeIngredient::find($id);
        $recipe_ingredient->update($request->all());

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

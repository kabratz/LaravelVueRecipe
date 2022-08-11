<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeIngredient;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        return $recipes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return($request[0]['name']);
        $recipe = new Recipe([
            'name'      => $request[0]['name'],
            'description' => $request[0]['description']
        ]);
        $recipe->save();

        foreach ($request[1] as $dataRecipeIngredient) {

            $new_recipe_ingredient = [
                'order'         => $dataRecipeIngredient['order'],
                'kg_quantity'   => $dataRecipeIngredient['quantity'],
                'recipe_id'     => $recipe->id,
                'ingredient_id' => $dataRecipeIngredient['igredient_id']
            ];

            $recipe_ingredient                = new RecipeIngredient($new_recipe_ingredient);
            $recipe_ingredient->save();

            // return ($recipe_ingredient->id);
        }
        return response()->json('Receita Salva com Sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipes = Recipe::find($id);
        return $recipes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipes = Recipe::find($id);
        return $recipes;
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
        $recipe = Recipe::where('id', '=', $id)->update([
            'description' => 'Teste2'
        ]);

        return $recipe;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::where('id', '=', $id)->delete();

        return $recipe;
    }
}

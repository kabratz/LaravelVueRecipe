<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeIngredient;

class RecipeController extends Controller
{

    /**
     * Get the recipe view.
     */
    public function __invoke()
    {
        return view('recipe');
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe = new Recipe([
            'name'        => $request[0]['name'],
            'description' => $request[0]['description']
        ]);

        $recipe->save();

        foreach ($request[1] as $dataRecipeIngredient) 
        {

            $new_recipe_ingredient = [
                'order'         => $dataRecipeIngredient['order'],
                'kg_quantity'   => $dataRecipeIngredient['kg_quantity'],
                'recipe_id'     => $recipe->id,
                'ingredient_id' => $dataRecipeIngredient['ingredient_id']
            ];

            $recipe_ingredient = new RecipeIngredient($new_recipe_ingredient);
            $recipe_ingredient->save();

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
        $recipes                    = Recipe::find($id);

        $recipeIngredientController = new RecipeIngredientController();
        $recipes->recipeIngredient  = $recipeIngredientController->search($id);
        
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
        $recipe = Recipe::find($id);
        $recipe->update($request->all());

        if ($request->recipeIngredients) 
        {
            foreach ($request->recipeIngredients as $dataRecipeIngredient) 
            {

                if (!($dataRecipeIngredient['id'])) 
                {
                    $new_recipe_ingredient = [
                        'order'         => $dataRecipeIngredient['order'],
                        'kg_quantity'   => $dataRecipeIngredient['kg_quantity'],
                        'recipe_id'     => $request->id,
                        'ingredient_id' => $dataRecipeIngredient['ingredient_id']
                    ];

                    $this->createNewRecipeIngredient($new_recipe_ingredient);
                }
            }
        }

        if ($request->recipeIngredientsDelete) 
        {
            foreach ($request->recipeIngredientsDelete as $dataRecipeIngredient) 
            {

                if (($dataRecipeIngredient['id'])) 
                {
                    $recipeIngredientController = new RecipeIngredientController();
                    $recipeIngredientController->destroy($dataRecipeIngredient['id']);
                }
            }
        }


        return response()->json('Recipe updated!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $recipeIngredient
     */
    public function createNewRecipeIngredient($recipeIngredient)
    {
        $recipe_ingredient = new RecipeIngredient($recipeIngredient);
        $recipe_ingredient->save();

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
        $recipeIngredientController = new RecipeIngredientController();
        $recipeIngredients          = $recipeIngredientController->search($id, null);

        if ($recipeIngredients) 
        {
            foreach($recipeIngredients as $recipeIngredient)
            {
                $recipeIngredientController->destroy($recipeIngredient->id);
            }
        }

        $recipe = Recipe::where('id', '=', $id)->delete();

        return $recipe;
    }
}

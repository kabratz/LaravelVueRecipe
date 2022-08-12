<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::get(['id', 'name', 'description']);
        return response()->json($ingredients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingredient = new Ingredient(['name' => $request->input('name'), 'description' => $request->input('description')]);
        $ingredient->save();

        return response()->json('Ingredient created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingredients = Ingredient::find($id);
        return $ingredients;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $ingredient = $request;

        $ingredient = Ingredient::find($ingredient->id);
        $ingredient->update($request->all());
        return response()->json('Ingredient updated!');
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
        $recipeIngredient           = $recipeIngredientController->search(null, $id);

        if ($recipeIngredient)
        {
            $response['status']  = 0;
            $response['message'] = 'Ingredient can\'t be deleted!';

        }
        else
        {
            $ingredient          = Ingredient::where('id', '=', $id)->delete();

            $response['status']  = 1;
            $response['message'] = 'Ingredient deleted!';
        }


        return response()->json($response);
    }
}

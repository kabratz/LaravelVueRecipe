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
        return response()->json ($ingredients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $new_ingredient = $request->description;

        $ingredient = new Ingredient($new_ingredient);

        $ingredient->save();

        return($ingredient);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingredient = new Ingredient(['name' => $request->input('name'),'description' => $request->input('description')]);
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
    public function update(Request $request)
    {
        
        $ingredient = $request;
        
        
        if ($ingredient->id)
        {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required'
            ]);
            $ingredient = Ingredient::where('id', '=', $ingredient->id)->update($request->only('name'), $request->only('description'));
            return response()->json($ingredient);
        }
        return ($this->create($request));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::where('id', '=', $id)->delete();

        return $ingredient;
    }
}

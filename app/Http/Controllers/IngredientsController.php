<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuantityTypesRef;
use App\Ingredient;
use Validator;

class IngredientsController extends Controller
{
    public function show() {
        $ingredients = new Ingredient;
        $ingredients = $ingredients->getAllIngredients();
        return view('products.ingredients.index')->with([
            'ingredients' => $ingredients
        ]);
    }

    public function add() {
    	$quantityTypes = QuantityTypesRef::all();
    	return view('products.ingredients.add')->with([
    		'quantityTypes' => $quantityTypes
    	]);
    }

    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'actual_quantity' => 'required|numeric',
            'expected_quantity' => 'required|numeric',
            'quantity_type' => 'required|numeric'
        ]);

        $attributeNames = array(
           'quantity_type' => 'quantity type',
           'actual_quantity' => 'actual quantity',
           'expected_quantity' => 'expected quantity'
        );

        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ingredient = Ingredient::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'actual_quantity' => $request['actual_quantity'],
            'expected_quantity' => $request['expected_quantity'],
            'quantity_type_id' => $request['quantity_type']
        ]);

        return redirect('/ingredients/'.$ingredient->id)->with('notification', 'The ingredient has been created.');
    }

    public function edit($id) {
        $ingredient = Ingredient::find($id);
        $quantityTypes = QuantityTypesRef::all();

    	return view('products.ingredients.edit')->with([
    		'ingredient' => $ingredient,
            'quantityTypes' => $quantityTypes
    	]);
    }

    public function update(Request $request, $id) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'actual_quantity' => 'required|numeric',
            'expected_quantity' => 'required|numeric',
            'quantity_type' => 'required|numeric'
        ]);

        $attributeNames = array(
           'quantity_type' => 'quantity type',
           'actual_quantity' => 'actual quantity',
           'expected_quantity' => 'expected quantity'
        );

        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update Ingredient Table
        $ingredient = Ingredient::find($id);
        $ingredient->name = $request['name'];
        $ingredient->description = $request['description'];
        $ingredient->actual_quantity = $request['actual_quantity'];
        $ingredient->expected_quantity = $request['expected_quantity'];
        $ingredient->quantity_type_id = $request['quantity_type'];
        $ingredient->save();

        return redirect()->back()->with('notification', 'The ingredient has been updated.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuantityTypesRef;
use App\Ingredient;

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
            'quantity_type' => 'required|numeric',
            'category' => 'required|numeric',
            'product_code' => 'required|string|max:255',
            'subnames.*' => 'required|string|max:255',
            'subprices.*' => 'required|numeric|digits_between:1,6',
            'subquantities.*' => 'required|numeric'
        ]);

        $attributeNames = array(
           'subnames.*' => 'subcategory name',
           'subprices.*' => 'subprice',
           'subquantities.*' => 'subquantity',
           'quantity_type' => 'quantity type',
           'product_code' => 'product code',
           'actual_quantity' => 'actual quantity',
           'expected_quantity' => 'expected quantity'
        );

        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'actual_quantity' => $request['actual_quantity'],
            'expected_quantity' => $request['expected_quantity'],
            'quantity_type_id' => $request['quantity_type'],
            'category_id' => $request['category'],
            'product_code' => $request['product_code']
        ]);

        $keys = array_keys($request['submenuId']);

        foreach($keys as $key) {
            $product->productDetails()->create([
                'name' => $request['subnames.'.$key],
                'price' => $request['subprices.'.$key],
                'quantity' => $request['subquantities.'.$key]
            ]);
        }

        return redirect('/details/'.$product->id)->with('notification', 'The product has been created.');
    }

    public function edit($id) {
        $product = new Product;
    	$product = $product->getProduct($id);
        $productSubmenus = ProductDetail::where('product_id', $id)->get();
        $categories = CategoriesRef::all();
        $quantityTypes = QuantityTypesRef::all();

    	return view('products.details.edit')->with([
    		'product' => $product,
            'productSubmenus' => $productSubmenus,
            'categories' => $categories,
            'quantityTypes' => $quantityTypes
    	]);
    }

    public function update(Request $request, $id) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'actual_quantity' => 'required|numeric',
            'expected_quantity' => 'required|numeric',
            'quantity_type' => 'required|numeric',
            'category' => 'required|numeric',
            'product_code' => 'required|string|max:255',
            'subnames.*' => 'required|string|max:255',
            'subprices.*' => 'required|numeric|digits_between:1,6',
            'subquantities.*' => 'required|numeric'
        ]);

        $attributeNames = array(
           'subnames.*' => 'subcategory name',
           'subprices.*' => 'subprice',
           'subquantities.*' => 'subquantity',
           'quantity_type' => 'quantity type',
           'product_code' => 'product code',
           'actual_quantity' => 'actual quantity',
           'expected_quantity' => 'expected quantity'
        );

        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update Product Table
        $product = Product::find($id);
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->actual_quantity = $request['actual_quantity'];
        $product->expected_quantity = $request['expected_quantity'];
        $product->quantity_type_id = $request['quantity_type'];
        $product->category_id = $request['category'];
        $product->product_code = $request['product_code'];
        $product->save();

        // Delete
        if ($request['deletes']) {
            foreach ($request['deletes'] as $delete) {
                $product->productDetails()->where('id',$delete)->delete($request['deletes']);
            }
        }

        // Update or Create Product Details
        $keys = array_keys($request['subnames']);
        foreach ($keys as $key) {
            $product->productDetails()->updateOrCreate(
                [
                    'name' => $request['subnames.'.$key],
                    'quantity' => $request['subquantities.'.$key]
                ],
                [
                    'name' => $request['subnames.'.$key],
                    'quantity' => $request['subquantities.'.$key],
                    'price' => $request['subprices.'.$key]
                ]
            );
        }

        return redirect()->back()->with('notification', 'The product has been updated.');
    }
}

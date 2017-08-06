<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
use App\CategoriesRef;
use App\QuantityTypesRef;
use Validator;

class ProductDetailsController extends Controller
{
    public function show() {
    	$products = new Product;
    	$products = $products->getAllProducts();
    	return view('products.details.index')->with([
    		'products' => $products
    	]);
    }

    public function add() {
    	$categories = CategoriesRef::all();
    	$quantityTypes = QuantityTypesRef::all();
    	return view('products.details.add')->with([
    		'categories' => $categories,
    		'quantityTypes' => $quantityTypes
    	]);
    }

    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'percentage' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DiscountsRef::create($request->all());

        return redirect()->back()->with('notification', 'The discount has been created.');
    }

    public function edit($id) {
    	$discount = DiscountsRef::find($id);
    	return view('products.details.edit')->with([
    		'discount' => $discount
    	]);
    }

    public function update(Request $request, $id) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'percentage' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $discount = DiscountsRef::find($id);
        $discount->name = $request['name'];
        $discount->description = $request['description'];
        $discount->percentage = $request['percentage'];
        $discount->save();

        return redirect()->back()->with('notification', 'The discount has been updated.');
    }
}

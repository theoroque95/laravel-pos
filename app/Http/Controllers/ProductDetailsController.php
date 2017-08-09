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
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required|string|max:255',
            'actual_quantity' => 'required|numeric',
            'expected_quantity' => 'required|numeric',
            'quantity_type' => 'required|numeric',
            'category' => 'required|numeric',
            'product_code' => 'required|string|max:255|unique:products',
            'subnames.*' => 'required|string|max:255',
            'subprices.*' => 'required|numeric',
            'subquantities.*' => 'required|numeric'
        ]);

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

        $submenu = sizeof($request['subname']) - 1;

        while($submenu >= 0) {
            $product->productDetails()->create([
                'name' => $request['subnames.'.$submenu],
                'price' => $request['subprices.'.$submenu],
                'quantity' => $request['subquantities.'.$submenu]
            ]);
            $submenu--;
        }

        return redirect()->back()->with('notification', 'The product has been created.');
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
            'subprices.*' => 'required|numeric',
            'subquantities.*' => 'required|numeric'
        ]);

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
        if (sizeof($request['deletes']) > 0) {
            $productDetail = ProductDetail::destroy($request['deletes']);
        }

        // Update or Create Product Details
        $keys = array_keys($request['subnames']);
        foreach ($keys as $key) {
            $productDetail = ProductDetail::updateOrCreate(
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

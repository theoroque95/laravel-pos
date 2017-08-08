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
            'subname.*' => 'required|string|max:255',
            'subprice.*' => 'required|numeric',
            'subquantity.*' => 'required|numeric'
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
                'name' => $request['subname.'.$submenu],
                'price' => $request['subprice.'.$submenu],
                'quantity' => $request['subquantity.'.$submenu]
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

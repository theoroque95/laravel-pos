<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriesRef;
use App\Product;
use App\ProductDetail;

class CashierController extends Controller
{
    public function show() {
    	$categories = CategoriesRef::all();
		return view('pages.cashier')->with([
    		'categories' => $categories
    	]);;
	}

	public function getMenuProducts(Request $request) {
    	$products = Product::where('category_id', $request['categoryId'])->get();
		$response = [ 'products' => $products ];
		return response()->json($response);
	}

	public function getMenuSubmenus(Request $request) {
    	$product = Product::find($request['productId']);
		$response = [
			'submenus' => $product->productDetails,
			'acronym' => $product->quantityType->acronym
		];
		return response()->json($response);
	}

	public function submitTransaction(Request $request) {
		dd($request->all());
	}
}

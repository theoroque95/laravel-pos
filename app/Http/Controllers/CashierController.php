<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriesRef;
use App\Product;
use App\ProductDetail;
use App\User;
use App\Sales;
use App\SalesProduct;
use App\Ingredient;
use App\Traits\ReceiptTrait;
use Hash;

class CashierController extends Controller
{
	use ReceiptTrait;

    public function show() {
    	$categories = CategoriesRef::all();
    	$ingredients = Ingredient::all();
		return view('pages.cashier')->with([
    		'categories' => $categories,
    		'ingredients' => $ingredients
    	]);;
	}

	public function getMenuProducts(Request $request) {
    	$products = Product::where('category_id', $request['categoryId'])->get();
		$response = [ 'products' => $products ];
		return response()->json($response);
	}

	public function getMenuSubmenus(Request $request) {
    	$product = Product::find($request['productId']);
    	$saleQuantity = [];
    	$ingredients = [];

    	foreach($product->productDetails as $productDetail) {
	    	$productIngredients = [];
	    	$productSaleQuantity = [];

    		foreach($productDetail->ingredients as $key => $ingredient) {
				array_push($productSaleQuantity, (int)$ingredient->pivot->sale_quantity);
    			array_push($productIngredients, $ingredient->id);
    		}

    		array_push($saleQuantity, $productSaleQuantity);
    		array_push($ingredients, $productIngredients);
    	}

		$response = [
			'submenus' => $product->productDetails,
			'acronym' => $product->quantityType->acronym,
			'saleQuantity' => $saleQuantity,
			'ingredients' => $ingredients
		];

		return response()->json($response);
	}

	public function submitTransaction(Request $request) {
		// Temporary (find)
    	$user = User::find(1);
    	// $user = Auth::user();

    	$receipt = $this->setReceiptNo();
    	$order = $this->setOrderNo();

    	$sale = $user->sales()->create([
			'receipt_id' => $receipt->id,
			'order_no' => $order,
			'total' => $request['total'],
			'tendered' => $request['tendered'],
	        'vat' => $request['vat']
		]);

    	$noOfItems = 0;
    	$products = [];
    	$productDetails = [];
    	$productQuantities = [];

    	foreach($request['productSubmenus.*'] as $key => $productSubmenu) {
    		$productDetailIdArg = explode('-', $productSubmenu);
    		$productDetailId = $productDetailIdArg[2];
    		$product = new Product;
    		$quantity = $request['productQuantities.'.$key];
    		$deductQuantity = 0;

    		$sale->salesProducts()->create([
	    		'product_detail_id' => $productDetailId,
	    		'quantity' => $request['productQuantities.'.$key]
	    	]);

	    	$productDetail = ProductDetail::find($productDetailId);

	    	// Deduct Ingredient
	    	foreach($productDetail->ingredients as $productIngredient) {
	    		while ($deductQuantity < $quantity) {
	    			$productIngredient->actual_quantity = $productIngredient->actual_quantity - $productIngredient->pivot->sale_quantity;
		    		$productIngredient->save();

		    		$deductQuantity++;
	    		}
	    	}

	    	array_push($productDetails, $productDetail);
	    	array_push($products, $product->getProduct($productDetail->product_id));
	    	array_push($productQuantities, $request['productQuantities.'.$key]);

	    	$noOfItems += (int)$quantity;
    	}

    	$sale->count_item = $noOfItems;
    	$sale->save();

    	$response = array(
			'receipt_no' => $receipt->receipt_no,
			'order_no' => $sale->order_no,
			'total' => $sale->total,
			'vat' => $sale->vat,
			'tendered' => $sale->tendered,
			'cashier' => $user->first_name,
			'noOfItems' => $sale->count_item,
			'products' => $products,
			'productDetails' => $productDetails,
			'productQuantities' => $productQuantities
		);

    	return response()->json($response);
	}

	public function voidSale(Request $request) {
		$orderNo = $request['orderNo'];
		$sale = Sales::where('order_no', $orderNo)->first();

		// Get Admin password
		$user = User::find(1);
		if ( ! Hash::check($request['password'], $user->password)) {
			return response()->json(['error' => 'Admin Password is incorrect'], 422);
        }
        elseif (!$sale) {
        	return response()->json(['error' => 'Sale does not exist'], 422);
        }

        $salesProducts = SalesProduct::where('sales_id', $sale->id)->get();
        foreach($salesProducts as $saleProduct) {
            $saleProduct->delete();
        }
        $sale->delete();

		return response()->json(['notification' => 'Sale # '.$orderNo.' is successfully voided'], 200);

	}
}

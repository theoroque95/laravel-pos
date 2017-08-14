<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\CategoriesRef;
use App\DiscountsRef;
use App\QuantityTypesRef;
use App\Ingredient;

class DeleteController extends Controller
{
    public function delete(Request $request) {
    	$id = $request['id'];
    	$form = $request['form'];

    	switch ($form) {
    		case 'product':
    			$product = Product::find($id);
    			// Delete details of product
    			$product->productDetails()->delete();
    			// Delete product
    			$product->delete();
    			break;
    		case 'staff':
    			// Delete user
    			$user = User::find($id);
    			$user->delete();
    			break;
			case 'category':
    			$category = CategoriesRef::find($id);
				//Delete products and details related to category
    			$products = $category->products;
    			foreach ($products as $product) {
    				$product->productDetails()->delete();
	    			$product->delete();
    			}
				//Delete category
    			$category->delete();
    			break;
    		case 'discount':
    			// Delete user
    			$discount = DiscountsRef::find($id);
    			$discount->delete();
    			break;
            case 'quantity':
                // Delete quantity type
                $quantity = QuantityTypesRef::find($id);
                $quantity->delete();
                break;
            case 'ingredient':
                // Delete ingredient
                $ingredient = Ingredient::find($id);
                $ingredient->delete();
                break;
    		default:
    			# code...
    			break;
    	}

    	return redirect()->back()->with('notification', 'The '.$form.' has been deleted.');
    }
}

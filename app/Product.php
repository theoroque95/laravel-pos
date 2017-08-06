<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'actual_quantity', 'expected_quantity', 'quantity_type_id', 'category_id', 'product_code',
    ];

    /**
     * Relate the category of the product.
     */
    public function category() {
        return $this->belongsTo('App\CategoriesRef', 'id', 'category_id');
    }

    /**
     * Relate the category of the product.
     */
    public function quantityType() {
        return $this->belongsTo('App\QuantityTypeRef', 'quantity_type_id');
    }

    /**return 
     * Relate the product details of the product.
     */
    public function productDetails() {
        return $this->hasMany('App\ProductDetail');
    }

    /**return 
     * Get all products to be displayed in product details index
     */

    public function getAllProducts() {
        return Product::select('products.name', 'products.description', 'products.actual_quantity', 'products.expected_quantity', DB::raw('round(actual_quantity/expected_quantity, 2)*100 as available_amount'), 'products.description', 'quantity_types_ref.name as quantity_type_name', 'quantity_types_ref.acronym','categories_ref.name as category_name')
                    ->join('categories_ref', 'products.category_id', 'categories_ref.id')
                    ->join('quantity_types_ref', 'products.quantity_type_id', 'quantity_types_ref.id')
                    ->get();
    }
}

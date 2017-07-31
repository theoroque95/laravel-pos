<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * Get the category of the product.
     */
    public function category() {
        return $this->belongsTo('App\CategoriesRef', 'id', 'category_id');
    }

    /**
     * Get the category of the product.
     */
    public function quantityType() {
        return $this->belongsTo('App\QuantityTypeRef', 'quantity_type_id');
    }

    /**
     * Get the product details of the product.
     */
    public function productDetails() {
        return $this->hasMany('App\ProductDetail', 'product_id', 'id');
    }

    /**
     * TODO:
     *	1. Get all products that are 20% less than expected : Yellow signal
     *	2. Get all products that are 5% less than expected : Red signal
     */
}

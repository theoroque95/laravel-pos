<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'product_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'name', 'quantity', 'quantity_type_id', 'price',
    ];

    /**
     * Get the products for a sale.
     */
    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function ingredients() {
        return $this->belongsToMany('App\Ingredient', 'ingredient_product_detail', 'product_detail_id', 'ingredient_id')
                    ->withTimestamps()
                    ->withPivot('sale_quantity');
    }
}

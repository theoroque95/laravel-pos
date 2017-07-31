<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'name', 'description', 'quantity', 'price',
    ];

    /**
     * Get the products for a sale.
     */
    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}

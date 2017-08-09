<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sales extends Model
{
    protected $table = 'sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'receipt_no', 'order_no', 'total', 'tendered', 'discount_id',
    ];

    /**
     * Get the products for a sale.
     */
    public function salesProducts() {
        return $this->hasMany('App\SalesProduct', 'sales_id', 'id');
    }

    /**
     * Get the discount for a sale.
     */
    public function discount() {
        return $this->belongsTo('App\DiscountsRef', 'discount_id');
    }

    /**
     * Get the user for a sale.
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get real time sales from 00:00 of day up to current time
     */
    public function getSalesCurrentTime() {
        //
    }

    /**
     * Get real time number of orders from 00:00 of day up to current time
     */
    public function getOrdersCurrentTime() {
        //
    }

    /**
     * Get real time sales from previous hour to current time
     */
    public function getSalesHour() {
        //
    }

    /**
     * Get real time number of products sold from 00:00 of day up to current time
     */
    public function getProductsSoldCurrentTime() {
        //
    }
}
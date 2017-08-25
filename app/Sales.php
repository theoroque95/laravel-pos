<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Sales extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'receipt_id', 'order_no', 'total', 'tendered', 'discount_id', 'vat', 'count_item',
    ];

    /**
     * Get the products for a sale.
     */
    public function salesProducts() {
        return $this->hasMany('App\SalesProduct', 'sales_id', 'id');
    }

    /**
     * Get the products for a sale.
     */
    public function receipt() {
        return $this->belongsTo('App\SalesProduct', 'receipt_id');
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
    public function getSalesRealtime() {
        return Sales::withTrashed()->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::now())->get();
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

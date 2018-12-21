<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB;

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

    public $timestamps = true;

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
     * Get all sales
     */
    public function getSalesAll() {
        $grandTotal = Sales::withTrashed()
        ->sum('total');

        $list = Sales::withTrashed()
        ->select('users.first_name', 'users.last_name', 'sales.*', 'discounts_ref.name as discount_name', 'discounts_ref.percentage as discount_percentage', 'receipt_logs.receipt_no')
        ->join('users', 'users.id', 'sales.user_id')
        ->join('receipt_logs', 'receipt_logs.id', 'sales.receipt_id')
        ->leftJoin('discounts_ref', 'discounts_ref.id', 'sales.discount_id')
        ->get();
        
        return [
            'list' => $list,
            'grand_total' => $grandTotal
        ];
    }

    /**
     * Get real time sales from start of day 00:00 to current time
     */
    public function getSalesDay() {
        $grandTotal = Sales::withTrashed()
        ->where('sales.created_at', '>=', Carbon::today())
        ->where('sales.created_at', '<=', Carbon::now())
        ->sum('total');
        
        $list = Sales::withTrashed()->select('users.first_name', 'users.last_name', 'sales.*', 'discounts_ref.name as discount_name', 'discounts_ref.percentage as discount_percentage', 'receipt_logs.receipt_no')
        ->join('users', 'users.id', 'sales.user_id')
        ->join('receipt_logs', 'receipt_logs.id', 'sales.receipt_id')
        ->leftJoin('discounts_ref', 'discounts_ref.id', 'sales.discount_id')
        ->where('sales.created_at', '>=', Carbon::today())
        ->where('sales.created_at', '<=', Carbon::now())
        ->get();
        
        return [
            'list' => $list,
            'grand_total' => $grandTotal
        ];
    }

    /**
     * Get real time sales from previous hour to current time
     */
    public function getSalesWeek() {
        $grandTotal = Sales::withTrashed()
        ->where('sales.created_at', '>=', Carbon::now()->subWeek())
        ->where('sales.created_at', '<=', Carbon::now())
        ->sum('total');
        
        $list = Sales::withTrashed()->select('users.first_name', 'users.last_name', 'sales.*', 'discounts_ref.name as discount_name', 'discounts_ref.percentage as discount_percentage', 'receipt_logs.receipt_no')
        ->join('users', 'users.id', 'sales.user_id')
        ->join('receipt_logs', 'receipt_logs.id', 'sales.receipt_id')
        ->leftJoin('discounts_ref', 'discounts_ref.id', 'sales.discount_id')
        ->where('sales.created_at', '>=', Carbon::now()->subWeek())
        ->where('sales.created_at', '<=', Carbon::now())
        ->get();
        
        return [
            'list' => $list,
            'grand_total' => $grandTotal
        ];
    }

    /**
     * Get real time sales from previous hour to current time
     */
    public function getSalesMonth() {
        $grandTotal = Sales::withTrashed()
        ->where('sales.created_at', '>=', Carbon::now()->subWeek())
        ->where('sales.created_at', '<=', Carbon::now())
        ->sum('total');
        
        $list = Sales::withTrashed()->select('users.first_name', 'users.last_name', 'sales.*', 'discounts_ref.name as discount_name', 'discounts_ref.percentage as discount_percentage', 'receipt_logs.receipt_no')
        ->join('users', 'users.id', 'sales.user_id')
        ->join('receipt_logs', 'receipt_logs.id', 'sales.receipt_id')
        ->leftJoin('discounts_ref', 'discounts_ref.id', 'sales.discount_id')
        ->where('sales.created_at', '>=', Carbon::now()->subMonth())
        ->where('sales.created_at', '<=', Carbon::now())
        ->get();
        
        return [
            'list' => $list,
            'grand_total' => $grandTotal
        ];
    }

    /**
     * Get all items sold per sale
     */
    public function getItemsAll() {
        $items = Sales::select('sales.order_no', 'rl.receipt_no', 'u.first_name', 'p.name as product', 'cr.name as category', 'pd.name as subcategory', 'pd.quantity', 'qtr.acronym', 'pd.price', 'sales.created_at')
        ->join('sales_products as sp', 'sp.sales_id', 'sales.id')
        ->join('product_details as pd', 'pd.id', 'sp.product_detail_id')
        ->join('products as p', 'p.id', 'pd.product_id')
        ->join('categories_ref as cr', 'cr.id', 'p.category_id')
        ->join('quantity_types_ref as qtr', 'qtr.id', 'p.quantity_type_id')
        ->join('users as u', 'u.id', 'sales.user_id')
        ->join('receipt_logs as rl', 'rl.id', 'sales.receipt_id')
        ->get();

        $top = Sales::select(DB::raw('count(p.id) as orders , p.name as product'))
        ->join('sales_products as sp', 'sp.sales_id', 'sales.id')
        ->join('product_details as pd', 'pd.id', 'sp.product_detail_id')
        ->join('products as p', 'p.id', 'pd.product_id')
        ->groupBy('p.id')
        ->orderByDesc('orders')
        ->get();

        return [
            'list' => $items,
            'top' => $top
        ];
    }

    /**
     * Get real time number of orders from 00:00 of day up to current time
     */
    public function getOrdersCurrentTime() {
        return  Sales::withTrashed()->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::now())->count();
    }

    /**
     * Get real time number of products sold from 00:00 of day up to current time
     */
    public function getProductsSoldCurrentTime() {
        return Sales::withTrashed()->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::now())->sum('count_item');
    }

    public function getProductsPerSales($id) {
        $sales = Sales::withTrashed()->select('p.*', 'pd.id as pd_id', 'pd.name as pd_name', 'pd.quantity as pd_quantity', 'pd.price as pd_price', 'sp.quantity as sp_quantity')->join('sales_products as sp', 'sp.sales_id', 'sales.id')->join('product_details as pd', 'pd.id', 'sp.product_detail_id')->join('products as p', 'p.id', 'pd.product_id')->where('sales.id', $id)->get();
    }
}

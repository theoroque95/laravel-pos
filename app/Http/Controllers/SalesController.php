<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\SalesProduct;
use App\QuantityTypesRef;
use App\ProductDetail;
use App\Product;
use App\ReceiptLog;
use App\ReportLog;
use App\ReportRef;
use App\DiscountsRef;
use App\Traits\ReceiptTrait;

class SalesController extends Controller
{
	use ReceiptTrait;

	public function show() {
		$sales = Sales::withTrashed()
		->select('users.first_name', 'users.last_name', 'sales.*', 'discounts_ref.name as discount_name', 'discounts_ref.percentage as discount_percentage', 'receipt_logs.receipt_no')
		->join('users', 'users.id', 'sales.user_id')
		->join('receipt_logs', 'receipt_logs.id', 'sales.receipt_id')
		->leftJoin('discounts_ref', 'discounts_ref.id', 'sales.discount_id')
		->get();

		return view('reports.sales.index')->with([
			'sales' => $sales
		]);
	}
}

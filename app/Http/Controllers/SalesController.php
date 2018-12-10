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

	public function show(Request $request) {
		$table = $request->table;
		$salesArg = new Sales;
		$active = '';

		if (!$table) {
			$sales = $salesArg->getSalesAll()['list'];
			$grandTotal = $salesArg->getSalesAll()['grand_total'];
			$active = 'none';
		}
		else if ($table == 'day') {
			$sales = $salesArg->getSalesDay()['list'];
			$grandTotal = $salesArg->getSalesDay()['grand_total'];
		}
		else if ($table == 'week') {
			$sales = $salesArg->getSalesWeek()['list'];
			$grandTotal = $salesArg->getSalesWeek()['grand_total'];
		}
		else if ($table == 'month') {
			$sales = $salesArg->getSalesMonth()['list'];
			$grandTotal = $salesArg->getSalesMonth()['grand_total'];
		}
		
		return view('reports.sales.index')->with([
			'sales' => $sales,
			'grand_total' => $grandTotal,
			'table' => $table
		]);
	}
}

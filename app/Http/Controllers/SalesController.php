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
			$sales = $salesArg->getSalesAll();
			$active = 'none';
		}
		else if ($table == 'realtime') {
			$sales = $salesArg->getSalesRealtime();
		}
		else if ($table == 'hour') {
			$sales = $salesArg->getSalesHour();
		}
		else if ($table == 'week') {
			$sales = $salesArg->getSalesWeek();
		}
		else if ($table == 'month') {
			$sales = $salesArg->getSalesMonth();
		}

		return view('reports.sales.index')->with([
			'sales' => $sales,
			'table' => $table
		]);
	}
}

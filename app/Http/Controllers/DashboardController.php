<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;

class DashboardController extends Controller
{
	public function show() {
		$sales = new Sales;
		// $salesCurrentTime = $sales->getSalesCurrentTime();
		// $ordersCurrentTime = $sales->getOrdersCurrentTime();
		return view('pages.index');
	}
}

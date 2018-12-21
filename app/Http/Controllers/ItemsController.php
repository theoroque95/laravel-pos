<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;

class ItemsController extends Controller
{
    public function show(Request $request) {
		$table = $request->table;
		$sales = new Sales;
		$active = '';
		
		if (!$table) {
			$items = $sales->getItemsAll()['list'];
			$top = $sales->getItemsAll()['top'];
			$active = 'none';
		}
		else if ($table == 'day') {
			$items = $sales->getItemsAll();
		}
		else if ($table == 'week') {
			$items = $sales->getItemsAll();
		}
		else if ($table == 'month') {
			$items = $sales->getItemsAll();
		}
		
		return view('reports.items.index')->with([
			'items' => $items,
			'top'	=> $top,
			'table' => $table
		]);
	}
}

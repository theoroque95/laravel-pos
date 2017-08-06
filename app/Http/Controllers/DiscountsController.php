<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiscountsRef;
use Validator;

class DiscountsController extends Controller
{
    public function show() {
    	$discounts = DiscountsRef::all();
    	return view('discounts.index')->with([
    		'discounts' => $discounts
    	]);
    }

    public function add() {
    	return view('discounts.add');
    }

    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'percentage' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DiscountsRef::create($request->all());

        return redirect()->back()->with('notification', 'The discount has been created.');
    }

    public function edit($id) {
    	$discount = DiscountsRef::find($id);
    	return view('discounts.edit')->with([
    		'discount' => $discount
    	]);
    }

    public function update(Request $request, $id) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'percentage' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $discount = DiscountsRef::find($id);
        $discount->name = $request['name'];
        $discount->description = $request['description'];
        $discount->percentage = $request['percentage'];
        $discount->save();

        return redirect()->back()->with('notification', 'The discount has been updated.');
    }
}

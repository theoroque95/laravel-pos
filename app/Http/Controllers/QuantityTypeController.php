<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuantityTypesRef;
use Validator;

class QuantityTypeController extends Controller
{
	public function show() {
    	$quantityTypes = QuantityTypesRef::all();
    	return view('quantitytypes.index')->with([
    		'quantityTypes' => $quantityTypes
    	]);
    }

    public function add() {
    	return view('quantitytypes.add');
    }

    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'acronym' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quantityType = QuantityTypesRef::create($request->all());

        return redirect('/quantitytypes/'.$quantityType->id)->with('notification', 'The quantity type has been created.');
    }

    public function edit($id) {
    	$quantityType = QuantityTypesRef::find($id);
    	return view('quantitytypes.edit')->with([
    		'quantityType' => $quantityType
    	]);
    }

    public function update(Request $request, $id) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'acronym' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quantitytype = QuantityTypesRef::find($id);
        $quantitytype->name = $request['name'];
        $quantitytype->description = $request['description'];
        $quantitytype->percentage = $request['percentage'];
        $quantitytype->save();

        return redirect()->back()->with('notification', 'The quantity type has been updated.');
    }
}

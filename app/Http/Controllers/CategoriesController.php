<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriesRef;
use Validator;

class CategoriesController extends Controller
{
    public function show() {
    	$categories = CategoriesRef::all();
    	return view('products.categories.index')->with([
    		'categories' => $categories
    	]);
    }

    public function add() {
    	return view('products.categories.add');
    }

    public function create(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = CategoriesRef::create($request->all());

        return redirect('/categories/'.$category->id)->with('notification', 'The category has been added.');
    }

    public function edit($id) {
    	$category = CategoriesRef::find($id);
    	return view('products.categories.edit')->with([
    		'category' => $category
    	]);
    }

    public function update(Request $request, $id) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = CategoriesRef::find($id);
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->save();

        return redirect()->back()->with('notification', 'The category has been updated.');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Ingredient extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'ingredients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name', 'description', 'actual_quantity', 'expected_quantity', 'quantity_type_id',
    ];

    /**return
     * Get all ingredients to be displayed in ingredient table
     */
    public function getAllIngredients() {
        return Ingredient::select('ingredients.*', DB::raw('round(actual_quantity/expected_quantity, 2)*100 as available_amount'), 'ingredients.description', 'quantity_types_ref.name as quantity_type_name', 'quantity_types_ref.acronym')
                    ->join('quantity_types_ref', 'ingredients.quantity_type_id', 'quantity_types_ref.id')
                    ->get();
    }

    public function productDetails() {
        return $this->belongsToMany('App\ProductDetail', 'ingredient_product_detail', 'ingredient_id', 'product_detail_id')
                    ->withTimestamps()
                    ->withPivot('sale_quantity');
    }
}

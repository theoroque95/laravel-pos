<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesRef extends Model
{
    protected $table = 'categories_ref';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Get the products associated with a category.
     */
    public function products() {
        return $this->hasMany('App\Products', 'category_id', 'id');
    }
}

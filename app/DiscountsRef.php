<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountsRef extends Model
{
    protected $table = 'discounts_ref';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'percentage',
    ];

    /**
     * Get the sales associated with a discount.
     */
    public function sales() {
        return $this->hasMany('App\Sales', 'discount_id', 'id');
    }
}

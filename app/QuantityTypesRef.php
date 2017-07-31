<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuantityTypesRef extends Model
{
    protected $table = 'quantity_types_ref';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'acronym',
    ];
}

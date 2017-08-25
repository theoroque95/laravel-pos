<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptLog extends Model
{
	use SoftDeletes;

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'receipt_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receipt_no',
    ];

    /**
     * Get the sales associated with a discount.
     */
    public function sale() {
        return $this->hasOne('App\Sales', 'receipt_id');
    }

    /**
     * Get the sales associated with a discount.
     */
    public function report() {
        return $this->hasOne('App\Report', 'receipt_id');
    }
}

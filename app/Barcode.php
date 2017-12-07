<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    protected $table = "barcode";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_name', 'region', 'product_name', 'product_date', 'expired_date', 'selling_date',
    ];
}

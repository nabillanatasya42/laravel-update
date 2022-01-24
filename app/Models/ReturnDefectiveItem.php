<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnDefectiveItem extends Model
{
    protected $fillable = [
    	'category_id','product_quantity','product_price'
    ];
}

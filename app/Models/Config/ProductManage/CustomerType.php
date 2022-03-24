<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $table ="customer_types";

    protected $fillable = [
        'name', 'discount', 'status'
    ];
}

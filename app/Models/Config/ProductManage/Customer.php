<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
        'customer_type_id', 'code', 'name', 'email', 'mobile', 'address', 'status'
    ];
}

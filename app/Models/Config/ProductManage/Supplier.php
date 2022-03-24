<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "suppliers"; 

    protected $fillable = [
        'code', 'name', 'email', 'mobile', 'bank_name', 'account_no', 'address', 'status'
    ];
}

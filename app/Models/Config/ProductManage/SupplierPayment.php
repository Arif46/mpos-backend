<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $table = "supplier_payments";

    protected $fillable = [
        'supplier_id' , 'amount', 'payment_date'
    ];
}

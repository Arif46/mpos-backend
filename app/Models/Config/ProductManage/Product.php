<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table= "products";

    protected $fillable = [
        'category_id', 'sub_category_id', 'brand_id', 'unit_id', 'code', 'name', 'buying_price', 'selling_price', 'min_stock',
        'photo', 'status' 
    ];
}

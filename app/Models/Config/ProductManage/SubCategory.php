<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = "sub_categories";

    protected $fillable = [
        'category_id', 'name', 'status', 'created_at', 'updated_at'
    ];
}

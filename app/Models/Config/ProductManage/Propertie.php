<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class Propertie extends Model
{
    protected $table = "properties"; 

    protected $fillable = [
        'name', 'value','status'
    ];
}

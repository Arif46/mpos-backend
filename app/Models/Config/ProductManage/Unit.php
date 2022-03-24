<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table= "units";

    protected $fillable = [
        'name', 'status'
    ];
}

<?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   protected $table = "brands";

   protected $fillable = [
        'name', 'status'
   ];
}

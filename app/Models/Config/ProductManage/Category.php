  <?php

namespace App\Models\Config\ProductManage;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";


    protected $fillable = [
        'name'
    ];
}

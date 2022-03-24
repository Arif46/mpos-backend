<?php

namespace App\Http\Validations\Configuration\ProductManagement;

use Validator;

class SubCategoryValidation
{
  public static function validate($request, $id = 0) 
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required|integer',
      'name'     => 'required'
    ]);

    if ($validator->fails()) {
        return([
            'success' => false,
            'errors'  => $validator->errors()
        ]);
    }

    return ['success'=>true];
  }
}
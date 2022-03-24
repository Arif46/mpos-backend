<?php

namespace App\Http\Validations\Configuration\ProductManagement;

use Validator;

class ProductValidation
{
  /**
   * Product Validation
   */
  public static function validate($request, $id= 0)
   {
      $validator = Validator::make($request->all(), [
        'category_id'      => 'required|integer',
        'sub_category_id'  => 'required|integer',
        'brand_id'    => 'required|integer',
        'unit_id'     => 'required|integer',
        'code'        => 'required|string',
        'name'        => 'required|string',
        'buying_price'         => 'required',
        'selling_price'        => 'required',
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
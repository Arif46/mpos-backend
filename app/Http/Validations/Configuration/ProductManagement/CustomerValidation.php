<?php

namespace App\Http\Validations\Configuration\ProductManagement;

use Validator;

class CustomerValidation
{
  /**
   * Customer Validation
   */
  public static function validate($request, $id= 0)
   {
      $validator = Validator::make($request->all(), [
        'customer_type_id'     => 'required|integer',
        'code'     => 'required',
        'name'     => 'required|string|max:255',
        'mobile'   => 'required|min:11'
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
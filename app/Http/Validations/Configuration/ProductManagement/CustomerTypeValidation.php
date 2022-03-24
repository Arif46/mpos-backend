<?php

namespace App\Http\Validations\Configuration\ProductManagement;

use Validator;

class CustomerTypeValidation
{
  /**
   * Customer Type Validation
   */
  public static function validate($request, $id= 0)
   {
      $validator = Validator::make($request->all(), [
        'name'     => 'required',
        'discount' => 'required'
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
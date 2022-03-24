<?php

namespace App\Http\Validations\Configuration\ProductManagement;

use Validator;

class PropertieValidation
{
  /**
   * Propertie Validation
   */
  public static function validate($request, $id= 0)
   {
      $validator = Validator::make($request->all(), [
        'name'     => 'required',
        'value'     => 'required'
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
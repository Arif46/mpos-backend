<?php

namespace App\Http\Validations\Configuration\ProductManagement;

use Validator;

class SupplierValidation
{
  /**
   * Supplier Validation
   */
  public static function validate($request, $id= 0)
   {
      $validator = Validator::make($request->all(), [
        'name'     => 'required',
        'code'     => 'required',
        'mobile'     => 'required|min:11'
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
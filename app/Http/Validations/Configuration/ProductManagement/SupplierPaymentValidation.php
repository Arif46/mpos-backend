<?php

namespace App\Http\Validations\Configuration\ProductManagement;

use Validator;

class SupplierPaymentValidation
{
  /**
   * Brand Validation
   */
  public static function validate($request, $id= 0)
   {
      $validator = Validator::make($request->all(), [
        'supplier_id'     => 'required|integer',
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
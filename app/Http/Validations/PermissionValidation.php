<?php 
 
namespace App\Http\Validations;

use Validator;

class  PermissionValidation
{
    /**
     * Master Country
     */
    public static function validate($request ,$id =0)
    {
		$validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        if ($validator->fails()) {
            return ([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        return ['success' => true];
    }
} 
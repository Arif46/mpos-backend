<?php 
 
namespace App\Http\Validations;

use Validator;

class  BranchValidation
{
    /**
     * Master Country
     */
    public static function validate($request ,$id =0)
    {
		$validator = Validator::make($request->all(), [
            'name' => 'required|unique:branches,name,' . $id,

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
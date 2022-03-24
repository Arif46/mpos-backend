<?php 
 
namespace App\Http\Validations;

use Validator;

class  SettingValidation 
{
    /**
     * Master Country
     */
    public static function validate($request ,$id =0)
    {
        
        $validator = Validator::make($request->all(), [
            'refer_bonus' => 'required',
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
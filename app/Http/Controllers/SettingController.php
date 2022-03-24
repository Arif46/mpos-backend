<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Validations\SettingValidation;
use Illuminate\Http\Request;
use PDOException;

class SettingController extends Controller
{

    public function update(Request $request) {

        $validationResult = SettingValidation:: validate($request);

        if (!$validationResult['success']) {
            return response($validationResult);
        }

        try {
            
            $Setting = Setting::first();

            $Setting->update($request->all());

            return respondWithSuccess('Setting updated successfully');

        } catch (PDOException $e) {
            
            return respondWithError($e->getMessage(), 422);
        }
    }

    public function destroy($id) {

        try {

            Setting::find($id)->delete();

            return respondWithSuccess('Setting deleted successfully');
            
        } catch (PDOException $e) {
            
            return respondWithError($e->getMessage(), 422);
        }
    }
    public function show() {

        try {
 
             $Setting = Setting::first();
 
             return respondWithSuccess('Setting fetched successfully', $Setting);
            
        } catch (PDOException $e) {
            
             return respondWithError($e->getMessage(), 422);
        } 
     }
    public function toggleStatus(Request $request, $id)
    {
        $Setting = Setting::find($id);

        if (!$Setting) {
            return response([
                'success' => false,
                'message' => 'Data not found.'
            ]);
        }

        $Setting->status = $request->status;
        $Setting->update();
        $message = $Setting->status === 1 ? 'Setting block succesfully.' : 'Setting active successfully.';
        return response([
            'success' => true,
            'message' => $message,
            'data'    => $Setting
        ]);
    }
}

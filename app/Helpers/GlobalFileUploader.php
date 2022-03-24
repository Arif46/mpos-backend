<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;


class GlobalFileUploader
{

  /*Check Dir Permission*/
    public static function checkAndSetDirPermission($directory){
        if (is_dir($directory)) {
            self::checkPermission($directory);
            return true;
        } else {
            self::makeDirectory($directory);
            return true;
        }

    }

    /*Make Diretory*/
    protected static function makeDirectory($directory){
        File::makeDirectory($directory, 0777, true, true);

        return true;
    }

    /*Check Permission*/
    protected static function checkPermission($directory){
        if (is_writable($directory))
        {
            return true;
        } else {
            self::setPermission($directory);
            return true;
        }
    }

    /** Set Permission */
    protected static function setPermission($directory){
        if (!is_dir($directory)){
            File::makeDirectory($directory, 0777, true, true);
            return true;
        }

        return false;
    }

    /**
     * Validate files
     * 
     * @return validation errors or file names
     */
    public static function validateFilesAndReturnFilePath($request, $file_path, $uploads_name){
        $file = $request->file($uploads_name);
        $rules = array( $uploads_name => 'required|mimes:png,gif,jpeg,svg,tiff,pdf,doc,docx,tex,txt,rtf');        
        $validator = Validator::make(array($uploads_name => $file), $rules);
        
        if ($validator->passes()) {
            $file_name =time().'.' . $file->getClientOriginalExtension();            
            //$file_name    = storage_path('uploads/'.$file_path.'original/').$file_original_name;         
        }

        if ($validator->fails()) {
            return ([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }        
        
        return $file_name;  
    }

    /**
     * This method should be used in multiple file upload system.
     * It will store files in a temporary location and will be moved to the original destination
     * while main form submitted by calling movedTemporaryFiles
     */
    public static function uploadSingleFile($request, $destinationPath = 'tmp-uploads')
    {
        $finalDestinationPath = storage_path($destinationPath);

        if (!$request->hasFile('custom_file')) {
            return [
                'success' => false,
                'message' => 'File not found.'
            ];
        }

        self::checkAndSetDirPermission($finalDestinationPath);
        $file = $request->file('custom_file');     
        $ext = $file->getClientOriginalExtension();
        $originalFileName = $file->getClientOriginalName();
        
        $customFileName = rand(100000, 999999) . time() . '.' . $ext;

        $file->move($finalDestinationPath, $customFileName);  

        return [
            'success' => true,
            'data' => [
                'customFileName' => $customFileName,
                'originalFileName' => $originalFileName,
                'fileFullPath' => $destinationPath . '/' . $customFileName
            ]
        ];
    }

    /**
     * Delete an existing file.
     * 
     * @param $filePath
    */
    public static function deleteUploadedFile($filePath) {
        $fileTargetPath = storage_path($filePath);         
        
        if (empty($fileTargetPath)) {
            return false;
        }
        
        if (!file_exists($fileTargetPath)) {
            return false;
        }

        unlink($fileTargetPath);

        return true;
    }

    public static function fileMove($filePath, $destinationPath)
    {
        $finalDestinationPath = storage_path($destinationPath);
        self::checkAndSetDirPermission($finalDestinationPath);
        $destinationFilePath = $finalDestinationPath . str_ireplace('tmp-uploads', '', $filePath);
        File::move(storage_path($filePath), $destinationFilePath);
        return $destinationPath. str_ireplace('tmp-uploads', '', $filePath);
    }

}
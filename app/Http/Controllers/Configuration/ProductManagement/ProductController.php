<?php

namespace App\Http\Controllers\Configuration\ProductManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Validations\Configuration\ProductManagement\ProductValidation;
use App\Models\Config\ProductManage\Product;
use App\Helpers\GlobalFileUploadFunctoin;

class ProductController extends Controller
{
    /**
     * Product List
     */
    public function index(Request $request)
    {
        try {

            $query = Product::query();
    
            if (request()->category_id ) {
                $query->where('category_id ', request()->category_id);
            }

            if (request()->sub_category_id  ) {
                $query->where('sub_category_id  ', request()->sub_category_id);
            }

            if (request()->brand_id) {
                $query->where('brand_id', request()->brand_id);
            }

            if (request()->unit_id ) {
                $query->where('unit_id ', request()->unit_id);
            }
    
            if (request()->status) {
                $query->where('status', request()->status);
            }
    
            $list = $query->paginate(10);
    
            return response([
                'success' => true,
                'message' => 'Product List',
                'data' => $list
            ]);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationResult = ProductValidation::validate($request);

        if (!$validationResult['success']) {
            return response($validationResult);
        }

        $file_path 	   = 'uploads/photo';
        $photo         = $request->file('photo');

        try {
            $model = Product::create($request->all());
            if($photo != null && $photo != ""){
                $photo = GlobalFileUploadFunctoin::file_validation_and_return_file_name($request, $file_path,'photo');
            }

            $model->photo     = !empty($photo) ? $photo : null;
            GlobalFileUploadFunctoin::file_upload($request, $file_path, 'photo', $photo);

            return response([
                'success' => true,
                'message' => 'Data save successfully',
                'data'    => $model
            ]);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validationResult = ProductValidation::validate($request, $id);

        if (!$validationResult['success']) {
            return response($validationResult);
        }

        $file_path 	   = 'uploads/photo';
        $photo         = $request->file('photo');

        

        try {

            $model = Product::find($id);
            $old_file_photo = $model->photo;
            if (!$model) {
                return response([
                    'success' => false,
                    'message' => 'Data not found.'
                ]);
            }
    
            $requestAll = $request->all();
            $model->fill($requestAll);
            
            if($photo != null && $photo != ""){
                $photo = GlobalFileUploadFunctoin::file_validation_and_return_file_name($request, $file_path,'photo');
            }
            
            $model->save();

            $model->photo  = $photo ?? $old_file_photo;
            GlobalFileUploadFunctoin::file_upload($request, $file_path, 'photo', $photo, $old_file_photo);
    
            return response([
                'success' => true,
                'message' => 'Data update successfully',
                'data'    => $model
            ]);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }

    /**
     * Update the status in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($id)
    {
        try {

            $model = Product::find($id);
    
            if (!$model) {
                return response([
                    'success' => false,
                    'message' => 'Data not found.'
                ]);
            }
            
            $model->status = $model->status == 1 ? 0 : 1;
            $model->update();
            return response([
                'success' => true,
                'message' => 'Data updated successfully',
                'data'    => $model
            ]);
        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Product::find($id);

        if (!$model) {
            return response([
                'success' => false,
                'message' => 'Data not found.'
            ]);
        }

        $model->delete();

        return response([
            'success' => true,
            'message' => 'Data deleted successfully'
        ]);
    }
}

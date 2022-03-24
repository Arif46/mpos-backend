<?php

namespace App\Http\Controllers\Configuration\ProductManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Validations\Configuration\ProductManagement\SupplierValidation;
use App\Models\Config\ProductManage\Supplier;

class SupplierController extends Controller
{
     /**
     * Supplier List
     */
    public function index(Request $request)
    {
        try {

            $query = Supplier::query();
    
            if (request()->name) {
                $query->where('name', request()->name);
            }

            if (request()->mobile) {
                $query->where('mobile', request()->mobile);
            }
    
            if (request()->status) {
                $query->where('status', request()->status);
            }
    
            $list = $query->paginate(10);
    
            return response([
                'success' => true,
                'message' => 'Supplier List',
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
        $validationResult = SupplierValidation::validate($request);

        if (!$validationResult['success']) {
            return response($validationResult);
        }

        try {
            $model = Supplier::create($request->all());

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
        $validationResult = SupplierValidation::validate($request, $id);

        if (!$validationResult['success']) {
            return response($validationResult);
        }
        try {

            $model = Supplier::find($id);
    
            if (!$model) {
                return response([
                    'success' => false,
                    'message' => 'Data not found.'
                ]);
            }
    
            $requestAll = $request->all();
            $model->fill($requestAll);
            $model->save();
    
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

            $model = Supplier::find($id);
    
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
        $model = Supplier::find($id);

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

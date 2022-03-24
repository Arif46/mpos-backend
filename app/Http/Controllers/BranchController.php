<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Http\Validations\BranchValidation;
use DB;
use Exception;

class BranchController extends Controller
{
    
    public function index(Request $request)
    {
        try {
            $query = Branch::query();
            if ($request->name) {
                $query->where('name', $request->name);
            }
            $data = $query->orderBy('id','DESC')->paginate(10);
            return respondWithSuccess('Users fetched successfully', $data, 200);
        } catch (\Exception $e) {
            return respondWithSuccess($e->message(), [], 500);
        }
        
    }

    public function store(Request $request)
    {
        $vaidator = BranchValidation::validate($request);
        if (!$vaidator['success']) {
            return response($vaidator);
        }

        try {

            $model = Branch::create($request->all());
            return respondWithSuccess('Branch create successfully', $model, 200);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $vaidator = BranchValidation::validate($request, $id);
        if (!$vaidator['success']) {
            return response($vaidator);
        }

        try {
            $model = Branch::find($id);
            $model->update($request->all());
            return respondWithSuccess('Branch update successfully', $model, 200);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }


    
    public function destroy($id)
    {
        try {
            $model = Branch::find($id);
            $model->status = $model->status == 1 ? 0 : 1; 
            $model->save();
            $message = $model->status == 1 ? 'Branch active successfully.' : 'Branch inactive successfully.'; 
            return respondWithSuccess($message, $model, 200);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }
   
}

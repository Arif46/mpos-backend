<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Http\Validations\StationValidation;
use DB;
use Exception;

class StationController extends Controller
{
    
    public function index(Request $request)
    {
        try {
            $query = Station::query();
            if ($request->branch_id) {
                $query->where('branch_id', $request->branch_id);
            }
            if ($request->name) {
                $query->where('name', $request->name);
            }
            $data = $query->orderBy('id','DESC')->paginate(10);
            return respondWithSuccess('Station fetched successfully', $data, 200);
        } catch (\Exception $e) {
            return respondWithSuccess($e->message(), [], 500);
        }
        
    }

    public function store(Request $request)
    {
        $vaidator = StationValidation::validate($request);
        if (!$vaidator['success']) {
            return response($vaidator);
        }

        try {

            $model = Station::create($request->all());
            return respondWithSuccess('Station create successfully', $model, 200);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $vaidator = StationValidation::validate($request, $id);
        if (!$vaidator['success']) {
            return response($vaidator);
        }

        try {
            $model = Station::find($id);
            $model->update($request->all());
            return respondWithSuccess('Station update successfully', $model, 200);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }


    
    public function destroy($id)
    {
        try {
            $model = Station::find($id);
            $model->status = $model->status == 1 ? 0 : 1; 
            $model->save();
            $message = $model->status == 1 ? 'Station active successfully.' : 'Station inactive successfully.'; 
            return respondWithSuccess($message, $model, 200);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }
   
}

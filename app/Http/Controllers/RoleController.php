<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Validations\RoleValidation;
use DB;


class RoleController extends Controller
{
    

    public function index(Request $request)
    {
        try {
            $query = Role::with('permissions');
            if ($request->name) {
                $query->where('name', $request->name);
            }
            $data = $query->orderBy('id','DESC')->paginate(10);
            return respondWithSuccess('Data fetched successfully', $data, 200);
        } catch (\Exception $e) {
            return respondWithSuccess($e->message(), [], 500);
        }
        
    }

    public function store(Request $request)
    {
        $vaidator = RoleValidation::validate($request);
        if (!$vaidator['success']) {
            return response($vaidator);
        }
        DB::beginTransaction();
        try {
            $model = Role::create(['name' => $request->name]);
            $model->syncPermissions($request->input('permission'));
            DB::commit();
            return respondWithSuccess('Permission create successfully', $model, 200);
        } catch (PDOException $e) {
            DB::rollback();
            return respondWithError($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $vaidator = RoleValidation::validate($request, $id);
        if (!$vaidator['success']) {
            return response($vaidator);
        }
        DB::beginTransaction();
        try {
            $model = Role::find($id);
            $model->name = $request->input('name');
            $model->save();
            $model->syncPermissions($request->input('permission'));
            DB::commit();
            return respondWithSuccess('Permission update successfully', $model, 200);
        } catch (PDOException $e) {
            DB::rollback();
            return respondWithError($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $model = Permission::find($id);
            $model->status = $model->status == 1 ? 0 : 1; 
            $model->save();
            $message = $model->status == 1 ? 'Permission active successfully.' : 'Permission inactive successfully.'; 
            return respondWithSuccess($message, $model, 200);

        } catch (PDOException $e) {
            return respondWithError($e->getMessage(), 500);
        }
    }

}

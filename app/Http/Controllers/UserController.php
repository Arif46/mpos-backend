<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Exception;
use Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth){
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        $data = User::with(['roles'=>function($query){ $query->select('name'); }])->orderBy('id','DESC')->paginate(10);
        return respondWithSuccess('Users fetched successfully', $data);
    }

	public function user(Request $request)
    {
        return response()->json([
			'success'=>true,
			'data'=>$request->user()
		]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $input = $request->except('roles');
        $plainPassword = $request->input('password');
        $input['password'] = app('hash')->make($plainPassword);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return respondWithSuccess('Users create successfully',[],201);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);


        $input = $request->except('roles');
        if(!empty($input['password'])){
            $plainPassword = $request->input('password');
            $input['password'] = app('hash')->make($plainPassword);
        }else{
            $input = $request->except('password');
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return respondWithSuccess('User update successfully',[],201);

    }

    public function logout() {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
                'success'=>true
            ]);
    }
    public function getAllPermissionsAttribute() {
        $permissions = [];
        foreach (Permission::all() as $permission) {
        if (Auth::user()->can($permission->name)) {
            $permissions[] = $permission->name;
        }
        }
        return $permissions;
    }
}

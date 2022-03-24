<?php
namespace App\Library;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use DB;

class DropDowns
{
    public static function permissions() {
        $permissions = [];
        foreach (Permission::all() as $permission) {
        if (Auth::user()->can($permission->name)) {
            $permissions[] = $permission->name;
        }
        }
        return $permissions;
    }
    public static function stationList()
    {
        return DB::table('stations')->select('id as value', 'name as text')->get();
    }
    public static function branchList()
    {
        return DB::table('branches')->select('id as value', 'name as text')->get();
    }
    public static function permissionList()
    {
        return DB::table('permissions')->select('name as value', 'name as text')->get();
    }
    public static function roleList()
    {
        return DB::table('roles')->select('name as value', 'name as text')->get();
    }
    public static function categoryList()
    {
        return DB::table('categories')->select('id as value', 'name as text')->get();
    }
    public static function subCategoryList()
    {
        return DB::table('sub_categories')->select('id as value', 'name as text', 'category_id')->get();
    }
    public static function brandList()
    {
        return DB::table('brands')->select('id as value', 'name as text')->get();
    }
    public static function unitList()
    {
        return DB::table('units')->select('id as value', 'name as text')->get();
    }
    public static function propertieList()
    {
        return DB::table('properties')->select('id as value', 'name as text', 'value')->get();
    }
    public static function customerList()
    {
        return DB::table('customers')->select('id as value', 'name as text', 'customer_type_id', 'code')->get();
    }
    public static function customerTypeList()
    {
        return DB::table('customer_types')->select('id as value', 'name as text')->get();
    }
    public static function supplierList()
    {
        return DB::table('suppliers')->select('id as value', 'name as text')->get();
    }
}

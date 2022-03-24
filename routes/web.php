<?php
use Illuminate\Support\Facades\Route;


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'middleware' => 'auth',
    'prefix' => 'api'

], function ($router) {
    $router->get('user', 'UserController@user');
    
	$router->group(['prefix' => 'users'], function ($router) {
        $router->get('/list', 'UserController@index');
        $router->post('/store', 'UserController@store');
        $router->put('/update/{id}','UserController@update');
        $router->delete('/delete/{id}', 'UserController@destroy');
	});

	$router->group(['prefix' => 'branch'], function ($router) {
        $router->get('/list', 'BranchController@index');
        $router->post('/store', 'BranchController@store');
        $router->put('/update/{id}','BranchController@update');
        $router->delete('/delete/{id}', 'BranchController@destroy');
	});

	$router->group(['prefix' => 'station'], function ($router) {
        $router->get('/list', 'StationController@index');
        $router->post('/store', 'StationController@store');
        $router->put('/update/{id}','StationController@update');
        $router->delete('/delete/{id}', 'StationController@destroy');
	});

	$router->group(['prefix' => 'permission'], function ($router) {
        $router->get('/list', 'PermissionController@index');
        $router->post('/store', 'PermissionController@store');
        $router->put('/update/{id}','PermissionController@update');
        $router->delete('/delete/{id}', 'PermissionController@destroy');
	});

	$router->group(['prefix' => 'role'], function ($router) {
        $router->get('/list', 'RoleController@index');
        $router->post('/store', 'RoleController@store');
        $router->put('/update/{id}','RoleController@update');
        $router->delete('/delete/{id}', 'RoleController@destroy');
	});
});


$router->group([
    'prefix' => 'api'
], function ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
});

Route::get('api/common-dropdowns', function () {
    return response([
        'success' => true,
        'data' => [
            'permissions' => \App\Library\DropDowns::permissions(),
            'branchList' => \App\Library\DropDowns::branchList(),
            'stationList' => \App\Library\DropDowns::stationList(),
            'permissionList' => \App\Library\DropDowns::permissionList(),
            'roleList' => \App\Library\DropDowns::roleList(),
            'categoryList' => \App\Library\DropDowns::categoryList(),
            'subCategoryList' => \App\Library\DropDowns::subCategoryList(),
            'brandList' => \App\Library\DropDowns::brandList(),
            'unitList' => \App\Library\DropDowns::unitList(),
            'propertieList' => \App\Library\DropDowns::propertieList(),
            'customerList' => \App\Library\DropDowns::customerList(),
            'customerTypeList' => \App\Library\DropDowns::customerTypeList(),
            'supplierList' => \App\Library\DropDowns::supplierList()
        ]
    ]);
});

require('api.php');
include('configuration.php');
<?php
use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
  return $router->app->version();
});

$router->group([
  'middleware' => 'auth',
  'prefix' => 'api'

], function ($router) {
  Route::group(['prefix' => '/configuration', 'namespace' => 'Configuration'], function () { 

        Route::group(['prefix' => '/product-management', 'namespace' => 'ProductManagement'], function () {

          // Category Routes...
          Route::group(['prefix' => '/category'], function () {
            Route::get('/list', 'CategoryController@index');
            Route::post('/store', 'CategoryController@store');
            Route::put('/update/{id}', 'CategoryController@update');
            Route::delete('/toggle-status/{id}', 'CategoryController@toggleStatus');
            Route::delete('/destroy/{id}', 'CategoryController@destroy');
          });
   
          // SubCategory Routes...
          Route::group(['prefix' => '/sub-category'], function () {
            Route::get('/list', 'SubCategoryController@index');
            Route::post('/store', 'SubCategoryController@store');
            Route::put('/update/{id}', 'SubCategoryController@update');
            Route::delete('/toggle-status/{id}', 'SubCategoryController@toggleStatus');
            Route::delete('/destroy/{id}', 'SubCategoryController@destroy');
          });

          // Brand Routes...
          Route::group(['prefix' => '/brand'], function () {
            Route::get('/list', 'BrandController@index');
            Route::post('/store', 'BrandController@store');
            Route::put('/update/{id}', 'BrandController@update');
            Route::delete('/toggle-status/{id}', 'BrandController@toggleStatus');
            Route::delete('/destroy/{id}', 'BrandController@destroy');
          });

          // Unit Routes...
          Route::group(['prefix' => '/unit'], function () {
            Route::get('/list', 'UnitController@index');
            Route::post('/store', 'UnitController@store');
            Route::put('/update/{id}', 'UnitController@update');
            Route::delete('/toggle-status/{id}', 'UnitController@toggleStatus');
            Route::delete('/destroy/{id}', 'UnitController@destroy');
          });

          // Propertie Routes...
          Route::group(['prefix' => '/propertie'], function () {
            Route::get('/list', 'PropertiesController@index');
            Route::post('/store', 'PropertiesController@store');
            Route::put('/update/{id}', 'PropertiesController@update');
            Route::delete('/toggle-status/{id}', 'PropertiesController@toggleStatus');
            Route::delete('/destroy/{id}', 'PropertiesController@destroy');
          });

          //Product Routes...
          Route::group(['prefix' => '/product'], function () {
            Route::get('/list', 'ProductController@index');
            Route::post('/store', 'ProductController@store');
            Route::put('/update/{id}', 'ProductController@update');
            Route::delete('/toggle-status/{id}', 'ProductController@toggleStatus');
            Route::delete('/destroy/{id}', 'ProductController@destroy');
          });

            // Customer Type Routes...
            Route::group(['prefix' => '/customer-type'], function () {
              Route::get('/list', 'CustomerTypeController@index');
              Route::post('/store', 'CustomerTypeController@store');
              Route::put('/update/{id}', 'CustomerTypeController@update');
              Route::delete('/toggle-status/{id}', 'CustomerTypeController@toggleStatus');
              Route::delete('/destroy/{id}', 'CustomerTypeController@destroy');
            });

              // Customer  Routes...
              Route::group(['prefix' => '/customer'], function () {
                Route::get('/list', 'CustomerController@index');
                Route::post('/store', 'CustomerController@store');
                Route::put('/update/{id}', 'CustomerController@update');
                Route::delete('/toggle-status/{id}', 'CustomerController@toggleStatus');
                Route::delete('/destroy/{id}', 'CustomerController@destroy');
              });

              //Supplier  Routes...
              Route::group(['prefix' => '/supplier'], function () {
                Route::get('/list', 'SupplierController@index');
                Route::post('/store', 'SupplierController@store');
                Route::put('/update/{id}', 'SupplierController@update');
                Route::delete('/toggle-status/{id}', 'SupplierController@toggleStatus');
                Route::delete('/destroy/{id}', 'SupplierController@destroy');
              });

              //Supplier  Routes...
              Route::group(['prefix' => '/supplier-payment'], function () {
                Route::get('/list', 'SupplierPaymentController@index');
                Route::post('/store', 'SupplierPaymentController@store');
                Route::put('/update/{id}', 'SupplierPaymentController@update');
                Route::delete('/toggle-status/{id}', 'SupplierPaymentController@toggleStatus');
                Route::delete('/destroy/{id}', 'SupplierPaymentController@destroy');
              });


        });
    });
});
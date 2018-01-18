<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'Auth\LoginController@login']);
Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('register', ['as' => 'postRegister', 'uses' => 'Auth\RegisterController@register']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'validateBackHistory'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
        Route::get('/', ['as' => 'home', 'uses' => 'Backend\HomeController@index']);
        Route::post('/upload', ['as' => 'upload', 'uses' => 'Backend\UploadController@store']);

        Route::group(['prefix' => 'config'], function (){
            Route::get('/', ['as' => 'config.index', 'uses' => 'Backend\ConfigController@index']);
//        Route::get('/create', ['as' => 'config.create', 'uses' => 'Backend\ConfigController@create']);
            Route::get('/detail/{id}', ['as' => 'config.detail', 'uses' => 'Backend\ConfigController@show']);
//        Route::post('/add', ['as' => 'config.add', 'uses' => 'Backend\ConfigController@store']);
            Route::post('/update/{id}', ['as' => 'config.update', 'uses' => 'Backend\ConfigController@update']);
//        Route::get('/{id}',['as' => 'config.delete', 'uses' => 'Backend\ConfigController@destroy']);
        });
        Route::group(['prefix' => 'galleries'], function (){
            Route::get('/', ['as' => 'gallery.index', 'uses' => 'Backend\GalleryController@index']);
            Route::get('/create', ['as' => 'gallery.create', 'uses' => 'Backend\GalleryController@create']);
            Route::get('/detail/{id}', ['as' => 'gallery.detail', 'uses' => 'Backend\GalleryController@show']);
            Route::post('/add', ['as' => 'gallery.add', 'uses' => 'Backend\GalleryController@store']);
            Route::post('/update/{id}', ['as' => 'gallery.update', 'uses' => 'Backend\GalleryController@update']);
            Route::get('/{id}',['as' => 'gallery.delete', 'uses' => 'Backend\GalleryController@destroy']);
        });
        Route::group(['prefix' => 'module_categories'], function (){
            Route::get('/', ['as' => 'moduleCate.index', 'uses' => 'Backend\ModuleCategoryController@index']);
            Route::get('/create', ['as' => 'moduleCate.create', 'uses' => 'Backend\ModuleCategoryController@create']);
            Route::get('/detail/{id}', ['as' => 'moduleCate.detail', 'uses' => 'Backend\ModuleCategoryController@show']);
            Route::post('/', ['as' => 'moduleCate.add', 'uses' => 'Backend\ModuleCategoryController@store']);
            Route::post('/update/{id}', ['as' => 'moduleCate.update', 'uses' => 'Backend\ModuleCategoryController@update']);
            Route::get('/{id}',['as' => 'moduleCate.delete', 'uses' => 'Backend\ModuleCategoryController@destroy']);
        });
        Route::group(['prefix' => 'modules'], function (){
            Route::get('/', ['as' => 'module.index', 'uses' => 'Backend\ModuleController@index']);
            Route::get('/module-detail/{id}', ['as' => 'module.detail', 'uses' => 'Backend\ModuleController@show']);
            Route::post('/module-versions', ['as' => 'module.addVersion', 'uses' => 'Backend\ModuleController@storeVersion']);
            Route::post('/module-versions/edit', ['as' => 'module.updateVersion', 'uses' => 'Backend\ModuleController@updateNewVersion']);
            Route::get('/detail/{id}', ['as' => 'module.modifyVersion', 'uses' => 'Backend\ModuleController@editVersion']);
            Route::post('/', ['as' => 'module.add', 'uses' => 'Backend\ModuleController@store']);
            Route::get('/{id}',['as' => 'module.delete', 'uses' => 'Backend\ModuleController@destroy']);
        });
        Route::group(['prefix' => 'member'], function (){
            Route::get('/', ['as' => 'member.index', 'uses' => 'Backend\MemberController@index']);
            Route::get('/create', ['as' => 'member.create', 'uses' => 'Backend\MemberController@create']);
            Route::get('/detail/{id}', ['as' => 'member.detail', 'uses' => 'Backend\MemberController@show']);
            Route::post('/add', ['as' => 'member.add', 'uses' => 'Backend\MemberController@store']);
            Route::post('/update/{id}', ['as' => 'member.update', 'uses' => 'Backend\MemberController@update']);
            Route::get('/{id}',['as' => 'member.delete', 'uses' => 'Backend\MemberController@destroy']);
        });
    });
});

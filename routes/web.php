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
        Route::group(['prefix' => 'banners'], function () {
            Route::get('/', ['as' => 'banner.index', 'uses' => 'Backend\BannerController@index']);
            Route::get('/create', ['as' => 'banner.create', 'uses' => 'Backend\BannerController@create']);
            Route::post('/add', ['as' => 'banner.add', 'uses' => 'Backend\BannerController@store']);
            Route::get('/detail/{id}', ['as' => 'banner.detail', 'uses' => 'Backend\BannerController@show']);
            Route::post('/update/{id}', ['as' => 'banner.update', 'uses' => 'Backend\BannerController@update']);
            Route::get('/{id}', ['as' => 'banner.delete', 'uses' => 'Backend\BannerController@destroy']);
        });
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

        Route::group(['prefix' => 'posts'], function (){
            Route::get('/', ['as' => 'post.index', 'uses' => 'Backend\PostController@index']);
            Route::get('/create', ['as' => 'post.create', 'uses' => 'Backend\PostController@create']);
            Route::get('/detail/{id}', ['as' => 'post.detail', 'uses' => 'Backend\PostController@show']);
            Route::post('/add', ['as' => 'post.add', 'uses' => 'Backend\PostController@store']);
            Route::post('/update/{id}', ['as' => 'post.update', 'uses' => 'Backend\PostController@update']);
            Route::get('/{id}',['as' => 'post.delete', 'uses' => 'Backend\PostController@destroy']);
        });
        Route::group(['prefix' => 'post_categories'], function (){
            Route::get('/', ['as' => 'postCate.index', 'uses' => 'Backend\PostCategoryController@index']);
            Route::get('/create', ['as' => 'postCate.create', 'uses' => 'Backend\PostCategoryController@create']);
            Route::get('/detail/{id}', ['as' => 'postCate.detail', 'uses' => 'Backend\PostCategoryController@show']);
            Route::post('/add', ['as' => 'postCate.add', 'uses' => 'Backend\PostCategoryController@store']);
            Route::post('/update/{id}', ['as' => 'postCate.update', 'uses' => 'Backend\PostCategoryController@update']);
            Route::get('/{id}',['as' => 'postCate.delete', 'uses' => 'Backend\PostCategoryController@destroy']);
        });
        Route::group(['prefix' => 'module_categories'], function (){
            Route::get('/', ['as' => 'moduleCate.index', 'uses' => 'Backend\ModuleCategoryController@index']);
            Route::get('/create', ['as' => 'moduleCate.create', 'uses' => 'Backend\ModuleCategoryController@create']);
            Route::get('/detail/{id}', ['as' => 'moduleCate.detail', 'uses' => 'Backend\ModuleCategoryController@show']);
            Route::post('/add', ['as' => 'moduleCate.add', 'uses' => 'Backend\ModuleCategoryController@store']);
            Route::post('/update/{id}', ['as' => 'moduleCate.update', 'uses' => 'Backend\ModuleCategoryController@update']);
            Route::get('/{id}',['as' => 'moduleCate.delete', 'uses' => 'Backend\ModuleCategoryController@destroy']);
        });
        Route::group(['prefix' => 'modules'], function (){
            Route::get('/', ['as' => 'module.index', 'uses' => 'Backend\ModuleController@index']);
            Route::get('/create', ['as' => 'module.create', 'uses' => 'Backend\ModuleController@create']);
            Route::get('/module-detail/{id}', ['as' => 'module.detail', 'uses' => 'Backend\ModuleController@show']);
            Route::post('/module-versions', ['as' => 'module.addVersion', 'uses' => 'Backend\ModuleController@storeVersion']);
            Route::get('/detail/{id}', ['as' => 'module.versionDetail', 'uses' => 'Backend\ModuleController@showDetail']);
            Route::post('/', ['as' => 'module.add', 'uses' => 'Backend\ModuleController@store']);
            Route::post('/update/{id}', ['as' => 'module.update', 'uses' => 'Backend\ModuleController@update']);
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

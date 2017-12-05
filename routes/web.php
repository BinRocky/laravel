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


//后台路由分组
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	Route::get('index','IndexController@index');
	Route::get('welcome','IndexController@welcome');
	
	//课时管理的路由  如果页面  使用ajax既有post又有get 使用match
	Route::match(['post','get'],'lesson/index','LessonController@index');
	
	//ajax 操作路由
	Route::post('lesson/status/{lesson}','LessonController@status');
	
	//添加课时路由
	Route::match(['post','get'],'lesson/add','LessonController@add');

	//上传视频的路由
	Route::post('lesson/upimg','LessonController@upimg');
	Route::post('lesson/upvideo','LessonController@upvideo');
	
	//播放视频的路由
	Route::get('lesson/play/{lesson}', 'LessonController@play');
	
	//修改课时的路由
	Route::match(['post','get'], 'lesson/update/{lesson}', 'LessonController@update');
});


Route::get('demo','DemoController@demo');


Route::get('setcache','DemoController@setcache');
Route::get('getcache','DemoController@getcache');
Route::get('delcache','DemoController@delcache');

Route::get('setsession','DemoController@setsession');
Route::get('getsession','DemoController@getsession');
Route::get('delsession','DemoController@delsession');


// Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){
	// Route::get('login', 'AdminController@login');
	// Route::post('login_check', 'AdminController@login_check');
	
	// 下面路由  需要经过中间件
	// Route::group(['middleware'=>'login'],function(){
		// Route::get('index', 'IndexController@index');
		// Route::get('info', 'IndexController@info');
		// Route::get('logout', 'AdminController@logout');
		
		// 商品管理模块
		// Route::match(['post', 'get'], 'goods/add', 'GoodsController@add'); //添加
		// Route::get('goods/index', 'GoodsController@index'); //列表
		// Route::match(['get', 'post'], 'goods/update/{goods}', 'GoodsController@update'); //修改
		// Route::post('goods/del', 'GoodsController@del'); //删除
		
		// Route::post('goods/upimg','GoodsController@upimg');//上传图片

		
	// });
	
// });

Route::get('/', function () {
    // return view('welcome');
    echo 'binbin';	
});



















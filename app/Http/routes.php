<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/hello',function(){
	return "hello GET[]";
});

Route::get('/testPost',function(){
    $csrf_token = csrf_token();
    $form = <<<FORM
        <form action="/hello" method="POST">
            <input type="hidden" name="_token" value="{$csrf_token}">
            <input type="submit" value="Test"/>
        </form>
FORM;
    return $form;
});

Route::post('/hello',function(){
    return "Hello Laravel[POST]!";
});
*/

/*
//match()方法自动匹配请求方式
Route::match(['get','post'],'/hello',function(){
   return "Hello Laravel! match";
});

//any方式匹配所有请求
Route::any('/hello',function(){
    return "Hello Laravel! any";
});
*/

/*
Route::get('/hello/{name}',function($name){
    return "Hello {$name}!";
});

//多个参数
Route::get('/hello/{name}/by/{user}',function($name,$user){
	return "hello {$name} by {$user}";
});

//可选择参数
Route::get('/hello/{name?}',function($name = "tony"){
	return "hello Laravel.";
});
*/


//路由命名
Route::get('/hello/tony/{id?}',['as'=>'tony',function($id = 10){
    return "Hello Tony！!id: { $id } ";
}]);
Route::get('/testRouteName',function(){
	// return redirect(route('tony'));  //重定向
	return redirect()->route("tony", $args = ['id'=>101]);
});

Route::group(['middleware' => 'test'],function(){
	Route::get('/write/laravel/age/{age}',function($age){
		//使用
	});
	Route::get('/update/laravel/age/{age}',function($age){
		//使用
	});
});

Route::get('/age/refuse',['as'=>'refuse',function(){
	return "仅仅18以上.";
}]);


//命名空间
Route::group(['namespace' => 'Admin'],function(){
	//
	//命名空间在controllers/Admin下
	Route::group(['namespace' => 'weibo'],function(){
		//命名空间在controllers/Admin/weibo
	});
});




// Blog pages
get('/', function () {
  return redirect('/blog');
});
get('blog', 'BlogController@index');
get('blog/{slug}', 'BlogController@showPost');

// Admin area
get('admin', function () {
  return redirect('/admin/post');
});
$router->group([
  'namespace' => 'Admin',
  'middleware' => 'auth',
], function () {
  resource('admin/post', 'PostController');
  // resource('admin/tag', 'TagController');
  resource('admin/tag', 'TagController', ['except' => 'show']);
  get('admin/upload', 'UploadController@index');
});

// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');
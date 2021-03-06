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

//首页
Route::get('/', 'PagesController@root')->name('root');


//Auth::routes();
// Authentication Routes...
//登陆(登出)视图/行为
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//注册视图/行为
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//忘记密码视图/行为
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
//Route::get('/users/{user}', 'UsersController@show')->name('users.show'); //
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');//
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');//


Route::resource('topics', 'TopicsController', ['only' => ['index',  'create', 'store', 'update', 'edit', 'destroy']]);

//topics.show  ->link()
Route::get('topics/{topic}/{slug?}','TopicsController@show')->name('topics.show');

//话题分类
Route::resource('categories','CategoriesController',['only' => ['show'] ]);

//富文本上传图片
Route::post('upload_image','TopicsController@uploadImage')->name('topics.upload_image');

Route::resource('replies', 'RepliesController', ['only' => [ 'store','destroy']]);

//消息通知显示出来;
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

//无权限提醒页面
Route::get('permission-denied','PagesController@permissionDenied')->name('permission-denied');








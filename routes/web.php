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
//登陆视图登陆/登出行为
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//注册视图注册行为
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//忘记密码视图
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//提交邮箱行为
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//修改密码视图（token验证）
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//修改密码行为
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
//Route::get('/users/{user}', 'UsersController@show')->name('users.show'); //个人中心视图
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');//用户编辑视图
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');//用户资料更新



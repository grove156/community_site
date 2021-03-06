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

Route::get('home',[
  'as'=>'home',
  'uses'=>'HomeController@index'
]);

Route::get('/',[
  'as'=>'root',
  'uses'=>'WelcomeController@index'
]);

//articles
Route::resource('articles', 'ArticlesController');

Route::get('tags/{slug}/articles',[
  'as'=>'tags.articles.index',
  'uses'=>'ArticlesController@index'
]);

//attachment file
Route::resource('attachments', 'AttachmentsController', ['only'=>['store','destroy']]);

//user registration
Route::get('auth/register',[
  'as'=>'users.create',
  'uses'=>'UsersController@create',
]);

Route::post('auth/register',[
  'as'=>'users.store',
  'uses'=>'UsersController@store',
]);

Route::get('auth/confirm/{code}',[
  'as'=>'users.confirm',
  'uses'=>'UsersController@confirm',
]);

//user authentication
Route::get('auth/login',[
  'as'=>'sessions.create',
  'uses'=>'SessionsController@create',
]);

Route::post('auth/login',[
  'as'=>'sessions.store',
  'uses'=>'SessionsController@store',
]);

Route::get('auth/logout',[
  'as'=>'sessions.destroy',
  'uses'=>'SessionsController@destroy',
]);

//password reset
Route::get('auth/remind',[
  'as'=>'remind.create',
  'uses'=>'PasswordsController@getRemind',
]);

Route::post('auth/remind',[
  'as'=>'remind.store',
  'uses'=>'PasswordsController@postRemind',
]);

Route::get('auth/reset/{token}',[
  'as'=>'reset.create',
  'uses'=>'PasswordsController@getReset',
]);

Route::post('auth/reset',[
  'as'=>'reset.store',
  'uses'=>'PasswordsController@postReset',
]);

Route::get('auth/confirm/{code}',[
  'as'=>'users.confirm',
  'uses'=>'UsersController@confirm',
]);
//->where('code','[\pL-\pN]{60}');

//social login
Route::get('social/{provider}',[
  'as'=>'social.login',
  'uses'=>'SocialController@execute',
]);

//comments controller
Route::resource('comments','CommentsController',['only'=>['update','destroy']]);
Route::resource('articles.comments', 'commentsController',['only'=>'store']);

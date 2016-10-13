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

Route::get('/','PostController@getIndex');

Route::get('/userAccount','UserController@getIndex');

Route::get('/page/{friend_id}','FriendShipsController@getFriendInfo');

Route::get('/deletePost/{id}','PostController@getDeletePost');

Route::get('/logout','UserController@logout');

Route::get('/home','PostController@getIndex');

Route::get('/friend_ship/{Friend_id}', 'FriendShipsController@getUpdateFriendRequiest');

Route::Post('/add_comment',
  ['as' => 'add_comment', 'uses' => 'CommentController@getAddComment']);
Route::get('/GetComments/{post_id}','PostController@getComments');

Route::get('/friendRequest', 'FriendShipsController@getUserFriendRequiest');

Route::post('register_view', 
  ['as' => 'register_view', 'uses' => 'UserController@GetRegisterView']);


  Route::post('sign up', 
  ['as' => 'register', 'uses' => 'UserController@postRegister']);
  
Route::post('login_view', 
  ['as' => 'login', 'uses' => 'UserController@postLogin']);
  
Route::post('add_post', 
  ['as' => 'add_post', 'uses' => 'PostController@postAddPost']);
  

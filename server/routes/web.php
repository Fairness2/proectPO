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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/stages', 'StageController@getStages')->middleware('auth');
Route::post('/stages', 'StageController@addStage')->middleware('auth');
Route::post('/stages/update', 'StageController@updateStage')->middleware('auth');
Route::post('/stages/delete', 'StageController@deleteStage')->middleware('auth');

Route::get('/roles', 'RoleController@getRoles')->middleware('auth');
Route::post('/roles', 'RoleController@addRole')->middleware('auth');
Route::post('/roles/update', 'RoleController@updateRole')->middleware('auth');
Route::post('/roles/delete', 'RoleController@deleteRole')->middleware('auth');

Route::post('/roles/set', 'RoleController@setRole')->middleware('auth');

Route::get('/projects', 'ProjectController@getProjects')->middleware('auth');
Route::post('/projects', 'ProjectController@addProject')->middleware('auth');
Route::post('/projects/update', 'ProjectController@updateProject')->middleware('auth');
Route::post('/projects/delete', 'ProjectController@deleteProject')->middleware('auth');

Route::get('/tasks', 'TaskController@getTasks')->middleware('auth');
Route::post('/tasks', 'TaskController@addTask')->middleware('auth');
Route::post('/tasks/update', 'TaskController@updateTask')->middleware('auth');
Route::post('/tasks/delete', 'TaskController@deleteTask')->middleware('auth');

Route::get('/users', 'UserController@getUsers')->middleware('auth');
Route::post('/users', 'UserController@updateUser')->middleware('auth');
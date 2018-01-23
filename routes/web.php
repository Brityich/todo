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

Route::get('/', function (){
    return redirect(route('home'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/addtask', 'HomeController@saveTask')->name('save.task');

Route::name('readAll')->post('/readAll', 'HomeController@readAll');

Route::name('delete.task')->post('/delete.task', 'HomeController@deleteTask');

Route::name('view.task')->post('/view.task', 'HomeController@viewTask');

Route::name('edit.task')->post('/edit.task', 'HomeController@editTask');

Route::name('check.task')->post('/check.task', 'HomeController@checkTask');

Route::name('show-all-tasks')->post('/all', 'HomeController@showAllTasks');
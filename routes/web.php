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

// PAGE ROUTES

Route::get('/', 'PagesController@index')->name('landing_page');
Route::get('/login', 'PagesController@user_login')->name('login');
Route::get('/dashboard', 'PagesController@user_dashboard')->name('dashboard');
Route::get('/admin', 'PagesController@admin_dashboard')->name('admin');
Route::get('/attendance/log', 'PagesController@admin_logs')->name('admin_logs');

// "User" Model ROUTES
Route::resource('users', 'UsersController');

// POST ROUTES
Route::post('/unlock', 'PostsController@checkUnlock')->name('check_unlock');
Route::post('/login/user', 'PostsController@checkLogin')->name('check_login');
Route::post('/scan', 'PostsController@scan')->name('scan');

//LOGOUT ROUTE
Route::get('/logout', 'PagesController@user_logout')->name('logout');

//AJAX ROUTES
Route::get('/logs', 'AjaxController@sendLogsToView');
Route::get('/admin/logs', 'AjaxController@sendLogsToAdminView');
Route::get('/admin/accounts', 'AjaxController@sendUsersToView');
Route::get('/count', 'AjaxController@countStudents')->name('count');
Route::post('/delete', 'AjaxController@deleteUser')->name('delete');
Route::post('/search', 'AjaxController@search')->name('search');
Route::post('/oncampus/logs', 'AjaxController@sendOnCampusLogs')->name('oncampus_logs');
Route::get('/getCampusCount', 'AjaxController@getCampusCount');

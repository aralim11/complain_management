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
    return view('auth.login');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return "All Cache Is Cleared";
});

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin', 'location']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('group', 'GroupController');
    Route::resource('user', 'UserController');
    Route::resource('updateticket', 'UpdateTicket');
    Route::resource('profile', 'ProfileController');

    // Report Search
    Route::get('report', 'ReportController@index')->name('report.index');
    Route::get('report-search', 'ReportController@reportSearch')->name('report.search');
    Route::get('report-export/{src_type}{src_keyword}{start_date}{end_date}', 'ReportController@export');

    // Route::resource('report', 'ReportController');
    
});

Route::group(['as' => 'supervisor.', 'prefix' => 'supervisor', 'namespace' => 'Supervisor', 'middleware' => ['auth', 'supervisor']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('updateticket', 'UpdateTicket');
    Route::resource('profile', 'ProfileController');

    // Report Search
    Route::get('report', 'ReportController@index')->name('report.index');
    Route::get('report-search', 'ReportController@reportSearch')->name('report.search');
    Route::get('report-export/{src_type}{src_keyword}{start_date}{end_date}', 'ReportController@export');
});

Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('updateticket', 'UpdateTicket');
    Route::resource('profile', 'ProfileController');
});

Route::group(['as' => 'client.', 'prefix' => 'client', 'namespace' => 'Client', 'middleware' => ['auth', 'client']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('ticketcreate', 'TicketCreateController');
    Route::resource('profile', 'ProfileController');
});
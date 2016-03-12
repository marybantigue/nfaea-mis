<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::auth();
    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index');

    Route::resource("provinces", "provinceController");
	Route::get('provinces/delete/{id}', [
	    'as' => 'provinces.delete',
	    'uses' => 'provinceController@destroy',
	]);

	Route::resource("members", "MemberController");
	Route::get('members/delete/{id}', [
	    'as' => 'members.delete',
	    'uses' => 'MemberController@destroy',
	]);

	Route::resource("invoices", "invoiceController");
	Route::get('invoices/delete/{id}', [
	    'as' => 'invoices.delete',
	    'uses' => 'invoiceController@destroy',
	]);

    Route::get('invoices/editFromProvince/{id}/province_id/{province_id}', [
    'as' => 'invoices.editFromProvince',
    'uses' => 'invoiceController@editFromProvince'
    ]);
    Route::patch('invoices/updateFromProvince/{id}/province_id/{province_id}',[
    'as' => 'invoices.updateFromProvince',
    'uses' => 'invoiceController@updateFromProvince'
    ]);


    Route::resource("helpMembers", "help_membersController");
    Route::get('helpMembers/delete/{id}', [
        'as' => 'helpMembers.delete',
        'uses' => 'help_membersController@destroy',
    ]);



    Route::resource("invoiceMembers", "InvoiceMemberController");
    Route::get('invoiceMembers/delete/{id}', [
        'as' => 'invoiceMembers.delete',
        'uses' => 'InvoiceMemberController@destroy',
    ]);


    Route::resource("invoiceProvinces", "InvoiceProvinceController");
    Route::get('invoiceProvinces/delete/{id}', [
        'as' => 'invoiceProvinces.delete',
        'uses' => 'InvoiceProvinceController@destroy',
    ]);

    Route::resource("users", "UserController");
    Route::get('users/delete/{id}', [
        'as' => 'users.delete',
        'uses' => 'UserController@destroy',
    ]);

});






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
    /*Route::auth();
    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index');
*/

    // Authorization
    Route::get('/login', ['as' => 'auth.login.form', 'uses' => 'Auth\SessionController@getLogin']);
    Route::post('/login', ['as' => 'auth.login.attempt', 'uses' => 'Auth\SessionController@postLogin']);
    Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\SessionController@getLogout']);

    // Registration
    Route::get('register', ['as' => 'auth.register.form', 'uses' => 'Auth\RegistrationController@getRegister']);
    Route::post('register', ['as' => 'auth.register.attempt', 'uses' => 'Auth\RegistrationController@postRegister']);

    // Activation
    Route::get('activate/{code}', ['as' => 'auth.activation.attempt', 'uses' => 'Auth\RegistrationController@getActivate']);
    Route::get('resend', ['as' => 'auth.activation.request', 'uses' => 'Auth\RegistrationController@getResend']);
    Route::post('resend', ['as' => 'auth.activation.resend', 'uses' => 'Auth\RegistrationController@postResend']);

    // Password Reset
    Route::get('password/reset/{code}', ['as' => 'auth.password.reset.form', 'uses' => 'Auth\PasswordController@getReset']);
    Route::post('password/reset/{code}', ['as' => 'auth.password.reset.attempt', 'uses' => 'Auth\PasswordController@postReset']);
    Route::get('password/reset', ['as' => 'auth.password.request.form', 'uses' => 'Auth\PasswordController@getRequest']);
    Route::post('password/reset', ['as' => 'auth.password.request.attempt', 'uses' => 'Auth\PasswordController@postRequest']);

    // Users
    Route::resource('users', 'UserController');

    // Roles
    Route::resource('roles', 'RoleController');

    // Dashboard
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => function() {
        return view('centaur.dashboard');
    }]);



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

	//Route::resource("invoices", "invoiceController");


    // invoices
    Route::resource('invoices', 'invoiceController');


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

/*    Route::resource("users", "UserController");
    Route::get('users/delete/{id}', [
        'as' => 'users.delete',
        'uses' => 'UserController@destroy',
    ]);
*/
});






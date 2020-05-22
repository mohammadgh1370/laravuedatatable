<?php

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('loginForm');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::get('register', 'RegisterController@showRegistrationForm')->name('registerForm');
    Route::post('register', 'RegisterController@register')->name('register');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

    Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'ConfirmPasswordController@confirm')->name('confirm');

    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
});

Route::group(['middleware' => 'auth:admin'], function () {
    // روت صفحه داشبورد
    Route::get('/', 'IndexController@index')->name('dashboard');

    // روت مجوزها
    Route::group(['prefix' => 'permission', 'as' => 'permission.'], function () {
        // روت لیست مجوزها
        Route::get('/', 'PermissionController@index')->name('index');
        // روت صفحه ایجاد مجوز
        Route::get('/create', 'PermissionController@create')->name('create');
        // روت ذخیره اطلاعات مجوز
        Route::post('/store', 'PermissionController@store')->name('store');
        // روت ویرایش اطلاعات مجوز
        Route::put('/{permission}', 'PermissionController@update')->name('update');
        // روت حذف مجوز
        Route::delete('/{permission?}', 'PermissionController@destroy')->name('delete');
    });

    // روت نقش ها
    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        // روت لیست نقش ها
        Route::get('/', 'RoleController@index')->name('index');
        // روت صفحه ایجاد نقش
        Route::get('/create', 'RoleController@create')->name('create');
        // روت ذخیره اطلاعات نقش
        Route::post('/store', 'RoleController@store')->name('store');
        // روت ویرایش اطلاعات نقش
        Route::put('/{role}', 'RoleController@update')->name('update');
        // روت حذف اطلاعات نقش
        Route::delete('/{role?}', 'RoleController@destroy')->name('delete');
    });

    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/{admin?}', 'AdminController@show')->name('show');
        Route::put('/{admin?}', 'AdminController@update')->name('update');
        Route::delete('/{admin?}', 'AdminController@destroy')->name('delete');
        Route::get('/active/{admin?}', 'AdminController@active')->name('active');
    });

    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('/{user?}', 'UserController@show')->name('show');
        Route::put('/{user?}', 'UserController@update')->name('update');
        Route::delete('/{user?}', 'UserController@destroy')->name('delete');
        Route::get('/active/{user?}', 'UserController@active')->name('active');
    });
});

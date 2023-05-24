<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', 'admin/home');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
    // Route of Class
    Route::resource('class-rooms', 'ClassRoomController');
    // End of Route Class
    // Route of Loans
    Route::resource('loans', 'LoanController');
    // End of Route Loans
    // Route of Parents
    Route::resource('parents', 'StudentParentController');
    // End of Route Parents
    // Route of Students
    Route::resource('students', 'StudentController');
    // End of Route Students
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
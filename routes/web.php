<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'web', 'prefix' => 'staff', 'namespace' => 'Staff'], function () {
    Route::get('login',[\App\Http\Controllers\Staff\Auth\LoginController::class,'showLoginForm'])->name('staff.login');

    Route::post('login',[\App\Http\Controllers\Staff\Auth\LoginController::class,'login']);
    Route::post('logout',[\App\Http\Controllers\Staff\Auth\LoginController::class,'logout'])->name('staff.logout');
});

Route::group(['middleware' => 'web', 'prefix' => 'reader', 'namespace' => 'Reader'], function () {
    Route::get('login',[\App\Http\Controllers\Reader\Auth\LoginController::class,'showLoginForm'])->name('reader.login');
    Route::get('register',[\App\Http\Controllers\Reader\Auth\LoginController::class,'showRegistrationForm'])->name('reader.register');

    Route::post('login',[\App\Http\Controllers\Reader\Auth\LoginController::class,'login']);
    Route::post('logout',[\App\Http\Controllers\Reader\Auth\LoginController::class,'logout'])->name('reader.logout');
    Route::post('register',[\App\Http\Controllers\Reader\Auth\LoginController::class,'register']);
});

Route::group(['middleware' => 'staff', 'prefix' => 'staff', 'namespace' => 'Staff'], function () {
    Route::get('dashboard',[\App\Http\Controllers\Staff\DashboardController::class,'showDashboard'])->name('staff.dashboard');
    Route::get('add-book',[\App\Http\Controllers\Staff\DashboardController::class,'addBookForm'])->name('add.book.ui');
    Route::get('edit-book/{id}',[\App\Http\Controllers\Staff\DashboardController::class,'editBookForm'])->name('edit.book.ui');
    Route::get('users',[\App\Http\Controllers\Staff\UserController::class,'showUserList'])->name('list.user.ui');
    Route::get('all-books',[\App\Http\Controllers\Staff\DashboardController::class,'getAllBooks']);
    Route::get('view-book/{id}',[\App\Http\Controllers\Staff\DashboardController::class,'viewBook']);
    Route::get('assign-book',[\App\Http\Controllers\Staff\DashboardController::class,'borrowBookForm'])->name('assign.book.ui');
    Route::get('add-user',[\App\Http\Controllers\Staff\UserController::class,'showUserRegistrationForm'])->name('user.registration.ui');

    Route::post('add-book',[\App\Http\Controllers\Staff\DashboardController::class,'saveBook']);
    Route::post('edit-book',[\App\Http\Controllers\Staff\DashboardController::class,'editBook']);
    Route::post('delete-book',[\App\Http\Controllers\Staff\DashboardController::class,'deleteBook']);
    Route::post('activate-reader',[\App\Http\Controllers\Staff\UserController::class,'activateReader']);
    Route::post('disable-reader',[\App\Http\Controllers\Staff\UserController::class,'disableReader']);
    Route::post('activate-staff-user',[\App\Http\Controllers\Staff\UserController::class,'activateStaffUser']);
    Route::post('disable-staff-user',[\App\Http\Controllers\Staff\UserController::class,'disableStaffUser']);
    Route::post('search-reader',[\App\Http\Controllers\Staff\DashboardController::class,'searchReader']);
    Route::post('search-book',[\App\Http\Controllers\Staff\DashboardController::class,'searchBook']);
    Route::post('assign-book',[\App\Http\Controllers\Staff\DashboardController::class,'assignBook']);
    Route::post('save-user',[\App\Http\Controllers\Staff\UserController::class,'saveUser']);

});

Route::group(['middleware' => 'reader', 'prefix' => 'reader', 'namespace' => 'Reader'], function () {
    Route::get('dashboard',[\App\Http\Controllers\Reader\DashboardController::class,'showDashboard'])->name('reader.dashboard');
    Route::get('borrowed-books',[\App\Http\Controllers\Reader\DashboardController::class,'showReturnedBooks'])->name('reader.borrowedBooks.ui');
});

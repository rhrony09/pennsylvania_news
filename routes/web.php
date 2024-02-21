<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//Frontend
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('category/{slug}', [FrontendController::class, 'category'])->name('category');
Route::get('news/{slug}', [FrontendController::class, 'news'])->name('news');
Route::get('ads', [FrontendController::class, 'ads'])->name('ads');
Route::get('archives', [FrontendController::class, 'archives'])->name('archives');


//Admin Panel
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth', 'as' => 'dashboard.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    //Category list
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    //News
    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('news/store', [NewsController::class, 'store'])->name('news.store');
    Route::get('news/edit/{news}', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('news/update', [NewsController::class, 'update'])->name('news.update');
    Route::get('news/delete/{news}', [NewsController::class, 'delete'])->name('news.delete');

    //users management
    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::get('profile', [UsersController::class, 'user_profile'])->name('users.profile');
    Route::get('users/{id}', [UsersController::class, 'user_show'])->name('users.show');
    Route::post('users/add', [UsersController::class, 'user_add'])->name('users.add');
    Route::post('users/update/info', [UsersController::class, 'user_update_info'])->name('users.update.info');
    Route::post('users/update/password', [UsersController::class, 'user_update_password'])->name('users.update.password');
    Route::post('users/update/pro_pic', [UsersController::class, 'user_update_pro_pic'])->name('users.update.pro.pic');
    Route::get('users/delete/{id}', [UsersController::class, 'user_delete'])->name('users.delete');

    //settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'settings_update'])->name('settings.update');

    //debug
    Route::get('debug', [HomeController::class, 'debug']);
});

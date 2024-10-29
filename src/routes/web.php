<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AdminController;

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

// 公開ルート
Route::controller(ContactController::class)->name('contacts.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('confirm', 'confirm')->name('confirm');
    Route::post('store', 'store')->name('store');
    Route::post('edit', 'edit')->name('edit');
    Route::get('thanks', 'thanks')->name('thanks');
});

// 管理者ルート
Route::prefix('admin')->middleware('auth')->controller(AdminController::class)->name('admin.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('search', 'search')->name('search');
    Route::get('export','export')->name('export');
    Route::delete('delete/{id}', 'destroy')->name('destroy');
});

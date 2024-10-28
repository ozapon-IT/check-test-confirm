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
Route::controller(ContactController::class)->group(function () {
    Route::get('/', 'index')->name('contact.index');
    Route::post('confirm', 'confirm')->name('contact.confirm');
    Route::post('/store', 'store')->name('contact.store');
    Route::post('/edit', 'edit')->name('contact.edit');
    Route::get('/thanks', 'thanks')->name('contact.thanks');
});

// 管理者ルート
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/search', [AdminController::class, 'search'])->name('search');
    Route::get('/export', [AdminController::class, 'export'])->name('export');
    Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('destroy');
});


<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\User\ListUsers;
use App\Http\Livewire\Admin\Master\ListSantri;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){

    Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');
    Route::get('admin/users', ListUsers::class)->name('admin.users');
    Route::get('admin/santri', ListSantri::class)->name('admin.santri');

});

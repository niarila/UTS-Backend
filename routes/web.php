<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agama14Controller;
use App\Http\Controllers\User14Controller;
use App\Http\Controllers\Detail_data14Controller;
use Illuminate\Support\Facades\Auth;

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

    if (Auth::check()) {
        $role = Auth::user()->role;
    } else {
        $role = null;
    }

    return view('dashboard', [
        'role'=>$role
    ]);
})->name('index14');

Route::middleware(['auth', 'hakakses:role'])->group(function () {

    // User
    Route::get('/users14', [User14Controller::class, 'users14'])->name('users14');
    Route::get('/detailUser14/{id}', [User14Controller::class, 'detailUser14'])->name('detailUser14');
    Route::get('/profile14', [User14Controller::class, 'profile14'])->name('profile14');


    Route::get('/updatePassword14', [User14Controller::class, 'updatePassword14'])->name('updatePassword14');
    Route::post('/updatePasswordProses14/{id}', [User14Controller::class, 'updatePasswordProses14'])->name('updatePasswordProses14');


    Route::get('/register14', [User14Controller::class, 'register14'])->name('register14');
    Route::post('/registerProses14', [User14Controller::class, 'registerProses14'])->name('registerProses14');

    Route::get('/logout14', [User14Controller::class, 'logout14'])->name('logout14');

    // Detail data
    Route::get('/detailData14', [Detail_data14Controller::class, 'detailData14'])->name('detailData14');

    Route::get('/createData14', [Detail_data14Controller::class, 'createData14'])->name('createData14');
    Route::post('/createDataProses14', [Detail_data14Controller::class, 'createDataProses14'])->name('createDataProses14');

    Route::get('/updateData14', [Detail_data14Controller::class, 'updateData14'])->name('updateData14');
    Route::post('/updateDataProses14', [Detail_data14Controller::class, 'updateDataProses14'])->name('updateDataProses14');
});

Route::middleware(['auth', 'hakadmin:role'])->group(function () {
    // agama
    Route::get('/agama14', [Agama14Controller::class, 'agama14'])->name('agama14');

    Route::get('/createAgama14', [Agama14Controller::class, 'createAgama14'])->name('createAgama14');
    Route::post('/createAgama14Proses', [Agama14Controller::class, 'createAgama14Proses'])->name('createAgama14Proses');

    Route::get('/deleteAgama14Proses/{id}', [Agama14Controller::class, 'deleteAgama14Proses'])->name('deleteAgama14Proses');

    Route::get('/updateAgama14/{id}', [Agama14Controller::class, 'updateAgama14'])->name('updateAgama14');
    Route::post('/updateAgama14Proses/{id}', [Agama14Controller::class, 'updateAgama14Proses'])->name('updateAgama14Proses');

    // user
    Route::get('/deleteUser14/{id}', [User14Controller::class, 'deleteUser14'])->name('deleteUser14');
    Route::get('/approveUser14/{id}', [User14Controller::class, 'approveUser14'])->name('approveUser14');
});

Route::get('/login14', [User14Controller::class, 'login14'])->name('login14');
Route::post('/loginProses14', [User14Controller::class, 'loginProses14'])->name('loginProses14');



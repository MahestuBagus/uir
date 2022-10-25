<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaControllers;
use App\Http\Controllers\ProjectControllers;
use App\Http\Controllers\KontakControllers;
use App\Http\Controllers\LoginControllers;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/project', function () {
    return view('project');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/admin', function () {
    return view('admin');
});

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/mastersiswa', function () {
//     return view('admin.MasterSiswa');
// });

// Route::get('/masterproject', function () {
//     return view('admin.MasterProject');
// });

// Route::get('/masterkontak', function () {
//     return view('admin.MasterKontak');
// });

// Route::get('/TambahProject', function () {
//     return view('admin.TambahProject');
// });


Route::middleware('guest')->group(function(){
    Route::get('login', [LoginControllers::class, 'index'])->name('login');
    Route::post('login', [LoginControllers::class, 'authenticate']);
    Route::get('admin', function(){return view('admin.app');});
    Route::get('about', function(){return view('about');});
    Route::get('project', function(){return view('project');});
    Route::get('contact', function(){return view('contact');});

});
// Route::get('/dashboard', function () {
//     return view('admin.Dashboard');
// });

Route::middleware('auth')->group(function(){
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/mastersiswa', SiswaControllers::class)->middleware('auth');
    Route::resource('/masterkontak', KontakControllers::class)->middleware('auth');
    Route::resource('/masterproject', ProjectControllers::class)->middleware('auth');
    Route::get('mastersiswa/{id_siswa}/hapus', [SiswaControllers::class, 'hapus'])->name('mastersiswa.hapus');
    Route::get('/masterproject/tambah/{id_siswa}',[ProjectControllers::class,'tambah'])->name('masterproject.tambah');
    
    Route::get('/masterproject/{id_siswa}/hapus',[ProjectControllers::class,'hapus'])->name('masterproject.hapus');
    Route::post('logout', [LoginControllers::class, 'logout']);
    
});
// Route::get('login', [LoginControllers::class, 'index'])->name('login')->middleware('guest');
// Route::post('login', [LoginControllers::class, 'authenticate']);
// Route::post('logout', [LoginControllers::class, 'logout']);

    
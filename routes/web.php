<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropzoneController;

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

Route::get('/dropzone', [DropzoneController::class, 'dropzone']);

Route::post('/dropzone', [DropzoneController::class, 'dropzoneStore'])->name('dropzone.store');

Route::delete('/dropzone', [DropzoneController::class, 'dropzoneDestroy']);

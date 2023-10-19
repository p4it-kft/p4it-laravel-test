<?php

use App\Http\Controllers\ContactUsAdvancedController;
use App\Http\Controllers\ContactUsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/tell-me', [ContactUsController::class, 'create'])->name('message.create');
Route::post('/tell-me', [ContactUsController::class, 'store'])->name('message.store');
Route::get('/tell-me/success', [ContactUsController::class, 'success']);

Route::get('/tell-me-advanced/list', [ContactUsAdvancedController::class, 'list'])->name('message.list-advanced');
Route::get('/tell-me-advanced/create', [ContactUsAdvancedController::class, 'create'])->name('message.create-advanced');
Route::get('/tell-me-advanced/update/{id}', [ContactUsAdvancedController::class, 'update'])->name('message.update-advanced');
Route::post('/tell-me-advanced/store/{id?}', [ContactUsAdvancedController::class, 'store'])->name('message.store-advanced');

// ennek a GET-es formnál van szerepe, mert a POST, PUT, DELETE formra automatikusan bepakolja a csrf tokent a laravelcollective/html
Route::post('foo',
    [
        'before' => 'csrf',
        function()
        {
            //
        }
    ]
);

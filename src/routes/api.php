<?php

use App\Http\Controllers\Book\BookCreateController;
use App\Http\Controllers\Book\BookDeleteController;
use App\Http\Controllers\Book\BookFindController;
use App\Http\Controllers\Book\BookListController;
use App\Http\Controllers\Book\BookUpdateController;
use App\Http\Controllers\Heap\HeapCreateController;
use App\Http\Controllers\Heap\HeapDeleteController;
use App\Http\Controllers\Heap\HeapFindController;
use App\Http\Controllers\Heap\HeapListController;
use App\Http\Controllers\Heap\HeapUpdateController;
use App\Http\Controllers\Third\CepController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('books', BookListController::class);
    Route::post('books', BookCreateController::class);
    Route::get('book/{id}', BookFindController::class);
    Route::put('book/{id}', BookUpdateController::class);
    Route::delete('book/{id}', BookDeleteController::class);

    Route::get('heaps', HeapListController::class);
    Route::post('heaps', HeapCreateController::class);
    Route::get('heap/{id}', HeapFindController::class);
    Route::put('heap/{id}', HeapUpdateController::class);
    Route::delete('heap/{id}', HeapDeleteController::class);

    Route::get('cep/{cepNumber}', CepController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

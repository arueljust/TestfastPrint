<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonResController;
use App\Http\Controllers\ProductController;

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


Route::get('/res-api', [JsonResController::class, 'getResponseApi']); // melihat response dr api
Route::get('/save-satuan', [ProductController::class, 'saveSatuan']); // menyimpan ke tabel satuan
Route::get('/save-status', [ProductController::class, 'saveStatus']); // minyampan ke tabel status
Route::get('/save-data', [ProductController::class, 'saveData']); // menyimpan ke tabel product
Route::get('/', [ProductController::class, 'getAllData']); // tampilkan semua data produk
Route::get('/in-stock', [ProductController::class, 'getInStock']); // tampilkan semua data produk yg bisa dijual
Route::get('/create-product', [ProductController::class, 'createProduct']); // pindah ke halaman tambh
Route::post('/store-product', [ProductController::class, 'productStore']); // insert data ke db product
Route::get('/edit-product/{id}', [ProductController::class, 'editProduct']); // halaman edit
Route::put('/update-product/{id}', [ProductController::class, 'updateProduct']); // update product
Route::delete('/delete-product/{id}', [ProductController::class, 'deleteData']); // hapus product

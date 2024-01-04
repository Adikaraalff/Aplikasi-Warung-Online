<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


Route::resource('roles', RoleController::class);
Route::resource('products', ProductController::class);
Route::resource('users', UserController::class);
Route::resource('kategoris', KategoriController::class);

//Cart routes
Route::get('/pages/carts', [CartController::class, 'index'])->name('carts.index');
Route::post('/carts', [CartController::class, 'store'])->name('carts.store');
Route::post('/carts/add-to-cart', [CartController::class, 'addToCart'])->name('carts.add-to-cart');
Route::get('/carts/show', [CartController::class, 'showCart'])->name('carts.show');
Route::delete('/carts/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');

//checkout routes
Route::group(['middleware' => ['web']], function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Authentication routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('register', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Client routes
Route::get('/dashboard/client', [ClientController::class, 'clientDashboard'])->name('dashboard.client');
Route::get('/client/profile', [ClientController::class, 'clientProfile'])->name('client.profile');
Route::resource('clients', ClientController::class)->except(['index', 'create', 'store', 'destroy']);
Route::get('clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('clients/{client}', [ClientController::class, 'update'])->name('clients.update');




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

Route::get('/', [PageController::class, 'index']);

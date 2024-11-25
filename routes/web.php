<?php
use  App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');

});

Route::get('/products', [productController::class, 'productList'])->name('products.list');
Route::get('/products/storedData', [productController::class, 'storedData'])->name('products.storedData');
Route::get('/products/create', [productController::class, 'create'])->name('products.create');
Route::post('/products', [productController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit',[productController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [productController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [productController::class, 'destroy'])->name('products.destroy');
Route::patch('/products/{product}', [productController::class, 'softDelete'])->name('products.softDelete');
Route::patch('/products/restore/{product}', [productController::class, 'restore'])->name('products.restore');
Route::get('/registration', [productController::class, 'register'])->name('auth.registration');





Route::get('/dashboard', function () {
    // Fetch all products from the database
    $products = Product::all();

    // Pass products to the view as a prop
    return view('dashboard', ['products' => $products]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
});

require __DIR__.'/auth.php';

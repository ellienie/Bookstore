<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $books = Book::with('category')
        ->latest()
        ->take(8)
        ->get();

    return view('welcome', compact('books'));
})->name('home');

Route::view('/about', 'about')->name('about');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    Route::get('/user/books', [UserBookController::class, 'index'])
        ->name('user.books.index');

    Route::get('/user/books/{book}', [UserBookController::class, 'show'])
        ->name('user.books.show');

    Route::get('/user/cart', [CartController::class, 'index'])
        ->name('user.cart.index');

    Route::post('/user/cart/{book}', [CartController::class, 'store'])
        ->name('user.cart.store');

    Route::patch('/user/cart/{book}', [CartController::class, 'update'])
        ->name('user.cart.update');

    Route::delete('/user/cart/{book}', [CartController::class, 'destroy'])
        ->name('user.cart.destroy');

    Route::get('/user/checkout', [CheckoutController::class, 'index'])
        ->name('user.checkout.index');

    Route::post('/user/checkout', [CheckoutController::class, 'store'])
        ->name('user.checkout.store');

    Route::get('/user/checkout/success/{order}', [CheckoutController::class, 'success'])
        ->name('user.checkout.success');

    Route::get('/user/orders', [UserOrderController::class, 'index'])
        ->name('user.orders.index');

    Route::get('/user/orders/{order}', [UserOrderController::class, 'show'])
        ->name('user.orders.show');

    Route::get('/user/contact', [ContactController::class, 'index'])
        ->name('user.contact.index');

    Route::post('/user/contact', [ContactController::class, 'store'])
        ->name('user.contact.store');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class)
            ->except(['show']);

        Route::resource('books', BookController::class)
            ->except(['show']);

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.update-status');

        Route::get('/messages', [MessageController::class, 'index'])
            ->name('messages.index');

        Route::get('/messages/{message}', [MessageController::class, 'show'])
            ->name('messages.show');

        Route::patch('/messages/{message}/reply', [MessageController::class, 'reply'])
            ->name('messages.reply');

        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])
            ->name('messages.destroy');
    });

require __DIR__.'/auth.php';
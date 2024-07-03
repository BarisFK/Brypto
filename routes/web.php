<?php

use App\Http\Controllers\CardsController;
use App\Http\Controllers\PassController;
use App\Http\Controllers\XfilesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;


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
    return view('home');
})->name('home');

Route::get('/about', [AdminController::class, 'about'])->name('about');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login'); # proje/login , login fonkisyonu ve eylemin ismi
    # bu rota , view dosyasında { route('login') } ile çağırılabilir
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});


//Admin için rotalar
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');

    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');

    //Add users
    Route::get('/admin/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/admin/users/store', [AdminController::class, 'store'])->name('users.store');

    //Users 
    Route::get('/admin/users/show/{id}', [AdminController::class, 'show'])->name('admin/products/show');
    Route::get('/admin/users/edit/{id}', [AdminController::class, 'edit'])->name('admin/products/edit');
    Route::put('/admin/users/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/users/destroy/{id}', [AdminController::class, 'destroy'])->name('admin/products/destroy');


    // X-files 
    Route::get('/admin/file', [XfilesController::class, 'decryptPage'])->name('decryptPage');
    Route::post('/admin/fileupload', [XfilesController::class, 'decryption'])->name('decryption');
    Route::post('/admin/read-txt', [XfilesController::class, 'readTxtFile'])->name('read.txt');
    Route::get('/admin/encrypt', [XfilesController::class, 'encryptPage'])->name('encryptPage');
    Route::post('/admin/encrypt', [XfilesController::class, 'encryption'])->name('encryption'); 
    Route::get('/admin/vault', [XfilesController::class, 'vaultPage'])->name('vaultPage');

    //Cards
    Route::get('/admin/cards', [CardsController::class, 'cardsPage'])->name('cardsPage');
    Route::post('/admin/cards/add', [CardsController::class, 'store'])->name('cardsAdd');
    Route::delete('/cards/delete/{id}', [CardsController::class, 'delete'])->name('cardsDelete');

    //Passwords
    Route::get('/admin/passwords', [PassController::class, 'passPage'])->name('passPage');
    Route::post('/admin/passwords/add', [PassController::class, 'store'])->name('passAdd');
    Route::delete('/passwords/delete/{id}', [CardsController::class, 'delete'])->name('cardsDelete');







});

//Normal kullancılar için rotalar
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::middleware(['user-access:user'])->get('/profile', [AdminController::class, 'userProfile'])->name('profile');
});

//Ortak rotalar
Route::middleware(['auth'])->group(function () { // Hem admin hem user için ortak middleware
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');
    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');
});

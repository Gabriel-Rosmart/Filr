<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use App\Models\Permit;
use App\Models\User;

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

Route::redirect('/', '/login');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'listAllActiveUsersFiles']);
    Route::get('/admin/manage', [AdminController::class, 'listAllUsers']);
    Route::get('/admin/permits', [AdminController::class, 'listAllPermits']);
    Route::get('/admin/details', [AdminController::class, 'getUserDetails']);
    Route::get('/admin/incidences', [AdminController::class, 'listAllIncidences']);
    Route::get('/admin/register', [AdminController::class, 'registerNewUser']);
    Route::get('/admin/edit', [AdminController::class, 'edit']);
    Route::post('/permits', PermitController::class);
    Route::post('/admin/register', [AdminController::class, 'saveRegisteredUser']);
    Route::post('/admin/edit', [AdminController::class, 'updateUser']);
    Route::get('/permits/pending', function () {
        return Permit::where('status', 'pending')->count();
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/edit', [UserController::class, 'edit']);
    Route::post('/user/edit', [UserController::class, 'update']);
    Route::get('user/permitreq', [UserController::class, 'permitRequest']);
    Route::post('user/permitreq', [UserController::class, 'permitSend']);
    Route::get('/avatar', function () {
        return auth()->user()->profile_pic;
    });

    //Route::get('/user/pdftest', [UserController::class, 'pdfGenerate']); // PARA BORRAR
});

Route::post('/token', TokenController::class);

Route::get('/dashboard', function () {
    return Inertia::render('User/Dashboard');
})->middleware(['auth', 'verified'])->name('user');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

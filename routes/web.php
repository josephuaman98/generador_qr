<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SocketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;;


use App\Http\Controllers\Generador\GeneradorController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/login', [AuthController::class, 'loginFiscalizador']);


// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);


Route::group(['middleware' => ['auth']], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/perfil', [ProfileController::class, 'perfil'])->name('perfil');
    Route::post('/perfil', [ProfileController::class, 'update'])->name('perfil.update');

    // : : : : : : : : : : : : : : : ROLES - USUARIOS - MODULO : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : :

    Route::resource('roles', RolController::class);

    // Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
    // Route::get('/roles/create', [RolController::class, 'create'])->name('roles.create');
    // Route::post('/roles', [RolController::class, 'store'])->name('roles.store');
    // Route::get('/roles/{role}', [RolController::class, 'show'])->name('roles.show');
    // Route::get('/roles/{role}/edit', [RolController::class, 'edit'])->name('roles.edit');
    // Route::put('/roles/{role}', [RolController::class, 'update'])->name('roles.update');
    // Route::delete('/roles/{role}', [RolController::class, 'destroy'])->name('roles.destroy');


    Route::resource('usuarios', UsuarioController::class);
    Route::put('usuarios/{usuario}/update-permissions', [UsuarioController::class, 'updatePermissions'])->name('usuarios.updatePermissions');

    Route::get('modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('modules/create', [ModuleController::class, 'create'])->name('modules.create');
    Route::post('modules', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('modules/{id}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('modules/{id}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('modules/{id}', [ModuleController::class, 'destroy'])->name('modules.destroy');


    // GENERADOR QR
    Route::get('/generador', [GeneradorController::class, 'index'])->name('generador.index');
    Route::get('generador/create', [GeneradorController::class, 'create'])->name('generador.create');
    Route::post('generador/store', [GeneradorController::class, 'store'])->name('generador.store');
    Route::get('generador/edit/{id}', [GeneradorController::class, 'edit'])->name('generador.edit');
    Route::put('generador/{id}', [GeneradorController::class, 'update'])->name('generador.update');
    Route::delete('generador/{id}', [GeneradorController::class, 'destroy'])->name('generador.destroy');




    // WEB SOCKET
    Route::get('/socket', [SocketController::class, 'index'])->name('socket.index');
    Route::get('/socket/create', [SocketController::class, 'create'])->name('socket.create');
    Route::post('/socket/store', [SocketController::class, 'store'])->name('socket.store');

    Route::get('/socket/edit/{id}', [SocketController::class, 'edit'])->name('socket.edit');
    Route::put('/socket/{id}', [SocketController::class, 'update'])->name('socket.update');

});




require __DIR__ . '/auth.php';

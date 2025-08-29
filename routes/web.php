<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SocketController;
use App\Http\Controllers\Restaurante\RestauranteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;;
use App\Http\Controllers\Restaurante\VentaController;

use App\Http\Controllers\Generador\GeneradorController;
use App\Http\Controllers\Credencial\CredencialController;
use App\Http\Controllers\Generador\Vista\VistaController;
// pdf
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/login', [AuthController::class, 'loginFiscalizador']);


// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// QR DE COMERCIO INFORMAL - CREDENCIAL
Route::get('/credencial/qr/{id_socio}', [CredencialController::class, 'generarLinkTemporal']);
Route::get('/credencial/token/{token}', [CredencialController::class, 'showPorToken']);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - -  PDF ENCRIPTADO - - - - - - - - - - - - - - - - - - - - - - - - - - -

Route::get('/ver-pdf/{file}', function ($file) {
    if (! request()->hasValidSignature()) {
        abort(403, 'El enlace expiró o no es válido.');
    }

    if (!Storage::disk('private')->exists($file)) {
        abort(404, 'Archivo no encontrado');
    }

    return Storage::disk('private')->response($file);

})->where('file', '.*')->name('pdf.ver');

Route::get('/credencial/generar-link', [CredencialController::class, 'generarLink'])
    ->name('credencial.generarLink');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

Route::group(['middleware' => ['auth']], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/perfil', [ProfileController::class, 'perfil'])->name('perfil');
    Route::post('/perfil', [ProfileController::class, 'update'])->name('perfil.update');

    // : : : : : : : : : : : : : : : ROLES - USUARIOS - MODULO : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : :

    Route::resource('roles', RolController::class);

    

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

    // VISTAS GENERADOR
    Route::get('/vista/parque-antonio-de-la-guerra', [VistaController::class, 'parqueAntonioDeLaGuerra'])->name('vistas.parque-antonio-de-la-guerra');


    // Credenciales
    Route::get('/credencial', [CredencialController::class, 'index'])->name('credencial.index');
    Route::get('/credencial/pdf', [CredencialController::class, 'pdf'])->name('credencial.pdf');
    
    Route::get('/pdf', [CredencialController::class, 'pdf'])->name('credenciales.pdf');


});




require __DIR__ . '/auth.php';


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Middleware global para bloquear acceso a admin desde puerto público
Route::middleware('block.admin.public')->group(function () {
    // Rutas públicas
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/habitaciones', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/habitaciones/{slug}', [RoomController::class, 'show'])->name('rooms.show');

    // Rutas de autenticación
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

    // Rutas de perfil
    Route::get('/perfil', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show')->middleware('auth');

    // Rutas de reservas
    Route::post('/reservas/verificar-disponibilidad', [ReservationController::class, 'checkAvailability'])->name('reservations.check');
    Route::post('/reservas', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservas/exito/{id}', [ReservationController::class, 'success'])->name('reservations.success');
    Route::get('/mis-reservas', [ReservationController::class, 'myReservations'])->name('reservations.my')->middleware('auth');

    // Rutas de reseñas
    Route::post('/resenas', [ReviewController::class, 'store'])->name('reviews.store');

    // Rutas de contacto
    Route::get('/contacto', function () {
        return view('contact');
    })->name('contact');

    // Rutas de páginas legales
    Route::get('/politica-privacidad', [App\Http\Controllers\PageController::class, 'privacy'])->name('pages.privacy');
    Route::get('/terminos-condiciones', [App\Http\Controllers\PageController::class, 'terms'])->name('pages.terms');

    // Rutas de libro de reclamaciones
    Route::get('/libro-reclamaciones', [App\Http\Controllers\ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/libro-reclamaciones', [App\Http\Controllers\ComplaintController::class, 'store'])->name('complaints.store');
});

// Rutas de login administrativo (OCULTAS - Solo accesibles desde puerto 8001)
Route::prefix('admin')->middleware('admin.port')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'showLoginForm'])->name('admin.login')->middleware('guest.admin');
    Route::post('/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'login'])->middleware('guest.admin');
    Route::post('/logout', [App\Http\Controllers\Admin\AdminLoginController::class, 'logout'])->name('admin.logout');
});

// Panel administrativo (Protegido) - Solo accesible desde puerto 8001, usa guard 'admin' para sesión separada
Route::prefix('admin')->middleware(['admin.port', 'auth:admin', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::resource('rooms', App\Http\Controllers\Admin\RoomController::class)->names([
        'index' => 'admin.rooms.index',
        'create' => 'admin.rooms.create',
        'store' => 'admin.rooms.store',
        'show' => 'admin.rooms.show',
        'edit' => 'admin.rooms.edit',
        'update' => 'admin.rooms.update',
        'destroy' => 'admin.rooms.destroy',
    ]);
    
    // Rutas para gestión de imágenes de habitaciones
    Route::delete('/rooms/{room}/images/{image}', [App\Http\Controllers\Admin\RoomController::class, 'deleteImage'])->name('admin.rooms.images.delete');
    Route::post('/rooms/{room}/images/{image}/set-primary', [App\Http\Controllers\Admin\RoomController::class, 'setPrimaryImage'])->name('admin.rooms.images.set-primary');
    
    Route::resource('reservations', App\Http\Controllers\Admin\ReservationController::class)->names([
        'index' => 'admin.reservations.index',
        'show' => 'admin.reservations.show',
        'destroy' => 'admin.reservations.destroy',
    ]);
    
    Route::post('/reservations/{id}/confirm', [App\Http\Controllers\Admin\ReservationController::class, 'confirm'])->name('admin.reservations.confirm');
    Route::post('/reservations/{id}/cancel', [App\Http\Controllers\Admin\ReservationController::class, 'cancel'])->name('admin.reservations.cancel');
    
    // Rutas de control de habitaciones (estado visual)
    Route::get('/room-status', [App\Http\Controllers\Admin\RoomStatusController::class, 'index'])->name('admin.room-status.index');
    Route::get('/room-status/{room}/status', [App\Http\Controllers\Admin\RoomStatusController::class, 'getRoomStatus'])->name('admin.room-status.get-status');
    Route::post('/room-status/{room}/update-status', [App\Http\Controllers\Admin\RoomStatusController::class, 'updateStatus'])->name('admin.room-status.update-status');
    Route::get('/room-status/{room}/history', [App\Http\Controllers\Admin\RoomStatusController::class, 'getHistory'])->name('admin.room-status.history');
    Route::post('/room-status/reservations/{reservation}/check-in', [App\Http\Controllers\Admin\RoomStatusController::class, 'checkIn'])->name('admin.room-status.check-in');
    Route::post('/room-status/reservations/{reservation}/check-out', [App\Http\Controllers\Admin\RoomStatusController::class, 'checkOut'])->name('admin.room-status.check-out');
    
    Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class)->names([
        'index' => 'admin.reviews.index',
        'show' => 'admin.reviews.show',
        'edit' => 'admin.reviews.edit',
        'update' => 'admin.reviews.update',
        'destroy' => 'admin.reviews.destroy',
    ]);
    
    Route::get('/settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('admin.settings.update');
    
    // Rutas de control de habitaciones (estado visual)
    Route::get('/room-status', [App\Http\Controllers\Admin\RoomStatusController::class, 'index'])->name('admin.room-status.index');
    Route::get('/room-status/{room}/status', [App\Http\Controllers\Admin\RoomStatusController::class, 'getRoomStatus'])->name('admin.room-status.get-status');
    Route::post('/room-status/{room}/update-status', [App\Http\Controllers\Admin\RoomStatusController::class, 'updateStatus'])->name('admin.room-status.update-status');
    Route::get('/room-status/{room}/history', [App\Http\Controllers\Admin\RoomStatusController::class, 'getHistory'])->name('admin.room-status.history');
    Route::post('/reservations/{reservation}/check-in', [App\Http\Controllers\Admin\RoomStatusController::class, 'checkIn'])->name('admin.room-status.check-in');
    Route::post('/reservations/{reservation}/check-out', [App\Http\Controllers\Admin\RoomStatusController::class, 'checkOut'])->name('admin.room-status.check-out');
    
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->names([
        'index' => 'admin.users.index',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ])->only(['index', 'show', 'edit', 'update', 'destroy']);
    
    // Rutas de libro de reclamaciones (admin)
    Route::resource('complaints', App\Http\Controllers\Admin\ComplaintController::class)->names([
        'index' => 'admin.complaints.index',
        'show' => 'admin.complaints.show',
        'update' => 'admin.complaints.update',
        'destroy' => 'admin.complaints.destroy',
    ])->only(['index', 'show', 'update', 'destroy']);
});

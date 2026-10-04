<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ── Landing Page ───────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ── Auth Routes (Guest only) ───────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:register')
        ->name('register.post');

    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.post');
});

// ── Protected dashboards: User ────────────────────────────────────────────────
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.home');
    
    // Menerapkan Rate Limiter (Maksimal 3 kali submit per 1 menit)
    Route::post('/pendaftaran', [PendaftaranController::class, 'CreatePendaftaran'])->middleware('throttle:3,1')->name('pendaftaran.create');

    Route::post('/user/jadwal/pilih', [UserController::class, 'pilihJadwal'])->name('user.jadwal.pilih');
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// ── Protected dashboards: Admin ───────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,Pres,HR,CC,Bendahara,Sekretaris,PR,Medinfo'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/admin/peserta', [AdminController::class, 'peserta'])
    ->middleware('throttle:3,1')
    ->name('admin.peserta');
    Route::get('/admin/jadwal', [AdminController::class, 'jadwal'])->name('admin.jadwal');
    Route::post('/admin/jadwal', [AdminController::class, 'storeJadwal'])->name('admin.jadwal.store');
    Route::put('/admin/jadwal/{id}', [AdminController::class, 'updateJadwal'])->name('admin.jadwal.update');
    Route::patch('/admin/jadwal/{id}/status', [AdminController::class, 'updateStatusJadwal'])->name('admin.jadwal.status');
    Route::delete('/admin/jadwal/{id}', [AdminController::class, 'destroyJadwal'])->name('admin.jadwal.destroy');
    Route::post('/admin/peserta/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.peserta.status');
});

// ── Logout (Auth only) ────────────────────────────────────────────────────────
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
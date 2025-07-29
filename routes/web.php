<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentTicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\TicketController as PublicTicketController;
use App\Http\Controllers\Technician\TechnicianDashboardController;
use App\Http\Controllers\Technician\TechnicianTicketController;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| 🔐 AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 🏠 PUBLIC LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| 🛠 ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckRole::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // 📊 Dashboard (View: resources/views/admin/dashboard/index.blade.php)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 👥 User Management (View: admin/users/)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // 🧑‍🔧 Technicians (View: admin/technicians/)
    Route::resource('technicians', TechnicianController::class);

    // 🗂 Categories (View: admin/category/)
    Route::resource('categories', CategoryController::class)->except(['show']);

    // 🎫 Tickets (View: admin/tickets/)
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
});

/*
|--------------------------------------------------------------------------
| 👤 USER (PELAPOR) ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckRole::class . ':user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');
        Route::get('/tickets', [PublicTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/create', [PublicTicketController::class, 'create'])->name('tickets.create'); // ← INI PENTING!
        Route::post('/tickets', [PublicTicketController::class, 'store'])->name('tickets.store');
    });

/*
|--------------------------------------------------------------------------
| 🧑‍💼 AGENT (HELPDESK AGENT) ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckRole::class . ':helpdesk_agent'])
    ->prefix('agent')
    ->name('agent.')
    ->group(function () {

    // 📊 Dashboard (View: agent/dashboard.blade.php)
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');

    // 🎫 Ticket Monitoring (View: agent/tickets/)
    Route::get('/tickets', [AgentTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/manual', [AgentTicketController::class, 'manualList'])->name('tickets.manual');
    Route::get('/tickets/{ticket}', [AgentTicketController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/manual-assign', [AgentTicketController::class, 'manualAssign'])->name('tickets.manual-assign');
    Route::post('/tickets/{ticket}/assign', [AgentTicketController::class, 'storeAssign'])->name('tickets.assign');
});


Route::middleware(['auth', CheckRole::class . ':it_support'])
    ->prefix('technician')
    ->name('technician.')
    ->group(function () {
        Route::get('/dashboard', [TechnicianDashboardController::class, 'index'])->name('dashboard');
        Route::get('/tickets', [TechnicianTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [TechnicianTicketController::class, 'show'])->name('tickets.show');
        Route::put('/tickets/{ticket}', [TechnicianTicketController::class, 'update'])->name('tickets.update');
        Route::post('/tickets/{ticket}/reply', [TechnicianTicketController::class, 'reply'])->name('tickets.reply');
    });

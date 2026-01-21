<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/', [HomeController::class, 'index']);
Route::post('/rsvp', [RsvpController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/event', [DashboardController::class, 'editEvent'])->name('admin.event.edit');
    Route::post('/admin/event', [DashboardController::class, 'updateEvent'])->name('admin.event.update');

    Route::get('/admin/gallery', [DashboardController::class, 'gallery'])->name('admin.gallery');
    Route::post('/admin/gallery', [DashboardController::class, 'storeGallery'])->name('admin.gallery.store');
    Route::delete('/admin/gallery/{id}', [DashboardController::class, 'deleteGallery'])->name('admin.gallery.delete');

    Route::get('/admin/rsvp/export-excel', [DashboardController::class, 'exportExcel'])->name('admin.rsvp.export.excel');
    Route::get('/admin/rsvp/export-pdf', [DashboardController::class, 'exportPdf'])->name('admin.rsvp.export.pdf');
});


require __DIR__.'/auth.php';

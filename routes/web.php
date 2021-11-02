<?php

use App\Http\Controllers\DrawingController;
use App\Http\Controllers\InviteeController;
use App\Http\Controllers\DrawController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth'])->group(function() {
    Route::resource('drawings', DrawingController::class);
    Route::resource('drawings.invitees', InviteeController::class);
    Route::post('drawings/{drawing}/invitees/invite', [InviteeController::class, 'invite'])->name('drawings.invitees.invite');
});

Route::get("/drawings/{drawing}/invitees/{invitee}/draw", [DrawController::class, 'show'])->name('drawings.draw');
Route::post("/drawings/{drawing}/invitees/{invitee}/draw", [DrawController::class, 'store'])->name('draw.store');

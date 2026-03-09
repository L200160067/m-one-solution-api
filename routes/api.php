<?php

use App\Http\Controllers\Api\AlumniController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\TestimonialController;
use Illuminate\Support\Facades\Route;

// Health check
Route::get('/ping', fn () => response()->json([
    'success' => true,
    'app'     => config('app.name'),
    'time'    => now()->toISOString(),
]));

// Blog / Artikel
Route::get('/posts', [PostController::class, 'index'])->name('api.posts.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('api.posts.show');

// Layanan
Route::get('/services', [ServiceController::class, 'index'])->name('api.services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('api.services.show');

// Portofolio
Route::get('/projects', [ProjectController::class, 'index'])->name('api.projects.index');

// Tim
Route::get('/team', [TeamController::class, 'index'])->name('api.team.index');

// Alumni PKL
Route::get('/alumni', [AlumniController::class, 'index'])->name('api.alumni.index');

// Testimoni
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('api.testimonials.index');

// Mitra
Route::get('/partners', [PartnerController::class, 'index'])->name('api.partners.index');

// Pengaturan Global
Route::get('/settings', [SettingController::class, 'index'])->name('api.settings.index');


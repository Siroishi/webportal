<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UniversityFacultyController;
use App\Http\Controllers\UniversityFacultyRelationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('news.index');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::resource('knowledge', KnowledgeController::class)->only(['index', 'show']);
Route::resource('universities', UniversityController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';

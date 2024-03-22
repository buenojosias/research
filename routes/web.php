<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function() {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('estudantes', \App\Livewire\Student\StudentIndex::class )->name('students');
    Route::get('pesquisas', function() {
        return 'Pesquisas';
    })->name('researches');

    Route::view('profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';

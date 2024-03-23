<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function() {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('estudantes', \App\Livewire\Student\StudentIndex::class )->name('students');

    Route::get('pesquisas', \App\Livewire\Research\ResearchIndex::class )->name('researches');

    Route::view('profile', 'profile')->name('profile');

    Route::prefix('{research:pid}')->group(function() {
        Route::get('/', \App\Livewire\Research\ResearchShow::class )->name('researches.show');
        Route::get('pub', \App\Livewire\Publication\PublicationIndex::class)->name('researches.publications');
    });
});

require __DIR__.'/auth.php';

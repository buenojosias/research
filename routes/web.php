<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function() {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('estudantes', \App\Livewire\Student\StudentIndex::class )->name('students');

    Route::get('pesquisas', \App\Livewire\Research\ResearchIndex::class )->name('researches');
    Route::get('pesquisas/nova', \App\Livewire\Research\ResearchForm::class )->name('researche.create');

    Route::view('profile', 'profile')->name('profile');

    Route::prefix('p{research:pid}')->group(function() {
        Route::get('/', \App\Livewire\Research\ResearchShow::class )->name('researches.show');
        Route::get('editar', \App\Livewire\Research\ResearchForm::class)->name('researches.edit');
        Route::get('pub', \App\Livewire\Publication\PublicationIndex::class)->name('researches.publications');
        Route::get('pub/{publication}', \App\Livewire\Publication\PublicationShow::class)->name('researches.publications.show');
        Route::get('pub/{publication}/pdf', \App\Livewire\File\FileShow::class)->name('researches.files.show');
        Route::get('pub/{publication}/conteudo', \App\Livewire\Publication\PublicationContent::class)->name('researches.publications.content');
    });
});

require __DIR__.'/auth.php';

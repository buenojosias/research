<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('files/{path}', [FileController::class, 'show'])->name('files');

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
        Route::get('pub/nova', \App\Livewire\Publication\PublicationCreate::class)->name('researches.publications.create');
        Route::get('pub/{publication}', \App\Livewire\Publication\PublicationShow::class)->name('researches.publications.show');
        Route::get('pub/{publication}/editar', \App\Livewire\Publication\PublicationEdit::class)->name('researches.publications.edit');
        Route::get('pub/{publication}/pdf', \App\Livewire\File\FileShow::class)->name('researches.files.show');
        Route::get('pub/{publication}/conteudo', \App\Livewire\Publication\PublicationContent::class)->name('researches.publications.content');
        Route::get('pub/{publication}/resumo', \App\Livewire\Internal\InternalForm::class)->name('researches.publications.abstract');
        Route::get('pub/{publication}/corpo', \App\Livewire\Internal\InternalForm::class)->name('researches.publications.body');

        Route::get('contagem', \App\Livewire\WordCount\WordCountIndex::class)->name('researches.wordcounts.index');
        Route::get('contagem/nova', \App\Livewire\WordCount\WordCountCreate::class)->name('researches.wordcounts.create');

        Route::get('arquivos', \App\Livewire\File\FileIndex::class)->name('researches.files.index');

        Route::get('keywords', \App\Livewire\Keyword\KeywordIndex::class)->name('researches.keywords.index');
    });
});

require __DIR__.'/auth.php';

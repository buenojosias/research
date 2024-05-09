<?php

use App\Http\Controllers\FileController;
use App\Livewire\Bibliometric\BibliometricForm;
use App\Livewire\Bibliometric\BibliometricShow;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\Project\ProjectCreate;
use App\Livewire\Project\ProjectIndex;
use App\Livewire\Project\ProjectShow;
use App\Livewire\Student\StudentIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('files/{path}', [FileController::class, 'show'])->name('files');

Route::middleware(['auth'])->group(function() {

    Route::get('dashboard', DashboardIndex::class)->name('dashboard');

    Route::get('estudantes', StudentIndex::class )->name('students.index');

    Route::get('projetos', ProjectIndex::class)->name('projects.index');
    Route::get('p/{project}', ProjectShow::class)->name('project.show');

    Route::get('p/{project}/bibiometria', BibliometricShow::class)->name('project.bibliometrics.show');

    Route::name('project.bibliometrics.')->prefix('p/{project}/b')->group(function() {
        Route::get('nova', BibliometricForm::class)->name('create');
        Route::get('editar', BibliometricForm::class)->name('edit');
    });

    // Route::get('pesquisas', \App\Livewire\Research\ResearchIndex::class )->name('researches');
    // Route::get('pesquisas/nova', \App\Livewire\Research\ResearchForm::class )->name('researche.create');

    // Route::view('profile', 'profile')->name('profile');

    // Route::prefix('p{research:pid}')->group(function() {
    //     Route::get('/', \App\Livewire\Research\ResearchShow::class )->name('researches.show');
    //     Route::get('editar', \App\Livewire\Research\ResearchForm::class)->name('researches.edit');

    //     Route::get('pub', \App\Livewire\Production\ProductionIndex::class)->name('researches.publications');
    //     Route::get('pub/nova', \App\Livewire\Production\ProductionCreate::class)->name('researches.publications.create');
    //     Route::get('pub/{publication}', \App\Livewire\Production\ProductionShow::class)->name('researches.publications.show');
    //     Route::get('pub/{publication}/editar', \App\Livewire\Production\ProductionEdit::class)->name('researches.publications.edit');
    //     Route::get('pub/{publication}/pdf', \App\Livewire\File\FileShow::class)->name('researches.files.show');
    //     Route::get('pub/{publication}/conteudo', \App\Livewire\Production\ProductionContent::class)->name('researches.publications.content');
    //     Route::get('pub/{publication}/resumo', \App\Livewire\Internal\InternalForm::class)->name('researches.publications.abstract');
    //     Route::get('pub/{publication}/corpo', \App\Livewire\Internal\InternalForm::class)->name('researches.publications.body');

    //     Route::get('contagem', \App\Livewire\WordCount\WordCountIndex::class)->name('researches.wordcounts.index');
    //     Route::get('contagem/nova', \App\Livewire\WordCount\WordCountCreate::class)->name('researches.wordcounts.create');
    //     Route::get('contagem/{wordcount}', \App\Livewire\WordCount\WordCountShow::class)->name('researches.wordcounts.show');

    //     Route::get('ranking', \App\Livewire\WordRanking\WordRankingIndex::class)->name('researches.wordrankings.index');
    //     Route::get('ranking/novo', \App\Livewire\WordRanking\WordRankingCreate::class)->name('researches.wordrankings.create');
    //     Route::get('ranking/{wordranking}', \App\Livewire\WordRanking\WordRankingShow::class)->name('researches.wordrankings.show');

    //     Route::get('arquivos', \App\Livewire\File\FileIndex::class)->name('researches.files.index');

    //     Route::get('keywords', \App\Livewire\Keyword\KeywordIndex::class)->name('researches.keywords.index');
    // });
});

require __DIR__.'/auth.php';

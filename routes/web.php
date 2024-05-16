<?php

use App\Http\Controllers\FileController;
use App\Livewire\Bibliometric\BibliometricForm;
use App\Livewire\Bibliometric\BibliometricShow;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\File\FileIndex;
use App\Livewire\File\FileShow;
use App\Livewire\Keyword\KeywordIndex;
use App\Livewire\Production\ProductionContent;
use App\Livewire\Production\ProductionCreate;
use App\Livewire\Production\ProductionEdit;
use App\Livewire\Production\ProductionIndex;
use App\Livewire\Production\ProductionKeywords;
use App\Livewire\Production\ProductionShow;
use App\Livewire\Project\ProjectCreate;
use App\Livewire\Project\ProjectIndex;
use App\Livewire\Project\ProjectShow;
use App\Livewire\Student\StudentIndex;
use App\Livewire\WordCount\WordCountCreate;
use App\Livewire\WordCount\WordCountIndex;
use App\Livewire\WordCount\WordCountShow;
use App\Livewire\WordRanking\WordRankingCreate;
use App\Livewire\WordRanking\WordRankingIndex;
use App\Livewire\WordRanking\WordRankingShow;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('files/{path}', [FileController::class, 'show'])->name('files');

Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', DashboardIndex::class)->name('dashboard');

    Route::get('estudantes', StudentIndex::class)->name('students.index');

    Route::get('projetos', ProjectIndex::class)->name('projects.index');
    Route::get('p/{project}', ProjectShow::class)->name('project.show');

    Route::get('p/{project}/bibiometria', BibliometricShow::class)->name('project.bibliometrics.show');

    Route::name('project.bibliometrics.')->prefix('p/{project}')->group(function () {
        Route::get('b/nova', BibliometricForm::class)->name('create');
        Route::get('b/editar', BibliometricForm::class)->name('edit');

        Route::get('producoes', ProductionIndex::class)->name('productions.index');
        Route::get('producoes/nova', ProductionCreate::class)->name('productions.create');
        Route::get('producoes/{production}', ProductionShow::class)->name('productions.show');
        Route::get('producoes/{production}/editar', ProductionEdit::class)->name('productions.edit');
        Route::get('producoes/{production}/arquivo', FileShow::class)->name('productions.files.show');
        Route::get('producoes/{production}/keywords', ProductionKeywords::class)->name('productions.keywords');
        Route::get('producoes/{production}/{section}', ProductionContent::class)->name('productions.section');
        Route::get('producoes/{production}/{section}/form', \App\Livewire\Internal\InternalForm::class)->name('productions.section.form');

        Route::get('rel/keywords', KeywordIndex::class)->name('keywords.index');

        Route::get('rel/contagem', WordCountIndex::class)->name('wordcounts.index');
        Route::get('rel/contagem/nova', WordCountCreate::class)->name('wordcounts.create');
        Route::get('rel/contagem/{wordcount}', WordCountShow::class)->name('wordcounts.show');

        Route::get('rel/ranking', WordRankingIndex::class)->name('wordrankings.index');
        Route::get('rel/ranking/novo', WordRankingCreate::class)->name('wordrankings.create');
        Route::get('rel/ranking/{wordranking}', WordRankingShow::class)->name('wordrankings.show');

        Route::get('arquivos', FileIndex::class)->name('files.index');
    });

    // Route::view('profile', 'profile')->name('profile');

    //     Route::get('pub/{publication}/conteudo', \App\Livewire\Production\ProductionContent::class)->name('researches.publications.content');
    //     Route::get('pub/{publication}/resumo', \App\Livewire\Internal\InternalForm::class)->name('researches.publications.abstract');
    //     Route::get('pub/{publication}/corpo', \App\Livewire\Internal\InternalForm::class)->name('researches.publications.body');

    // });
});

require __DIR__ . '/auth.php';

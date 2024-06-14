<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerSearch extends Component
{
    public $project;

    public $selectedWords = [];

    public $bibliometricTypes = [];

    public $bibliometricTerms = [];

    public $selectedTypes = [];

    public $withTrashed = false;

    public function mount(Project $project)
    {
        $this->project = $project;

        $bibliometric = $project->bibliometric;

        $this->bibliometricTypes = $bibliometric->types;
        $this->bibliometricTerms = $bibliometric->terms;
    }

    public function render()
    {
        // VERSÃO 1
        sort($this->selectedWords);

        $selectedWordsJson = json_encode($this->selectedWords);

        $records = Production::query()
            ->select(['id', 'title', 'type', 'year', 'searched_terms'])
            ->where('project_id', $this->project->id)
            ->whereRaw('JSON_LENGTH(searched_terms) = ?', [count($this->selectedWords)])
            ->whereRaw('JSON_CONTAINS(searched_terms, ?)', [$selectedWordsJson])
            ->when($this->selectedTypes, function($query) {
                $query->whereIn('type', $this->selectedTypes);
            })
            ->when($this->withTrashed, function($query) {
                $query->withTrashed();
            })
            ->get()
            ->groupBy('type');

        // FIM VERSÃO 1


        // VERSÃO 2
        $refeicoes = collect($this->project->productions);

        $agrupadasPorFrutas = $refeicoes->groupBy(function ($refeicao) {
            $frutas = $refeicao->searched_terms;
            sort($frutas); // Ordena as frutas para garantir a consistência
            return json_encode($frutas); // Converte para string JSON
        });

        $dadosTabela = [];
        $turnos = $this->bibliometricTypes;

        foreach ($agrupadasPorFrutas as $frutas => $grupo) {
            $frutasArray = json_decode($frutas, true);
            $frutasChave = implode(' AND ', $frutasArray); // Converte o array de frutas para string

            $total = 0; // Inicializa o total

            foreach ($turnos as $turno) {
                $count = $grupo->filter(function ($refeicao) use ($turno) {
                    return $refeicao->type->value === $turno;
                })->count();

                $dadosTabela[$frutasChave][$turno] = $count;
                $total += $count; // Incrementa o total com a contagem atual
            }

            $dadosTabela[$frutasChave]['total'] = $total; // Adiciona o total ao array
        }
        // FIM VERSÃO 2

        return view('livewire.record.record-per-search', compact('records', 'dadosTabela', 'turnos'))
            ->title('Relatório por combinações buscadas');
    }
}

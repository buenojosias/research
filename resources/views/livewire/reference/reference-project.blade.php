<div>
    <x-page-header title="Referências do projeto"
        subtitle="Estas referências são geradas automaticamente com base nas produções registradas no projeto.
        Estão prontas para serem adicionadas à sua monografia" />

    @foreach ($references as $reference)
        <p class="mb-4">
            {{-- <span class="text-gray-400">{{ $reference->type }}</span> --}}
            @foreach ($reference->authors as $author)
                {{ Str::upper($author->lastname) }}, {{ $author->forename }}{{ !$loop->last ? '; ' : (!str_ends_with($author->forename, '.') ? '.' : '') }}
            @endforeach
            @if(in_array($reference->type->value, ['TCC', 'Tese', 'Dissertação']))
                <strong>{{ $reference->title }}</strong>@if ($reference->subtitle){{ ': '. $reference->subtitle }}@endif.
                {{ $reference->year }}.
                {{ $reference->type }}
                <span class="text-red-600">(GRAU DE INSTRUÇÃO) –
                VINCULAÇÃO,</span>
                {{ $reference->institution }},
                {{ $reference->city }},
                {{ $reference->year }}.
                @if($reference->url)
                    Disponível em: <a href="{{ $reference->url }}" target="_blank">{{ $reference->url }}</a>.
                    Acesso em: {{ $reference->access_at }}.
                @endif
            @else
                {{ $reference->title }}@if ($reference->subtitle){{ ': '. $reference->subtitle }}@endif.
                <strong>{{ $reference->periodical }}</strong>,
                @if($reference->city){{ $reference->city }}, @endif
                <span class="text-red-600">v. {{ $reference->volume }},
                n. {{ $reference->number }},
                p. {{ $reference->pages }},</span>
                {{ $reference->month ? $reference->month . '.' : '' }}{{ $reference->year }}.
                @if($reference->doi) DOI: <a href="{{ $reference->doi }}" target="_blank">{{ $reference->doi }}</a>. @endif
                @if($reference->url)
                    Disponível em: <a href="{{ $reference->url }}" target="_blank">{{ $reference->url }}</a>.
                    Acesso em: {{ $reference->access_at }}.
                @endif
            @endif
        </p>
    @endforeach
</div>

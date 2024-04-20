<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use SebastianBergmann\CodeCoverage\Util\Percentage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('similariedade', function () {
    $internals = \App\Models\Internal::select('id', 'content')->whereIn('id', [1, 2])->get();

    // Itera sobre cada internal
    foreach ($internals as $internal1) {
        foreach ($internals as $internal2) {
            // Não compara o mesmo internal
            if ($internal1->id != $internal2->id) {
                // Aqui você implementaria a lógica para comparar os textos dos internals
                // Por exemplo, você pode usar uma biblioteca como 'text-similarity' para calcular a similaridade entre os textos
                $similarity = similar_text($internal1->content, $internal2->content, $percent);
                dump('Similariedade:', $internal1->id, $internal2->id, $similarity . '%');

                // Se a similaridade for superior a um determinado limiar, considere-os como correspondentes
                if ($percent > 80) { // Exemplo de limiar de 80%
                    $this->info("internals $internal1->id e $internal2->id são similares (Similaridade: $percent%)");
                }
            }
        }
    }
});

Artisan::command('levenshtein', function () {
    $input = 'carrrot';

    // array of words to check against
    $words = array (
        'apple',
        'pineapple',
        'banana',
        'orange',
        'radish',
        'carrot',
        'pea',
        'bean',
        'potato'
    );

    // no shortest distance found, yet
    $shortest = -1;

    // loop through words to find the closest
    foreach ($words as $word) {

        // calculate the distance between the input word,
        // and the current word
        $lev = levenshtein($input, $word);

        // check for an exact match
        if ($lev == 0) {

            // closest word is this one (exact match)
            $closest = $word;
            $shortest = 0;

            // break out of the loop; we've found an exact match
            break;
        }

        // if this distance is less than the next found shortest
        // distance, OR if a next shortest word has not yet been found
        if ($lev <= $shortest || $shortest < 0) {
            // set the closest match, and shortest distance
            $closest = $word;
            $shortest = $lev;
        }
        dump($lev);
    }

    // echo "Input word: $input\n";
    // if ($shortest == 0) {
    //     echo "Exact match found: $closest\n";
    // } else {
    //     echo "Did you mean: $closest?\n";
    // }
});

Artisan::command('similarwords', function () {
    $internals = \App\Models\Internal::whereIn('id', [1,2,3])->get();
    // Itera sobre cada internal
    $data = [];
    foreach ($internals as $internal1) {
        foreach ($internals as $internal2) {
            // Não compara o mesmo internal
            if ($internal1->id != $internal2->id) {
                // Divide os internals em arrays de palavras
                $words1 = explode(' ', $internal1->content);
                $words2 = explode(' ', $internal2->content);

                // Conta quantas palavras são comuns entre os dois internals
                $common_words = array_intersect($words1, $words2);
                $num_common_words = count($common_words);

                // Calcula a similaridade como uma porcentagem relativa ao número total de palavras no internal1
                $percent = ($num_common_words / (count($words1) + count($words2) / 2)) * 100;

                array_push($data, [
                    'internal1' => $internal1->id,
                    'internal2' => $internal2->id,
                    'common words' => $num_common_words,
                    'percentage' => $percent
                ]);

                // Exibe a similaridade
                // dump("internals $internal1->id e $internal2->id têm $num_common_words palavras em comum (Similaridade: $percent%)");
            }
        }
    }
    dump($data);
});

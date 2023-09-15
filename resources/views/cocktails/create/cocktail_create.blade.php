
{{-- @php
    // Rimuovi duplicati basati sul nome della tabella
    $uniqueIngredients = collect($ingredients)->unique(function ($item) {
        return $item->Tables();
    });

    // Ordina gli ingredienti per nome
    $sortedIngredients = $uniqueIngredients->sortBy(function ($item) {
        return $item->Tables();
    });

    foreach ($sortedIngredients as $ingredient) {
        echo $ingredient->Tables() . '<br>';
    }
@endphp --}}

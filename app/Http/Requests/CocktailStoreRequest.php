<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\DB;

class CocktailStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'preparation' => 'required|string',
            'ABV' => 'required|numeric|min:0|max:99',
            'official_ABV' => 'boolean|nullable',
            'glass_id' => 'required|exists:glasses,id',
            'ice_option' => 'in:yes,no',
            'ice_id' => 'nullable|exists:ices,id',
            'variation_option' => 'in:yes,no',
            'variation' => 'nullable|exists:cocktails,id',
            'signature_option' => 'in:yes,no',
            'signature_text' => 'nullable|string',
            'garnish_option' => 'in:yes,no',
            'garnish' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Aggiungi regole per l'immagine
            'ingredients.*.ingredientable_type' => 'required|string',
            'ingredients.*.ingredientable_id' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    // Ottieni il tipo dinamico dell'ingrediente (es. "Alcool")
                    $ingredientableType = $this->input("ingredients.*.ingredientable_type");

                    // Assicurati che ci sia almeno un elemento nell'array
                    if (count($ingredientableType) > 0) {
                        // Estrai il nome completo del modello dal primo elemento dell'array
                        $model = $ingredientableType[0];

                        // Ottieni il nome della tabella associata al modello
                        $modelInstance = new $model;
                        $tableName = $modelInstance->getTable();

                        // Verifica se l'ID esiste nella tabella specificata
                        $exists = DB::table($tableName)->where('id', $value)->exists();

                        // Se l'ID non esiste, aggiungi un messaggio di errore personalizzato
                        if (!$exists) {
                            $fail("L'ID specificato non esiste nella tabella $tableName.");
                        }
                    } else {
                        // L'array è vuoto, gestisci l'errore di conseguenza
                        $fail("Nessun tipo dinamico dell'ingrediente trovato");
                    }
                },
            ],

            'ingredients.*.quantity_type' => 'required|string|in:ml,oz,dash,spoon,slice,clove,leaf,branch,pcs',
            'ingredients.*.quantity' => 'required|numeric|min:0.1|max:999.9', // Regole per ingredientable_type
            'equipements.*' => 'required|exists:equipements,id', // Regole per gli equipaggiamenti
        ];
    }
}

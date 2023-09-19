
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Creazione Nuovo Cocktail</h2>
    <form method="POST" action="{{ route('cocktails.store') }}" enctype="multipart/form-data" id="form">
        @csrf
        <!-- Campo Nome -->
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome" minlength="3" maxlength="50" value="{{ old('name') }}" pattern="^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$" required>
            <div class="valid-feedback">Campo valido.</div>
            <div class="invalid-feedback">Nome non idoneo</div>
        </div>
        <!-- Campo Descrizione -->
        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Inserisci una descrizione"></textarea>
        </div>
        <!-- Campo Categoria Ingredienti -->
        <div class="form-group" id="ingredientsLane1">
            <label for="ingredients1">Categoria Ingredienti:</label>
            <select id="ingredients1" onchange="AddIngredients(this)">
                <option value="0" selected>Scegli la categoria</option>
                <option value="alcools">Alcoolici</option>
                <option value="aromaticBitters">Bitter Aromatici</option>
                <option value="fruits">Frutta</option>
                <option value="juices">Succhi</option>
                <option value="others">Altro</option>
                <option value="sodas">Sodati</option>
                <option value="sugars">Zuccheri</option>
                <option value="syrups">Sciroppi</option>
            </select>
        </div>
        <!-- Bottone Aggiungi Ingrediente -->
        <div class="form-group" id="ingredientsLane2">
            <button type="button" class="btn btn-primary" id="addingredientbtn2" onclick="functionAddLane(this)">Aggiungi un altro ingrediente</button>
        </div>
        <!-- Checkboxes Equipments -->
        <div class="form-group">
            <label>Equipments:</label>
            @foreach ($equipements as $equipement)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="equipements[]" value="{{$equipement->id}}">
                    <label class="form-check-label">{{$equipement->name}}</label>
                </div>
            @endforeach
        </div>
        <!-- Campo Preparazione -->
        <div class="form-group">
            <label for="preparation">Preparazione:</label>
            <textarea class="form-control" id="preparation" name="preparation" placeholder="Inserisci una descrizione"></textarea>
        </div>
        <!-- Campo Grado Alcolico Medio -->
        <div class="form-group">
            <label for="avg_ABV">Grado Alcolico Medio (ABV%):</label>
            <input type="number" step="0.1" class="form-control" id="ABV" name="ABV" placeholder="Inserisci il grado alcolico" required>
        </div>
        <!-- Campo Ghiaccio -->
        <div class="form-group">
            <label>Ghiaccio:</label>
            <div>
                <input type="radio" name="ice_option" id="ice_no" value="no" checked>
                <label for="ice_no">No</label>
            </div>
            <div>
                <input type="radio" name="ice_option" id="ice_yes" value="yes">
                <label for="ice_yes">Sì</label>
            </div>
        </div>
        <!-- Seleziona Tipo di Ghiaccio -->
        <div id="ice_select" style="display: none;">
            <label for="ice_id">Seleziona il tipo di ghiaccio:</label>
            <select name="ice_id" id="ice_id" required>
                @foreach ($ices as $ice)
                    <option value="{{$ice->id}}">{{$ice->name}}</option>
                @endforeach
            </select>
        </div>
        <!-- Campo Tipo di Bicchiere -->
        <div class="form-group">
            <label for="glass_id">Tipo di bicchiere:</label>
            <select name="glass_id" id="glass_id" required>
                <option disabled selected>Scegli il tipo di bicchiere</option>
                @foreach ($glasses as $glass)
                    <option value="{{$glass->id}}">{{$glass->name}}</option>          
                @endforeach
            </select>
        </div>
        <!-- Cocktail Ufficiale IBA -->
        <div class="form-group">
            <label>Cocktail Ufficiale IBA:</label>
            <div>
                <input type="radio" name="official_IBA" id="official_IBA_yes" value="true">
                <label for="official_IBA_yes">Si</label>
            </div>
            <div>
                <input type="radio" name="official_IBA" id="official_IBA_no" value="false" checked>
                <label for="official_IBA_no">No</label>
            </div>
        </div>
        <!-- Variazione -->
        <div class="form-group">
            <label>Variazione:</label>
            <div>
                <input type="radio" name="variation_option" id="variation_no" value="no" checked>
                <label for="variation_no">No</label>
            </div>
            <div>
                <input type="radio" name="variation_option" id="variation_yes" value="yes">
                <label for="variation_yes">Si</label>
            </div>
        </div>
        <!-- Seleziona Variazione -->
        <div id="variation_select" style="display: none;">
            <label for="variation">Seleziona la variazione:</label>
            <select name="variation" id="variation" required>
                <option disabled selected>Scegli la variazione</option>
                @foreach ($cocktails as $cocktail)
                    <option value="{{$cocktail->id}}">{{$cocktail->name}}</option>
                @endforeach
            </select>
        </div>
        <!-- Cocktail Signature -->
        <div class="form-group">
            <label for="signature">Cocktail Signature?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="signature_option" id="signature_no" value="no" checked>
                <label class="form-check-label" for="signature_no">No</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="signature_option" id="signature_yes" value="yes">
                <label class="form-check-label" for="signature_yes">Yes</label>
            </div>
            <div class="form-group" id="signature_text_input" style="display: none;">
                <label for="signature_text">Enter Signature Text:</label>
                <input type="text" class="form-control" id="signature_text" name="signature_text">
            </div>
        </div>
        <!-- Guarnizione -->
        <div class="form-group">
            <label for="garnish_option">Guarnizione:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="garnish_option" id="garnish_no" value="no" checked>
                <label class="form-check-label" for="garnish_no">No</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="garnish_option" id="garnish_yes" value="yes">
                <label class="form-check-label" for="garnish_yes">Yes</label>
            </div>
            <div class="form-group" id="garnish_text_input" style="display: none;">
                <label for="garnish_text">Enter Garnish Text:</label>
                <input type="text" class="form-control" id="garnish_text" name="garnish_text">
            </div>
        </div>
        <!-- Immagine -->
        <div class="form-group">
            <label for="image">Immagine:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img id="image-preview" src="" alt="Preview dell'immagine" style="max-width: 400px; max-height: 400px; display: none;">
        </div>
        <!-- Con Cannuccia -->
        <div class="form-group">
            <label>Con Cannuccia:</label>
            <div>
                <input type="radio" name="straw" id="straw_yes" value=true>
                <label for="straw_yes">Si</label>
            </div>
            <div>
                <input type="radio" name="straw" id="straw_no" value=false checked>
                <label for="straw_no">No</label>
            </div>
        </div>
        <!-- Bottone di Invio -->
        <button type="submit" class="btn btn-primary" id="submitButton">Crea Alcolico</button>
    </form>
</div>

<script>
    let ingredientNumber = 1;

    let categories = {
        alcools: {!! $alcools !!},
        aromaticBitters: {!! $aromaticBitters !!},
        fruits: {!! $fruits !!},
        juices: {!! $juices !!},
        others: {!! $others !!},
        sodas: {!! $sodas !!},
        sugars: {!! $sugars !!},
        syrups: {!! $syrups !!},
    }

    document.getElementById('image').addEventListener('change', function (e) {
        const imagePreview = document.getElementById('image-preview');

        // Verifica se è stato selezionato un file
        if (e.target.files.length > 0) {
            const selectedImage = e.target.files[0];

            // Leggi il file come URL dati (data URL)
            const reader = new FileReader();
            reader.onload = function (event) {
                // Assegna l'URL dati all'elemento <img> per la visualizzazione della preview
                imagePreview.src = event.target.result;
                imagePreview.style.display = 'block'; // Mostra l'elemento
            };
            reader.readAsDataURL(selectedImage);
        } else {
            // Se non è stato selezionato un file, nascondi l'elemento <img>
            imagePreview.style.display = 'none';
            imagePreview.src = ''; // Pulisci l'URL
        }
    });

    document.getElementById('submitButton').setAttribute('disabled', 'disabled');

    function handleInputValidation() {
        let nameInput = document.getElementById('name');
        let value = nameInput.value;

        if (value.length > 2) {
            return fetch("{{ route('check.Alcools') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ name: value })
            })
            .then(response => response.json())
            .then(data => {
                if (data.result) {
                    // Il nome è valido
                    nameInput.classList.remove('is-invalid');
                    nameInput.classList.add('is-valid');
                    console.log('true');
                    document.getElementById('submitButton').removeAttribute('disabled'); // Abilita il pulsante
                    return true; // Restituisci true se la validazione è positiva
                } else {
                    // Il nome non è valido
                    nameInput.classList.remove('is-valid');
                    nameInput.classList.add('is-invalid');
                    document.getElementById('submitButton').setAttribute('disabled', 'disabled'); // Disabilita il pulsante
                    return false; // Restituisci false se la validazione è negativa
                }
            });
        } else {
            nameInput.classList.remove('is-valid');
            nameInput.classList.remove('is-invalid');
            document.getElementById('submitButton').setAttribute('disabled', 'disabled'); // Disabilita il pulsante
            return false; // Restituisci false se la validazione non è stata avviata
        }
    };

    document.getElementById('form').addEventListener('submit', function (event) {
        if (!handleInputValidation()) {
            event.preventDefault(); // Previeni l'invio del modulo se l'input non è valido
            return false;
        }
    });

    document.getElementById('name').addEventListener('input', () => {
        handleInputValidation();
    });

    document.addEventListener('DOMContentLoaded', function () {
        var signatureOptionInputs = document.querySelectorAll('input[name="signature_option"]');
        var signatureTextInput = document.getElementById('signature_text_input');

        signatureOptionInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                if (this.value === 'yes') {
                    signatureTextInput.style.display = 'block';
                } else {
                    signatureTextInput.style.display = 'none';
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var iceNoRadio = document.getElementById('ice_no');
        var iceYesRadio = document.getElementById('ice_yes');
        var iceSelect = document.getElementById('ice_select');

        function toggleIceSelect() {
            iceSelect.style.display = iceYesRadio.checked ? 'block' : 'none';
        }

        iceNoRadio.addEventListener('change', toggleIceSelect);
        iceYesRadio.addEventListener('change', toggleIceSelect);

        // Esegui il toggle iniziale in base alla selezione predefinita
        toggleIceSelect();
    });

    document.addEventListener('DOMContentLoaded', function () {
        var garnishNoRadio = document.getElementById('garnish_no');
        var garnishYesRadio = document.getElementById('garnish_yes');
        var garnishTextInput = document.getElementById('garnish_text_input');

        function toggleGarnishTextInput() {
            garnishTextInput.style.display = garnishYesRadio.checked ? 'block' : 'none';
        }

        garnishNoRadio.addEventListener('change', toggleGarnishTextInput);
        garnishYesRadio.addEventListener('change', toggleGarnishTextInput);

        // Esegui il toggle iniziale in base alla selezione predefinita
        toggleGarnishTextInput();
    });

    document.addEventListener('DOMContentLoaded', function () {
        var variationNoRadio = document.getElementById('variation_no');
        var variationYesRadio = document.getElementById('variation_yes');
        var variationSelect = document.getElementById('variation_select');

        function toggleVariationSelect() {
            variationSelect.style.display = variationYesRadio.checked ? 'block' : 'none';
        }

        variationNoRadio.addEventListener('change', toggleVariationSelect);
        variationYesRadio.addEventListener('change', toggleVariationSelect);

        // Esegui il toggle iniziale in base alla selezione predefinita
        toggleVariationSelect();
    });

    //funzione creazione select
    function createSelect(name, id) {
        //crea un select
        var newSelect = document.createElement("select");
        newSelect.name = "ingredients[" + id + "][ingredientable_id]";
        newSelect.id = name + id;

        // Aggiungi le opzioni in base alle tue esigenze
        var options = {
            0: 'Scegli un ingrediente',
            // Aggiungi le altre opzioni qui
        };

        for (var value in options) {
            var option = document.createElement("option");
            option.text = options[value];
            option.value = value;
            newSelect.appendChild(option);
        }

        return newSelect;
    }

    //funzione creazione option
    function createOption(text, value) {
        var option = document.createElement("option");
        option.text = text;
        option.value = value;
        return option;
    }

    //funzione creazione select per quantity type
    function createQuantityType(name, id) {
        var newSelectType = document.createElement("select");
        newSelectType.name = "ingredients[" + id + "][quantity_type]";
        newSelectType.id = name + id;

        // Aggiungi le opzioni in base alle tue esigenze
        var options = {
            'ml': 'ml',
            'oz': 'oz',
            'dash': 'dash',
            'spoon': 'spoon',
            'slice': 'slice',
            'cove': 'cove',
            'leaf': 'leaf',
            'branch': 'branch'
            // Aggiungi le altre opzioni qui
        };

        for (var value in options) {
            var option = document.createElement("option");
            option.text = options[value];
            option.value = value;
            newSelectType.appendChild(option);
        }

        return newSelectType;
    }

    //funzione creazione input per quantity
    function createQuantity(name, id) {
        var newInput = document.createElement("input");
        newInput.type = "number";
        newInput.name = "ingredients[" + id + "][quantity]";
        newInput.id = name + id;
        newInput.min = 0.1;
        newInput.max = 999.9;
        newInput.step = 0.1;

        return newInput;
    }

    //funzione creazione input nascosto per ingredientable_type
    function createHiddenInput(id, value) {
        var newHiddenInput = document.createElement("input");
        newHiddenInput.type = "hidden";
        newHiddenInput.name = "ingredients[" + id + "][ingredientable_type]";
        newHiddenInput.id = 'hidden' + id;
        newHiddenInput.value = value[0].model;

        return newHiddenInput;
    }

    //funzione per aggiungere ingredienti
    function AddIngredients(x) {
        //prendo l'id della select che sto usando
        let idSelect = x.id;
        //tolgo la scritta "ingredients" in modo che so su quale linea sto lavorando
        let laneNumber = idSelect.replace("ingredients", "");
        //sfruttando il numero appena appreso trovo in quale div lavorare
        let SelectedDiv = document.getElementById('ingredientsLane' + laneNumber);
        //cin base all'id id prima prendo il valore
        let categoriesSelected = document.getElementById(idSelect).value;
        //creiamo una variabile di controllo per vedere se esiste già una select con quel nome
        checkeSelect = document.getElementById("ingredientType" + laneNumber);
        console.log(checkeSelect);
        checkQuantitySelect = document.getElementById("quantityType" + laneNumber);
        checkQuantity = document.getElementById("quantity" + laneNumber);
        checkHidden = document.getElementById("hidden" + laneNumber);
        //se esiste, eliminale
        if (checkeSelect || checkQuantitySelect || checkQuantity || checkHidden) {
            checkeSelect.remove();
            checkQuantitySelect.remove();
            checkQuantity.remove();
            checkHidden.remove();
        }
        //se esiste un valore a category
        if (categoriesSelected !== '0') {
            //categoria scelta
            let category = Object.values(categories[categoriesSelected]);

            // Creiamo il select per gli ingredienti
            let newSelect = createSelect('ingredientType', laneNumber);

            // Per ogni elemento di category, crea una option
            category.forEach(function (category) {
                newSelect.appendChild(createOption(category.name, category.id));
            });

            // Attaccala sotto
            SelectedDiv.appendChild(newSelect);

            // Creiamo il select per i tipi di quantità
            let newSelectType = createQuantityType('quantityType', laneNumber);

            // Aggiungi le opzioni in base alla categoria selezionata
            if (categoriesSelected == 'alcools' || categoriesSelected == 'sodas' || categoriesSelected == 'aromaticBitters' || categoriesSelected == 'juices' || categoriesSelected == 'syrups') {
                let quantityType = ['ml', 'oz', 'dash', 'spoon'];
                quantityType.forEach(function (quantityType) {
                    newSelectType.appendChild(createOption(quantityType, quantityType));
                });
            } else if (categoriesSelected == 'fruits') {
                let quantityType = ['slice', 'clove'];
                quantityType.forEach(function (quantityType) {
                    newSelectType.appendChild(createOption(quantityType, quantityType));
                });
            } else if (categoriesSelected == 'sugars') {
                let quantityType = ['spoon', 'pcs'];
                quantityType.forEach(function (quantityType) {
                    newSelectType.appendChild(createOption(quantityType, quantityType));
                });
            } else if (categoriesSelected == 'others') {
                let quantityType = ['ml', 'oz', 'dash', 'spoon', 'slice', 'cove', 'leaf', 'branch'];
                quantityType.forEach(function (quantityType) {
                    newSelectType.appendChild(createOption(quantityType, quantityType));
                });
            }

            // Attaccala sotto
            SelectedDiv.appendChild(newSelectType);

            // Creiamo l'input per la quantità
            let newInput = createQuantity('quantity', laneNumber);

            // Attaccalo sotto
            SelectedDiv.appendChild(newInput);

            // Creiamo l'input nascosto per ingredientable_type
            let newHiddenInput = createHiddenInput(laneNumber, category);

            // Attaccalo sotto
            SelectedDiv.appendChild(newHiddenInput);
        }
    }

    // Funzione per aggiungere una nuova "lane" di ingredienti
    function functionAddLane(x) {
        let idSelect = x.id.replace("addingredientbtn", "");
        console.log(idSelect);
        let originalLane = document.getElementById('ingredientsLane' + idSelect);
        let newLane = document.createElement("div");
        newLane.className = "form-group";
        newLane.id = 'ingredientsLane' + (parseInt(idSelect) + 1);
        let btn = document.getElementById('addingredientbtn' + idSelect).cloneNode(true);
        btn.id = 'addingredientbtn' + (parseInt(idSelect) + 1);
        newLane.appendChild(btn);
        originalLane.parentNode.insertBefore(newLane, originalLane.nextSibling);

        // Tolgo la scritta "ingredients" in modo che so su quale linea sto lavorando
        ingredientNumber++;
        document.getElementById('ingredredintsLane' + idSelect);
        let lane = document.getElementById('ingredientsLane' + ingredientNumber);
        let input = document.getElementById('ingredients1');
        let newInput = input.cloneNode(true);
        newInput.id = 'ingredients' + ingredientNumber;
        lane.innerHTML = '';
        lane.appendChild(newInput);
    }
</script>

@endsection


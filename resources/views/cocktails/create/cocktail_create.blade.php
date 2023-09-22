
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
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Creazione Nuovo Cocktail</h2>
    <form method="POST" action="{{ route('cocktails.store') }}" enctype="multipart/form-data" id="form">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome" minlength="3" maxlength="50" value="{{ old('name') }} " pattern="^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$" required>
            <div class="valid-feedback">Campo valido.</div>
            <div class="invalid-feedback">Nome non idoneo</div>
        </div>
        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Inserisci una descrizione"></textarea>
        </div>
        <div class="form-group" id="ingredientsLane1">
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
        <div class="form-group" id="ingredientsLane2">
            <button type="button" class="btn btn-primary" id="addingredientbtn2" onclick="functionAddLane(this)">Aggiungi un altro ingrediente</button>
        </div>
        <div class="form-group">
            @foreach ($equipements as $equipement)
            <input type="checkbox" name="equipements[]" value="{{$equipement->id}}">
                {{$equipement->name}}
            @endforeach

        </div>
        <div class="form-group">
            <label for="preparation">Preparazione:</label>
            <textarea class="form-control" id="description" name="preparation" placeholder="Inserisci una descrizione"></textarea>
        </div>
        <div class="form-group">
            <label for="avg_ABV">Grado Alcolico Medio (ABV%):</label>
            <input type="number" step="0.1" class="form-control" id="ABV" name="ABV" placeholder="Inserisci il grado alcolico" required>
        </div>
        <div class="form-group">
            <label>Ghiaccio</label>
            <div>
                <input type="radio" name="ice_option" id="ice_no" value="no" checked>
                <label for="ice_no">No</label>
            </div>
            <div>
                <input type="radio" name="ice_option" id="ice_yes" value="yes">
                <label for="ice_yes">Sì</label>
            </div>
        </div>    
        <div id="ice_select" style="display: none;">
            <label for="ice_id">Seleziona il tipo di ghiaccio</label>
            <select name="ice_id" id="ice_id" required>
                @foreach ($ices as $ice)
                    <option value="{{$ice->id}}">{{$ice->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="glass_id">Tipo di bicchiere</label>
            <select name="glass_id" id="glass_id" required>
                <option  disabled selected>Scegli il tipo di ghiaccio</option>
                @foreach ($glasses as $glass)
                    <option value="{{$glass->id}}">{{$glass->name}}</option>          
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Cocktail Ufficiale IBA</label>
            <div>
                <input type="radio" name="official_IBA" id="official_IBA_yes" value="true">
                <label for="official_IBA_yes">Si</label>
            </div>
            <div>
                <input type="radio" name="official_IBA" id="official_IBA_no" value="false" checked>
                <label for="official_IBA_no">No</label>
            </div>
        </div>
        <div class="form-group">
            <label>Variazione</label>
            <div>
                <input type="radio" name="variation_option" id="variation_no" value="no" checked>
                <label for="variation_no">No</label>
            </div>
            <div>
                <input type="radio" name="variation_option" id="variation_yes" value="yes">
                <label for="variation_yes">Si</label>
            </div>
        </div>
        
        <div id="variation_select" style="display: none;">
            <label for="variation">Seleziona la variazione</label>
            <select name="variation" id="variation" required>
                <option disabled selected>Scegli la variazione</option>
                @foreach ($cocktails as $cocktail)
                    <option value="{{$cocktail->id}}">{{$cocktail->name}}</option>
                @endforeach
            </select>
        </div>
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
        <div class="form-group">
            <label for="garnish_option">Guarnizione</label>
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
        <div class="form-group">
            <label for="image">Immagine:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img id="image-preview" src="" alt="Preview dell'immagine" style="max-width: 400px; max-height: 400px; display: none;">
        </div>
        <div class="form-group">
            <label>Con Cannuccia</label>
            <div>
                <input type="radio" name="straw" id="straw_yes" value=true>
                <label for="straw_yes">Si</label>
            </div>
            <div>
                <input type="radio" name="straw" id="straw_no" value=false checked>
                <label for="straw_no">No</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="submitButton" >Crea Alcolico</button>
    </form>
</div>
<script>
    let ingredientNumber = 1;

    let categories = {
        alcools : {!! $alcools !!},
        aromaticBitters : {!! $aromaticBitters !!},
        fruits : {!! $fruits !!},
        juices : {!! $juices !!},
        others : {!! $others !!},
        sodas : {!! $sodas !!},
        sugars : {!! $sugars !!},
        syrups : {!! $syrups !!},
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

document.getElementById('form').addEventListener('submit', function(event) {
    if (!handleInputValidation()) {
        event.preventDefault(); // Previeni l'invio del modulo se l'input non è valido
        return false;
    }
});

document.getElementById('name').addEventListener('input', () => {
    handleInputValidation();
});

document.addEventListener('DOMContentLoaded', function() {
        var signatureOptionInputs = document.querySelectorAll('input[name="signature_option"]');
        var signatureTextInput = document.getElementById('signature_text_input');

        signatureOptionInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                if (this.value === 'yes') {
                    signatureTextInput.style.display = 'block';
                } else {
                    signatureTextInput.style.display = 'none';
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
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

    document.addEventListener('DOMContentLoaded', function() {
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

    document.addEventListener('DOMContentLoaded', function() {
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
    function createSelect(name, id){
        //crea un select
        newSelect = document.createElement("select")
        newSelect.name = "ingredients["+id+"][ingredientable_id]"
        newSelect.id = name + id

    }

    let quantityType = ['ml', 'oz', 'dash', 'spoon', 'slice', 'cove', 'leaf', 'branch']

    //funzione creazione option
    function createOption(text, value) {
    var option = document.createElement("option");
    option.text = text;
    option.value = value;
    return option;
    }

    function createQuantityType(name, id){
        newSelectType = document.createElement("select")
        newSelectType.name = "ingredients["+id+"][quantity_type]"
        newSelectType.id = name + id
    }

    function createQuantity(name, id) {
        newInput = document.createElement("input");
        newInput.type = "number";
        newInput.name = "ingredients["+id+"][quantity]"
        newInput.id = name + id;
        newInput.min = 0.1;
        newInput.max = 999.9;
        newInput.step = 0.1;
    } 
    function createHiddenInput(id, value) {
        newHiddenInput = document.createElement("input")
        newHiddenInput.type = "hidden"
        newHiddenInput.name = "ingredients["+id+"][ingredientable_type]"
        newHiddenInput.id = 'hidden'+ id
        newHiddenInput.value = value[0].model
    } 


    //funzione creazione ingrediente
    function AddIngredients (x) {
        //prendo l'id della slecte che sto usando
        let idSelect = x.id
        //tolgo la scritta ingredients in modo che so s quale linea sto lavorando
        let laneNumber = idSelect.replace("ingredients", "")
        //sfruttando il numero appena appreso trovo in quale div lavorare
        let SelectedDiv = document.getElementById('ingredientsLane'+ laneNumber ) 
        //cin base all'id id prima prendo il valore
        let categoriesSelected = document.getElementById(idSelect).value
        //creaiamo un variabile di controllo per vedere se esite gia una select con quel nome
        checkeSelect = document.getElementById("ingredientType" + laneNumber)
        console.log(checkeSelect)
        let error = document.getElementById('ingredientErrorLane' + laneNumber)
        if(error){
            error.remove()
        }
        checkQuantitySelect = document.getElementById("quantityType" + laneNumber)
        checkQuantity = document.getElementById("quantity" + laneNumber)
        checkHidden = document.getElementById("hidden" + laneNumber)
        //se esiste eliminale
        if(checkeSelect || checkQuantitySelect || checkQuantity || checkHidden){
            checkeSelect.remove()
            checkQuantitySelect.remove()
            checkQuantity.remove()
            checkHidden.remove()
        }
        //se esiste un valore a category
        if(categoriesSelected !== '0'){
            //categoria scelta
            let category = Object.values(categories[categoriesSelected])

            createSelect('ingredientType', laneNumber)
            //per ogni elemento di category cra una option
            category.forEach(function(category) {
            newSelect.appendChild(createOption(category.name, category.id));
            });
    
            //attaccala sotto
            SelectedDiv.appendChild(newSelect)

            createQuantityType('quantityType', laneNumber)
            if (categoriesSelected == 'alcools' || categoriesSelected == 'sodas' || categoriesSelected == 'aromaticBitters' || categoriesSelected == 'juices' || categoriesSelected == 'syrups'){
            let quantityType =  ['ml', 'oz', 'dash', 'spoon']
            quantityType.forEach(function(quantityType) {
                    newSelectType.appendChild(createOption(quantityType, quantityType))
                })
            } else if (categoriesSelected == 'fruits') {
                let quantityType =  ['slice', 'clove']
                quantityType.forEach(function(quantityType) {
                    newSelectType.appendChild(createOption(quantityType, quantityType))
                })
            }   else if (categoriesSelected == 'sugars') {
                let quantityType =  ['spoon', 'pcs']
                quantityType.forEach(function(quantityType) {
                    newSelectType.appendChild(createOption(quantityType, quantityType))
                })
            } else if (categoriesSelected == 'others') {
                let quantityType =  ['ml', 'oz', 'dash', 'spoon', 'slice', 'cove', 'leaf', 'branch']
                quantityType.forEach(function(quantityType) {
                    newSelectType.appendChild(createOption(quantityType, quantityType))
                })
            }
            
            SelectedDiv.appendChild(newSelectType)

            createQuantity('quantity', laneNumber)
            SelectedDiv.appendChild(newInput)
            console.log(category)
            createHiddenInput(laneNumber, category)
            SelectedDiv.appendChild(newHiddenInput)
        }else {
            SelectedDiv.innerHTML +=               
            `<div id="ingredientErrorLane`+(laneNumber) +  `">
                aggoiungi un ingrediente
            </div>`
        }
    }

    function functionAddLane (x){
        let idSelect = x.id.replace("addingredientbtn", "")
        let ingredient = document.getElementById("ingredients" + (idSelect - 1)).value 
        if(ingredient !== '0'){
            let errornow =  document.getElementById('ingredientErrorLane' + (idSelect-1))
           if(errornow){
            errornow.remove()
           }
            let originalLane = document.getElementById('ingredientsLane' + idSelect)
            let newLane = document.createElement("div")
            newLane.className = "form-group"
            newLane.id = 'ingredientsLane' + (parseInt(idSelect) + 1)
            let btn = document.getElementById('addingredientbtn' + idSelect).cloneNode(true)
            btn.id = 'addingredientbtn' + (parseInt(idSelect) + 1)
            newLane.appendChild(btn)
            originalLane.parentNode.insertBefore(newLane, originalLane.nextSibling)
            //tolgo la scritta ingredients in modo che so s quale linea sto lavorando
            ingredientNumber ++
            document.getElementById('ingredredintsLane' + idSelect)
            let lane = document.getElementById('ingredientsLane' + ingredientNumber)
            let input = document.getElementById('ingredients1')
            let newInput = input.cloneNode(true)
            newInput.id = 'ingredients'+ ingredientNumber
            lane.innerHTML = ''
            lane.appendChild(newInput)

        }else{
            let error = document.getElementById('ingredientErrorLane' + (idSelect-1))
            if(!error){
                
                document.getElementById("ingredientsLane" + (idSelect - 1)).innerHTML += 
                `<div id="ingredientErrorLane`+(idSelect-1) +  `">
                aggoiungi un ingrediente
                    </div>`

            }
        }
        }
    
    functionAddLane()

</script>
@endsection


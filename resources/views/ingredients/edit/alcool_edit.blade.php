@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Modifica Alcolico</h2>
    <form method="POST" action="{{ route('ingredients.alcools.update', ['alcools' => $alcool]) }}" id="form" enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT') <!-- Aggiungi il metodo PUT per l'aggiornamento -->
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control w-25 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci nome Alcolico" minlength="3" maxlength="50" value="{{ old('name', $alcool->name) }}" required pattern="^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="valid-feedback">Campo valido.</div>
            <div class="invalid-feedback">Nome Alcolico già esistente</div>
        </div>
        <div class="form-group">
            <label for="ABV">Grado Alcolico (ABV%):</label>
            <input type="number" step="0.1" class="form-control" id="ABV" name="ABV" placeholder="Inserisci il grado alcolico" required value="{{ old('ABV', $alcool->ABV) }}">
        </div>
        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Inserisci una descrizione">{{ old('description', $alcool->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Immagine:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if ($alcool->image)
            <div class="mt-2">
                <img src="{{ asset('storage/'. $alcool->image) }}" alt="Immagine {{ $alcool->name }}" style="max-height: 200px" id="image-preview">
            </div>
            @endif
        </div>
        <div class="form-group">
            <label for="alcool_categories_id">Categoria:</label>
            <select class="form-control" id="alcool_categories_id" name="alcool_categories_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $alcool->alcool_categories_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2" id="submitButton">Aggiorna Alcolico</button>
    </form>
</div>
<script>
    let nomeOriginale = document.getElementById('name').value;

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


function handleInputValidation() {
    let nameInput = document.getElementById('name');
    let value = nameInput.value;
    console.log(nomeOriginale, value)
    if(nomeOriginale !== value){
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
</script>
@endsection
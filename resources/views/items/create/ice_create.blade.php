@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Creazione Nuovo Tipo di Strumento</h2>
    <form method="POST" action="{{ route('ices.store') }}" enctype="multipart/form-data" id="form">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome" minlength="3" maxlength="50" value="{{ old('name') }} " pattern="^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$" required>
            <div class="valid-feedback">Campo valido.</div>
            <div class="invalid-feedback">Nome non idoneo</div>
        </div>
        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Inserisci una descrizione" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Immagine:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
            <img id="image-preview" src="" alt="Preview dell'immagine" style="max-width: 400px; max-height: 400px; display: none;">
        </div>
        <button type="submit" class="btn btn-primary" id="submitButton" >Crea Strumento</button>
    </form>
</div>
<script>
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
        return fetch("{{ route('check.Ice') }}", {
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
</script>
@endsection

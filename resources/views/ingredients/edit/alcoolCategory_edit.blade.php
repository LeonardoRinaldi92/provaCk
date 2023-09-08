@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Modifica {{$pagina}}</h2>
    <form method="POST" action="{{ route( 'ingredient.alcools.update', ['alcool'=> $alcool]) }}" id="form">
        @csrf
        @method('PUT') <!-- Aggiungi il metodo PUT per l'aggiornamento -->
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control w-25 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci nome {{$pagina}}" minlength="3" maxlength="50" value="{{ old('name', $categoryName->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="valid-feedback">Campo valido.</div>
            <div class="invalid-feedback">Nome {{$pagina}} già esistente</div>
        </div>
        <input type="submit" class="btn btn-primary mt-2" id="submitButton" value="Aggiorna">
    </form>
    <form method="POST" action="{{ route('ingredients.alcoolscategory.destroy', ['categoryName' => $categoryName]) }}" id="deleteForm">
        @csrf
        @method('DELETE') <!-- Usa il metodo DELETE -->
        <button type="submit" class="btn btn-danger">Elimina</button>
    </form>
</div>

<script>
document.getElementById('submitButton').setAttribute('disabled', 'disabled');

function handleInputValidation() {
    let nameInput = document.getElementById('name');
    let value = nameInput.value;

    if (value.length > 2) {
        return fetch("{{ route('check.AlcoolCategory') }}", {
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
                console.log('false');
                document.getElementById('submitButton').setAttribute('disabled', 'disabled'); // Disabilita il pulsante
                return false; // Restituisci false se la validazione è negativa
            }
        });
    } else {
        nameInput.classList.remove('is-valid');
        nameInput.classList.remove('is-invalid');
        console.log('sqto qui');
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

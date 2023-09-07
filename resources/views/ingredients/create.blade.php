@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Crea {{$pagina}}</h2>
    <form method="POST" action="{{ route($rotta . '.store') }}">
        @csrf <!-- Aggiunge il token CSRF -->
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control w-25" id="name" name="name" placeholder="Inserisci nome {{$pagina}}" minlength="3" maxlength="50"
                   pattern="[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-]+" value="{{ old('name') }}" required>
            <div class="valid-feedback">Campo valido.</div>
            <div class="invalid-feedback">Nome {{$pagina}} già esistente</div>
        </div>
        <input type="submit" class="btn btn-primary mt-2">
    </form>
</div>

<script>

document.getElementById('name').addEventListener('input', () => {
    let value = document.getElementById('name').value.toLowerCase();
    const nameInput = document.getElementById('name');
    let alcoolCategories = @json($alcoolCategories).map(category => category.toLowerCase());
    if(value.length > 2){
        if (alcoolCategories.includes(value)) {
            nameInput.classList.remove('is-valid');
            nameInput.classList.add('is-invalid');
        } else {
            nameInput.classList.remove('is-invalid');
            nameInput.classList.add('is-valid');
        }
    };
});
</script>
@endsection

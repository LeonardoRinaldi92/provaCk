@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Creazione Nuovo Alcolico</h2>
    <form method="POST" action="{{ route('ingredients.alcools.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome" minlength="3" maxlength="50" value="{{ old('name') }} " pattern="^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$" required>
        </div>
        <div class="form-group">
            <label for="ABV">Grado Alcolico (ABV%):</label>
            <input type="number" step="0.1" class="form-control" id="ABV" name="ABV" placeholder="Inserisci il grado alcolico" required>
        </div>
        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Inserisci una descrizione"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Immagine:</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="alcool_categories_id">Categoria:</label>
            <select class="form-control" id="alcool_categories_id" name="alcool_categories_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Aggiungi altri campi se necessario -->
        <button type="submit" class="btn btn-primary">Crea Alcolico</button>
    </form>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-3">
            <div>
                <b>
                    {{$item->name}}
                </b>
            </div>
                     
                <div>
                    <div class="mt-2">
                        <b>
                            Descrizione: 
                        </b><br>
                        {{$item->description}}
                    </div>  
                </div> 

                <div class="col-3">
                    <img src="{{ asset('storage/'. $item->image) }}" alt="Immagine {{$item->name}}" style="max-height: 400px">
                </div>

                <div class="mt-3">
                    <a href="{{ route('items.'.$item->getTable().'.edit', [
                        'slug' => $item->slug
                    ]) }}" class="btn btn-primary">Modifica</a>

                    <form method="POST" action="{{ route('items.'. $item->getTable().'.destroy', [$item->getTable() => $item]) }}" id="deleteForm">
                        @csrf
                        @method('DELETE') <!-- Usa il metodo DELETE -->
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div> 
        </div>
    </div>
@endsection
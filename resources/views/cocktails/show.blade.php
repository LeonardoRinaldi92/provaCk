@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-3">
                        <div>
                            <b>
                                {{$cocktail->name}}
                            </b>
                        </div>
                            <div class="col-3">
                                @if ($cocktail->image)
                                <img src="{{ asset('storage/'. $cocktail->image) }}" alt="Immagine {{$cocktail->name}}" style="max-height: 400px">
                                @endif
                            </div>
                    <div>
                        <b>
                            UFFICIALE IBA: 
                        </b>
                        @if($cocktail->official_IBA)
                        si
                        @else
                        no
                        @endif
                    </div>
                    <div class="mt-2">
                        <b>
                            VARIAZIONE:
                        </b>
                        @if ($cocktail->variation)
                        <a href="{{ route('cocktails.show', $cocktail->originalCocktail->slug) }}">
                        {{$cocktail->originalCocktail->name}}
                        </a>
                        @else
                        no
                        @endif
                    </div>
                    <div class="mt-2">
                        <b>
                            SIGNATURE COCKTAIL: 
                        </b>
                        @if ($cocktail->signature)
                            {{$cocktail->signature}}
                        @else
                        no
                        @endif

                    </div>
                    <div class="mt-2">
                        <b>
                            Gradazione Media: 
                        </b>
                         {{$cocktail->getAverageABV()}}
                    

                    </div>
                <div >
                    <div class="mt-2">
                        <b>
                            Descrizione: 
                        </b><br>
                        {{$cocktail->description}}
                        
                    </div>
                    <div class="mt-2">
                            <b>
                                Ingredienti:
                            </b>
                        @foreach ($cocktail->ingredients as  $key => $ingredient)
                        <div class="{{ $key > 0 ? 'mt-2' : '' }}">
                            {{ $ingredient->getSingleQuantity() }} {{$ingredient->quantity_type}} 
                            @if ($ingredient->ingredientable->slug)
                                @if ($ingredient->ingredientable->category)  
                            <a href="{{ route( 'ingredients.'. $ingredient->ingredientable->getTable() .'.show', ['slug' => $ingredient->ingredientable->slug, 'category'=> $ingredient->ingredientable->category->name]) }}">
                                @else
                            <a href="{{ route( 'ingredients.'. $ingredient->ingredientable->getTable() .'.show', ['slug' => $ingredient->ingredientable->slug]) }}">
                                @endif
                            @endif
                            {{$ingredient->ingredientable->name}}   
                            @if ($ingredient->ingredientable->slug)
                            </a> 
                            @endif
                            @if ($ingredient->ingredientable->category)
                            <span class="text-secondary">{{$ingredient->ingredientable->category->name}}</span>
                            @endif
                        </div>
                        @endforeach
                        <div class="mt-2">
                            <b>
                                Strumenti per la preparazione:
                            </b>
                            <ul class="mt-2">
                                @foreach ($cocktail->equipments as $equipement )
                                <li>
                                    <a href="{{ route( 'items.'. $equipement->getTable()  .'.show', ['slug' => $equipement->slug]) }}">
                                        {{$equipement->name}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mt-2">
                        <b>
                            Procedimento:
                        </b><br>
                        {{$cocktail->preparation}}

                    </div>
                    <div class="mt-2">
                        <p>
                            <b>
                                Tipo di bicchiere: 
                            </b>
                            <a href="{{ route( 'items.'. $cocktail->glass->getTable()  .'.show', ['slug' => $cocktail->glass->slug]) }}">
                                {{$cocktail->glass->name}}
                            </p>
                        </a>
                    </div>
                    <div class="mt-2">
                        <p>
                            <b>
                                Cannuccia: 
                            </b>
                            @if ($cocktail->straw)
                                si
                            @else
                            no
                            @endif
                        </p>
                    </div>
                    <div class="mt-2">
                        <p>

                            <b>
                                Tipo di ghiaccio: 
                            </b>
                            @if ($cocktail->ice_id)
                            <a href="{{ route( 'items.'. $cocktail->ice->getTable()  .'.show', ['slug' => $cocktail->ice->slug]) }}">
                                {{$cocktail->ice->name}}
                            </a>
                            @else
                            no
                            @endif
                        </p>
                    </div>
                </div>

        </div>
    </div>
@endsection
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
    </div>
    <div class="row mt-3">
        @foreach ($cocktails as $cocktail)
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('cocktails.show', $cocktail->slug) }}">
                        <div>
                            <b>
                                {{$cocktail->name}}
                            </b>
                        </div>
                    </a>
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
                </div>
                <div class="card-body">
                    <div>
                        <p>
                            Ingredienti:
                        </p>
                        @foreach ($cocktail->ingredients as $ingredient)
                        <p>
                            {{ $ingredient->getSingleQuantity() }} {{$ingredient->quantity_type}}
                            @if ($ingredient->ingredientable->slug)
                            <a href="{{ route( 'ingredients.'. $ingredient->ingredientable->getTable()  .'.show', ['slug' => $ingredient->ingredientable->slug, 'category'=> $ingredient->ingredientable->category->name]) }}">
                            @endif
                            {{ $ingredient->ingredientable->name }}
                            @if ($ingredient->ingredientable->slug)
                            </a>
                            @endif 
                            <br>
                            <span class="text-secondary">{{$ingredient->ingredientable->category->name}}</span>
                        </p>
                        @endforeach
                        <p>
                            Strumenti per la preparazione:
                            <ul>
                                @foreach ($cocktail->equipments as $equipement )
                                <li>
                                    <a href="{{ route( 'items.'. $equipement->getTable()  .'.show', ['slug' => $equipement->slug]) }}">
                                        {{$equipement->name}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </p>
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
                            <a href="{{ route( 'items.'. $cocktail->ice->getTable()  .'.show', ['slug' => $cocktail->ice->slug]) }}">
                                {{$cocktail->ice->name}}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
        <select name="ingredients" id="ingredients">
            <option value="Tutti">Tutti</option>
            <option value="Alcolici">Alcolici</option>
            <option value="Bitter Aromatici">Bitter Aromatici</option>
            <option value="Frutta">Frutta</option>
            <option value="Succhi">Succhi</option>
            <option value="Sodati">Sodati</option>
            <option value="Zuccheri">Zuccheri</option>
            <option value="Altro">Altro</option>
          </select>
    </div>
    <div class="row mt-3">
        @foreach ($ingredients as $ingredient)
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <div>
                        {{$ingredient->tables()}}
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <b>
                            {{$ingredient->name}}
                        </b>
                    </div>
                    @if (isset($ingredient->ABV))
                    <div class="mt-2">
                        <b>
                            Gradazione alcolica: 
                        </b>
                        {{$ingredient->getSingleDigitABV()}}
                    </div>
                    @endif
                    @if (isset($ingredient->description))
                    <div class="mt-2">
                        {{$ingredient->description}}

                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
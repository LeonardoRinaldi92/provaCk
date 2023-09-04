@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($ingredients as $ingredient)
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <div>
                        {{$ingredient->tables()}}
                    </div>
                    <b>
                        {{$ingredient->name}}
                    </b>
                </div>
                <div class="card-body">
                    @if (isset($ingredient->ABV))
                    <b>
                        Gradazione alcolica: 
                    </b>
                    {{$ingredient->getSingleDigitABV()}}
                    @endif
                    <div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
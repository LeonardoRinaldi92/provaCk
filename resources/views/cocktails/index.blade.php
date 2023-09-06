@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
    </div>
    <div class="row mt-3">
        @foreach ($cocktails as $cocktail)
        <div class="col-3">
            <a href="{{ route('cocktails.show', $cocktail->slug) }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <b>
                                {{$cocktail->name}}
                            </b>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-2">
                            {{$cocktail->description}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="col-6 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Aggiungi Ingredienti
                </div>
                <div class="card-body row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi un Alcolico
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi un Bitter 
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi uno Sciroppo 
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi una Soda 
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi un Succo 
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi uno Zucchero 
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi una Frutta 
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi "Altro" 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-6 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Aggiungi Preparazione
                </div>
                <div class="card-body row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi uno Strumento 
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi un tipo di Ghiaccio 
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                Aggiungi un tipo di Bicchiere 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header text-center">
                    Aggiungi un Cocktail
                </div>
                <div class="card-body row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Crea un Cocktail
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

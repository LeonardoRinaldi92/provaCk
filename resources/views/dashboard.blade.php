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
                <div class="card-header d-flex align-items-center">
                    <div class="col-6">
                        Ingredienti:
                    </div>
                    <div class="col-6 text-center">
                        <a href="{{ route('ingredients.index') }}" class="btn btn-primary">
                            Visualizza tutti
                        </a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('alcools.create') }}" >
                                    Aggiungi un Alcolico
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <a href="{{ route('ingredients.alcoolscategory.create') }}">
                                <div class="card-header">
                                    Aggiungi una Categoria Alcolici
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <a href="{{ route('aromatic_bitters.create') }}">
                                <div class="card-header">
                                    Aggiungi un Bitter Aromatico
                                </div>
                            </a>
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
                            <a href="{{ route('sodas.create') }}" >
                                <div class="card-header">
                                    Aggiungi una Soda
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <a href="{{ route('juices.create') }}">
                                <div class="card-header">
                                    Aggiungi un Succo 
                                </div>
                            </a>
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
                            <a href="{{ route('fruits.create') }}">
                                <div class="card-header">
                                    Aggiungi una Frutta 
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="card">
                            <a href="{{ route('others.create') }}">
                                <div class="card-header">
                                    Aggiungi "Altro" 
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mt-2">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="col-6">
                        Preparazioni:
                    </div>
                    <div class="col-6 text-center">
                        <a href="{{ route('items.index') }}" class="btn btn-primary">
                            Visualizza tutti
                        </a>
                    </div>
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
                <div class="card-header d-flex align-items-center">
                    <div class="col-6">
                        Cocktails:
                    </div>
                    <div class="col-6 text-center">
                        <a href="{{ route('cocktails.index') }}" class="btn btn-primary">
                            Visualizza tutti
                        </a>
                    </div>
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

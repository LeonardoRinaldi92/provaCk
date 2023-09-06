@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-3">
                        <div>
                            <b>
                                {{$ingredient->name}}
                            </b>
                        </div>
                        @if ($ingredient->ABV)         
                        <div class="mt-2">
                            <b>
                                Gradazione: 
                            </b>
                             {{$ingredient->getSingleDigitABV()}}
                        </div>
                            @if($ingredient->category)
                        <div>

                            <b>
                                Categoria:
                            </b>
                            {{$ingredient->category->name}}
                            @endif
                        </div>
                        @endif
                     
                <div >
                    <div class="mt-2">
                        <b>
                            Descrizione: 
                        </b><br>
                        {{$ingredient->description}}
                    </div>  
                </div> 
        </div>
    </div>
@endsection
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
        </div>
    </div>
@endsection
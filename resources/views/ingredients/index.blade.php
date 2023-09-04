@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
        <select name="ingredients" id="ingredients">
            <option value="index"
            @if (Request::path() == 'ingredients') selected @endif
            >Tutti</option>
            <option value="alcools"
            @if (Request::path() == 'ingredients/alcools') selected @endif
            >Alcolici</option>
            <option value="aromatic_bitters"
            @if (Request::path() == 'ingredients/aromatic_bitters') selected @endif
            >Bitter Aromatici</option>
            <option value="fruit"
            @if (Request::path() == 'ingredients/fruit') selected @endif
            >Frutta</option>
            <option value="juices"
            @if (Request::path() == 'ingredients/juices') selected @endif
            >Succhi</option>
            <option value="sodas"
            @if (Request::path() == 'ingredients/sodas') selected @endif
            >Sodati</option>
            <option value="sugars"
            @if (Request::path() == 'ingredients/sugars') selected @endif
            >Zuccheri</option>
            <option value="syrup"
            @if (Request::path() == 'ingredients/syrup') selected @endif
            >Sciroppi</option>
            <option value="other"
            @if (Request::path() == 'ingredients/other') selected @endif
            >Altro</option>
          </select>
    </div>
    <div class="row mt-3">
        @foreach ($ingredients as $ingredient)
        <div class="col-3">

            @if (isset($ingredient->slug))
            <a href="{{ route('ingredients.' . $ingredient->getTable() . '.show', ['slug' => $ingredient->slug]) }}">
        @endif
                <div class="card">
                    @if (Request::path() == 'ingredients')
                    <div class="card-header">
                        <div>
                            {{$ingredient->tables()}}
                        </div>
                    </div>
                    @endif
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
            @if (isset($ingredient->slug))
            </a>
            @endif
        </div>
        @endforeach
    </div>

</div>
<script>
    document.getElementById('ingredients').addEventListener('change', function() {
        let rotta = this.value;
        if(rotta !== 'index'){
            
            window.location.href = '{{ url("ingredients") }}/' + rotta;
        }else {
            window.location.href = '{{ url("ingredients") }}';
        }
    });
</script>
@endsection
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
        <select name="ingredients" id="ingredients">
            <option value="index"
            @if (Request::path() == 'ingredients') selected @endif
            >Tutti</option>
            <option value="alcool"
            @if (Request::path() == 'ingredients/alcool') selected @endif
            >Alcolici</option>
            <option value="aromatic_bitter"
            @if (Request::path() == 'ingredients/aromatic_bitter') selected @endif
            >Bitter Aromatici</option>
            <option value="fruit"
            @if (Request::path() == 'ingredients/fruit') selected @endif
            >Frutta</option>
            <option value="juice"
            @if (Request::path() == 'ingredients/juice') selected @endif
            >Succhi</option>
            <option value="soda"
            @if (Request::path() == 'ingredients/soda') selected @endif
            >Sodati</option>
            <option value="sugar"
            @if (Request::path() == 'ingredients/sugar') selected @endif
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
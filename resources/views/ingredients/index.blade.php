@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
        <select name="ingredients" id="ingredients">
            <option value="index">Tutti</option>
            <option value="alcool">Alcolici</option>
            <option value="aromatic_bitter">Bitter Aromatici</option>
            <option value="fruit">Frutta</option>
            <option value="juice">Succhi</option>
            <option value="soda">Sodati</option>
            <option value="sugar">Zuccheri</option>
            <option value="syrup">Sciroppi</option>
            <option value="other">Altro</option>
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
<script>
    document.getElementById('ingredients').addEventListener('change', function() {
        let rotta = this.value;
        window.location.href = '{{ url("ingredients") }}/' + rotta;
    });
</script>
@endsection
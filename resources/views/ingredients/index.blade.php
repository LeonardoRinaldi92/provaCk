@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
        <select name="ingredients" id="ingredients">
            @foreach ([
                'index' => 'Tutti',
                'alcools' => 'Alcolici',
                'aromatic_bitters' => 'Bitter Aromatici',
                'fruits' => 'Frutta',
                'juices' => 'Succhi',
                'sodas' => 'Sodati',
                'sugars' => 'Zuccheri',
                'syrups' => 'Sciroppi',
                'others' => 'Altro',
            ] as $value => $label)
                <option value="{{ $value }}" @if (Request::is('ingredients/' . $value)) selected @endif>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    @if(Str::contains(Request::url(), 'ingredients/alcools'))
    <div class="text-center mt-3">
        <select name="category" id="category">
            <option value="all">Tutti</option>
            @foreach ($categories as $category)
                <option value="{{$category->name}}" @if(Request::is('ingredients/alcools/' . $category->name)) selected 
                    @endif>{{$category->name}} 
                    </option>
            @endforeach
        </select>
    </div>  
    @endif
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
                        @if (isset($ingredient->slug))
                            @if($ingredient->category->name)
                            <a href="{{ route('ingredients.' . $ingredient->getTable() . '.show', ['category' => $ingredient->category->name , 'slug' => $ingredient->slug]) }}">
                            @else
                            <a href="{{ route('ingredients.' . $ingredient->getTable() . '.show', ['slug' => $ingredient->slug]) }}">
                            @endif
                        @endif
                            <div>
                                <b>
                                    {{$ingredient->name}}
                                </b>
                            </div>
                        @if (isset($ingredient->slug))
                        </a>
                        @endif
                        @if (isset($ingredient->ABV))
                        <div class="mt-2">
                            <b>
                                {{ __("ABV") }} 
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

    document.getElementById('category').addEventListener('change', function() {
    let rotta = this.value;
    if (rotta !== 'all') {
        window.location.href = '{{ url("ingredients/alcools") }}/' + rotta;
    } else {
        window.location.href = '{{ url("ingredients/alcools") }}';
    }
});

</script>
@endsection
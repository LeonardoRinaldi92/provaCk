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
        @foreach ($categories as $category)
        @if (Request::path() == 'ingredients/alcools/' . str_replace(' ', '%20', $category->name))
        <div>
            <a href="{{ route('ingredients.alcoolscategory.edit', ['categoryName' => $category]) }}">Modifica {{ $category->name }}</a>
        </div>
        @endif
    @endforeach
    </div>  
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                @if (!(Str::contains(Request::url(), 'ingredients/fruits')) && !(Str::contains(Request::url(), 'ingredients/syrups')) && !(Str::contains(Request::url(), 'ingredients/others')) && !(Str::contains(Request::url(), 'ingredients/juices')))
                <th>Descrizione</th>
                @endif
                @if (Str::contains(Request::url(), 'ingredients/alcools'))
                <th>CATEGORIA</th>
                @endif
                @if ((Request::path() == 'ingredients/aromatic_bitters') || (Request::path() == 'ingredients') || Str::contains(Request::url(), 'ingredients/alcools'))
                <th>ABV</th>     
                @endif
                @if (Request::path() == 'ingredients')
                <th>CATEGORIA</th>
                @endif
                <th>Modifica</th>
                <th>Elimina</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
            <tr>
                <td>
                    @if (isset($ingredient->slug))
                        @if($ingredient->category)
                        <a href="{{ route('ingredients.' . $ingredient->getTable() . '.show', ['category' => $ingredient->category->name , 'slug' => $ingredient->slug]) }}">
                        @else
                        <a href="{{ route('ingredients.' . $ingredient->getTable() . '.show', ['slug' => $ingredient->slug]) }}">
                        @endif
                    @endif
                    {{$ingredient->name}}
                    @if (isset($ingredient->slug))
                    </a>
                    @endif
                </td>
                @if (!(Str::contains(Request::url(), 'ingredients/fruits')) && !(Str::contains(Request::url(), 'ingredients/syrups')) && !(Str::contains(Request::url(), 'ingredients/others')) && !(Str::contains(Request::url(), 'ingredients/juices')))
                <td>
                    @if (isset($ingredient->description))
                    {{$ingredient->description}}
                    @else
                    N/A
                    @endif
                </td>
                @endif
                @if (Str::contains(Request::url(), 'ingredients/alcools'))
                <td>
                    <a href="{{ route('ingredients.alcools.category.index', ['category' => $ingredient->category->name]) }}">{{$ingredient->category->name}}</a>
                </td>
                @endif
                @if ((Request::path() == 'ingredients/aromatic_bitters') || (Request::path() == 'ingredients') || Str::contains(Request::url(), 'ingredients/alcools'))
                <td>
                    @if (isset($ingredient->ABV))
                    {{$ingredient->getSingleDigitABV()}}
                    @else
                    N/A
                    @endif
                </td>
                @endif
                @if ((Request::path() == 'ingredients'))
                <td>
                    <a href="{{ route('ingredients.'. $ingredient->getTable() . '.index')}}">{{$ingredient->tables()}}</a>
                </td>
                @endif
                <td>
                    <!-- Aggiungi qui il pulsante di modifica -->
                </td>
                <td>
                    <!-- Aggiungi qui il pulsante di eliminazione -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

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
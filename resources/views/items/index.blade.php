@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
        <select name="items" id="items">
            @foreach ([
                'index' => 'Tutti',
                'equipements' => 'Strumenti',
                'glasses' => 'Tipi di Bicchieri',
                'ices' => 'Tipi di Ghiaccio',
            ] as $value => $label)
                <option value="{{ $value }}" @if (Request::is('items/' . $value)) selected @endif>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                @if (Request::path() == 'items')
                <th>CATEGORIA</th>
                @endif
                <th>Modifica</th>
                <th>Elimina</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>
                    <a href="{{ route('items.' . $item->getTable() . '.show', ['slug' => $item->slug]) }}">
                    {{$item->name}}
                    </a>
                </td>
                <td>
                    {{$item->description}}
                </td>
                @if (Request::path() == 'items')
                <td>
                    <a href="{{ route('items.'. $item->getTable() . '.index')}}">{{$item->tables()}}</a>
                </td>
                @endif
                <td>
                    {{-- <button class="btn btn-warning">
                        <a href="{{ route('items.' . $item->getTable() . '.edit', [$item->getTable() => $item]) }}">Modifica</a>
                    </button> --}}
                </td>
                <td>
                    {{-- <form method="POST" action="{{ route('items.' . $item->getTable() . '.destroy', [$item->getTable() => $item]) }}" id="deleteForm">
                        @csrf
                        @method('DELETE') <!-- Usa il metodo DELETE -->
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<script>
    document.getElementById('items').addEventListener('change', function() {
        let rotta = this.value;
        if(rotta !== 'index'){
            
            window.location.href = '{{ url("items") }}/' + rotta;
        }else {
            window.location.href = '{{ url("items") }}';
        }
    });
</script>
@endsection
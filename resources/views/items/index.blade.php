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
    <div class="row mt-3">
        @foreach ($items as $item)
        <div class="col-3">

            @if (isset($item->slug))
            <a href="{{ route('items.' . $item->getTable() . '.show', ['slug' => $item->slug]) }}">
            @endif
                <div class="card">
                    @if (Request::path() == 'items')
                    <div class="card-header">
                        <div>
                            {{$item->tables()}}
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <div>
                            <b>
                                {{$item->name}}
                            </b>
                        </div>
                        @if (isset($item->description))
                        <div class="mt-2">
                            {{$item->description}}
    
                        </div>
                        @endif
                    </div>
                </div>
            @if (isset($item->slug))
            </a>
            @endif
        </div>
        @endforeach
    </div>

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
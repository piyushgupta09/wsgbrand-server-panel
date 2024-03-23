@extends('panel::layouts.guest')

@section('content')
    <h1>Sync Report</h1>
    <ul class="list-group">
        @foreach ($data as $item)
            <li class="list-group-item">{{ $item }}</li>
        @endforeach
    </ul>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Stores</h1>
    <div class="list-group">
        @foreach($stores as $store)
            <a href="{{ route('customer.store', $store) }}" class="list-group-item list-group-item-action">
                {{ $store->name }}
            </a>
        @endforeach
    </div>
</div>
@endsection

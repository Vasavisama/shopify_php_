@extends('layouts.customer')

@section('content')
<div class="container">
    <h1>All Stores</h1>
    <div class="list-group">
        @foreach($stores as $store)
            <a href="{{ route('customer.stores.show', $store) }}" class="list-group-item list-group-item-action">
                {{ $store->name }}
            </a>
        @endforeach
    </div>
</div>
@endsection

@extends('layouts.customer')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold my-8">All Stores</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($stores as $store)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <a href="{{ route('customer.stores.show', $store) }}">
                    @if($store->logo_path)
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $store->logo_path) }}" alt="{{ $store->name }} logo">
                    @else
                        <div class="w-full h-48 flex items-center justify-center bg-gray-200">
                            <span class="text-gray-500">No Logo</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h4 class="font-bold text-xl mb-2">{{ $store->name }}</h4>
                        <p class="text-gray-700 text-base">
                            {{ Str::limit($store->description, 100) ?? 'No description provided.' }}
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                <p>No stores found.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

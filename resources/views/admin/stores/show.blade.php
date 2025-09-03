@extends('layouts.admin')

@section('title', 'Store Details')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">{{ $store->name }}</h3>
        <a href="{{ route('admin.products.create', ['store_id' => $store->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Product
        </a>
    </div>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Domain</label>
            <p class="text-gray-700">{{ $store->domain }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Theme</label>
            <p class="text-gray-700">{{ $store->theme->name ?? 'No Theme' }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <p class="text-gray-700">{{ $store->description ?? 'N/A' }}</p>
        </div>
    </div>

    <h4 class="text-gray-700 text-2xl font-medium mt-8">Products</h4>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @php
        $theme = $store->theme;
        $bgColor = $theme ? $theme->background_color : '#ffffff';
        $fontColor = $theme ? $theme->font_color : '#000000';
        $fontStyle = $theme ? $theme->font_style : 'normal';
        $fontSize = $theme ? $theme->font_size . 'px' : '16px';
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @forelse ($store->products as $product)
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: {{ $bgColor }}; color: {{ $fontColor }}; font-family: {{ $fontStyle }}; font-size: {{ $fontSize }};">
                @if($product->image_path)
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }} image">
                @else
                    <div class="w-full h-48 flex items-center justify-center bg-gray-200">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
                <div class="p-6">
                    <h4 class="font-bold text-xl mb-2">{{ $product->name }}</h4>
                    <p class="text-base mb-4">
                        {{ Str::limit($product->description, 100) ?? 'No description provided.' }}
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg">${{ number_format($product->price, 2) }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                <p>No products found for this store.</p>
            </div>
        @endforelse
    </div>
@endsection

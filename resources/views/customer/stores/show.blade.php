@extends('layouts.customer')

@section('content')
    @php
        $theme = $store->theme;
        $bgColor = $theme ? $theme->background_color : '#ffffff';
        $fontColor = $theme ? $theme->font_color : '#000000';
        $fontStyle = $theme ? $theme->font_style : 'normal';
        $fontSize = $theme ? $theme->font_size . 'px' : '16px';
    @endphp

    <div style="background-color: {{ $bgColor }}; color: {{ $fontColor }}; font-family: {{ $fontStyle }}; font-size: {{ $fontSize }};">
        <div class="container">
            <h1>{{ $store->name }}</h1>
            <p>{{ $store->description }}</p>
            <hr>
            <h2>Products</h2>
            <div class="row">
                @foreach($store->products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

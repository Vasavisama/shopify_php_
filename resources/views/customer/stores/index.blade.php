@extends('layouts.customer')

@section('content')
<div style="max-width: 100%; margin: 0 auto; padding: 20px;">
    <h1 style="font-size: 28px; font-weight: bold; margin: 20px 0;">All Stores</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        @forelse ($stores as $store)
            <div style="background: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; transition: 0.3s;">
                <a href="{{ route('customer.stores.show', $store) }}" style="text-decoration: none; color: inherit;">
                    @if($store->logo_path)
                        <img src="{{ asset('storage/' . $store->logo_path) }}" alt="{{ $store->name }} logo" style="width: 100%; height: 200px; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 200px; display: flex; align-items: center; justify-content: center; background: #e5e7eb; color: #6b7280;">
                            No Logo
                        </div>
                    @endif

                    <div style="padding: 20px;">
                        <h4 style="font-weight: bold; font-size: 20px; margin-bottom: 10px;">{{ $store->name }}</h4>
                        <p style="color: #374151; font-size: 14px; min-height: 40px;">
                            {{ $store->description ?? 'No description provided.' }}
                        </p>
                        <span style="display: inline-block; margin-top: 10px; color: #2563eb; font-weight: 600;">View Store</span>
                    </div>
                </a>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; color: #6b7280;">
                <p>No stores found.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

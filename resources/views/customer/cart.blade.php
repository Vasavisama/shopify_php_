@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cart</h1>

    @if(session('cart'))
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>${{ $details['price'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PATCH')
                                <button type="button" class="btn btn-sm btn-secondary" onclick="this.nextElementSibling.stepDown(); this.form.requestSubmit()">-</button>
                                <input type="number" value="{{ $details['quantity'] }}" name="quantity" min="1" class="form-control form-control-sm text-center" style="width: 60px;">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="this.previousElementSibling.stepUp(); this.form.requestSubmit()">+</button>
                            </form>
                        </td>
                        <td>${{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <h3>Total: ${{ $total }}</h3>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection

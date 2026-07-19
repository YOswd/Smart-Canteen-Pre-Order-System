@extends('layouts.app')

@section('content')

<h2>Your Cart</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Food</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
            <th>Checkout</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cart as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>৳{{ $item['price'] }}</td>
            <td>৳{{ $item['quantity'] * $item['price'] }}</td>
            <td>
                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
            </td>
            <td>
                <form action="{{ route('cart.checkout.single', $item['id']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Checkout</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No items in cart.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="text-end">
<form action="{{ route('cart.checkout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">
        Checkout All
    </button>
</form>
</div>

@endsection
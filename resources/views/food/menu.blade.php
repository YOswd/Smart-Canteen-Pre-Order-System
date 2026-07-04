@extends('layouts.app')

@section('content')

<h2 class="mb-4">Food Menu</h2>

<div class="row">

@foreach($foods ?? [] as $food)

<div class="col-md-4 mb-4">

<div class="card h-100 shadow-sm">

<img src="{{ $food->image ?? 'https://via.placeholder.com/300x200' }}"
class="card-img-top">

<div class="card-body">

<h5>{{ $food->name }}</h5>

<p>{{ $food->description }}</p>

<p>

<strong>Price:</strong>

৳{{ $food->price }}

</p>

<p>

<strong>Stock:</strong>

{{ $food->stock }}

</p>

<form action="{{ route('cart.add') }}" method="POST">

@csrf

<input type="hidden"
name="food_id"
value="{{ $food->id }}">

<button class="btn btn-success w-100">

Add to Cart

</button>

</form>

</div>

</div>

</div>

@endforeach

</div>

@endsection
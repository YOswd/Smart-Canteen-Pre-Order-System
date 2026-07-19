resources/views/food/menu.blade.php,
@extends('layouts.app')

@section('content')

<form action="{{ route('menu') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search food..."
            value="{{ request('search') }}">

        <button class="btn btn-primary" type="submit">
            Search
        </button>
    </div>
</form>

@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

<h2 class="mb-4">Food Menu</h2>
<div class="row">
    @foreach($foods as $food)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ $food->image ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top">

                <div class="card-body">
                    <h5>{{ $food->name }}</h5>
                    <p>{{ $food->description }}</p>

                    <p><strong>Price:</strong> ৳{{ $food->price }}</p>
                    <p><strong>Stock:</strong> {{ $food->stock }}</p>

                    <form action="{{ route('cart.add', $food->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
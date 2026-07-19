@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Manage Food Menu</h2>
    <a href="{{ route('manage-food.create') }}" class="btn btn-success">Add New Food</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Available</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       @forelse($foods as $food)
        <tr>
            <td>
                @if($food->image && $food->image !== 'default.jpg')
                    <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" width="50" height="50" style="object-fit: cover;">
                @else
                    <img src="{{ asset('images/default.jpg') }}" alt="Default Image" width="50" height="50" style="object-fit: cover;">
                @endif
            </td>
            <td>{{ $food->name }}</td>
            <td>৳{{ $food->price }}</td>
            <td>{{ $food->stock }}</td>
            <td>
                <span class="badge {{ $food->available ? 'bg-success' : 'bg-danger' }}">
                    {{ $food->available ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <a href="{{ route('manage-food.edit', $food->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('manage-food.destroy', $food->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this food item?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No food items found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection

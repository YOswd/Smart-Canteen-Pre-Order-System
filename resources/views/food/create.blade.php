@extends('layouts.app')

@section('content')

<h2>Add New Food</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('manage-food.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price (৳)</label>
        <input type="number" step="0.01" name="price" class="form-control" id="price" value="{{ old('price') }}" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock', 0) }}" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" class="form-control" id="image" accept="image/*">
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="available" class="form-check-input" id="available" value="1" {{ old('available', true) ? 'checked' : '' }}>
        <label class="form-check-label" for="available">Available</label>
    </div>

    <button type="submit" class="btn btn-primary">Save Food</button>
    <a href="{{ route('manage-food.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection

@extends('layouts.app')

@section('content')

<h2>Edit Food: {{ $food->name }}</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('manage-food.update', $food->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $food->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $food->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price (৳)</label>
        <input type="number" step="0.01" name="price" class="form-control" id="price" value="{{ old('price', $food->price) }}" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock', $food->stock) }}" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        @if($food->image && $food->image !== 'default.jpg')
            <div class="mb-2">
                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" width="100">
            </div>
        @endif
        <input type="file" name="image" class="form-control" id="image" accept="image/*">
        <small class="text-muted">Leave blank to keep the current image.</small>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="available" class="form-check-input" id="available" value="1" {{ old('available', $food->available) ? 'checked' : '' }}>
        <label class="form-check-label" for="available">Available</label>
    </div>

    <button type="submit" class="btn btn-primary">Update Food</button>
    <a href="{{ route('manage-food.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection

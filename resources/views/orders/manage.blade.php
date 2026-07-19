@extends('layouts.app')

@section('content')

<h2>Manage Orders</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
       @forelse($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user ? $order->user->name : 'Unknown' }}</td>
            <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
            <td>৳{{ $order->total_amount }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <form action="{{ route('orders.status', $order->id) }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    @method('PATCH')
                    
                    <select name="status" class="form-select form-select-sm me-2" style="width: auto;">
                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Preparing" {{ $order->status == 'Preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="Ready" {{ $order->status == 'Ready' ? 'selected' : '' }}>Ready</option>
                        <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    
                    <button type="submit" class="btn btn-primary btn-sm">
                        Update
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">
                No orders found.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection

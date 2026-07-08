@extends('layouts.app')

@section('content')

<h2>My Orders</h2>

<table class="table table-striped">

<thead>

<tr>

<th>Order ID</th>

<th>Date</th>

<th>Status</th>

<th>Total</th>

</tr>

</thead>

<tbody>

@forelse($orders ?? [] as $order)

<tr>

<td>{{ $order->id }}</td>

<td>{{ $order->created_at }}</td>

<td>

<span class="badge bg-warning">

{{ $order->status }}

</span>

</td>

<td>

৳{{ $order->total_price }}

</td>

</tr>

@empty

<tr>

<td colspan="4" class="text-center">

No orders found.

</td>

</tr>

@endforelse

</tbody>

</table>

@endsection
@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card">

<div class="card-header bg-success text-white">
Register
</div>

<div class="card-body">

<form method="POST" action="{{ route('register') }}">

@csrf

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control">
</div>

<div class="mb-3">
<label>Confirm Password</label>
<input type="password"
name="password_confirmation"
class="form-control">
</div>

<button class="btn btn-success w-100">
Register
</button>

</form>

</div>

</div>

</div>

</div>

@endsection
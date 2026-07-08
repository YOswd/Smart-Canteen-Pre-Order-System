@extends('layouts.app')

@section('content')

<div class="text-center mb-5">

    <h1 class="display-4 fw-bold">
        Smart Canteen Pre-Order System
    </h1>

    <p class="lead">
        Order your favorite meals quickly and avoid waiting in queues.
    </p>

    <a href="/menu" class="btn btn-success btn-lg">
        Order Now
    </a>

</div>

<hr>

<h3 class="mb-4">Featured Foods</h3>

<div class="row">

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">

            <img src="https://via.placeholder.com/300x200"
                class="card-img-top">

            <div class="card-body">

                <h5>Chicken Burger</h5>

                <p>Delicious chicken burger.</p>

                <button class="btn btn-success w-100">
                    View Menu
                </button>

            </div>

        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">

            <img src="https://via.placeholder.com/300x200"
                class="card-img-top">

            <div class="card-body">

                <h5>Fried Rice</h5>

                <p>Special fried rice.</p>

                <button class="btn btn-success w-100">
                    View Menu
                </button>

            </div>

        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">

            <img src="https://via.placeholder.com/300x200"
                class="card-img-top">

            <div class="card-body">

                <h5>Cold Drinks</h5>

                <p>Fresh beverages.</p>

                <button class="btn btn-success w-100">
                    View Menu
                </button>

            </div>

        </div>
    </div>

</div>

@endsection
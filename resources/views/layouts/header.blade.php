@php
use Illuminate\Support\Facades\Auth;
@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">
            🍽️ Smart Canteen
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="navbar-collapse d-flex justify-content-end">
        <ul class="navbar-nav ms-auto">

        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/menu">Menu</a>
        </li>

        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
        @endguest

        @auth
        <li class="nav-item">
            <a class="nav-link" href="/cart">Cart</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/my-orders">My Orders</a>
        </li>

        <li class="nav-item">
            <span class="nav-link">
                Welcome, {{ Auth::user()->name }}
            </span>
        </li>

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-light ms-2">
                    Logout
                </button>
            </form>
        </li>
        @endauth

        </ul>
        </div>
    </div>
</nav>
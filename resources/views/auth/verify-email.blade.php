@extends('layout')

@section('title', 'Email megerősítés')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header py-3">
                <h4 class="mb-0">Email megerősítés szükséges</h4>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <p>Köszönjük a regisztrációt! Mielőtt folytatná, kérjük erősítse meg email címét a kiküldött linkre kattintva.</p>
                <p>Ha nem kapott megerősítő emailt, kérheti egy új email kiküldését.</p>

                <form action="{{ route('verification.resend') }}" method="GET" class="mt-4">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email cím</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Megerősítő email újraküldése</button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-white py-3">
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none">Vissza a bejelentkezéshez</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

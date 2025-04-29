@extends('layout')

@section('title', 'Elfelejtett jelszó')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header py-3">
                <h4 class="mb-0">Elfelejtett jelszó</h4>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <p>Adja meg az e-mail címét, és küldünk egy linket, amelyen keresztül visszaállíthatja jelszavát.</p>

                <form action="{{ route('password.email') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail cím</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Jelszó-visszaállítási link küldése</button>
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

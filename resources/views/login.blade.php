@extends('layout')

@section('title', 'Bejelentkezés')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header py-3">
                <h4 class="mb-0">Bejelentkezés</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email cím</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Jelszó</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Elfelejtette jelszavát?</a>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Emlékezz rám</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-white py-3">
                <div class="text-center">
                    <p class="mb-0">Még nincs fiókja? <a href="{{ route('registration') }}" class="text-primary">Regisztráljon itt!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

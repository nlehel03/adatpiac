@extends('layout')

@section('title', 'Jelszó visszaállítása')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header py-3">
                <h4 class="mb-0">Jelszó visszaállítása</h4>
            </div>
            <div class="card-body p-4">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="password" class="form-label">Új jelszó</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Új jelszó megerősítése</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Jelszó visszaállítása</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

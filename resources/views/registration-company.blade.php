@extends('layout')

@section('title', 'Regisztráció - Cég')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h4 class="mb-0">Regisztráció cégként</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('register.company') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="nev" class="form-label">Cégnév</label>
                        <input type="text" class="form-control @error('nev') is-invalid @enderror" id="nev" name="nev" value="{{ old('nev') }}" required>
                        @error('nev')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="cegjegyzekszam" class="form-label">Cégjegyzékszám</label>
                        <input type="text" class="form-control @error('cegjegyzekszam') is-invalid @enderror" id="cegjegyzekszam" name="cegjegyzekszam" value="{{ old('cegjegyzekszam') }}" required>
                        @error('cegjegyzekszam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Telefonszám</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="iranyitoszam" class="form-label">Irányítószám</label>
                        <input type="text" class="form-control @error('iranyitoszam') is-invalid @enderror" id="iranyitoszam" name="iranyitoszam" value="{{ old('iranyitoszam') }}" required>
                        @error('iranyitoszam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-9">
                        <label for="varos" class="form-label">Város</label>
                        <input type="text" class="form-control @error('varos') is-invalid @enderror" id="varos" name="varos" value="{{ old('varos') }}" required>
                        @error('varos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-9">
                        <label for="utca" class="form-label">Utca</label>
                        <input type="text" class="form-control @error('utca') is-invalid @enderror" id="utca" name="utca" value="{{ old('utca') }}" required>
                        @error('utca')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="hazszam" class="form-label">Házszám</label>
                        <input type="text" class="form-control @error('hazszam') is-invalid @enderror" id="hazszam" name="hazszam" value="{{ old('hazszam') }}" required>
                        @error('hazszam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Jelszó</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Jelszó megerősítése</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="col-12 mt-4">
                        <label class="form-label d-block">Regisztráció típusa</label>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="role" class="form-check-input" id="role_buyer" value="buyer" checked>
                            <label class="form-check-label" for="role_buyer">Vásárló</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="role" class="form-check-input" id="role_seller" value="seller">
                            <label class="form-check-label" for="role_seller">Eladó</label>
                        </div>
                        @error('role')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Elfogadom az <a href="#" class="text-decoration-none">adatvédelmi irányelveket</a> és a <a href="#" class="text-decoration-none">felhasználási feltételeket</a>.
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">Regisztráció</button>
                        <a href="{{ route('registration') }}" class="btn btn-outline-secondary ms-2">Vissza</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

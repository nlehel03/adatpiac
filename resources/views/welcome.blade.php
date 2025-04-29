@extends('layout')

@section('title', 'Kezdőlap')

@section('content')
<div class="row align-items-center section-padding fade-in">
    <div class="col-md-6">
        <h1 class="display-4 fw-bold mb-4">Üdvözöljük az Adatpiacon!</h1>
        <p class="lead mb-4">Az Adatpiac platform összeköti az adatgyűjtőket és az adatvásárlókat. Regisztráljon most és fedezze fel a lehetőségeket!</p>
        <div class="d-flex gap-3">
            <a href="{{ route('registration') }}" class="btn btn-primary btn-lg">Regisztráció</a>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Bejelentkezés</a>
        </div>
    </div>
    <div class="col-md-6">
        <img src="https://source.unsplash.com/random/600x400/?data,technology" alt="Adatpiac" class="img-fluid rounded-custom shadow">
    </div>
</div>

<div class="row mt-5 pt-5">
    <div class="col-12 text-center mb-5">
        <h2 class="fw-bold">Miért válasszon minket?</h2>
        <p class="text-muted">Az Adatpiac egyszerű, biztonságos és hatékony.</p>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center p-4">
                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-lock fa-2x text-primary"></i>
                </div>
                <h5 class="card-title">Biztonságos</h5>
                <p class="card-text text-muted">Az Ön adatai mindig biztonságban vannak nálunk. Titkosított kapcsolaton keresztül kommunikálunk.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center p-4">
                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-bolt fa-2x text-primary"></i>
                </div>
                <h5 class="card-title">Gyors</h5>
                <p class="card-text text-muted">Gyors és hatékony folyamatok. Ne vesztegesse az idejét felesleges várakozással!</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center p-4">
                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-chart-pie fa-2x text-primary"></i>
                </div>
                <h5 class="card-title">Elemzések</h5>
                <p class="card-text text-muted">Részletes elemzéseket kínálunk, hogy a legtöbbet hozhassa ki adataiból.</p>
            </div>
        </div>
    </div>
</div>
@endsection

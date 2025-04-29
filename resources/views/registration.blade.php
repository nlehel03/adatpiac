@extends('layout')

@section('title', 'Regisztráció')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h4 class="mb-0">Regisztráció</h4>
            </div>
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <p class="lead">Válassza ki a regisztráció típusát</p>
                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                        <a href="{{ route('registration-user') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-user me-2"></i>Magánszemélyként
                        </a>
                        <a href="{{ route('registration-company') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-building me-2"></i>Cégként
                        </a>
                    </div>
                </div>

                <div class="mt-5">
                    <h5 class="text-center mb-4">Miért érdemes regisztrálni?</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-3 mt-1" style="font-size: 1.2rem;"></i>
                                <div>
                                    <h6>Egyszerű adatkezelés</h6>
                                    <p class="text-muted small">Kezelje adatait egyszerűen és biztonságosan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-3 mt-1" style="font-size: 1.2rem;"></i>
                                <div>
                                    <h6>Személyre szabott ajánlatok</h6>
                                    <p class="text-muted small">Kapjon személyre szabott ajánlatokat az adatokhoz.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-3 mt-1" style="font-size: 1.2rem;"></i>
                                <div>
                                    <h6>Könnyű navigáció</h6>
                                    <p class="text-muted small">Könnyen navigálhat az adatpiaci ajánlatok között.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check-circle text-success me-3 mt-1" style="font-size: 1.2rem;"></i>
                                <div>
                                    <h6>Biztonságos tranzakciók</h6>
                                    <p class="text-muted small">Minden adattranzakció biztonságosan zajlik.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white py-3">
                <div class="text-center">
                    <p class="mb-0">Már van fiókja? <a href="{{ route('login') }}" class="text-primary">Jelentkezzen be itt!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

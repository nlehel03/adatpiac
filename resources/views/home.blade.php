@extends('layout')

@section('title', 'Irányítópult')

@section('content')
<div class="row fade-in">
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <h5 class="card-title">Üdvözöljük, {{ Auth::user()->nev }}!</h5>
                <p class="text-muted">Sikeresen bejelentkezett az Adatpiac rendszerbe.</p>
                <div class="d-grid mt-4">
                    <a href="#" class="btn btn-primary">Profil megtekintése</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <h5 class="card-title mb-4">Gyorshivatkozások</h5>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary p-4">
                                <i class="fas fa-database d-block mb-2 fa-2x"></i>
                                Adatok böngészése
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary p-4">
                                <i class="fas fa-chart-bar d-block mb-2 fa-2x"></i>
                                Statisztikák
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary p-4">
                                <i class="fas fa-user-cog d-block mb-2 fa-2x"></i>
                                Beállítások
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h5 class="mb-0">Legújabb adatok</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Név</th>
                                <th>Kategória</th>
                                <th>Dátum</th>
                                <th>Művelet</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Minta adat 1</td>
                                <td><span class="badge bg-primary">Marketing</span></td>
                                <td>2023.10.15</td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">Részletek</a></td>
                            </tr>
                            <tr>
                                <td>Minta adat 2</td>
                                <td><span class="badge bg-success">Pénzügy</span></td>
                                <td>2023.10.12</td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">Részletek</a></td>
                            </tr>
                            <tr>
                                <td>Minta adat 3</td>
                                <td><span class="badge bg-info">Kutatás</span></td>
                                <td>2023.10.10</td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">Részletek</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white py-3">
                <a href="#" class="text-decoration-none">Összes adat megtekintése <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h5 class="mb-0">Aktivitás</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                                <i class="fas fa-sign-in-alt text-success"></i>
                            </div>
                            <div>
                                <p class="mb-0">Sikeres bejelentkezés</p>
                                <small class="text-muted">Ma, {{ date('H:i') }}</small>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                <i class="fas fa-eye text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-0">Adat megtekintve</p>
                                <small class="text-muted">Tegnap</small>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                                <i class="fas fa-edit text-info"></i>
                            </div>
                            <div>
                                <p class="mb-0">Profil frissítve</p>
                                <small class="text-muted">2 napja</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-white py-3">
                <a href="#" class="text-decoration-none">Aktivitási napló <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection

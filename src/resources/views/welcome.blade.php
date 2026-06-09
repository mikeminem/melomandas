@extends('layouts.app')

@section('content')

<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm border-0 welcome-card">
                    <div class="card-body p-5 text-center">
                        <h1 class="h4 fw-bold mb-4">¿Qué se te antoja <b>hoy</b>?</h1>
                        <h2 class="text-muted mb-4"> ~ ME LO MANDAS ~</h2>

                        <div class="d-flex justify-content-center gap-4 mb-4" style="font-size: 2.625rem;">
                            <i class="bi bi-egg-fried" title="Desayuno"></i>
                            <i class="bi bi-cup-hot" title="Bebida caliente"></i>
                            <i class="bi bi-fire" title="A la Parrilla"></i>
                            <i class="bi bi-fork-knife" title="Comida"></i>
                            <i class="bi bi-cake2" title="Postres"></i>
                        </div>

                        <a href="{{ route('register') }}" class="btn btn-dark btn-lg w-100">
                            <i class="bi bi-rocket-takeoff me-2"></i>Comenzar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

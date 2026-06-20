@extends('layouts.client')

@section('content')

    <div class="exhibitions-page">

        {{-- HERO --}}
        <div class="exhibitions-hero py-5 text-center">

            <div class="container">

                <span class="badge bg-secondary mb-2">Archives</span>

                <h1 class="fw-bold">Expositions passées</h1>

                <p class="text-muted">
                    Découvrez les anciennes expositions de la galerie
                </p>

            </div>

        </div>

        {{-- LIST --}}
        <div class="container py-4">

            <div class="row g-4">

                @forelse($passees as $expo)

                    <div class="col-lg-4 col-md-6">

                        <div class="card exhibition-card h-100 shadow-sm border-0">

                            @if($expo->image)
                                <img src="{{ asset('storage/'.$expo->image) }}"
                                     class="card-img-top exhibition-image">
                            @endif

                            <div class="card-body">

                            <span class="badge bg-dark mb-2">
                                Terminée
                            </span>

                                <h5 class="card-title">{{ $expo->titre }}</h5>

                                <p class="card-text text-muted">
                                    {{ Str::limit($expo->description, 100) }}
                                </p>

                                <div class="small text-muted mb-3">
                                    📍 {{ $expo->lieu }} <br>
                                    📅 {{ $expo->date_debut }} → {{ $expo->date_fin }}
                                </div>

                                <a href="{{ route('expositions.show', $expo) }}"
                                   class="btn btn-outline-primary w-100">
                                    Voir détails
                                </a>

                            </div>

                        </div>

                    </div>

                @empty
                    <div class="text-center text-muted">
                        Aucune exposition passée.
                    </div>
                @endforelse

            </div>

        </div>

    </div>

@endsection

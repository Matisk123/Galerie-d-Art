@extends('layouts.client')

@section('content')

    <div class="exhibitions-page">

        {{-- HERO --}}
        <div class="exhibitions-hero">

            <div class="exhibitions-hero-content">

                <span class="hero-badge">
                    Événements artistiques
                </span>

                <h1>
                    Découvrez les expositions de la galerie
                </h1>

                <p>
                    Explorez les événements passés, présents et à venir,
                    mettant en lumière les artistes et les œuvres de notre collection.
                </p>

            </div>

        </div>

        {{-- EXPOSITIONS EN COURS --}}
        <div class="section-header mt-5">
            <h2>Expositions en cours</h2>
        </div>

        <div class="row g-4">

            @forelse($enCours as $expo)

                <div class="col-lg-4">

                    <div class="exhibition-card featured h-100 shadow-sm">

                        <div class="exhibition-image-wrapper">
                            <img src="{{ asset('storage/'.$expo->image) }}"
                                 class="exhibition-image">
                        </div>

                        <div class="exhibition-content p-3">

        <span class="exhibition-status active">
            En cours
        </span>

                            <h4 class="mt-2">{{ $expo->titre }}</h4>

                            <p class="text-muted">
                                {{ \Illuminate\Support\Str::limit($expo->description, 120) }}
                            </p>

                            <div class="exhibition-meta small text-muted">
                                <span>📍 {{ $expo->lieu }}</span><br>
                                <span>📅 Jusqu’au {{ \Carbon\Carbon::parse($expo->date_fin)->format('d/m/Y') }}</span>
                            </div>

                            <a href="{{ route('expositions.show', $expo) }}"
                               class="btn btn-primary btn-sm mt-3 w-100">
                                Découvrir
                            </a>

                        </div>

                    </div>

                </div>

            @empty
                <p>Aucune exposition en cours.</p>
            @endforelse

        </div>

        {{-- PROCHAINEMENT --}}
        <div class="section-header mt-5">
            <h2>Prochainement</h2>
        </div>

        <div class="row g-4">

            @forelse($aVenir as $expo)

                <div class="col-md-6">

                    <div class="upcoming-exhibition d-flex gap-3 p-3 shadow-sm">

                        <img src="{{ asset('storage/'.$expo->image) }}"
                             class="upcoming-image">

                        <div class="upcoming-content flex-grow-1">

                            <span class="upcoming-date badge bg-secondary">
                                {{ \Carbon\Carbon::parse($expo->date_debut)->format('d/m/Y') }}
                            </span>

                            <h4 class="mt-2">{{ $expo->titre }}</h4>

                            <p class="text-muted">
                                {{ \Illuminate\Support\Str::limit($expo->description, 100) }}
                            </p>

                            <a href="{{ route('expositions.show', $expo) }}">
                                En savoir plus →
                            </a>

                        </div>

                    </div>

                </div>

            @empty
                <p>Aucune exposition à venir.</p>
            @endforelse

        </div>

        {{-- BANDEAU FINAL --}}
        <div class="exhibition-banner-large mt-5">

            <div>

                <span class="exhibition-label">
                    Archives
                </span>

                <h2>
                    Expositions passées
                </h2>

                <p>
                    Retrouvez toutes les expositions déjà terminées.
                </p>

            </div>

            <a href="{{ route('expositions.past') }}" class="btn btn-light">
                Voir
            </a>

        </div>

    </div>

@endsection

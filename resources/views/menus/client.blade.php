@extends('layouts.client')

@section('content')

    <div class="home-page">

        {{-- HERO --}}
        <div class="hero-section">

            <div class="hero-content">

            <span class="hero-badge">
                Galerie d’art contemporain
            </span>

                <h1>
                    Découvrez des œuvres uniques et des artistes émergents
                </h1>

                <p>
                    Explorez une collection moderne de peintures, sculptures,
                    photographies et expositions.
                </p>

                <div class="hero-actions">

                    <a href="/oeuvres" class="btn btn-primary">
                        Explorer les œuvres
                    </a>

                    <a href="/artistes" class="btn btn-outline-light">
                        Voir les artistes
                    </a>

                </div>

            </div>

        </div>

        {{-- STATS --}}
        <div class="row g-4 mt-1">

            <div class="col-md-4">
                <div class="home-card stat-card">
                    <h3>{{ $oeuvresCount }}</h3>
                    <p>Œuvres disponibles</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="home-card stat-card">
                    <h3>{{ $artistesCount }}</h3>
                    <p>Artistes partenaires</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="home-card stat-card">
                    <h3>{{ $expositionsActives }}</h3>
                    <p>Expositions actives</p>
                </div>
            </div>

        </div>

        {{-- ŒUVRES POPULAIRES --}}
        <div class="section-header mt-5">

            <h2>Œuvres populaires</h2>

            <a href="{{ route('oeuvres') }}">
                Voir tout
            </a>

        </div>

        <div class="row g-4">

            @foreach($oeuvresPopulaires as $oeuvre)

                <div class="col-xl-4 col-lg-6 col-md-6">

                    <div class="art-item">

                        <div class="art-image-wrapper">
                            <a href="{{ route('oeuvres.show', $oeuvre) }}">
                                @if($oeuvre->image)
                                    <img src="{{ asset('storage/'.$oeuvre->image) }}"
                                         class="art-item-image">
                                @endif
                            </a>
                        </div>

                        <div class="art-item-info">

                            <div class="art-title">
                                {{ $oeuvre->titre }}
                            </div>

                            <div class="art-artist">
                                {{ $oeuvre->artist_name }}
                            </div>

                            <div class="art-details">
                                {{ $oeuvre->categorie }}
                                @if($oeuvre->style)
                                    {{ $oeuvre->style }}
                                @endif
                                • {{ $oeuvre->largeur }} x {{ $oeuvre->hauteur }} cm
                            </div>

                            <div class="artist-work-footer d-flex justify-content-between align-items-center">

                                <div class="art-price">
                                    {{ number_format($oeuvre->prix,0,',',' ') }} €
                                </div>

                                <div class="favorite-btn {{ auth()->check() && auth()->user()->favorites->contains($oeuvre->id) ? 'active' : '' }}"
                                     data-id="{{ $oeuvre->id }}">
                                    ♥
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        {{-- ARTISTES --}}
        <div class="section-header mt-5">
            <h2>Artistes à découvrir</h2>
            <a href="/artistes">Voir tout</a>
        </div>

        <div class="row g-4">

            @foreach($artistesPopulaires as $artist)

                <div class="col-lg-3 col-md-6">

                    <a href="{{ route('artistes.oeuvres', $artist->id) }}"
                       style="text-decoration:none; color:inherit;">

                        <div class="home-card artist-card text-center">

                            @if($artist->profile_photo)
                                <img src="{{ asset('storage/'.$artist->profile_photo) }}"
                                     class="artist-avatar">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($artist->name) }}"
                                     class="artist-avatar">
                            @endif

                            <h5 class="mt-3">
                                {{ $artist->name }}
                            </h5>

                            <p>Art contemporain</p>

                        </div>

                    </a>
                </div>

            @endforeach

        </div>

        {{-- EXPOSITIONS --}}
        <div class="section-header mt-5">
            <h2>Expositions</h2>
            <a href="{{ route('expositions') }}">Voir tout</a>
        </div>

        <div class="home-card exhibition-banner">

            <div>
                <span class="exhibition-label">
                    Exposition du mois
                </span>

                <h3>
                    {{ $expoDuMois?->titre ?? 'Aucune exposition en cours' }}
                </h3>

                <p>
                    {{ $expoDuMois?->description ?? 'Aucune description disponible' }}
                </p>
            </div>

            <a href="{{ route('expositions') }}" class="btn btn-light">
                Découvrir
            </a>

        </div>

    </div>

@endsection

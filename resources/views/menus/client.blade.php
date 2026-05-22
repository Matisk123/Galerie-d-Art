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

                    <h3>250+</h3>

                    <p>Œuvres disponibles</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="home-card stat-card">

                    <h3>40+</h3>

                    <p>Artistes partenaires</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="home-card stat-card">

                    <h3>12</h3>

                    <p>Expositions actives</p>

                </div>

            </div>

        </div>


        {{-- OEUVRES POPULAIRES --}}
        <div class="section-header mt-5">

            <h2>Œuvres populaires</h2>

            <a href="/oeuvres">
                Voir tout
            </a>

        </div>

        <div class="row g-4">

            @for($i = 0; $i < 6; $i++)

                <div class="col-lg-4 col-md-6">

                    <div class="home-card artwork-card">

                        <img src="https://picsum.photos/500/350?random={{ $i }}"
                             class="artwork-image">

                        <div class="artwork-content">

                            <h5>Œuvre contemporaine</h5>

                            <p>Artiste moderne</p>

                        </div>

                    </div>

                </div>

            @endfor

        </div>


        {{-- ARTISTES --}}
        <div class="section-header mt-5">

            <h2>Artistes à découvrir</h2>

            <a href="/artistes">
                Voir tout
            </a>

        </div>

        <div class="row g-4">

            @for($i = 0; $i < 4; $i++)

                <div class="col-lg-3 col-md-6">

                    <div class="home-card artist-card text-center">

                        <img src="https://i.pravatar.cc/200?img={{ $i+10 }}"
                             class="artist-avatar">

                        <h5 class="mt-3">
                            Artiste {{ $i + 1 }}
                        </h5>

                        <p>
                            Art contemporain
                        </p>

                    </div>

                </div>

            @endfor

        </div>


        {{-- EXPOSITIONS --}}
        <div class="section-header mt-5">

            <h2>Expositions</h2>

            <a href="/expositions">
                Voir tout
            </a>

        </div>

        <div class="home-card exhibition-banner">

            <div>

            <span class="exhibition-label">
                Exposition du mois
            </span>

                <h3>
                    Lumières Urbaines
                </h3>

                <p>
                    Une immersion dans l’art moderne inspiré des villes contemporaines.
                </p>

            </div>

            <a href="/expositions" class="btn btn-light">
                Découvrir
            </a>

        </div>

    </div>

@endsection

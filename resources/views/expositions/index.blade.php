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

            @for($i = 1; $i <= 3; $i++)

                <div class="col-lg-4">

                    <div class="exhibition-card featured">

                        <img
                            src="https://picsum.photos/700/450?random={{ $i }}"
                            class="exhibition-image"
                        >

                        <div class="exhibition-content">

                        <span class="exhibition-status active">
                            En cours
                        </span>

                            <h4>
                                Exposition {{ $i }}
                            </h4>

                            <p>
                                Une immersion dans l'univers artistique contemporain,
                                entre abstraction et modernité.
                            </p>

                            <div class="exhibition-meta">

                                <span>📍 Galerie Centrale</span>

                                <span>📅 Jusqu'au 30 septembre</span>

                            </div>

                            <a href="#" class="btn btn-primary mt-3">
                                Découvrir
                            </a>

                        </div>

                    </div>

                </div>

            @endfor

        </div>


        {{-- PROCHAINEMENT --}}
        <div class="section-header mt-5">

            <h2>Prochainement</h2>

        </div>

        <div class="row g-4">

            @for($i = 4; $i <= 7; $i++)

                <div class="col-md-6">

                    <div class="upcoming-exhibition">

                        <img
                            src="https://picsum.photos/500/300?random={{ $i }}"
                            class="upcoming-image"
                        >

                        <div class="upcoming-content">

                        <span class="upcoming-date">
                            Octobre 2026
                        </span>

                            <h4>
                                Horizons Modernes
                            </h4>

                            <p>
                                Une nouvelle exposition consacrée aux talents émergents.
                            </p>

                            <a href="#">
                                En savoir plus →
                            </a>

                        </div>

                    </div>

                </div>

            @endfor

        </div>


        {{-- BANDEAU FINAL --}}
        <div class="exhibition-banner-large mt-5">

            <div>

            <span class="exhibition-label">
                À ne pas manquer
            </span>

                <h2>
                    Nuit des Arts Contemporains
                </h2>

                <p>
                    Une soirée exceptionnelle réunissant artistes,
                    performances et découvertes inédites.
                </p>

            </div>

            <a href="#" class="btn btn-light">
                Réserver
            </a>

        </div>

    </div>

@endsection

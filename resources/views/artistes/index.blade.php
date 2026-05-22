@extends('layouts.client')

@section('content')

    <div class="artists-page">

        {{-- HEADER --}}
        <div class="artists-hero">

            <div class="artists-hero-content">

            <span class="artists-badge">
                Artistes contemporains
            </span>

                <h1>
                    Découvrez les artistes de la galerie
                </h1>

                <p>
                    Explorez des univers uniques, des styles modernes
                    et des talents émergents du monde artistique.
                </p>

            </div>

        </div>


        {{-- SEARCH + FILTER --}}
        <div class="artists-toolbar">

            <div class="search-box">

                <input type="text"
                       class="form-control"
                       placeholder="Rechercher un artiste...">

            </div>

            <div class="filter-box">

                <select class="form-control">

                    <option>
                        Tous les styles
                    </option>

                    <option>
                        Art moderne
                    </option>

                    <option>
                        Peinture
                    </option>

                    <option>
                        Sculpture
                    </option>

                    <option>
                        Photographie
                    </option>

                </select>

            </div>

        </div>


        </div>{{-- LIST ARTISTS --}}

        <div class="artists-list">

            @for($i = 1; $i <= 10; $i++)


                <div class="artist-line-card">

                    {{-- LEFT --}}
                    <div class="artist-left">

                        <div class="artist-header">

                            <img src="https://i.pravatar.cc/200?img={{ $i + 20 }}"
                                 class="artist-avatar-large">

                            <div class="artist-name-block">

                                <h3>
                                    Artiste {{ $i }}
                                </h3>

                                <span class="artist-speciality">
                                    Art contemporain • France
                                </span>

                            </div>

                        </div>

                        <a href="#"
                           class="artist-follow-btn">

                            +
                            Suivre

                        </a>

                    </div>


                    {{-- RIGHT --}}
                    <div class="artist-content">

                        <div class="artist-top-bar">

                            <a href="#"
                               class="artist-all-link">

                                Toutes les œuvres →

                            </a>

                        </div>


                        <div class="artist-right">

                            @for($x = 1; $x <= 5; $x++)

                                <div class="artist-work-card">

                                    <img src="https://picsum.photos/400/400?random={{ $i + $x }}"
                                         class="artist-work-preview">

                                    <div class="artist-work-title">
                                        Sans titre
                                    </div>

                                    <div class="artist-work-author">
                                        Artiste {{ $i }}
                                    </div>

                                    <div class="artist-work-details">
                                        Peinture • 80 x 60 cm
                                    </div>

                                    <div class="artist-work-price">
                                        {{ rand(1200, 9500) }} €
                                    </div>

                                </div>

                            @endfor

                        </div>

                    </div>

                </div>
            @endfor

        </div>

    </div>

@endsection

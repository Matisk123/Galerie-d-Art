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
                    Découvrez les vendeurs de la galerie
                </h1>

                <p>
                    Explorez des univers uniques, des styles modernes
                    et des talents émergents du monde artistique.
                </p>

            </div>

        </div>


        {{-- SEARCH + FILTER (UI only pour l'instant) --}}
        <div class="artists-toolbar">

            <div class="search-box">
                <input type="text"
                       class="form-control"
                       placeholder="Rechercher un artiste...">
            </div>

            <div class="filter-box">
                <select class="form-control">
                    <option>Tous les styles</option>
                    <option>Art moderne</option>
                    <option>Peinture</option>
                    <option>Sculpture</option>
                    <option>Photographie</option>
                </select>
            </div>

        </div>


        {{-- LIST ARTISTS --}}
        <div class="artists-list">

            @foreach($artistes as $artiste)

                <div class="artist-line-card">

                    {{-- LEFT --}}
                    <div class="artist-left">

                        <div class="artist-header">

                            @if($artiste->profile_photo)
                                <img src="{{ asset('storage/'.$artiste->profile_photo) }}"
                                     class="artist-avatar-large">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($artiste->name) }}"
                                     class="artist-avatar-large">
                            @endif

                            <div class="artist-name-block">

                                <h3>
                                    {{ $artiste->name }}
                                </h3>

                                <span class="artist-speciality">
                                Vendeur • {{ $artiste->oeuvres_count }} œuvre(s)
                            </span>

                            </div>

                        </div>

                    </div>

                    {{-- RIGHT (optionnel preview œuvres) --}}
                    <div class="artist-content">

                        <div class="artist-top-bar">
                        <span class="artist-all-link">
                            Toutes les œuvres →
                        </span>
                        </div>

                        <div class="artist-right">

                            @foreach($artiste->oeuvres->take(3) as $oeuvre)

                                <div class="artist-work-card bordered-work">

                                    <a href="{{ route('oeuvres.show', $oeuvre) }}">
                                        <img src="{{ asset('storage/'.$oeuvre->image) }}"
                                             class="artist-work-preview">
                                    </a>

                                    <div class="artist-work-title">
                                        {{ $oeuvre->titre }}
                                    </div>

                                    <div class="artist-work-author">
                                        {{ $artiste->name }}
                                    </div>

                                    <div class="artist-work-details">
                                        {{ $oeuvre->categorie }}
                                        @if($oeuvre->style)
                                            {{ $oeuvre->style }}
                                        @endif
                                    </div>

                                    <div class="art-footer">
                                        <div class="art-price">
                                            {{ number_format($oeuvre->prix,0,',',' ') }} €
                                        </div>

                                        <div class="favorite-btn {{ auth()->check() && auth()->user()->favorites->contains($oeuvre->id) ? 'active' : '' }}"
                                             data-id="{{ $oeuvre->id }}">
                                            ♥
                                        </div>
                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

@endsection

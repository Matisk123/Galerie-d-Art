@extends('layouts.client')

@section('content')

    <div class="oeuvres-page">

        <div class="oeuvres-hero">

        <span class="badge-oeuvres">
            Collection de la galerie
        </span>

            <h1>Œuvres & objets d’art</h1>

            <p>
                Découvrez un univers varié : peintures, sculptures, céramiques,
                objets décoratifs et créations uniques.
            </p>

        </div>

        <div class="oeuvres-categories">

            @php
                $categories = [
                    "Peintures", "Sculptures", "Céramiques",
                    "Bouteilles", "Assiettes", "Photographies", "Objets d’art"
                ];
            @endphp

            @foreach($categories as $cat)
                <div class="category-card">
                    {{ $cat }}
                </div>
            @endforeach

        </div>

        <div class="oeuvres-filters">

            <input type="text" class="form-control"
                   placeholder="Rechercher une œuvre...">

            <select class="form-control">
                <option>Toutes les catégories</option>
                <option>Peintures</option>
                <option>Sculptures</option>
                <option>Céramiques</option>
            </select>

        </div>

        <div class="row g-4 mt-4">

            @forelse($oeuvres as $oeuvre)

                <div class="col-xl-3 col-lg-4 col-md-6">

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

            @empty

                <div class="text-center py-5">
                    <h5>Aucune œuvre disponible</h5>
                </div>

            @endforelse

        </div>

    </div>

@endsection

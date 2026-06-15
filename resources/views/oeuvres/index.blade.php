@extends('layouts.client')

@section('content')

    <div class="oeuvres-page">

        {{-- HERO --}}
        <div class="oeuvres-hero">

        <span class="badge-oeuvres">
            Collection de la galerie
        </span>

            <h1>
                Œuvres & objets d’art
            </h1>

            <p>
                Découvrez un univers varié : peintures, sculptures, céramiques,
                objets décoratifs et créations uniques.
            </p>

        </div>

        {{-- CATEGORIES --}}
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

        {{-- FILTRES --}}
        <div class="oeuvres-filters">

            <input type="text" class="form-control" placeholder="Rechercher une œuvre...">

            <select class="form-control">
                <option>Toutes les catégories</option>
                <option>Peintures</option>
                <option>Sculptures</option>
                <option>Céramiques</option>
            </select>

        </div>

        <div class="row g-4 mt-4">

            @php
                $types = [
                    'Peinture',
                    'Sculpture',
                    'Céramique',
                    'Bouteille décorative',
                    'Assiette décorative',
                    'Photographie'
                ];
            @endphp

            @for($i = 1; $i <= 16; $i++)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="art-item">

                        <img src="https://picsum.photos/500/650?random={{ $i }}"
                             class="art-item-image">

                        <div class="art-item-info">

                            <div class="art-title">
                                Sans titre
                            </div>

                            <div class="art-artist">
                                Artiste {{ rand(1,10) }}
                            </div>

                            <div class="art-details">
                                {{ $types[array_rand($types)] }} •
                                {{ rand(20,120) }} x {{ rand(20,120) }} cm
                            </div>

                            <div class="artist-work-footer">

                                <div class="art-price">
                                    {{ rand(150,9500) }} €
                                </div>

                                <button class="like-btn">
                                    <i class="bi bi-heart"></i>
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            @endfor

        </div>

    </div>

@endsection

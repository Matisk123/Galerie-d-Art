@extends('layouts.client')

@section('content')

    <div class="oeuvres-page">

        <div class="oeuvres-hero">
            <span class="badge-oeuvres">Collection de la galerie</span>

            <h1>Œuvres & objets d’art</h1>

            <p>
                Découvrez un univers varié : peintures, sculptures, céramiques,
                objets décoratifs et créations uniques.
            </p>
        </div>

        {{-- CATEGORIES --}}
        <div class="oeuvres-categories">

            <a href="{{ route('oeuvres') }}"
               class="category-card text-decoration-none {{ !request('categorie') ? 'active' : '' }}">
                Toutes les œuvres
            </a>

            @foreach($categories as $cat)
                <a href="{{ route('oeuvres', ['categorie' => $cat]) }}"
                   class="category-card {{ request('categorie') == $cat ? 'active' : '' }}">
                    {{ $cat }}
                </a>
            @endforeach

        </div>

        {{-- SEARCH --}}
        <form method="GET" action="{{ route('oeuvres') }}" class="oeuvres-filters">

            <input type="text"
                   id="search-input"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Rechercher une œuvre...">

            <select name="categorie" class="form-control mt-2">
                <option value="">Toutes catégories</option>

                @foreach($categories as $cat)
                    <option value="{{ $cat }}"
                        @selected(request('categorie') == $cat)>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>

            <button class="btn btn-primary mt-2">
                Rechercher
            </button>

        </form>

        <div id="suggestions-box"
             style="position:absolute; background:white; border:1px solid #ddd; z-index:999; width:100%;">
        </div>

        {{-- LIST --}}
        <div class="row g-4 mt-4">

            @forelse($oeuvres as $oeuvre)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="art-item">

                        <a href="{{ route('oeuvres.show', $oeuvre) }}">
                            <img src="{{ asset('storage/'.$oeuvre->image) }}" class="art-item-image">
                        </a>

                        <div class="art-item-info">

                            <div class="art-title">{{ $oeuvre->titre }}</div>

                            <div class="art-artist">{{ $oeuvre->artist_name }}</div>

                            <div class="art-details">
                                {{ $oeuvre->categorie }}
                                @if($oeuvre->style)
                                    {{ $oeuvre->style }}
                                @endif
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

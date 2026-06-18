@extends('layouts.client')

@section('content')

    <div class="peintures-page">

        <div class="peintures-hero">
            <span class="badge-peinture">Univers peinture</span>

            <h1>La peinture contemporaine</h1>

            <p>
                Explorez des œuvres abstraites, modernes et expressives
                réalisées par des artistes contemporains.
            </p>
        </div>

        {{-- STYLES --}}
        <div class="peinture-styles">

            <a href="{{ route('peintures') }}"
               class="style-pill text-decoration-none {{ !request('style') ? 'active' : '' }}">
                Tous
            </a>

            @foreach($styles as $style)
                <a href="{{ route('peintures', ['style' => $style, 'search' => request('search')]) }}"
                   class="style-pill text-decoration-none {{ request('style') == $style ? 'active' : '' }}">
                    {{ ucwords($style) }}
                </a>
            @endforeach

        </div>

        {{-- SEARCH --}}
        <form method="GET" action="{{ route('oeuvres') }}" class="oeuvres-filters">

            <div class="search-wrapper">

                <input type="text"
                       id="search-input"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Rechercher une œuvre...">

                <div id="suggestions-box"></div>

            </div>

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

        {{-- LIST --}}
        <div class="row g-4 mt-4">

            @forelse($oeuvres as $oeuvre)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="art-item">

                        <a href="{{ route('oeuvres.show', $oeuvre) }}">
                            <img src="{{ asset('storage/'.$oeuvre->image) }}"
                                 class="art-item-image">
                        </a>

                        <div class="art-item-info">

                            <div class="art-title">{{ $oeuvre->titre }}</div>

                            <div class="art-artist">{{ $oeuvre->artist_name }}</div>

                            <div class="art-details">
                                {{ $oeuvre->categorie }}

                                @if($oeuvre->style)
                                    {{ ucwords($oeuvre->style) }}
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

            @empty

                <div class="text-center py-5">
                    <h5>Aucune peinture disponible</h5>
                </div>

            @endforelse

        </div>

    </div>

@endsection

@extends('layouts.client')

@section('content')

    <div class="oeuvres-page">

        <div class="oeuvres-hero">

            <span class="badge-oeuvres">
                Artiste
            </span>

            {{-- PROFIL ARTISTE --}}
            <div class="d-flex align-items-center gap-3 mt-3 mb-3">

                @if($user->profile_photo)
                    <img src="{{ asset('storage/'.$user->profile_photo) }}"
                         class="rounded-circle"
                         style="width:80px;height:80px;object-fit:cover;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                         class="rounded-circle"
                         style="width:80px;height:80px;">
                @endif

                <div>
                    <h1 class="mb-0">
                        {{ $user->name }}
                    </h1>

                    <p class="mb-0 text-muted">
                        Artiste / Vendeur
                    </p>
                </div>

            </div>

            <p>
                Découvrez toutes les créations publiées par cet artiste.
            </p>

        </div>

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

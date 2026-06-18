@extends('layouts.client')

@section('content')

    <div class="peintures-page">

        <div class="peintures-hero">

        <span class="badge-peinture">
            Univers peinture
        </span>

            <h1>La peinture contemporaine</h1>

            <p>
                Explorez des œuvres abstraites, modernes et expressives
                réalisées par des artistes contemporains.
            </p>

        </div>

        <div class="peinture-styles">

            @php
                $styles = [
                    "Abstrait", "Figuratif", "Street Art",
                    "Expressionnisme", "Minimalisme"
                ];
            @endphp

            @foreach($styles as $style)
                <div class="style-pill">{{ $style }}</div>
            @endforeach

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
                                {{ $oeuvre->largeur }} x {{ $oeuvre->hauteur }} cm
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

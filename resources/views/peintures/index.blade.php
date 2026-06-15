@extends('layouts.client')

@section('content')

    <div class="peintures-page">

        {{-- HERO --}}
        <div class="peintures-hero">

        <span class="badge-peinture">
            Univers peinture
        </span>

            <h1>
                La peinture contemporaine
            </h1>

            <p>
                Explorez des œuvres abstraites, modernes et expressives
                réalisées par des artistes contemporains.
            </p>

        </div>

        {{-- FILTRES STYLES --}}
        <div class="peinture-styles">

            @php
                $styles = [
                    "Abstrait", "Figuratif", "Street Art",
                    "Expressionnisme", "Minimalisme"
                ];
            @endphp

            @foreach($styles as $style)
                <div class="style-pill">
                    {{ $style }}
                </div>
            @endforeach

        </div>

        {{-- LISTE PEINTURES --}}
        <div class="row g-4 mt-4">

            @for($i = 1; $i <= 12; $i++)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="art-item">

                        <img src="https://picsum.photos/500/650?random={{ $i }}"
                             class="art-item-image">

                        <div class="art-item-info">

                            <div class="art-title">
                                Sans titre
                            </div>

                            <div class="art-artist">
                                Artiste {{ $i }}
                            </div>

                            <div class="art-details">
                                Peinture • 80 x 60 cm
                            </div>

                            <div class="artist-work-footer">

                                <div class="artist-work-price">
                                    {{ rand(1200,9500) }} €
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

@endsection

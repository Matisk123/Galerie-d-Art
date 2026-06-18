@extends('layouts.client')

@section('content')

    <div class="oeuvre-show-page py-4">

        <div class="container">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-start mb-4">

                <div>
                    <h1 class="mb-1">{{ $oeuvre->titre }}</h1>

                    <p class="text-muted mb-0">
                        par {{ $oeuvre->artist_name }}
                    </p>
                </div>

                <div>
                    <a href="{{ route('oeuvres') }}" class="btn btn-outline-secondary">
                        ← Retour
                    </a>
                </div>

            </div>

            {{-- CONTENT --}}
            <div class="row g-5">

                {{-- IMAGE --}}
                <div class="col-md-6">

                    <div class="oeuvre-image-wrapper">

                        @if($oeuvre->image)
                            <img src="{{ asset('storage/'.$oeuvre->image) }}"
                                 class="img-fluid rounded shadow">
                        @else
                            <img src="https://via.placeholder.com/800x800"
                                 class="img-fluid rounded shadow">
                        @endif

                    </div>

                </div>

                {{-- INFOS --}}
                <div class="col-md-6">

                    <div class="card p-4 shadow-sm border-0">

                        <h3 class="text-primary mb-3">
                            {{ number_format($oeuvre->prix, 0, ',', ' ') }} €
                        </h3>

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="favorite-btn {{ auth()->user()->favorites->where('oeuvre_id', $oeuvre->id)->count() ? 'active' : '' }}"
                                 data-id="{{ $oeuvre->id }}">
                                ♥
                            </div>

                        </div>

                        <hr>

                        <p class="mb-2">
                            <strong>Catégorie :</strong> {{ $oeuvre->categorie }}
                            @if($oeuvre->style)
                                {{ $oeuvre->style }}
                            @endif
                        </p>

                        <p class="mb-2">
                            <strong>Dimensions :</strong>
                            {{ $oeuvre->largeur }} x {{ $oeuvre->hauteur }} cm
                        </p>

                        <p class="mb-2">
                            <strong>Artiste :</strong> {{ $oeuvre->artist_name }}
                        </p>

                        <hr>

                        <p class="mt-3">
                            {{ $oeuvre->description ?? 'Aucune description disponible.' }}
                        </p>


                    </div>

                </div>

            </div>

            {{-- AUTRES INFOS / CTA --}}
            <div class="mt-5 text-center">

                <a href="{{ route('oeuvres') }}" class="btn btn-primary">
                    Voir plus d’œuvres
                </a>

            </div>

        </div>

    </div>

@endsection

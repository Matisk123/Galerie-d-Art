@extends('layouts.client')

@section('content')

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-start mb-4">

            <div>
                <h2>{{ $oeuvre->titre }}</h2>
                <p class="text-muted mb-0">
                    {{ $oeuvre->artist_name }}
                </p>
            </div>

            @if(Auth::user()->hasRole('super_admin') || Auth::id() === $oeuvre->user_id)

                <a href="{{ route('admin.oeuvres.edit', $oeuvre) }}"
                   class="btn btn-primary">
                    Modifier
                </a>

            @endif

        </div>

        <div class="row g-4">

            <div class="col-md-6">
                <img src="{{ asset('storage/'.$oeuvre->image) }}"
                     class="img-fluid rounded">
            </div>

            <div class="col-md-6">

                <div class="card p-4">

                    <p><strong>Catégorie :</strong> {{ $oeuvre->categorie }}</p>

                    <p><strong>Dimensions :</strong>
                        {{ $oeuvre->largeur }} x {{ $oeuvre->hauteur }} cm
                    </p>

                    <p><strong>Prix :</strong> {{ $oeuvre->prix }} €</p>

                    <hr>

                    <p>{{ $oeuvre->description }}</p>

                </div>

            </div>

        </div>

    </div>

@endsection

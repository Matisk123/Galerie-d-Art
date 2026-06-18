@extends('layouts.client')

@section('content')

    <div class="container py-4">

        <h2 class="mb-4">Modifier l'œuvre</h2>

        <form method="POST"
              action="{{ route('admin.oeuvres.update', $oeuvre) }}">

            @csrf
            @method('PUT')

            <input class="form-control mb-2" name="titre" value="{{ $oeuvre->titre }}">

            <input class="form-control mb-2" name="artist_name" value="{{ $oeuvre->artist_name }}">

            <input class="form-control mb-2" name="categorie" value="{{ $oeuvre->categorie }}">

            <input class="form-control mb-2" name="prix" value="{{ $oeuvre->prix }}">

            <input class="form-control mb-2" name="largeur" value="{{ $oeuvre->largeur }}">

            <input class="form-control mb-2" name="hauteur" value="{{ $oeuvre->hauteur }}">

            <textarea class="form-control mb-3" name="description">
            {{ $oeuvre->description }}
        </textarea>

            <button class="btn btn-success w-100">
                Sauvegarder
            </button>

        </form>

    </div>

@endsection

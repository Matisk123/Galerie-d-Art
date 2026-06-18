@extends('layouts.client')

@section('content')

    <div class="users-content">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2>Ajouter une œuvre</h2>
                <p class="text-muted mb-0">Créez une nouvelle œuvre dans votre galerie.</p>
            </div>

            <a href="{{ route('admin.oeuvres') }}" class="btn btn-outline-primary">
                Retour
            </a>

        </div>

        <div class="profile-card p-4">

            <form method="POST" action="{{ route('admin.oeuvres.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="text" name="titre" class="form-control mb-2" placeholder="Titre" required>

                <input type="text" name="artist_name" class="form-control mb-2" placeholder="Artiste" required>

                <select name="categorie" id="categorie" class="form-control mb-2" required>
                    <option value="peinture">Peinture</option>
                    <option value="sculpture">Sculpture</option>
                    <option value="ceramique">Céramique</option>
                    <option value="photographie">Photographie</option>
                </select>

                <div id="style-box" class="mb-2">
                    <select name="style" class="form-control">
                        <option value="">-- Choisir un style --</option>
                        <option value="abstrait">Abstrait</option>
                        <option value="figuratif">Figuratif</option>
                        <option value="street_art">Street Art</option>
                        <option value="expressionnisme">Expressionnisme</option>
                        <option value="minimalisme">Minimalisme</option>
                        <option value="surrealiste">Surréalisme</option>
                        <option value="pop_art">Pop Art</option>
                        <option value="realiste">Réaliste</option>
                    </select>
                </div>

                <input type="number" name="prix" class="form-control mb-2" placeholder="Prix">

                <input type="number" name="largeur" class="form-control mb-2" placeholder="Largeur">

                <input type="number" name="hauteur" class="form-control mb-2" placeholder="Hauteur">

                <input type="file" name="image" class="form-control mb-2">

                <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

                <button class="btn btn-primary w-100">Ajouter</button>

            </form>

        </div>

    </div>

@endsection

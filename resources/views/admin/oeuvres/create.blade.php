@extends('layouts.client')

@section('content')

    <div class="users-content">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2>Ajouter une œuvre</h2>
                <p class="text-muted mb-0">
                    Créez une nouvelle œuvre dans votre galerie.
                </p>
            </div>

            <a href="{{ route('admin.oeuvres') }}" class="btn btn-outline-primary">
                Retour
            </a>

        </div>

        <div class="profile-card p-4">

            <form method="POST"
                  action="{{ route('admin.oeuvres.store') }}"
                  enctype="multipart/form-data">

                @csrf

                {{-- TITRE --}}
                <div class="mb-3">
                    <label class="form-label">Titre de l'œuvre</label>
                    <input type="text" name="titre" class="form-control" required>
                </div>

                {{-- ARTISTE --}}
                <div class="mb-3">
                    <label class="form-label">Nom de l'artiste</label>
                    <input type="text" name="artist_name" class="form-control" required>
                </div>

                {{-- CATEGORIE --}}
                <div class="mb-3">
                    <label class="form-label">Catégorie</label>

                    <select name="categorie" class="form-control" required>
                        <option>Peinture</option>
                        <option>Sculpture</option>
                        <option>Céramique</option>
                        <option>Bouteille décorative</option>
                        <option>Assiette décorative</option>
                        <option>Photographie</option>
                    </select>
                </div>

                {{-- DIMENSIONS --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Largeur (cm)</label>
                        <input type="number" name="largeur" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hauteur (cm)</label>
                        <input type="number" name="hauteur" class="form-control">
                    </div>

                </div>

                {{-- PRIX --}}
                <div class="mb-3">
                    <label class="form-label">Prix (€)</label>
                    <input type="number" name="prix" class="form-control" required>
                </div>

                {{-- IMAGE --}}
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                {{-- SUBMIT --}}
                <button class="btn btn-primary w-100">
                    Ajouter l'œuvre
                </button>

            </form>

        </div>

    </div>

@endsection

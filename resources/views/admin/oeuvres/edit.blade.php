@extends('layouts.client')

@section('content')

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="mb-4 text-center">
        <span class="badge bg-dark px-3 py-2 mb-3">
            Administration
        </span>

            <h1 class="fw-bold">Modifier l’œuvre</h1>

            <p class="text-muted">
                Modifiez les informations de votre œuvre.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5">

                        <form method="POST" action="{{ route('admin.oeuvres.update', $oeuvre) }}">
                            @csrf
                            @method('PUT')

                            {{-- TITRE --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Titre</label>
                                <input class="form-control form-control-lg"
                                       name="titre"
                                       value="{{ old('titre', $oeuvre->titre) }}">
                            </div>

                            {{-- ARTISTE --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Nom de l'artiste</label>
                                <input class="form-control form-control-lg"
                                       name="artist_name"
                                       value="{{ old('artist_name', $oeuvre->artist_name) }}">
                            </div>

                            {{-- CATEGORIE --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Catégorie</label>

                                <select name="categorie" id="categorie" class="form-control form-control-lg">
                                    <option value="peinture"
                                        @selected(strtolower(old('categorie', $oeuvre->categorie)) == 'peinture')>
                                        Peinture
                                    </option>

                                    <option value="sculpture"
                                        @selected(strtolower(old('categorie', $oeuvre->categorie)) == 'sculpture')>
                                        Sculpture
                                    </option>

                                    <option value="ceramique"
                                        @selected(strtolower(old('categorie', $oeuvre->categorie)) == 'ceramique')>
                                        Céramique
                                    </option>

                                    <option value="photographie"
                                        @selected(strtolower(old('categorie', $oeuvre->categorie)) == 'photographie')>
                                        Photographie
                                    </option>
                                </select>
                            </div>

                            {{-- STYLE --}}
                            <div id="style-box" class="mb-4">
                                <label class="form-label fw-semibold">Style</label>

                                <select name="style" class="form-control form-control-lg">
                                    <option value="">-- Style peinture --</option>

                                    <option value="abstrait" @selected(old('style', $oeuvre->style) == 'abstrait')>Abstrait</option>
                                    <option value="figuratif" @selected(old('style', $oeuvre->style) == 'figuratif')>Figuratif</option>
                                    <option value="street_art" @selected(old('style', $oeuvre->style) == 'street_art')>Street Art</option>
                                    <option value="expressionnisme" @selected(old('style', $oeuvre->style) == 'expressionnisme')>Expressionnisme</option>
                                    <option value="minimalisme" @selected(old('style', $oeuvre->style) == 'minimalisme')>Minimalisme</option>
                                    <option value="surrealiste" @selected(old('style', $oeuvre->style) == 'surrealiste')>Surréalisme</option>
                                    <option value="pop_art" @selected(old('style', $oeuvre->style) == 'pop_art')>Pop Art</option>
                                    <option value="realiste" @selected(old('style', $oeuvre->style) == 'realiste')>Réaliste</option>
                                </select>
                            </div>

                            {{-- PRIX --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Prix (€)</label>
                                <input class="form-control form-control-lg"
                                       name="prix"
                                       value="{{ old('prix', $oeuvre->prix) }}">
                            </div>

                            {{-- DIMENSIONS --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Largeur (cm)</label>
                                    <input class="form-control form-control-lg"
                                           name="largeur"
                                           value="{{ old('largeur', $oeuvre->largeur) }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Hauteur (cm)</label>
                                    <input class="form-control form-control-lg"
                                           name="hauteur"
                                           value="{{ old('hauteur', $oeuvre->hauteur) }}">
                                </div>
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea class="form-control"
                                          rows="5"
                                          name="description">{{ old('description', $oeuvre->description) }}</textarea>
                            </div>

                            {{-- BOUTONS --}}
                            <div class="d-grid">
                                <button class="btn btn-dark btn-lg rounded-3">
                                    Sauvegarder les modifications
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

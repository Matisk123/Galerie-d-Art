@extends('layouts.client')

@section('content')

    <div class="container py-4">

        <h2 class="mb-4">Modifier l'œuvre</h2>

        <form method="POST" action="{{ route('admin.oeuvres.update', $oeuvre) }}">
            @csrf
            @method('PUT')

            {{-- TITRE --}}
            <input class="form-control mb-2"
                   name="titre"
                   value="{{ old('titre', $oeuvre->titre) }}">

            {{-- ARTISTE --}}
            <input class="form-control mb-2"
                   name="artist_name"
                   value="{{ old('artist_name', $oeuvre->artist_name) }}">

            {{-- CATEGORIE --}}
            <select name="categorie" id="categorie" class="form-control mb-2">

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

            {{-- STYLE PEINTURE --}}
            <div id="style-box" class="mb-2">

                <select name="style" class="form-control">

                    <option value="">-- Style peinture --</option>

                    <option value="abstrait"
                        @selected(old('style', $oeuvre->style) == 'abstrait')>
                        Abstrait
                    </option>

                    <option value="figuratif"
                        @selected(old('style', $oeuvre->style) == 'figuratif')>
                        Figuratif
                    </option>

                    <option value="street_art"
                        @selected(old('style', $oeuvre->style) == 'street_art')>
                        Street Art
                    </option>

                    <option value="expressionnisme"
                        @selected(old('style', $oeuvre->style) == 'expressionnisme')>
                        Expressionnisme
                    </option>

                    <option value="minimalisme"
                        @selected(old('style', $oeuvre->style) == 'minimalisme')>
                        Minimalisme
                    </option>

                    <option value="surrealiste"
                        @selected(old('style', $oeuvre->style) == 'surrealiste')>
                        Surréalisme
                    </option>

                    <option value="pop_art"
                        @selected(old('style', $oeuvre->style) == 'pop_art')>
                        Pop Art
                    </option>

                    <option value="realiste"
                        @selected(old('style', $oeuvre->style) == 'realiste')>
                        Réaliste
                    </option>

                </select>

            </div>

            {{-- PRIX --}}
            <input class="form-control mb-2"
                   name="prix"
                   value="{{ old('prix', $oeuvre->prix) }}">

            {{-- DIMENSIONS --}}
            <input class="form-control mb-2"
                   name="largeur"
                   value="{{ old('largeur', $oeuvre->largeur) }}">

            <input class="form-control mb-2"
                   name="hauteur"
                   value="{{ old('hauteur', $oeuvre->hauteur) }}">

            {{-- DESCRIPTION --}}
            <textarea class="form-control mb-3"
                      name="description">{{ old('description', $oeuvre->description) }}</textarea>

            <button class="btn btn-success w-100">
                Sauvegarder
            </button>

        </form>

    </div>

@endsection

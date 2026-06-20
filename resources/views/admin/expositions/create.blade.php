@extends('layouts.client')

@section('content')

    <div class="container py-4">

        <div class="mb-4">
            <h2 class="mb-1">Créer une exposition</h2>
            <p class="text-muted">Ajoute une nouvelle exposition à la galerie</p>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form method="POST"
                      action="{{ route('admin.expositions.store') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Titre</label>
                            <input type="text"
                                   name="titre"
                                   class="form-control"
                                   placeholder="Titre de l'exposition">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lieu</label>
                            <input type="text"
                                   name="lieu"
                                   class="form-control"
                                   placeholder="Ex: Paris, Galerie X">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Description de l'exposition"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date début</label>
                            <input type="date" name="date_debut" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date fin</label>
                            <input type="date" name="date_fin" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Image</label>
                            <input type="file"
                                   name="image"
                                   class="form-control"
                                   id="imageInput">

                            <div class="mt-3">
                                <img id="preview"
                                     style="max-height:250px; width:auto; display:none; border-radius:10px;">
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-success w-100 mt-4">
                        Créer l'exposition
                    </button>

                </form>

            </div>
        </div>

    </div>

    {{-- preview image --}}
    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    </script>

@endsection

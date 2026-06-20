@extends('layouts.client')

@section('content')

    <div class="container py-4">

        <h2 class="mb-4">Modifier l'exposition</h2>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form method="POST"
                      action="{{ route('admin.expositions.update', $exposition) }}"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Titre</label>
                            <input type="text"
                                   name="titre"
                                   class="form-control"
                                   value="{{ old('titre', $exposition->titre) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lieu</label>
                            <input type="text"
                                   name="lieu"
                                   class="form-control"
                                   value="{{ old('lieu', $exposition->lieu) }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="4">{{ old('description', $exposition->description) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date début</label>
                            <input type="date"
                                   name="date_debut"
                                   class="form-control"
                                   value="{{ old('date_debut', $exposition->date_debut) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date fin</label>
                            <input type="date"
                                   name="date_fin"
                                   class="form-control"
                                   value="{{ old('date_fin', $exposition->date_fin) }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Image</label>
                            <input type="file"
                                   name="image"
                                   class="form-control"
                                   id="imageInput">

                            {{-- IMAGE ACTUELLE --}}
                            @if($exposition->image)
                                <div class="mt-3">
                                    <p class="text-muted mb-1">Image actuelle :</p>
                                    <img src="{{ asset('storage/'.$exposition->image) }}"
                                         style="max-height:250px; width:auto; border-radius:10px;">
                                </div>
                            @endif

                            {{-- NOUVELLE PREVIEW --}}
                            <img id="preview"
                                 style="max-height:250px; width:auto; display:none; margin-top:10px; border-radius:10px;">
                        </div>

                    </div>

                    <button class="btn btn-primary w-100 mt-4">
                        Sauvegarder
                    </button>

                </form>

            </div>
        </div>

    </div>

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

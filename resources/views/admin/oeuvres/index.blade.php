@extends('layouts.client')

@section('content')

    <div class="users-content">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="mb-1">Gestion des œuvres</h2>
                <p class="text-muted mb-0">
                    Retrouvez toutes les œuvres que vous avez publiées.
                </p>
            </div>

            <a href="{{ route('admin.oeuvres.create') }}" class="btn btn-primary">
                Ajouter une œuvre
            </a>

        </div>

        <div class="row g-4">

            @forelse($oeuvres as $oeuvre)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="art-item">

                        @if($oeuvre->image)
                            <img src="{{ asset('storage/'.$oeuvre->image) }}"
                                 class="art-item-image">
                        @endif

                        <div class="art-item-info">

                            <div class="art-title">
                                {{ $oeuvre->titre }}
                            </div>

                            <div class="art-artist">
                                {{ $oeuvre->artist_name }}
                            </div>

                            <div class="art-details">
                                {{ $oeuvre->categorie }}
                            </div>

                            <div class="artist-work-footer">

                                <div class="art-price">
                                    {{ number_format($oeuvre->prix,0,',',' ') }} €
                                </div>

                            </div>

                            <div class="mt-3 d-flex gap-2">

                                {{-- Voir --}}
                                <a href="{{ route('admin.oeuvres.show', $oeuvre) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Voir
                                </a>

                                {{-- Modifier --}}
                                <a href="{{ route('admin.oeuvres.edit', $oeuvre) }}"
                                   class="btn btn-sm btn-primary">
                                    Modifier
                                </a>

                                {{-- Supprimer --}}
                                <form action="{{ route('admin.oeuvres.destroy', $oeuvre) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer cette œuvre ?');">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        Supprimer
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">
                    <h5>Aucune œuvre</h5>
                    <p class="text-muted">Vous n'avez encore publié aucune œuvre.</p>
                </div>

            @endforelse

        </div>

    </div>

@endsection

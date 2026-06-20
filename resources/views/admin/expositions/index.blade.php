@extends('layouts.client')

@section('content')

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Gestion des expositions</h2>
                <p class="text-muted mb-0">Créer, modifier et gérer vos expositions</p>
            </div>

            <a href="{{ route('admin.expositions.create') }}" class="btn btn-primary">
                + Ajouter une exposition
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">

            @forelse($expositions as $expo)

                <div class="col-md-4">

                    <div class="card shadow-sm border-0 h-100">

                        {{-- IMAGE --}}
                        <div style="height:220px; overflow:hidden; background:#f5f5f5;">
                            @if($expo->image)
                                <img src="{{ asset('storage/'.$expo->image) }}"
                                     style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                    Aucune image
                                </div>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column">

                            <h5 class="mb-1">{{ $expo->titre }}</h5>

                            <p class="text-muted mb-2">
                                📍 {{ $expo->lieu }}
                            </p>

                            <p class="small text-muted mb-3">
                                📅 {{ \Carbon\Carbon::parse($expo->date_debut)->format('d/m/Y') }}
                                →
                                {{ \Carbon\Carbon::parse($expo->date_fin)->format('d/m/Y') }}
                            </p>

                            <div class="mt-auto d-flex gap-2">

                                <a href="{{ route('admin.expositions.edit', $expo) }}"
                                   class="btn btn-sm btn-outline-warning flex-fill">
                                    Modifier
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.expositions.destroy', $expo) }}"
                                      class="flex-fill">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger w-100"
                                            onclick="return confirm('Supprimer cette exposition ?')">
                                        Supprimer
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="text-center py-5 text-muted">
                        Aucune exposition pour le moment
                    </div>
                </div>

            @endforelse

        </div>

    </div>

@endsection

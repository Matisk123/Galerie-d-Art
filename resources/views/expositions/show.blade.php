@extends('layouts.client')

@section('content')

    <div class="exhibitions-page py-5">

        <div class="container">

            <a href="{{ route('expositions') }}"
               class="btn btn-outline-secondary mb-4">
                ← Retour
            </a>

            <div class="card shadow-lg border-0 exhibition-detail-card">

                @if($exposition->image)
                    <div class="exhibition-cover">
                        <img src="{{ asset('storage/'.$exposition->image) }}"
                             class="img-fluid w-100">
                    </div>
                @endif

                <div class="card-body p-4">

                    <h1 class="mb-2">{{ $exposition->titre }}</h1>

                    <p class="text-muted mb-3">
                        📍 {{ $exposition->lieu }}
                    </p>

                    <p class="lead">
                        {{ $exposition->description }}
                    </p>

                    <hr>

                    <div class="exhibition-dates">
                        <p class="mb-1">
                            <strong>Début :</strong>
                            {{ \Carbon\Carbon::parse($exposition->date_debut)->format('d/m/Y') }}
                        </p>

                        <p class="mb-0">
                            <strong>Fin :</strong>
                            {{ \Carbon\Carbon::parse($exposition->date_fin)->format('d/m/Y') }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

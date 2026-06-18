@extends('layouts.client')

@section('content')

    <div class="container py-4">
        <h2>Mes favoris</h2>

        <div class="row g-4 mt-3">
            @forelse($favorites as $oeuvre)
                <div class="col-md-4">

                    <div class="art-item">

                        <a href="{{ route('oeuvres.show', $oeuvre) }}">
                            <img src="{{ asset('storage/'.$oeuvre->image) }}"
                                 class="art-item-image">
                        </a>

                        <div class="art-item-info">
                            <div class="art-title">{{ $oeuvre->titre }}</div>
                            <div class="art-artist">{{ $oeuvre->artist_name }}</div>
                        </div>

                    </div>

                </div>
            @empty
                <p>Aucun favori.</p>
            @endforelse
        </div>
    </div>

@endsection

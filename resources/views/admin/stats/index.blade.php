@extends('layouts.client')

@section('content')

    <div class="container py-4">
        <h2>Statistiques des œuvres</h2>

        <table class="table mt-4">
            <thead>
            <tr>
                <th>Œuvre</th>
                <th>Favoris</th>
                <th>Vues uniques</th>
                <th>Vues totales</th>
            </tr>
            </thead>
            <tbody>
            @foreach($oeuvres as $oeuvre)
                <tr>
                    <td>{{ $oeuvre->titre }}</td>
                    <td>{{ $oeuvre->favorites_count }}</td>
                    <td>{{ $oeuvre->unique_views }}</td>
                    <td>{{ $oeuvre->total_views }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@extends('layouts.admin')

@section('content')

    @include('menus.client')

    <div class="admin-panel-home mt-5">

        <div class="section-header">
            <h2>Administration</h2>
        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="home-card admin-card">

                    <h5>Gestion des œuvres</h5>

                    <p>
                        Ajouter, modifier ou supprimer les œuvres.
                    </p>

                    <a href="/admin/oeuvres" class="btn btn-primary">
                        Ouvrir
                    </a>

                </div>

            </div>

            <div class="col-md-4">

                <div class="home-card admin-card">

                    <h5>Expositions</h5>

                    <p>
                        Gérez les événements et expositions.
                    </p>

                    <a href="/admin/expositions" class="btn btn-primary">
                        Ouvrir
                    </a>

                </div>

            </div>

            <div class="col-md-4">

                <div class="home-card admin-card">

                    <h5>Statistiques</h5>

                    <p>
                        Consultez les performances de la galerie.
                    </p>

                    <a href="/admin/statistiques" class="btn btn-primary">
                        Voir
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection

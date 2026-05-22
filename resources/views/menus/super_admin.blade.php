@extends('layouts.super_admin')

@section('content')

    @include('menus.client')

    <div class="admin-panel-home mt-5">

        <div class="section-header">
            <h2>Super Administration</h2>
        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="home-card admin-card">

                    <h5>Gestion utilisateurs</h5>

                    <p>
                        Modifier les rôles et gérer les comptes.
                    </p>

                    <a href="{{ route('admin.users') }}"
                       class="btn btn-danger">

                        Ouvrir

                    </a>

                </div>

            </div>

            <div class="col-md-4">

                <div class="home-card admin-card">

                    <h5>Demandes Admin</h5>

                    <p>
                        Valider ou refuser les demandes d'administration.
                    </p>

                    <a href="/super-admin/admin-requests"
                       class="btn btn-danger">

                        Voir

                    </a>

                </div>

            </div>

            <div class="col-md-4">

                <div class="home-card admin-card">

                    <h5>Statistiques plateforme</h5>

                    <p>
                        Vue globale des utilisateurs et contenus.
                    </p>

                    <a href="/super-admin/statistiques"
                       class="btn btn-danger">

                        Ouvrir

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection

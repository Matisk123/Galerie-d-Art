@extends('layouts.client')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- MENU PROFILE --}}
            <div class="col-md-3 mb-4">
                <div class="card profile-card p-3">
                    <h5 class="section-title mb-3">Mon compte</h5>
                    <ul class="profile-menu list-unstyled">
                        <li><a href="/profile">Informations</a></li>
                        <li><a href="/profile/security">Sécurité</a></li>
                        <li><a href="/profile/favorites">Favoris</a></li>

                        {{-- Client — Demande admin --}}
                        @if(Auth::user()->hasRole('client'))
                            <li class="mt-2">
                                @if($canRequestAdmin)
                                    <a href="{{ route('admin-request.create') }}" class="profile-menu-link w-100 text-start p-2">
                                        Faire une demande Admin
                                    </a>
                                @else
                                    @if($lastAdminRequest->status == 'pending')
                                        <span class="badge bg-warning w-100 d-block text-center">Demande en attente</span>
                                    @elseif($lastAdminRequest->status == 'refused')
                                        <span class="badge bg-danger w-100 d-block text-center mb-2">Demande refusée — Vous pouvez refaire une demande</span>
                                        <form action="{{ route('admin-request.store') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="profile-menu-link w-100 text-start p-2 border-0 bg-transparent">
                                                Refaire une demande
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </li>
                        @endif

                        {{-- Admin & Super Admin menus --}}
                        @if(Auth::user()->hasRole('admin'))
                            <li><a href="/admin/oeuvres">Gestion des œuvres</a></li>
                            <li><a href="/admin/statistiques">Statistiques des œuvres</a></li>
                            <li><a href="/admin/expositions">Gestion des expositions</a></li>
                        @endif

                        @if(Auth::user()->hasRole('super_admin'))
                            <li><a href="/super-admin/users">Gestion utilisateurs</a></li>
                            <li><a href="/super-admin/admin-requests">Demandes Admin</a></li>
                            <li><a href="/super-admin/statistiques">Statistiques plateforme</a></li>
                            <hr>
                            <li><a href="/admin/oeuvres">Gestion des œuvres</a></li>
                            <li><a href="/admin/statistiques">Statistiques des œuvres</a></li>
                            <li><a href="/admin/expositions">Gestion des expositions</a></li>
                        @endif

                    </ul>
                </div>
            </div>

            {{-- CONTENU PROFILE --}}
            <div class="col-md-9">

                <div class="profile-header card mb-4 p-4">
                    <div class="profile-cover mb-3"></div>
                    <div class="d-flex align-items-center gap-3">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}" class="profile-avatar-large rounded-circle">
                        @else
                            <img src="https://via.placeholder.com/150" class="profile-avatar-large rounded-circle">
                        @endif

                        <div class="profile-main-info text-truncate">
                            <h2 class="mb-1 text-truncate">{{ Auth::user()->name }}</h2>
                            <p class="text-muted mb-0 text-truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif

                {{-- FORMULAIRE MODIFICATION PROFIL --}}
                <div class="card profile-card p-4 mb-4">
                    <h5 class="section-title mb-3">Modifier mes informations</h5>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="password" class="form-control" placeholder="Laisser vide pour ne pas changer">
                        </div>
                        <button class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>

                {{-- STATUT DEMANDE ADMIN --}}
                @if($lastAdminRequest)
                    <div class="mb-3">
                        @if($lastAdminRequest->status == 'pending')
                            <div class="alert alert-warning">Votre demande est en attente de validation</div>
                        @elseif($lastAdminRequest->status == 'accepted')
                            <div class="alert alert-success">Votre demande pour devenir admin a été acceptée</div>
                        @elseif($lastAdminRequest->status == 'refused')
                            <div class="alert alert-danger">Votre demande pour devenir admin a été refusée</div>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

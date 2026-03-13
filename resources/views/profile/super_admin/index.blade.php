@extends('layouts.super_admin')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- MENU SUPER ADMIN --}}
            <div class="col-md-3">
                <div class="card p-3">

                    <h5>Mon compte</h5>

                    <ul class="list-unstyled">

                        <li>
                            <a href="/profile">Informations</a>
                        </li>

                        <li>
                            <a href="/profile/security">Sécurité</a>
                        </li>

                        <li>
                            <a href="/profile/favorites">Favoris</a>
                        </li>

                        <hr>

                        <li>
                            <a href="/super-admin/users">
                                Gestion utilisateurs
                            </a>
                        </li>

                        <li>
                            <a href="/super-admin/admin-requests">
                                Demandes Admin

                                @if($pendingRequests > 0)
                                    <span class="badge bg-danger ms-2">
                                        {{ $pendingRequests }}
                                    </span>
                                @endif

                            </a>
                        </li>

                        <li>
                            <a href="/super-admin/statistiques">
                                Statistiques plateforme
                            </a>
                        </li>

                        <hr>

                        <li>
                            <a href="/admin/oeuvres">
                                Gestion des œuvres
                            </a>
                        </li>

                        <li>
                            <a href="/admin/statistiques">
                                Statistiques des œuvres
                            </a>
                        </li>

                        <li>
                            <a href="/admin/expositions">
                                Gestion des expositions
                            </a>
                        </li>

                    </ul>

                </div>
            </div>


            {{-- CONTENU SUPER ADMIN --}}
            <div class="col-md-9">

                <div class="profile-header mb-3">

                    <h2>{{ Auth::user()->name }}</h2>

                    <p>{{ Auth::user()->email }}</p>

                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}" width="120">
                    @else
                        <img src="https://via.placeholder.com/120">
                    @endif

                </div>


                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <div class="card p-3">

                    <h5>Modifier mes informations</h5>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Nom</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
                        </div>

                        <button class="btn btn-primary">
                            Mettre à jour
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection

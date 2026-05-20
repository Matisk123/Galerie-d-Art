@extends('layouts.admin')

@section('content')

    <div class="users-content">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        {{-- CARD TABLE --}}
        <div class="card profile-card p-4">

            <h4 class="section-title mb-4">
                Liste des utilisateurs
            </h4>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                    <tr>

                        <th>ID</th>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($users as $user)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $user->id }}
                            </td>


                            {{-- PHOTO --}}
                            <td>

                                @if($user->profile_photo)

                                    <img src="{{ asset('storage/'.$user->profile_photo) }}"
                                         class="user-photo">

                                @else

                                    <img src="https://via.placeholder.com/50"
                                         class="user-photo">

                                @endif

                            </td>


                            {{-- NOM --}}
                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>


                            {{-- EMAIL --}}
                            <td>
                                {{ $user->email }}
                            </td>


                            {{-- ROLE --}}
                            <td>

                                @php
                                    $role = $user->roles()->first()->name ?? 'client';
                                @endphp

                                @if($role == 'super_admin')

                                    <span class="badge bg-danger">
                                    Super Admin
                                </span>

                                @elseif($role == 'admin')

                                    <span class="badge bg-warning text-dark">
                                    Admin
                                </span>

                                @else

                                    <span class="badge bg-primary">
                                    Client
                                </span>

                                @endif

                            </td>


                            {{-- MODIFIER ROLE --}}
                            <td>

                                @if($role != 'super_admin')

                                    <form method="POST"
                                          action="{{ route('admin.users.role',$user->id) }}">

                                        @csrf

                                        <select name="role"
                                                class="form-control mb-2">

                                            <option value="client"
                                                {{ $role == 'client' ? 'selected' : '' }}>
                                                Client
                                            </option>

                                            <option value="admin"
                                                {{ $role == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>

                                        </select>

                                        <button class="btn btn-primary btn-sm w-100">

                                            Modifier

                                        </button>

                                    </form>

                                @else

                                    <span class="text-muted">
                                    Protégé
                                </span>

                                @endif

                            </td>


                            {{-- SUPPRIMER --}}
                            <td>

                                @if($role != 'super_admin')

                                    <form method="POST"
                                          action="{{ route('admin.users.delete',$user->id) }}">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm w-100">

                                            Supprimer

                                        </button>

                                    </form>

                                @else

                                    <span class="text-muted">
                                    Impossible
                                </span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection

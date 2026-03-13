@extends('layouts.super_admin')

@section('content')

    <div class="container-fluid">

        <h2 class="mb-4">Demandes pour devenir Admin</h2>

        @if($requests->isEmpty())

            <div class="alert alert-info">
                Aucune demande en attente pour le moment.
            </div>

        @else

            <div class="row">

                @foreach($requests as $request)

                    <div class="col-md-6 mb-4">

                        <div class="card shadow-sm h-100">

                            <div class="card-body">

                                <div class="d-flex align-items-center mb-3">

                                    @if($request->user->profile_photo)
                                        <img
                                            src="{{ asset('storage/'.$request->user->profile_photo) }}"
                                            class="rounded-circle me-3"
                                            width="50"
                                            height="50"
                                        >
                                    @else
                                        <img
                                            src="https://via.placeholder.com/50"
                                            class="rounded-circle me-3"
                                        >
                                    @endif

                                    <div>
                                        <h5 class="mb-0">{{ $request->user->name }}</h5>
                                        <small class="mb-0">{{ $request->user->email }}</small>
                                    </div>

                                </div>

                                <p class="mb-2">
                                    <strong>Message :</strong>
                                </p>

                                <div class="admin-message-box mb-3">
                                    {{ $request->reason }}
                                </div>

                                <p class="mb-3">

                                    <strong>Statut :</strong>

                                    @if($request->status == 'pending')
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    @elseif($request->status == 'accepted')
                                        <span class="badge bg-success">Acceptée</span>
                                    @elseif($request->status == 'refused')
                                        <span class="badge bg-danger">Refusée</span>
                                    @endif

                                </p>

                                @if($request->status == 'pending')

                                    <div class="d-flex gap-2">

                                        <form action="/super-admin/admin-requests/{{ $request->id }}/accept" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                Accepter
                                            </button>
                                        </form>

                                        <form action="/super-admin/admin-requests/{{ $request->id }}/refuse" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                Refuser
                                            </button>
                                        </form>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>



                @endforeach

            </div>

        @endif
        <a href="{{ route('super-admin.admin-requests.archive') }}" class="btn btn-secondary archive-button">
            Voir les archives
        </a>
    </div>
@endsection

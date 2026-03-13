@extends('layouts.super_admin')

@section('content')
    <div class="container">
        <h2>Archives des demandes Admin</h2>

        <a href="{{ url('/super-admin/admin-requests') }}" class="btn btn-secondary mb-3">
            ← Retour aux demandes en attente
        </a>

        @forelse($requests as $request)
            <div class="card mb-3 p-3 admin-message-box">
                <h5>{{ $request->user->name }}</h5>
                <p class="mb-0">{{ $request->user->email }}</p>
                <p></p>
                <p>{{ $request->user->name }} a fait une demande pour devenir admin</p>
                <p><strong>Message :</strong> {{ $request->reason }}</p>
                <p>
                    Statut :
                    @if($request->status == 'accepted')
                        <span class="badge bg-success">{{ ucfirst($request->status) }}</span>
                    @else
                        <span class="badge bg-danger">{{ ucfirst($request->status) }}</span>
                    @endif
                </p>
                <p>Mis à jour le : {{ $request->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        @empty
            <div class="alert alert-info">Aucune demande archivée pour le moment.</div>
        @endforelse
    </div>
@endsection

@extends('layouts.client')

@section('content')

    <div class="container">
        <div class="card p-4">
            <h4>Demande pour devenir Admin</h4>

            <form method="POST" action="{{ route('admin-request.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Pourquoi souhaitez-vous devenir admin ?</label>

                    <textarea
                        name="reason"
                        class="form-control"
                        rows="5"
                        required
                        minlength="10"
                    ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Envoyer la demande
                </button>

            </form>
        </div>
    </div>

@endsection

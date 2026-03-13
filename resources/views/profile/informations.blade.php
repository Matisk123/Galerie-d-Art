@extends('layouts.client')

@section('content')

    <div class="container">

        <h2 class="mb-4">Informations personnelles</h2>

        {{-- message succès --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- message erreur --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.info.save') }}">

            @csrf

            {{-- date de naissance --}}
            <div class="mb-3">
                <label class="form-label">Date de naissance</label>

                <input
                    type="date"
                    name="birth_date"
                    class="form-control"
                    value="{{ $info->birth_date ?? '' }}"
                >
            </div>


            {{-- téléphone --}}
            <div class="mb-3">
                <label class="form-label">Téléphone</label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ $info->phone ?? '' }}"
                >
            </div>


            {{-- pays --}}
            <div class="mb-3">
                <label class="form-label">Pays</label>

                <input
                    type="text"
                    name="country"
                    class="form-control"
                    value="{{ $info->country ?? '' }}"
                >
            </div>


            {{-- langue --}}
            <div class="mb-3">
                <label class="form-label">Langue</label>

                <select name="language" class="form-control">

                    <option value="fr"
                        {{ isset($info) && $info->language == 'fr' ? 'selected' : '' }}>
                        Français
                    </option>

                    <option value="en"
                        {{ isset($info) && $info->language == 'en' ? 'selected' : '' }}>
                        Anglais
                    </option>

                </select>
            </div>


            {{-- devise --}}
            <div class="mb-3">
                <label class="form-label">Devise</label>

                <select name="currency" class="form-control">

                    <option value="EUR"
                        {{ isset($info) && $info->currency == 'EUR' ? 'selected' : '' }}>
                        Euro (€)
                    </option>

                    <option value="USD"
                        {{ isset($info) && $info->currency == 'USD' ? 'selected' : '' }}>
                        Dollar ($)
                    </option>

                    <option value="GBP"
                        {{ isset($info) && $info->currency == 'GBP' ? 'selected' : '' }}>
                        Livre (£)
                    </option>

                </select>
            </div>


            <hr>


            <h4>Adresse</h4>

            {{-- adresse --}}
            <div class="mb-3">
                <label class="form-label">Adresse</label>

                <input
                    type="text"
                    name="address"
                    class="form-control"
                    value="{{ $info->address ?? '' }}"
                >
            </div>


            {{-- ville --}}
            <div class="mb-3">
                <label class="form-label">Ville</label>

                <input
                    type="text"
                    name="city"
                    class="form-control"
                    value="{{ $info->city ?? '' }}"
                >
            </div>


            {{-- code postal --}}
            <div class="mb-3">
                <label class="form-label">Code postal</label>

                <input
                    type="text"
                    name="postal_code"
                    class="form-control"
                    value="{{ $info->postal_code ?? '' }}"
                >
            </div>


            {{-- infos vendeur --}}
            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('super_admin'))

                <hr>

                <h4>Informations vendeur</h4>

                {{-- IBAN --}}
                <div class="mb-3">
                    <label class="form-label">IBAN</label>

                    <input
                        type="text"
                        name="iban"
                        class="form-control"
                        value="{{ $info->iban ?? '' }}"
                    >
                </div>


                {{-- BIC --}}
                <div class="mb-3">
                    <label class="form-label">BIC</label>

                    <input
                        type="text"
                        name="bic"
                        class="form-control"
                        value="{{ $info->bic ?? '' }}"
                    >
                </div>

            @endif


            <button class="btn btn-primary mt-3">
                Enregistrer les informations
            </button>


        </form>

    </div>

@endsection

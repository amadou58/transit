@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Modifier le Transport</h2>

        @if (session()->has('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                <h3>{{ session()->get('success') }}</h3>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transports.update', $transport->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-5 gap-6 mt-4 sm:grid-cols-5">

                <!-- Date -->
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Date<span class="text-red-500">*</span></label>
                    <input type="date" name="date" id="date" class="w-full px-4 py-2 bg-gray-200 rounded"
                        value="{{ old('date', $transport->date) }}" required>
                </div>

                <!-- Designation -->
                <div class="mb-4">
                    <label for="designation" class="block text-sm font-medium text-gray-700">Désignation<span class="text-red-500">*</span></label>
                    <input type="text" name="designation" id="designation" class="w-full px-4 py-2 bg-gray-200 rounded"
                        value="{{ old('designation', $transport->designation) }}" required>
                </div>

                <!-- Immatriculation -->
                <div class="mb-4">
                    <label for="immatriculation_vehicule" class="block text-sm font-medium text-gray-700">Immatriculation Véhicule<span class="text-red-500">*</span></label>
                    <input type="text" name="immatriculation_vehicule" id="immatriculation_vehicule" class="w-full px-4 py-2 bg-gray-200 rounded"
                        value="{{ old('immatriculation_vehicule', $transport->immatriculation_vehicule) }}" required>
                </div>

                <!-- Destination -->
                <div class="mb-4">
                    <label for="destination_id" class="block text-sm font-medium text-gray-700">Destination<span class="text-red-500">*</span></label>
                    <select name="destination_id" id="destination_id" class="w-full px-4 py-2 bg-gray-200 rounded" required>
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ old('destination_id', $transport->destination_id) == $destination->id ? 'selected' : '' }}>
                                {{ $destination->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Client -->
                <div class="mb-4">
                    <label for="client_id" class="block text-sm font-medium text-gray-700">Client<span class="text-red-500">*</span></label>
                    <select name="client_id" id="client_id" class="w-full px-4 py-2 bg-gray-200 rounded" required>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $transport->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->prenom }} {{ $client->nom }} - {{ $client->adresse }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Numero Declaration -->
                <div class="mb-4">
                    <label for="numero_declaration" class="block text-sm font-medium text-gray-700">Numero Declaration<span class="text-red-500">*</span></label>
                    <input type="text" name="numero_declaration" id="numero_declaration" class="w-full px-4 py-2 bg-gray-200 rounded"
                        value="{{ old('numero_declaration', $transport->numero_declaration) }}" required>
                </div>

                <!-- Les autres champs numériques -->
                @php
                    $champs = [
                        'poids' => 'Poids (kg)',
                        'droit_douane' => 'Droit Douane',
                        'frais_kati' => 'Frais Kati',
                        'frais_frontiere' => 'Frais Frontière',
                        'frais_circuit' => 'Frais Circuit',
                        'frais_rapport' => 'Frais Rapport',
                        'frais_ts' => 'Frais Ts',
                        'prix' => 'Prix',
                        'paiement' => 'Paiement',
                    ];
                @endphp

                @foreach ($champs as $champ => $label)
                    <div class="mb-4">
                        <label for="{{ $champ }}" class="block text-sm font-medium text-gray-700">{{ $label }}<span class="text-red-500">*</span></label>
                        <input type="number" min="0" name="{{ $champ }}" id="{{ $champ }}" class="w-full px-4 py-2 bg-gray-200 rounded"
                            value="{{ old($champ, $transport->$champ) }}" required>
                    </div>
                @endforeach

            </div>

            <button type="submit"
                class="w-full px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                Mettre à jour
            </button>
        </form>
    </div>
</div>
@endsection

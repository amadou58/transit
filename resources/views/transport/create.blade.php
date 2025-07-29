@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Ajouter un Transport</h2>

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

        <form action="{{ route('transports.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-5 gap-6 mt-4 sm:grid-cols-5">
                <!-- Date -->
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Date<span class="text-red-500">*</span></label>
                    <input type="date" name="date" id="date" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('date') }}" required>
                </div>

                <!-- Designation -->
                <div class="mb-4">
                    <label for="designation" class="block text-sm font-medium text-gray-700">Désignation<span class="text-red-500">*</span></label>
                    <input type="text" name="designation" id="designation" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('designation') }}" required>
                </div>

                <!-- Immatriculation -->
                <div class="mb-4">
                    <label for="immatriculation_vehicule" class="block text-sm font-medium text-gray-700">Immatriculation Véhicule<span class="text-red-500">*</span></label>
                    <input type="text" name="immatriculation_vehicule" id="immatriculation_vehicule" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('immatriculation_vehicule') }}" required>
                </div>

                <!-- Destination -->
                <div class="mb-4">
                    <label for="destination_id" class="block text-sm font-medium text-gray-700">Destination<span class="text-red-500">*</span></label>
                    <select name="destination_id" id="destination_id" class="w-full px-4 py-2 bg-gray-200 rounded" required>
                        <option value="" disabled selected>Choisir une destination</option>
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                                {{ $destination->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Client -->
                <div class="mb-4">
                    <label for="client_id" class="block text-sm font-medium text-gray-700">Client<span class="text-red-500">*</span></label>
                    <select name="client_id" id="client_id" class="w-full px-4 py-2 bg-gray-200 rounded" required>
                        <option value="" disabled selected>Choisir un client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->prenom }} {{ $client->nom }} - {{ $client->adresse }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- numero -->
                <div class="mb-4">
                    <label for="numero_declaration" class="block text-sm font-medium text-gray-700">Numero Declaration<span class="text-red-500">*</span></label>
                    <input type="text" name="numero_declaration" id="numero_declaration" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('numero_declaration') }}" required>
                </div>

                <!-- Poids -->
                <div class="mb-4">
                    <label for="poids" class="block text-sm font-medium text-gray-700">Poids (kg)<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="poids" id="poids" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('poids') }}" required>
                </div>

                <!-- Douane -->
                <div class="mb-4">
                    <label for="droit_douane" class="block text-sm font-medium text-gray-700">Droit Douane<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="droit_douane" id="droit_douane" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('droit_douane') }}" required>
                </div>

                <!-- Frais Kati -->
                <div class="mb-4">
                    <label for="frais_kati" class="block text-sm font-medium text-gray-700">Frais Kati<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="frais_kati" id="frais_kati" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('frais_kati') }}" required>
                </div>

                <!-- Frais Frontiere -->
                <div class="mb-4">
                    <label for="frais_frontiere" class="block text-sm font-medium text-gray-700">Frais Frontière<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="frais_frontiere" id="frais_frontiere" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('frais_frontiere') }}" required>
                </div>

                <!-- Frais circuit -->
                <div class="mb-4">
                    <label for="frais_circuit" class="block text-sm font-medium text-gray-700">Frais Circuit<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="frais_circuit" id="frais_circuit" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('frais_circuit') }}" required>
                </div>

                <!-- Frais rapport -->
                <div class="mb-4">
                    <label for="frais_rapport" class="block text-sm font-medium text-gray-700">Frais Rapport<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="frais_rapport" id="frais_rapport" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('frais_rapport') }}" required>
                </div>

                <!-- Frais Ts -->
                <div class="mb-4">
                    <label for="frais_ts" class="block text-sm font-medium text-gray-700">Frais Ts<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="frais_ts" id="frais_ts" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('frais_ts') }}" required>
                </div>

                <!-- Prix -->
                <div class="mb-4">
                    <label for="prix" class="block text-sm font-medium text-gray-700">Prix<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="prix" id="prix" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('prix') }}" required>
                </div>

                <!-- paiement -->
                <div class="mb-4">
                    <label for="prix" class="block text-sm font-medium text-gray-700">Paiement<span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="paiement" id="paiement" class="w-full px-4 py-2 bg-gray-200 rounded" value="{{ old('paiement') }}" required>
                </div>

            </div>
                <button type="submit" 
                        class="w-full px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Enregistrer
                </button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full lg:w-4/5 my-6 pr-0 lg:pr-2 bg-white p-4 rounded shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Modifier Encaissement</h2>

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

        <form action="{{ route('encaissements.update', $encaissement->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-3">
                <!-- Date -->
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Date<span class="text-red-500">*</span></label>
                    <input type="date" name="date" id="date" class="w-full px-4 py-2 bg-gray-200 rounded" 
                        value="{{ old('date', $encaissement->date) }}" required>
                </div>

                <!-- Nature -->
                <div class="mb-4">
                    <label for="nature_id" class="block text-sm font-medium text-gray-700">Nature<span class="text-red-500">*</span></label>
                    <select name="nature_id" id="nature_id" class="w-full px-4 py-2 bg-gray-200 rounded" required>
                        <option value="" disabled></option>
                        @foreach ($natures as $nature)
                            <option value="{{ $nature->id }}" {{ (old('nature_id', $encaissement->nature_id) == $nature->id) ? 'selected' : '' }}>
                                {{ $nature->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Designation -->
                <div class="mb-4">
                    <label for="designation" class="block text-sm font-medium text-gray-700">Désignation<span class="text-red-500">*</span></label>
                    <input type="text" name="designation" id="designation" class="w-full px-4 py-2 bg-gray-200 rounded" 
                        value="{{ old('designation', $encaissement->designation) }}" required>
                </div>

                <!-- reference -->
                <div class="mb-4">
                    <label for="reference" class="block text-sm font-medium text-gray-700">Réference<span class="text-red-500">*</span></label>
                    <input type="text" name="reference" id="reference" class="w-full px-4 py-2 bg-gray-200 rounded" 
                        value="{{ old('reference', $encaissement->reference) }}" required>
                </div>

                <!-- type -->
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">
                        Type <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type" class="w-full px-4 py-2 bg-gray-200 rounded" required>
                        <option value="" disabled {{ old('type', $encaissement->type) == '' ? 'selected' : '' }}></option>
                        <option value="Paiement Clients" {{ old('type', $encaissement->type) == 'Paiement Clients' ? 'selected' : '' }}>Paiement Clients</option>
                        <option value="Reboursement Pret" {{ old('type', $encaissement->type) == 'Reboursement Pret' ? 'selected' : '' }}>Reboursement Pret</option>
                    </select>
                </div>

                <!-- Montant -->
                <div class="mb-4">
                    <label for="montant" class="block text-sm font-medium text-gray-700">Montant<span class="text-red-500">*</span></label>
                    <input type="number" name="montant" id="montant" min="0" class="w-full px-4 py-2 bg-gray-200 rounded" 
                        value="{{ old('montant', $encaissement->montant) }}" required>
                </div>
                <!-- commentaire -->
                <div class="mb-4">
                    <label for="commentaire" class="block text-sm font-medium text-gray-700">Commentaire<span class="text-red-500">*</span></label>
                    <input type="text" name="commentaire" id="commentaire" class="w-full px-4 py-2 bg-gray-200 rounded" 
                        value="{{ old('commentaire', $encaissement->commentaire) }}" required>
                </div>
            </div>

            <button type="submit" 
                    class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Modifier
            </button>
        </form>
    </div>
</div>
@endsection

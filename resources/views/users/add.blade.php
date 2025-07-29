@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 flex items-center">
            <i class="fas fa-user-plus mr-2"></i> Ajout Utilisateur
        </h2>

        {{-- Messages de succès ou d'erreurs --}}
        @if (session()->has("success"))
            <div class="bg-green-100 text-green-700 p-4 mt-4 rounded-md shadow-sm">
                {{ session()->get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mt-4 rounded-md shadow-sm">
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <form method="POST" action="{{ route('add') }}" enctype="multipart/form-data" class="mt-6 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Prénom --}}
                <div>
                    <label for="prenom" class="block text-gray-600 font-medium">Prénom <span class="text-red-500">*</span></label>
                    <input id="prenom" name="prenom" type="text" value="{{ old('prenom') }}" required 
                           class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Nom --}}
                <div>
                    <label for="name" class="block text-gray-600 font-medium">Nom <span class="text-red-500">*</span></label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required 
                           class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 uppercase">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-gray-600 font-medium">Email <span class="text-red-500">*</span></label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                           class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Rôle --}}
                <div>
                    <label for="fonction" class="block text-gray-600 font-medium">Rôle <span class="text-red-500">*</span></label>
                    <select id="fonction" name="fonction" required 
                            class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Sélectionnez rôle</option>
                        <option value="Admin">Admin</option>
                        <option value="Utilisateur">Utilisateur</option>
                    </select>
                </div>

                {{-- Image --}}
                <div>
                    <label for="image" class="block text-gray-600 font-medium">Image <span class="text-red-500">*</span></label>
                    <input id="image" name="image" type="file" required 
                           class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Signature --}}
                <div>
                    <label for="signature" class="block text-gray-600 font-medium">Signature <span class="text-red-500">*</span></label>
                    <input id="signature" name="signature" type="file" required 
                           class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Mot de passe --}}
                <div>
                    <label for="password" class="block text-gray-600 font-medium">Mot de passe <span class="text-red-500">*</span></label>
                    <input id="password" name="password" type="password" required 
                           class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Confirmation mot de passe --}}
                <div>
                    <label for="password_confirmation" class="block text-gray-600 font-medium">Confirmer le mot de passe <span class="text-red-500">*</span></label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            {{-- Bouton de soumission --}}
            <div class="flex justify-end mt-6">
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

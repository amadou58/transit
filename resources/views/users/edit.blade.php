@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-3xl bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 flex items-center">
            <i class="fas fa-edit mr-2"></i> Modification Utilisateur
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
        <form method="POST" action="{{ route('edit', ['user' => $user->id]) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Prénom --}}
                <div>
                    <label for="prenom" class="block text-gray-600 font-medium">Prénom <span class="text-red-500">*</span></label>
                    <input id="prenom" name="prenom" type="text" value="{{ old('prenom', $user->prenom) }}" required 
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Nom --}}
                <div>
                    <label for="name" class="block text-gray-600 font-medium">Nom <span class="text-red-500">*</span></label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required 
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 uppercase">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-gray-600 font-medium">Email <span class="text-red-500">*</span></label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required 
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Mot de passe --}}
                <div>
                    <label for="password" class="block text-gray-600 font-medium">Mot de passe</label>
                    <input id="password" name="password" type="password" placeholder="Laissez vide pour conserver l'ancien mot de passe" 
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            {{-- Bouton de soumission --}}
            <div class="flex justify-center mt-6">
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 transition">
                    Modifier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

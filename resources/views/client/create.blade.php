@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full lg:w-4/5 my-6 pr-0 lg:pr-2 bg-white p-4 rounded shadow-md">
        <h2 class="text-2xl font-semibold text-gray-700 flex items-center">
            <i class="fas fa-plus mr-3"></i> Ajout Clients
        </h2>

        {{-- Messages de succès et d'erreurs --}}
        @if (session()->has("success"))
            <div class="bg-green-100 text-green-700 p-4 rounded mt-4">
                {{ session()->get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mt-4">
                <ul class="list-disc ml-6">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire --}}
        <form action="{{ route('client.store') }}" method="POST" class="mt-6 w-full space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-6 mt-4 sm:grid-cols-2">
                <div class="mb-4">
                    <label for="Prénom" class="block text-sm font-medium text-gray-600">
                        Prénom <span class="text-red-500">*</span>
                    </label>
                    <input id="prenom" name="prenom" type="text" required 
                        class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded border focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-600">
                        Nom <span class="text-red-500">*</span>
                    </label>
                    <input id="nom" name="nom" type="text" required 
                        class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded border focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="mb-4">
                    <label for="Adresse" class="block text-sm font-medium text-gray-600">
                        Adresse <span class="text-red-500">*</span>
                    </label>
                    <input id="adresse" name="adresse" type="text" required 
                        class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded border focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="mb-4">
                    <label for="contact" class="block text-sm font-medium text-gray-600">
                        Contact <span class="text-red-500">*</span>
                    </label>
                    <input id="contact" name="contact" type="text" required 
                        class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded border focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
            &nbsp;
            <button type="submit" 
                    class="w-full px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                Enregistrer
            </button>
        </form>
    </div>
</div>

{{-- Styles personnalisés --}}
<style>
    input:required {
        border: 1px solid red;
    }
    select:required {
        border: 1px solid red;
    }
</style>
@endsection

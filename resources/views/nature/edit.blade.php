@extends('layouts.app')

@section('content')
    
<div class="flex items-center justify-center">
    <div class="flex">
        <div class="w-full lg:w-4/5 my-6 pr-0 lg:pr-2 bg-white p-4 rounded shadow-md">
            
            <p class="text-2xl pb-4 flex items-center">
                <i class="fas fa-map fas-fa-icon"></i> Modifier Nature
            </p>
            @if (session()->has("success"))
                <div class="bg-green-100 text-green-700 p-4 rounded">
                    <h3>{{ session()->get('success') }}</h3>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('nature.update', ['nature'=>$nature->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6 mt-4 sm:grid-cols-2">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600" for="nom">Nom Nature</label>
                        <input class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded" value="{{$nature->nom}}" id="nom" name="nom" type="text">
                    </div>
                    <!-- type -->
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" id="type" class="w-full px-4 py-2 bg-gray-200 rounded" required>
                            <option value="" disabled {{ old('type', $nature->type) == '' ? 'selected' : '' }}></option>
                            <option value="Encaissement" {{ old('type', $nature->type) == 'Encaissement' ? 'selected' : '' }}>Encaissement</option>
                            <option value="Decaissement" {{ old('type', $nature->type) == 'Decaissement' ? 'selected' : '' }}>Decaissement</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <button class="w-full px-2 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700" type="submit">Modifier</button>
                    </div>
                </div>
            </form>
        </div>

    </div>    
</div>

@endsection

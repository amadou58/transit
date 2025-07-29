@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-4xl grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Formulaire d'ajout --}}
        <div class="bg-white p-6 rounded shadow-md flex flex-col items-center justify-center">
            <h2 class="text-2xl font-semibold text-gray-700 flex items-center">
                <i class="fas fa-plus mr-3"></i> Ajout Destination
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
            <form action="{{ route('destination.store') }}" method="POST" class="mt-6 w-full space-y-4">
                @csrf
                <div class="text-center">
                    <label for="nom" class="block text-sm font-medium text-gray-600">
                        Nom Destination <span class="text-red-500">*</span>
                    </label>
                    <input id="nom" name="nom" type="text" required 
                        class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded border focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                &nbsp;
                <button type="submit" 
                        class="w-full px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Enregistrer
                </button>
            </form>
        </div>

        {{-- Tableau des destinations --}}
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-semibold text-gray-700 flex items-center">
                <i class="fas fa-list mr-3"></i> Liste des Destinations
            </h2>

            <table id="destinationsTable" class="min-w-full mt-4 bg-white border rounded">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Nom Destination</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($destination as $index => $dest)
                        <tr>
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">{{ $dest->nom }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('destination.edit', ['destination' => $dest->id]) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                &nbsp;&nbsp;
                                <button class="text-red-500 hover:text-red-700 delete-destination" data-destinationid="{{ $dest->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- JavaScript pour DataTables et suppression --}}
<script>
    $(document).ready(function() {
        // Initialisation de DataTable
        $('#destinationsTable').DataTable({
            
            responsive: true
        });

        // Suppression d'une destination avec confirmation
        $('.delete-destination').click(function (e) {
            e.preventDefault();
            const destinationId = $(this).data('destinationid');
            const confirmation = confirm('Êtes-vous sûr de vouloir supprimer cette destination ?');
            if (confirmation) {
                $('<form>', {
                    method: 'POST',
                    action: `/destination/${destinationId}`
                })
                .append($('<input>', { type: 'hidden', name: '_token', value: '{{ csrf_token() }}' }))
                .append($('<input>', { type: 'hidden', name: '_method', value: 'DELETE' }))
                .appendTo('body')
                .submit();
            }
        });
    });
</script>

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

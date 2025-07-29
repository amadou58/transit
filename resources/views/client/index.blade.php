@extends('layouts.app')

@section('content')

<div class="w-full">
    <main class="w-full flex-grow py-4">

        <div class="bg-white p-6">
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list-alt mr-3"></i>Liste Clients
                </p>
            </div> 
            @if (session()->has("success"))
                <div class="bg-green-200 text-green-700 p-4">
                    <h3>{{ session()->get('success') }}</h3>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-200 text-red-700 p-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-x-auto">
                <table id="clientsTable" class="min-w-full mt-4 bg-white border border-red-500 rounded">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left border border-red-500">#</th>
                            <th class="py-3 px-4 text-left border border-red-500">Nom</th>
                            <th class="py-3 px-4 text-left border border-red-500">Prenom</th>
                            <th class="py-3 px-4 text-left border border-red-500">Adresse</th>
                            <th class="py-3 px-4 text-left border border-red-500">Contact</th>
                            <th class="py-3 px-4 text-left border border-red-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        {{-- les lignes seront remplies automatiquement par DataTables --}}
                    </tbody>
                </table>
            </div>
        </div>             
    </main>  
</div>

<script>
    $(document).ready(function() {
        // Initialisation avec traitement côté serveur
        let table = $('#clientsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("client.data") }}',
            columns: [
                { data: 'id', name: 'id', orderable: false, searchable: false },
                { data: 'nom', name: 'nom' },
                { data: 'prenom', name: 'prenom' },
                { data: 'adresse', name: 'adresse' },
                { data: 'contact', name: 'contact' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            pageLength: 100,
            lengthMenu: [
                [100, 200, 300, 400, 500, 1000, 1500, 2000],
                [100, 200, 300, 400, 500, 1000, 1500, 2000]
            ],
            dom: 'lBfrtip', // Ajoute la barre des boutons
            buttons: [
                {
                    extend: 'excel',
                    text: 'Exporter Excel',
                    className: 'bg-green-500 text-white px-3 py-1 rounded mr-2'
                },
                {
                    extend: 'pdf',
                    text: 'Exporter PDF',
                    className: 'bg-red-500 text-white px-3 py-1 rounded'
                }
            ],createdRow: function(row, data, dataIndex) {
                    $('td', row).addClass('border border-black py-2 px-3');
                }
        });

        // Gestion suppression avec délégué
        $(document).on('click', '.delete-client', function () {
            const clientId = $(this).data('clientid');
            if (confirm('Êtes-vous sûr de vouloir supprimer ce client ?')) {
                $('<form>', {
                    method: 'POST',
                    action: `/client/${clientId}`
                })
                .append($('<input>', { type: 'hidden', name: '_token', value: '{{ csrf_token() }}' }))
                .append($('<input>', { type: 'hidden', name: '_method', value: 'DELETE' }))
                .appendTo('body')
                .submit();
            }
        });
    });
</script>    
@endsection

@extends('layouts.app')

@section('content')
<div class="w-full">
    <main class="w-full flex-grow py-4">
        <main class="bg-white p-6">
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list-alt mr-3"></i>Liste des Transits
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
                <div class="flex items-center gap-4 mb-4">
                    <select id="field-select" class="border rounded px-3 py-1">
                        <option value="">-- Champ à modifier --</option>
                        <option value="droit_douane">Droit Douane</option>
                        <option value="frais_kati">Frais Kati</option>
                        <option value="frais_frontiere">Frais Frontière</option>
                        <option value="frais_circuit">Frais Circuit</option>
                        <option value="frais_rapport">Frais Rapport</option>
                        <option value="frais_ts">Frais TS</option>
                    </select>

                    <input type="number" id="new-value" placeholder="Nouvelle valeur" class="border rounded px-3 py-1">

                    <button id="apply-changes" class="bg-blue-500 text-white px-4 py-2 rounded">Appliquer</button>
                </div>

            <div class="bg-white overflow-x-auto">
            <table id="transportsTable" class="min-w-full mt-4 bg-white border border-red-500 rounded">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left border border-red-500">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th class="py-3 px-4 text-left border border-red-500">Date</th>
                        <th class="py-3 px-4 text-left border border-red-500">Désignation</th>
                        <th class="py-3 px-4 text-left border border-red-500">Immatriculation</th>
                        <th class="py-3 px-4 text-left border border-red-500">Destination</th>
                        <th class="py-3 px-4 text-left border border-red-500">Client</th>
                        <th class="py-3 px-4 text-left border border-red-500">N° Déclaration</th>
                        <th class="py-3 px-4 text-left border border-red-500">Poids (T)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Droit Douane (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Frais Kati (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Frais Frontière (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Frais Circuit (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Frais Rapport (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Frais TS (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Prix (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Paiement (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Bénéfice (XOF)</th>
                        <th class="py-3 px-4 text-left border border-red-500">Saisie</th>
                        <th class="py-3 px-4 text-left border border-red-500">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </main>
</div>

<script>
    let checkedIds = [];
    let table;
    $(document).ready(function () {
        table = $('#transportsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("transports.data") }}',
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        const isChecked = checkedIds.includes(data.toString()) ? 'checked' : '';
                        return `<input type="checkbox" class="select-row" value="${data}" ${isChecked}>`;
                    }
                },
                { data: 'date', name: 'date' },
                { data: 'designation', name: 'designation' },
                { data: 'immatriculation_vehicule', name: 'immatriculation_vehicule' },
                { data: 'destination', name: 'destination.nom' },
                { data: 'client', name: 'client.nom' },
                { data: 'numero_declaration', name: 'numero_declaration' },
                { data: 'poids', name: 'poids' },
                { data: 'droit_douane', name: 'droit_douane' },
                { data: 'frais_kati', name: 'frais_kati' },
                { data: 'frais_frontiere', name: 'frais_frontiere' },
                { data: 'frais_circuit', name: 'frais_circuit' },
                { data: 'frais_rapport', name: 'frais_rapport' },
                { data: 'frais_ts', name: 'frais_ts' },
                { data: 'prix', name: 'prix' },
                { data: 'paiement', name: 'paiement' },
                { data: 'benefice', name: 'benefice' },
                { data: 'user', name: 'user' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
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

        // Suppression avec confirmation
        $(document).on('click', '.delete-transport', function () {
            const id = $(this).data('id');
            if (confirm('Êtes-vous sûr de vouloir supprimer ce transport ?')) {
                $('<form>', {
                    method: 'POST',
                    action: `/transports/${id}`
                })
                .append($('<input>', { type: 'hidden', name: '_token', value: '{{ csrf_token() }}' }))
                .append($('<input>', { type: 'hidden', name: '_method', value: 'DELETE' }))
                .appendTo('body')
                .submit();
            }
        });
    });

    // ✅ Recocher les cases après chaque redraw (filtrage, pagination, etc.)
    $('#transportsTable').on('draw.dt', function () {
        $('.select-row').each(function () {
            const id = $(this).val();
            if (checkedIds.includes(id)) {
                $(this).prop('checked', true);
            }
        });
    });

    // ✅ Mettre à jour la liste lors du clic sur une case
    $(document).on('change', '.select-row', function () {
        const id = $(this).val();
        if ($(this).is(':checked')) {
            if (!checkedIds.includes(id)) checkedIds.push(id);
        } else {
            checkedIds = checkedIds.filter(x => x !== id);
        }
    });

    // ✅ Gérer "Tout cocher"
    $('#select-all').on('change', function () {
        const checked = $(this).is(':checked');
        $('.select-row').each(function () {
            $(this).prop('checked', checked).trigger('change');
        });
    });

    // ✅ Lors de l'application
    $('#apply-changes').on('click', function () {
        const field = $('#field-select').val();
        const value = $('#new-value').val();

        if (!field || !value || checkedIds.length === 0) {
            alert('Veuillez sélectionner au moins une ligne, un champ et une valeur.');
            return;
        }

        if (!confirm('Confirmez-vous la modification des lignes sélectionnées ?')) return;

        $.ajax({
            url: '{{ route("transports.batch-update") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                ids: checkedIds,
                field: field,
                value: value
            },
            success: function () {
                alert('Modifications appliquées avec succès.');
                checkedIds = []; // on vide après
                $('#select-all').prop('checked', false);
                table.ajax.reload();
            },
            error: function () {
                alert("Erreur lors de la mise à jour.");
            }
        });
        table.ajax.reload();
    });
</script>
@endsection

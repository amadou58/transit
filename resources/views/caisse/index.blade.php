@extends('layouts.app')

@section('content')

    <div class="w-full">
        <main class="w-full flex-grow py-4">
            <div class="bg-white p-6">
                <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list-alt mr-3"></i>Tableaux de la Caisse
                    </p>
                </div>

                <!-- Filtre par mois -->
                <form method="GET" class="mb-4">
                    <input type="month" name="mois" value="{{ request('mois') }}" class="border p-2 rounded">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrer</button>
                </form>

                <!-- Trois tableaux côte à côte -->
                <div class="flex gap-6 overflow-auto">
                    <!-- Tableau Caisse Résumé -->
                    <div class="w-full">
                        <h2 class="font-bold text-lg mb-2 text-center">Caisse</h2>
                        <table id="caisseTable" class="min-w-full bg-white border border-black border-collapse text-sm">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-2 px-3 border border-black">Mois</th>
                                    <th class="py-2 px-3 border border-black">Initial</th>
                                    <th class="py-2 px-3 border border-black">Encaisse</th>
                                    <th class="py-2 px-3 border border-black">Décaisse</th>
                                    <th class="py-2 px-3 border border-black">Final</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    
                    <!-- Tableau Encaissements -->
                    <div class="w-full" style=" background-color: rgb(212, 224, 197);">
                        <h2 class="font-bold text-lg mb-2 text-center">Encaissements</h2>
                        <table id="encaissementTable" class="min-w-full bg-white border border-black border-collapse rounded text-sm">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-2 px-3">Date</th>
                                    <th class="py-2 px-3">Montant</th>
                                    <th class="py-2 px-3">Nature</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th colspan="2" class="text-right" id="total-montant-encaissement"></th>
                                </tr>
                            </tfoot>
                            <tbody></tbody>
                        </table>
                    </div>

                    <!-- Tableau Décaissements -->
                    <div class="w-full" style=" background-color: rgb(245, 231, 231);">
                        <h2 class="font-bold text-lg mb-2 text-center">Décaissements</h2>
                        <table id="decaissementTable" class="min-w-full bg-white border border-black border-collapse rounded text-sm">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-2 px-3">Date</th>
                                    <th class="py-2 px-3">Montant</th>
                                    <th class="py-2 px-3">Nature</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th colspan="2" class="text-right" id="total-montant-decaissement"></th>
                                </tr>
                            </tfoot>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>



<script>
    $(document).ready(function () {
        let table = $('#caisseTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('caisses.data') }}',
                data: function (d) {
                    d.mois = $('input[name="mois"]').val(); // 👈 ajouter le mois sélectionné
                }
            },
            columns: [
                { data: 'mois', name: 'mois' },
                { data: 'montant_initial', name: 'montant_initial',
                  render: data => parseInt(data).toLocaleString() + ' FCFA'
                },
                { data: 'total_encaisse', name: 'total_encaisse',
                  render: data => parseInt(data).toLocaleString() + ' FCFA'
                },
                { data: 'total_decaisse', name: 'total_decaisse',
                  render: data => parseInt(data).toLocaleString() + ' FCFA'
                },
                { data: 'montant_final', name: 'montant_final',
                  render: data => parseInt(data).toLocaleString() + ' FCFA'
                },
            ],
                createdRow: function(row, data, dataIndex) {
                    $('td', row).addClass('border border-black py-2 px-3');
                }
        });

        $('#encaissementTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("encaissements.data") }}',
            columns: [
                { data: 'date' },
                { data: 'montant',
                  render: data => parseInt(data).toLocaleString() + ' FCFA' },
                { data: 'nature' }
            ],
            pageLength: 100,
            lengthMenu: [
                [100, 200, 300, 400, 500, 1000, 1500, 2000],
                [100, 200, 300, 400, 500, 1000, 1500, 2000]
            ],
            dom: 'lBfrtip',
            drawCallback: function(settings) {
                let total = 0;
                settings.json.data.forEach(item => {
                    total += parseFloat(item.montant);
                });
                $('#total-montant-encaissement').text(total.toLocaleString() + ' FCFA');
            },
                createdRow: function(row, data, dataIndex) {
                    $('td', row).addClass('border border-black py-2 px-3');
                }
        });

        $('#decaissementTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("decaissements.data") }}',
            columns: [
                { data: 'date'},
                { data: 'montant',
                render: data => parseInt(data).toLocaleString() + ' FCFA' },
                { data: 'nature' }
            ],
            pageLength: 100,
            lengthMenu: [
                [100, 200, 300, 400, 500, 1000, 1500, 2000],
                [100, 200, 300, 400, 500, 1000, 1500, 2000]
            ],
            dom: 'lBfrtip',
            drawCallback: function(settings) {
                let total = 0;
                settings.json.data.forEach(item => {
                    total += parseFloat(item.montant);
                });
                $('#total-montant-decaissement').text(total.toLocaleString() + ' FCFA');
            },
                createdRow: function(row, data, dataIndex) {
                    $('td', row).addClass('border border-black py-2 px-3');
                }
        });

        // Rafraîchir DataTables à la soumission du formulaire de filtre
        $('form').on('submit', function (e) {
            e.preventDefault();
            table.ajax.reload(); // 👈 recharge les données avec le filtre
        });
    });
</script>

@endsection

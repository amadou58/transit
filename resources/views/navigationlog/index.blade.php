@extends('layouts.app')

@section('content')

<div class="w-full">
    <main class="w-full flex-grow py-4">
        <div class="bg-white p-6">
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-route mr-3"></i> Journal de navigation
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
                <table id="logs-table" class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-2 uppercase font-semibold text-sm border border-black">
                                Utilisateur
                            </th>
                            <th class="text-left py-3 px-2 uppercase font-semibold text-sm border border-black">
                                URL
                            </th>
                            <th class="text-left py-3 px-2 uppercase font-semibold text-sm border border-black">
                                IP
                            </th>
                            <th class="text-left py-3 px-2 uppercase font-semibold text-sm border border-black">
                                Navigateur
                            </th>
                            <th class="text-left py-3 px-2 uppercase font-semibold text-sm border border-black">
                                Date/Heure
                            </th>
                        </tr>
                    </thead>
                    <tbody class=""></tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    $(document).ready(function () {
        $('#logs-table').DataTable({
            language: {
                url: "{{ asset('francaisdatatable/French.json') }}",
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('navigation-logs.data') }}',
            columns: [
                { data: 'user_name', name: 'user.name' },
                { data: 'url', name: 'url' },
                { data: 'ip', name: 'ip' },
                { data: 'user_agent', name: 'user_agent' },
                { data: 'visited_at', name: 'visited_at' },
            ],
            lengthMenu: [10, 25, 50, 100],
            dom: '<"buttons-cell"B>lfrtip',
            buttons: [
                {
                    extend: 'collection',
                    text: 'Exporter',
                    buttons: ['csv', 'excel', 'pdf', 'print']
                }
            ]
        });
    });
</script>

<style>
    .larger-icon {
        font-size: 2em;
    }

    @media print {
        .filter-menu,
        .filter-icon,
        #resetFilter {
            display: none !important;
        }
    }
</style>

@endsection

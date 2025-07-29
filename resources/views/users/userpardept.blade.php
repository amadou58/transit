@extends('layouts.app')

@section('content')

<div class="w-full">
    <main class="w-full flex-grow p-6">
            
        <div class="bg-white p-6">
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-user mr-3"></i> Liste des Utilisateurs
                </p>
                {{-- <div class="flex justify-end"> <a href="{{ route('create') }}" class="text-white text-x font-semibold uppercase hover:text-gray-300">
                    <button class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px--9 rounded">
                        <i class="fas fa-plus"></i> Ajouter Utilisateur 
                    </button></a>
                </div> --}}
                @if (session()->has("success"))
                <div class="bg-green-200 text-green-700 p-4 alert">
                    <h3>{{ session()->get('success') }}</h3>
                </div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-200 text-red-700 p-4 alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div> <br>
            <div class="bg-white overflow-auto">
                <table id="myTable" class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Image</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">Prenom</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">Nom</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Departement</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Statut</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Statut Interimaire</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</td>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm" scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($user as $user)
                        <tr>
                            <th scope="row">{{ $loop->index + 1}}</th>
                            <td class="text-left py-3 px-4 image-column"><img src="{{ asset(Storage::url($user->image)) }}" class="img img-responsive rounded-circle" />
                            </td>
                            <td class=" text-left py-3 px-4 uppercase">{{ $user->prenom }}</td>
                            <td class="text-left py-3 px-4 uppercase">{{ $user->name }}</td>
                            <td class="text-left py-3 px-4 uppercase">{{ $user->departement->nom_dept }}</td>
                            <td class="text-left py-3 px-4 uppercase">{{$user->statut}}</td>
                            <td class="text-left py-3 px-4 uppercase">{{$user->interim}}</td>
                            <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                            <td class="text-left py-3 px-4" style="white-space: nowrap;">
                                <a href="{{ route('donnerInterim', ['id' => $user->id]) }}" class="hover:text-blue-500 donner-interim" title="donner interim" data-userid="{{ $user->id }}"><i class="fas fa-user-tie text-blue-500"></i></a>
                                &nbsp;&nbsp;
                                <a href="{{ route('retirerInterim', ['id' => $user->id]) }}" class="hover:text-red-500 retirer-interim" title="retirer interim" data-userid="{{ $user->id }}"><i class="fas fa-minus-circle text-red-500"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </main>   
</div>

{{-- <!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables JSZip -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- DataTables Buttons JS -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script> --}}

<script>

$(document).ready(function () {
        
        $('#myTable').DataTable({
            "language": {
                "url": "{{ asset('francaisdatatable/French.json') }}",
                "paginate": {
                    "next": "Suivant",
                    "previous": "Précédent"
                },
                "search": "Rechercher",
                "searching": true,
                "lengthMenu": "Afficher _MENU_ entrées",
                
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                "infoEmpty": "Affichage de 0 à 0 sur 0 entrée",
                "emptyTable": "Aucune donnée disponible dans le tableau"
            },
            "columnDefs": [
                { "orderable": false, "targets": [1,8] }
            ],
            "buttons": [
                {
                    extend: 'collection',
                    text: 'Exporter',
                    buttons: ['csv', 'excel', 'pdf', 'print']
                },
            ],
            "pagingType": "simple",
            "dom": '<"buttons-cell"B>lfrtip'
        });
    });

    $('.delete-user').click(function (e) {
        e.preventDefault();
        var userId = $(this).data('userid');
        var confirmation = confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');

        if (confirmation) {
            // Si l'utilisateur a confirmé, soumettez le formulaire de suppression
            var form = $('<form>', {
                'method': 'POST',
                'action': '/users/' + userId
            });
            form.append($('<input>', {
                'type': 'hidden',
                'name': '_token',
                'value': '{{ csrf_token() }}'
            }));
            form.append($('<input>', {
                'type': 'hidden',
                'name': '_method',
                'value': 'DELETE'
            }));
            form.appendTo('body').submit();
        }
    });


    function hideMessage() {
        $(".alert").slideUp(500, function(){
            $(this).remove();
        });
    }

    // Ajoutez cette fonction pour déclencher le masquage du message après un délai
    function triggerHideMessage() {
        setTimeout(hideMessage, 5000); // 5000 millisecondes (5 secondes)
    }

    // Exécutez la fonction au chargement de la page
    $(document).ready(function(){
        triggerHideMessage();
    });

</script>


<style>
     .rounded-circle {
            border-radius: 50%;
            width: 60px; /* Ajustez la largeur selon vos besoins */
            height: 60px; /* Ajustez la hauteur selon vos besoins */
            object-fit: cover; /* Pour assurer que l'image couvre la zone définie */
        }

        .image-column {
            overflow: hidden; /* Assurez-vous que l'image ne dépasse pas du cadre */
        }
</style>
@endsection
@extends('layouts.app')

@section('content')

<div class="w-full">
    <main class="w-full flex-grow p-6">
            
        <div class="bg-white p-6">
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-user mr-3"></i> Liste des Utilisateurs
                </p>
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
                            <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                            <td class="text-left py-3 px-4" style="white-space: nowrap;">
                                <a href="{{ route('edit', ['user'=>$user->id]) }}"><i
                                    class="fa fa-edit text-blue-400"></i>
                                </a>
                                &nbsp;&nbsp;
                                <button class="delete-user" data-userid="{{ $user->id }}">
                                    <i class="fa fa-trash text-red-400"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </main>   
</div>

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
            "order": [1],
            "columnDefs": [
                { "orderable": false, "targets": [0,5] }
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
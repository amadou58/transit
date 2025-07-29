<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBKIT</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo/logo.jpg') }}" width="100" height="100"/>

    <link rel="stylesheet" href="{{ asset('js/jquery-ui.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('js/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/dateTime.min.css') }}">
   <link rel="stylesheet" href="{{ asset('js/fixedHeader.dataTables.min.css') }}"> 
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="{{ asset('js/dataTables.buttons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2.min.css') }}">
   

    {{-- <script type="text/javascript" src="{{ asset('js/jquery-3.7.0.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.fixedHeader.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dateTime.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap4.min.js') }}"></script>
    <!-- DataTables JSZip -->
    <script type="text/javascript" src="{{ asset('js/jszip-3.1.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.print.min.js') }}"></script>
   
    <!-- AlpineJS -->
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
    <!-- Font Awesome -->
    <script type="text/javascript" src="{{ asset('js/fontawesome.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/alpine.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chart.min.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>

    button[type="submit"] {
        background-color: rgb(8, 51, 68);
        color: white; /* Texte en blanc pour un meilleur contraste */
        border: none; /* Optionnel: enlever les bordures */
        padding: 10px 20px; /* Optionnel: ajuster les marges intérieures */
        border-radius: 5px; /* Optionnel: ajouter des coins arrondis */
        cursor: pointer; /* Optionnel: changer le curseur au survol */
    }

    button[type="submit"]:hover {
        background-color: rgba(8, 51, 68, 0.8); /* Optionnel: effet au survol */
    }

        .new-record-indicator {
            color: red; /* Couleur rouge */
            font-weight: bold; /* Texte en gras */
            margin-left: 5px; /* Marge à gauche pour l'espace */
        }

        @keyframes blink {
        0% {
            background-color: transparent;
        }
        50% {
            background-color: #f8d7da; /* Couleur de fond clignotante */
        }
        100% {
            background-color: transparent;
        }
        }

        .blink-bg {
        animation: blink 0.5s infinite;
        }


        .sticky-row {
            position: sticky;
            top: 0;
            background-color: white; /* Couleur de fond si nécessaire */
            z-index: 1000; /* Ajustez cela en fonction de votre mise en page */
        }
     
            /* ... autres styles ... */
            .profile-dropdown {
            position: relative;
            display: inline-block;
            margin-left: auto; /* Utilisez margin-left: auto pour aligner à droite */
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ee0b0b;
            min-width: 60px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 4px;
            right: 0; /* Position à droite */
        }

        .profile-dropdown:hover .dropdown-content {
            display: block;
            right: 0; /* Position à droite */
        }

        .font-family-karla {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }      
        .sidebar {
            background-color: rgb(70, 125, 146);
            position: fixed;
            top: 0;
            left: 0;
            width: 270px;
            height: 100%;
            overflow-y: auto; /* Ajoutez cette ligne pour activer le défilement */
        }
        .nav-item {
            transition: background 0.3s ease;
        }
        .nav-item:hover {
            background: rgb(202 138 4);
            opacity: 1;
        }
        .account-link:hover {
            background: rgb(70, 125, 146);;
        }

        header {
            color:white;
            background-color: rgb(70, 125, 146);; /* Ajoutez la couleur du sidebar ici */
        }
      
        /* ... Votre style existant ... */

        .nav-item:hover,
        
        .nav-item.active-nav-link {
            background: rgb(35, 81, 95);
            opacity: 1;
        }

        .account-link:hover {
            background: rgb(70, 125, 146);
        }
        
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            box-sizing: border-box;
        }

        body {
            background-color: #f3f3f3;
            transform: scale(0.7); /* Applique un zoom de 70% */
            transform-origin: top left; /* Point de référence pour le zoom */
            width: calc(100% / 0.7); /* Ajuste la largeur pour compenser le zoom */
            height: calc(100% / 0.7); /* Ajuste la hauteur pour compenser le zoom */
            display: flex;
            flex-direction: column;
        }

        .header {
            width: 100%;
        }

        .main-content {
            margin-left: 270px; /* Marge ajustée pour correspondre à la largeur de la barre latérale */
            margin-right: 0;
            flex: 1; /* Permet à .main-content de s'étendre pour remplir l'espace restant */
            overflow-y: auto; /* Permet le défilement si le contenu dépasse */
            padding: 10px; /* Optionnel : ajoute du padding si nécessaire */
        }

        .principale {
            display: flex;
            flex-direction: column;
            height: 200%;
        }
        
    </style>
</head>
<body class="font-family-karla flex">

    <!-- Barre latérale -->
    <aside class="sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="max-h-44 relative border-4 border-yellow-400 focus:outline-none sticky-row">
            <img src="{{ asset('storage/logo/logo.jpg') }}" alt="LOGO" width="70%" >
        </div>
        <hr>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('tableau.accueil') }}" class="flex items-center  text-white opacity-100  py-4 pl-6 nav-item" data-nav-item="accueil">
                <i class="fas fa-home mr-3"></i>Accueil
            </a>

            @if(auth()->user() && auth()->user()->fonction === 'Admin')
            <div x-data="{ isOpen: localStorage.getItem('adduser') === 'open' }" class="rounded shadow">
                <a @click="isOpen = !isOpen; localStorage.setItem('adduser', isOpen ? 'open' : 'closed')" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" data-nav-item="adduser">
                    <i class="fas fa-user-shield mr-3"></i>
                    <span class="flex items-center">
                        Utilisateurs
                        <i :class="isOpen ? 'fas fa-chevron-circle-down ml-2' : 'fas fa-chevron-circle-right ml-2'"></i>
                    </span>
                </a>
                </a>
                <ul x-animated-collapse="isOpen" class="overflow-hidden pl-6">
                    <li>
                        <a href="{{ route('create') }}" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item" data-nav-item="adduser1">
                            <i class="fas fa-plus mr-3"></i>Ajouter 
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="flex items-center hover:opacity-100 py-2 pl-6 nav-item" data-nav-item="adduser2">
                            <i class="fas fa-list mr-3"></i> Liste Utilisateurs
                        </a>
                    </li>
                </ul>
            </div>
            @endif 
            <div x-data="{ isOpen: localStorage.getItem('transit') === 'open' }" class="rounded shadow">
                <a @click="isOpen = !isOpen; localStorage.setItem('transit', isOpen ? 'open' : 'closed')" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" data-nav-item="transit">
                    <i class="fas fa-shipping-fast mr-3"></i>
                    <span class="flex items-center">
                        Transit
                        <i :class="isOpen ? 'fas fa-chevron-circle-down ml-2' : 'fas fa-chevron-circle-right ml-2'"></i>
                    </span>
                </a>
                </a>
                <ul x-animated-collapse="isOpen" class="overflow-hidden pl-6">
                    <li>
                        <a href="{{ route('transports.create') }}" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item" data-nav-item="transit1">
                            <i class="fas fa-plus mr-3"></i>Ajouter 
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transports.index') }}" class="flex items-center hover:opacity-100 py-2 pl-6 nav-item" data-nav-item="transit2">
                            <i class="fas fa-list mr-3"></i> Liste Transits
                        </a>
                    </li>
                </ul>
            </div>

            <div x-data="{ isOpen: localStorage.getItem('decaissement') === 'open' }" class="rounded shadow">
                <a @click="isOpen = !isOpen; localStorage.setItem('decaissement', isOpen ? 'open' : 'closed')" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" data-nav-item="decaissement">
                    <i class="fas fa-money-bill-wave mr-3"></i>
                    <span class="flex items-center">
                        Decaissement
                        <i :class="isOpen ? 'fas fa-chevron-circle-down ml-2' : 'fas fa-chevron-circle-right ml-2'"></i>
                    </span>
                </a>
                </a>
                <ul x-animated-collapse="isOpen" class="overflow-hidden pl-6">
                    <li>
                        <a href="{{ route('decaissements.create') }}" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item" data-nav-item="transit1">
                            <i class="fas fa-plus mr-3"></i>Ajouter 
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('decaissements.index') }}" class="flex items-center hover:opacity-100 py-2 pl-6 nav-item" data-nav-item="transit2">
                            <i class="fas fa-list mr-3"></i> Liste Decaissements
                        </a>
                    </li>
                </ul>
            </div>

            <div x-data="{ isOpen: localStorage.getItem('encaissement') === 'open' }" class="rounded shadow">
                <a @click="isOpen = !isOpen; localStorage.setItem('encaissement', isOpen ? 'open' : 'closed')" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" data-nav-item="encaissement">
                    <i class="fas fa-cash-register mr-3"></i>
                    <span class="flex items-center">
                        Encaissement
                        <i :class="isOpen ? 'fas fa-chevron-circle-down ml-2' : 'fas fa-chevron-circle-right ml-2'"></i>
                    </span>
                </a>
                </a>
                <ul x-animated-collapse="isOpen" class="overflow-hidden pl-6">
                    <li>
                        <a href="{{ route('encaissements.create') }}" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item" data-nav-item="encaisse1">
                            <i class="fas fa-plus mr-3"></i>Ajouter 
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('encaissements.index') }}" class="flex items-center hover:opacity-100 py-2 pl-6 nav-item" data-nav-item="encaisse2">
                            <i class="fas fa-list mr-3"></i> Liste Encaissements
                        </a>
                    </li>
                </ul>
            </div>

            <div x-data="{ isOpen: localStorage.getItem('Configuration') === 'open' }" class="rounded shadow">
                <a @click="isOpen = !isOpen; localStorage.setItem('Configuration', isOpen ? 'open' : 'closed')" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" data-nav-item="Configuration">
                    <i class="fas fa-sliders-h mr-3"></i>
                    <span class="flex items-center">Configuration
                        <i :class="isOpen ? 'fas fa-chevron-down ml-2' : 'fas fa-chevron-right ml-2'"></i>
                    </span>
                </a>
                <ul x-animated-collapse="isOpen" class="overflow-hidden pl-6">
                    <div x-data="{ isOpen: localStorage.getItem('client') === 'open' }" class="rounded shadow">
                        <a @click="isOpen = !isOpen; localStorage.setItem('client', isOpen ? 'open' : 'closed')" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" data-nav-item="client">
                            <i class="fas fa-users mr-3"></i>
                            <span class="flex items-center">
                                Client
                                <i :class="isOpen ? 'fas fa-chevron-circle-down ml-2' : 'fas fa-chevron-circle-right ml-2'"></i>
                            </span>
                        </a>
                        </a>
                        <ul x-animated-collapse="isOpen" class="overflow-hidden pl-6">
                            <li>
                                <a href="{{ route('client.create') }}" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item" data-nav-item="client1">
                                    <i class="fas fa-plus mr-3"></i>Ajouter 
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('client.index') }}" class="flex items-center hover:opacity-100 py-2 pl-6 nav-item" data-nav-item="client2">
                                    <i class="fas fa-list mr-3"></i> Liste Clients
                                </a>
                            </li>
                        </ul>
                    </div>
                </ul> 
                <ul x-animated-collapse="isOpen" class="overflow-hidden pl-6">
                    <li>
                        <a href="{{ route('destination.create') }}" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item" data-nav-item="Destination">
                                <i class="fas fa-location-arrow mr-3"></i>Destination
                        </a>
                    </li>
                </ul> 
                <ul x-animated-collapse="isOpen" class="overflow-hidden pl-6">
                    <li>
                        <a href="{{ route('nature.create') }}" class="flex items-center hover:opacity-100 py-4 pl-6 nav-item" data-nav-item="Nature">
                                <i class="fas fas fa-money-bill-wave mr-3"></i>Nature Encaisse/Decaisse
                        </a>
                    </li>
                </ul> 
                {{-- @endif --}}
            </div> 
            <a href="{{ route('caisses.index') }}" class="flex items-center  text-white opacity-100  py-4 pl-6 nav-item" data-nav-item="accueil">
                <i class="fas fa-list mr-3"></i>Caisse
            </a>
            <a href="{{ route('navigation-logs.index') }}" class="flex items-center  text-white opacity-100  py-4 pl-6 nav-item" data-nav-item="accueil">
                <i class="fas fa-list mr-3"></i>Journal de Navigation
            </a>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <div class="principale w-full flex flex-col  max-h-screen overflow-y-hidden ">
        <!-- En-tête de bureau -->
        <header class="w-full items-center py-2 px-6 hidden sm:flex">
                <!-- Profil à droite -->
            <div x-data="{ isOpen: false }" class="relative flex items-center profile-dropdown">
                <div>
                    Bonjour, {{ Auth::user()->prenom }} {{ strtoupper(Auth::user()->name) }}
                    <button @click="isOpen = !isOpen" class="img img-responsive w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                        <img src="{{ Storage::url(Auth::user()->image) }}" alt="image" class="w-full h-10 img img-responsive rounded-circle"> 
                    </button>
                </div>
                <div x-show="isOpen" class="dropdown-content">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <div class="main-content">
            @yield('content')
        </div>   

    </div>
</body>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // Lors du chargement de la page, vérifiez si un élément du sidebar est sélectionné dans le stockage local
            var selectedNavItem = localStorage.getItem("selectedNavItem");
            
            // Ajoutez un gestionnaire d'événements pour le chargement de la page
            window.addEventListener("load", function () {
                // Restaurer la position de défilement du sidebar
                var sidebar = document.querySelector('.sidebar');
                var scrollTop = localStorage.getItem('sidebarScrollTop');
                if (scrollTop) {
                    sidebar.scrollTop = scrollTop;
                }
                
                // Sélectionnez l'élément actif sauvegardé dans le stockage local
                if (selectedNavItem) {
                    var activeNavItem = document.querySelector(`[data-nav-item="${selectedNavItem}"]`);
                    if (activeNavItem) {
                        activeNavItem.classList.add("active-nav-link");
                    }
                }
            });
    
            // Ajoutez un gestionnaire d'événements pour les clics sur les éléments du sidebar
            document.querySelectorAll(".nav-item").forEach(function (element) {
                element.addEventListener("click", function () {
                    // Lorsqu'un élément est cliqué, enregistrez son ID dans le stockage local
                    document.querySelectorAll(".nav-item").forEach(function (el) {
                        el.classList.remove("active-nav-link");
                    });
    
                    // Lorsqu'un élément est cliqué, ajoutez la classe "active-nav-link" à l'élément correspondant
                    if (element) {
                        element.classList.add("active-nav-link");
                        localStorage.setItem("selectedNavItem", element.dataset.navItem);
                    }
    
                    // Enregistrez la position de défilement du sidebar
                    var sidebar = document.querySelector('.sidebar');
                    localStorage.setItem('sidebarScrollTop', sidebar.scrollTop);
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Variable pour indiquer si l'utilisateur est actuellement en train de saisir du texte
            var isTyping = false;

            // Écoutez l'événement focus et blur sur tous les champs de formulaire
            document.addEventListener('focus', function () {
                isTyping = true;
            }, true);

            document.addEventListener('blur', function () {
                isTyping = false;
            }, true);

            document.addEventListener('keydown', function (event) {
                // Vérifiez si la touche pressée est le "Backspace" (code 8)
                if (event.keyCode === 8 && !isTyping) {
                    // Empêchez le comportement par défaut du navigateur (par exemple, le retour en arrière)
                    event.preventDefault();

                    // Utilisez window.history pour revenir à la page précédente
                    window.history.back();
                }
            });
        });

            document.addEventListener('alpine:init', () => {
                Alpine.directive('animated-collapse', (el, { expression }, { evaluateLater, effect }) => {
                let get = evaluateLater(expression);

                el.style.transition = 'all 0.3s ease-in-out';
                el.style.transformOrigin = 'top';
                el.style.overflow = 'hidden';

                effect(() => {
                    get(value => {
                        if (value) {
                            el.style.display = 'block';
                            requestAnimationFrame(() => {
                                el.style.opacity = 1;
                                el.style.transform = 'scaleY(1)';
                                el.style.maxHeight = el.scrollHeight + 'px';
                            });
                        } else {
                            el.style.opacity = 0;
                            el.style.transform = 'scaleY(0.8)';
                            el.style.maxHeight = '0px';
                            setTimeout(() => {
                                if (el.style.opacity == 0) {
                                    el.style.display = 'none';
                                }
                            }, 300);
                        }
                    });
                });
            });
    })
</script>
</html>

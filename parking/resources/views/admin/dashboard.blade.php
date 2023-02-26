<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/69c46c92d5.js" crossorigin="anonymous"></script>
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    <!-- Tailwind UI font -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- JavaScript -->
    @vite('resources/js/app.js')
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Parking</title>
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="flex flex-row bg-spanish-gray" x-data="{creerUtilisateur : false, optionsUtilisateur : false, validerSuppressionPlace : false}">

    <x-modal nom="creerUtilisateur"/>
    <x-modal nom="optionsUtilisateur" />
    <x-modal nom="validerSuppressionPlace" />

    <x-dashboard.sidebar :user="$user"/>

    <!-- Dashboard -->
    <div class="w-full h-fit xl:h-screen sm:max-lg:ml-36 text-clip grow flex flex-col bg-timberwolf max-lg:static">
            
        <!-- Navigation supérieure -->
        <x-dashboard.top-nav titre="Administration" />

        <!-- Contenu -->
        <div class="w-full h-full xl:h-full p-10 flex flex-col xl:justify-around xl:grid xl:grid-cols-2 xl:grid-rows-2 xl:gap-10 bg-timberwolf">

                <!-- Utilisateurs -->
                <div class="w-full h-fit flex flex-col rounded-xl bg-white text-black shadow-lg xl:col-span-1">
                    <h1 class="text-xl my-5 px-5">Utilisateurs - <span>{{ $utilisateurs->count()}}</span></h1>
                    <div class="h-44 px-5 overflow-auto scrollbar-thin scrollbar-thumb-spanish-gray scrollbar-track-grey">
                        <table class="table-fixed w-full">
                            <tbody class="">
                                @foreach($utilisateurs as $utilisateur)
                                <tr class="w-full h-fit mb-3 last:mb-0 px-5 py-3 hover:bg-grey border-timberwolf hover:border-3 border-2 rounded-lg flex flex-row justify-between items-center">
                                    <td class="w-1/2 flex flex-row">
                                        <div class="w-12 h-12 mr-5 bg-middle-grey flex flex-col justify-end align-bottom items-end rounded-full"></div> 
                                        <div class="h-12 flex flex-row items-center">
                                            <span>{{ $utilisateur->prenom_utilisateur}}&nbsp;</span>
                                            <span>{{ $utilisateur->nom_utilisateur}}</span>
                                        </div>
                                    </td>
                                    @if( $utilisateur->est_actif)
                                    <td class="w-1/4 text-xs sm:text-base px-2 "><span class="bg-lavande/25 text-black text-xs py-1 px-2 rounded-lg">Actif</span></td>
                                    @else
                                    <td class="w-1/4 text-xs sm:text-base px-2 "><span class="bg-coquelicot/25 text-black text-xs py-1 px-2 rounded-lg">Inactif</span></td>
                                    @endif
                                    <td class="flex justify-center items-center font-bold">
                                        <button type="button" @@click="optionsUtilisateur = true, $refs.desactiver_user_btn.setAttribute('form', 'desactiver_{{$utilisateur->id}}')">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                    </td>
                            </tr>
                            <form action="{{ route('admin.desactiver_utilisateur')}}" id="desactiver_{{$utilisateur->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $utilisateur->id}}">
                            </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="w-full p-5 flex flex-row justify-end">
                        <button type="button" class="bg-grey px-2 py-1 shadow rounded-lg" @@click="creerUtilisateur = true">
                            <i class="fa-solid fa-plus p-1"></i>
                            <span>Ajouter</span>
                        </button>
                    </div>
                </div>

                <!-- Places -->
                <div class="w-full h-fit flex flex-col rounded-xl bg-white text-black shadow-lg xl:col-span-1 px-3">
                    <h1 class="text-xl my-5 px-5">Places</h1>
                    <div class="h-44 rounded-lg overflow-auto scrollbar-thin scrollbar-thumb-spanish-gray scrollbar-track-grey border-2 border-timberwolf">
                        <table class="table-auto w-full">
                            <thead class="">
                                <tr class="bg-grey">
                                    <th class="text-xs sm:text-base py-2">ID</th>
                                    <th class="text-xs sm:text-base py-2">Statut</th>
                                    <th class="text-xs sm:text-base py-2"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($places as $place)
                                    <tr class="text-center ease-in-out border-y-2 last:border-b-0 border-timberwolf bg-white group">
                                        <td class="text-xs sm:text-base py-2">#{{ $place->id }}</td>
                                        @if($place->est_occupee)
                                        <td class="text-xs sm:text-base py-2 "><span class="bg-coquelicot/25 text-xs  py-1 px-2 rounded-lg">Occupée</span></td>
                                        @else 
                                        <td class="text-xs sm:text-base py-2 "><span class="bg-lavande/25  text-xs py-1 px-2 rounded-lg">Disponible</span></td>
                                        @endif
                                        <td class="text-xs sm:text-base py-2">
                                            <button x-on:click="validerSuppressionPlace = true">
                                                <i class="fa-solid fa-xmark text-sm"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-full p-5 flex flex-row justify-end">
                        <a href="#" class="bg-grey px-2 py-1 shadow rounded-lg">
                            <i class="fa-solid fa-plus p-1"></i>
                            <span>Ajouter</span>
                        </a>
                    </div>
                </div>
            

           <!-- Reservations -->
            <div class="xl:h-full xl:col-span-2">
                <x-cards.liste-reservations :reservations="$reservations" />
            </div>
        </div>
    </div>
</body>

</html>
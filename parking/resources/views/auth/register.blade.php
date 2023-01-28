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
    <title>Inscription</title>
</head>

<body class="bg-beige h-screen w-screen flex flex-col justify-center align-middle items-center">

    <!-- Conteneur boutons en haut de l'écran -->
    <div class="w-full h-1/6 p-6 flex flex-row justify-end">
        <a href="{{ route('login') }}" class="w-fit h-fit mr-5 text-base text-black border-b-black border-b-solid hover:border-b-middle-grey hover:text-middle-grey">Connexion</a>
    </div>

    <!-- Conteneur formulaire de login -->
    <div class="grow w-full h-5/6 flex flex-col justify-start align-middle items-center">

        <!-- Conteneur du "logo" de l'application -->
        <div class="w-2/6 h-fit mt-10 flex flex-row align-middle justify-center items-center">
            <i class=" fa-solid fa-car-side text-middle-grey text-2xl"></i>
            <h1 class="m-3 text-2xl">Parking</h1>
        </div>

        <!-- Conteneur de la "card" de connexion -->
        <div class="h-fit w-2/6 p-6 pb-8  text-black bg-white opacity-75 rounded-3xl shadow-lg">
            <!-- Titre du formulaire -->
            <h2 class="text-xl">Inscription</h2>
            <!-- Formulaire d'inscription -->
            <form action="{{ route('inscription.store') }}" method="post" class="h-full w-full flex flex-col justify-start">

                @csrf

                <fieldset class="my-4">
                    <label for="nom_utilisateur">Nom</label>
                    <input type="text" name="nom_utilisateur" class="w-full h-7 px-2 text-sm opacity-60 rounded-md border 
                        border-middle-grey focus:outline-none focus:border-black
                        focus:ring-1 focus:ring-middle-grey">
                        @error('nom_utilisateur')
                            <span class="my-3">
                                <i class="fa-solid fa-exclamation w-4 h-4 pt-px text-xs text-white bg-coquelicot text-center rounded-full"></i>
                                {{ $message}}
                            </span>
                        @enderror
                </fieldset>


                <fieldset class="mb-4">
                    <label for="prenom_utilisateur">Prénom</label>
                    <input type="text" name="prenom_utilisateur" class="w-full h-7 px-2 text-sm opacity-60 rounded-md border 
                        border-middle-grey focus:outline-none focus:border-black
                        focus:ring-1 focus:ring-middle-grey">
                         @error('prenom_utilisateur')
                            <span class="my-3">
                                <i class="fa-solid fa-exclamation w-4 h-4 pt-px text-xs text-white bg-coquelicot text-center rounded-full"></i>
                                {{ $message}}
                            </span>
                        @enderror               
                    </fieldset>

                <fieldset class="mb-4">
                    <label for="username">Nom d'utilisateur</label><br>
                    <input type="text" name="username" class="w-full h-7 px-2  text-sm opacity-50 rounded-md border 
                        border-middle-grey focus:outline-none focus:border-black
                        focus:ring-1 focus:ring-middle-grey">
                        @error('username')
                            <span class="my-3">
                                <i class="fa-solid fa-exclamation w-4 h-4 pt-px text-xs text-white bg-coquelicot text-center rounded-full"></i>
                                {{ $message}}
                            </span>
                        @enderror               
                </fieldset>

                <fieldset class="mb-4">
                    <label for="password">Mot de passe</label><br>
                    <input type="password" name="password" class="w-full h-7 px-2 opacity-50 rounded-md border 
                        border-middle-grey focus:outline-none focus:border-black
                        focus:ring-1 focus:ring-middle-grey">
                        @error('password')
                            <span class="my-3">
                                <i class="fa-solid fa-exclamation w-4 h-4 pt-px text-xs text-white bg-coquelicot text-center rounded-full"></i>
                                {{ $message}}
                            </span>
                        @enderror               
                </fieldset>

                <fieldset class="mb-4">
                    <label for="password_confirmation">Confirmer le mot de passe</label><br>
                    <input type="password" name="password_confirmation" class="w-full h-7 px-2 opacity-50 rounded-md border 
                        border-middle-grey focus:outline-none focus:border-black
                        focus:ring-1 focus:ring-middle-grey">
                        @error('password_confirmation')
                            <span class="my-3">
                                <i class="fa-solid fa-exclamation w-4 h-4 pt-px text-xs text-white bg-coquelicot text-center rounded-full"></i>
                                {{ $message}}
                            </span>
                        @enderror               
                </fieldset>

                <div class="mb-5 flex flex-row justify-center justify-self-end grow">
                    <button type="submit" class="p-2 w-fit h-fit rounded-lg bg-middle-grey hover:opacity-80 text-white shadow-md 
                        flex flex-col justify-center self-end">
                        S'inscrire
                    </button>
                </div>
            </form>

        </div>

    </div>

</body>

</html>
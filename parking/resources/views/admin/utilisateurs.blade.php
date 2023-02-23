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
    <title>Parking</title>
</head>

<body class="flex flex-row bg-spanish-gray">

    <x-dashboard.sidebar :user="$user" />

    <!-- Dashboard -->
    <div class="w-full h-fit xl:h-screen sm:max-lg:ml-36 text-clip grow flex flex-col bg-timberwolf max-lg:static">
            
        <!-- Navigation supérieure -->
        <x-dashboard.top-nav titre="Gestion des utilisateurs" />

        <!-- Contenu -->
        <div class="w-full h-full p-10 xl:pb-0 flex flex-col xl:flex-row xl:justify-around">

            <!-- Colonne de droite -->
            <div class="xl:w-1/2 xl:pr-10 flex flex-col justify-start">
                <x-validation-inscriptions :utilisateurs="$utilisateurs" />
            </div>
            <!-- Colonne de gauche -->
            <div class="xl:w-1/2 xl:pr-10 flex flex-col">
            </div>
            
        </div>
</body>

</html>
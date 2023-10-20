<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<head>
    <title>Gestion Films</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-white shadow dark:bg-gray-800">
        <div class="container flex items-center justify-between p-6 mx-auto text-gray-600 capitalize dark:text-gray-300">
            <div> 
                <?= $_SESSION['username'] ?> 
            </div>
            <div class="flex items-center justify-center">
                <a href= "/gestion_films/Films/Dashboard" class="border-b-2 border-transparent text-gray-800 hover:border-blue-500 mx-1.5 sm:mx-6">Dashboard</a>
                <a href= "/gestion_films/Films/Add" class="border-b-2 border-transparent hover:text-gray-800 hover:border-blue-500 mx-1.5 sm:mx-6">Ajouter un Film</a>
                <a href= "/gestion_films/Disconnect" class="border-b-2 border-transparent hover:text-gray-800 hover:border-blue-500 mx-1.5 sm:mx-6">Déconnexion</a>
            </div>
        </div>
    </nav>
    <main>
        <?= $content ?>
    </main> 
</body>

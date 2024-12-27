<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Members</title>
</head>

<body class="flex bg-gray-100">
    <header>
        <!-- Sidebar -->
        <aside class="absolute top-0 left-0 h-screen w-44 bg-green-400 p-6 z-10">
            <button onclick="window.location.href='login.php'"
                class="w-full bg-white text-green-600 mt-2 px-4 py-2 rounded-lg shadow hover:bg-green-50 transition-colors duration-200">
                connexion
            </button>
            <button onclick="window.location.href='register.php'"
                class="w-full bg-white text-green-600 mt-2 px-4 py-2 rounded-lg shadow hover:bg-green-50 transition-colors duration-200">
                inscription
            </button>
        </aside>
    </header>

    <!-- Main Content -->
    <main class="ml-44 w-full h-screen p-8 bg-cover bg-center" style="background-image: url('/asset/hero.jpg');">
        <div class="max-w-full bg-white bg-opacity-80 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="px-4 py-4 border-b border-gray-200 hidden">
                <!-- <h2 class="text-2xl font-semibold text-gray-800">Members</h2> -->
            </div>
        </div>
    </main>
</body>

</html>
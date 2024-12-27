<?php
include $_SERVER['DOCUMENT_ROOT'] . '/classes/users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['f_Name'];
    $prenom = $_POST['l_Name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $msg = null;
    $user = new User();
    $result = $user->register($nom, $prenom, $email, $password);

    if ($result) {
        $msg =  "Inscription réussie. Vous pouvez maintenant vous connecter.";
    } else {
        $msg =  "Erreur lors de l'inscription.";
    }
}
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
        <!-- Modale for Inscription -->
        <div id="inscriptionModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                <div class="flex space-x-56">
                    <h3 class="text-xl font-semibold text-gray-800">Inscription</h3>
                    <span onclick="window.location.href='index.php'" class="ml-4 text-red-500 text-3xl cursor-pointer">&times;</span>
                </div>
                <div><?php echo $msg; ?></div>
                <form action="" method="POST" class="mt-4">
                    <div class="flex space-x-4">
                        <div class="space-y-2">
                            <label for="f_Name" class="block text-gray-700">First Name</label>
                            <input type="text" id="f_Name" name="f_Name" class="w-full p-2 border border-gray-300 rounded-lg mt-2">
                        </div>
                        <div class="space-y-2">
                            <label for="l_Name" class="block text-gray-700">Last Name</label>
                            <input type="text" id="l_Name" name="l_Name" class="w-full p-2 border border-gray-300 rounded-lg mt-2">
                        </div>
                    </div>

                    <label for="email" class="block text-gray-700 mt-4">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg mt-2">

                    <label for="password" class="block text-gray-700 mt-4">Password</label>
                    <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg mt-2">

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </main>


</body>

</html>
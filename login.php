<?php
include $_SERVER['DOCUMENT_ROOT'] . '/classes/users.php';
$msg = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $authenticatedUser = $user->login($email, $password);

    if ($authenticatedUser) {
        // Vérifier le rôle de l'utilisateur et le rediriger vers le tableau de bord
        if ($authenticatedUser['role'] == 'Admin') {
            header("Location: views/dashboard_a.php");
            exit;
        } else {
            header("Location: views/dashboard_m.php");
            exit;
        }
    } else {
        $msg = "email ou mot de passe incorrect.";
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
            <button onclick="window.location.href='clogin.php'"
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
        <!-- Modale for Connexion -->
        <div id="connexionModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                <div class="flex space-x-56">
                    <h3 class="text-xl font-semibold text-gray-800">Connexion</h3>
                    <span onclick="window.location.href='index.php'" class="ml-4 text-red-500 text-3xl cursor-pointer">&times;</span>
                </div>
                <div><?php echo $msg; ?></div>
                <form method="POST" class="mt-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg mt-2">

                    <label for="password" class="block text-gray-700 mt-4">Password</label>
                    <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg mt-2">

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
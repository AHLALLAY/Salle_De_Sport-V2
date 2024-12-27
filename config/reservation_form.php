

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ajouter une réservation</title>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Nouvelle Réservation</h2>
        
        <form method="POST" action="" class="space-y-4">
            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" 
                       id="nom" 
                       name="nom" 
                       required 
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            
            <!-- Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" 
                       id="prenom" 
                       name="prenom" 
                       required 
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            
            <!-- Activité -->
            <div>
                <label for="activite" class="block text-sm font-medium text-gray-700">Activité</label>
                <select id="activite" 
                        name="activite" 
                        required 
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Sélectionner une activité</option>
                    <?php 
                        while($activity = mysqli_fetch_assoc($activities)) { 
                            echo '<option value="'.htmlspecialchars($activity['id_activite']).'">' 
                                 .htmlspecialchars($activity['nom']).'</option>';
                        } 
                    ?>
                </select>
            </div>
            
            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Réserver
                </button>
            </div>
        </form>

        <!-- Retour button -->
        <div class="mt-4">
            <a href="../index.php" 
               class="block w-full text-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow hover:bg-gray-300 transition-colors duration-200">
                Retour
            </a>
        </div>
    </div>
</body>
</html>
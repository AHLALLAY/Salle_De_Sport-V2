<?php

include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/classes/Database.php';

class User {
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct() {
        $this->db = Database::getConnection(); // Utilise la classe Database pour la connexion
    }

    // Inscription de l'utilisateur
    public function register($nom, $prenom, $email, $password, $role = 'Membre') {
        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'email fourni n'est pas valide.");
        }
    
        // Vérifier si l'email existe déjà dans la base de données
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $emailExists = $stmt->fetchColumn();
    
        if ($emailExists > 0) {
            // L'email existe déjà, nous ne pouvons pas enregistrer un utilisateur avec le même email
            throw new Exception("Cet email est déjà utilisé.");
        }
    
        // Hashage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Préparer la requête SQL
        $query = "INSERT INTO users (nom, prenom, email, passwords, roles) VALUES (:nom, :prenom, :email, :password, :role)";
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':role', $role);
    
            // Exécuter la requête
            if ($stmt->execute()) {
                return true;  // Enregistrement réussi
            } else {
                throw new Exception("Une erreur s'est produite lors de l'enregistrement de l'utilisateur.");
            }
        } catch (PDOException $e) {
            // En cas d'erreur avec la base de données
            throw new Exception("Erreur de base de données : " . $e->getMessage());
        }
    }
    

    // Connexion de l'utilisateur
    public function login($email, $password) {
        // Préparer la requête SQL pour récupérer l'utilisateur
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérifier si l'utilisateur existe
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['passwords'])) {
            // Si le mot de passe est correct, retourner l'utilisateur et son rôle
            return $user;
        }
        return false;
    }
}

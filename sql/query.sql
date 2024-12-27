-- Création de la base de données
CREATE DATABASE IF NOT EXISTS salle_de_sport;

-- Utilisation de la base de données
USE test;

-- Suppression des tables si elles existent (dans l'ordre inverse des dépendances)
-- DROP TABLE IF EXISTS annulation;
-- DROP TABLE IF EXISTS reservation;
-- DROP TABLE IF EXISTS activite;
-- DROP TABLE IF EXISTS users;


-- Table des membres
CREATE TABLE users (
    id_users INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    passwords VARCHAR(100),
    roles ENUM('Admin', 'Membre') DEFAULT 'Membre'
);

CREATE TABLE membres (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    telephone VARCHAR(15) NOT NULL,
    date_naissance DATE NOT NULL,
    date_inscription DATE NOT NULL DEFAULT CURRENT_DATE,
    statut ENUM('Actif', 'Inactif', 'Suspendu') NOT NULL DEFAULT 'Actif',
    id_users INT,
    Foreign Key (id_users) REFERENCES users(id_users)
);
-- Table des activités
CREATE TABLE activite (
    id_activite INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    capacite INT NOT NULL,
    statut ENUM('En cours', 'Terminé', 'Annulé') NOT NULL DEFAULT 'En cours'
);

-- Table des réservations
CREATE TABLE reservation (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    date_reservation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('Confirmé', 'Annulé', 'En attente') NOT NULL DEFAULT 'En attente',
    id_activite INT NOT NULL,
    id_users INT NOT NULL,
    FOREIGN KEY (id_activite) REFERENCES activite(id_activite) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_users) REFERENCES users(id_users) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table des annulations
CREATE TABLE annulation (
    id_annulation INT AUTO_INCREMENT PRIMARY KEY,
    date_annulation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    motif TEXT,
    id_reservation INT NOT NULL,
    FOREIGN KEY (id_reservation) REFERENCES Reservation(id_reservation) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Ajouter de colonnes aprés la créations
ALTER TABLE Activite ADD COLUMN Statut ENUM('En Cours', 'Terminer');

-- ========== CRUD POUR LA TABLE MEMBRE ==========
-- CREATE (Créer)
INSERT INTO users (nom, prenom, email, passwords, roles) VALUES
('Benali', 'Ahmed', 'ahmed.benali@example.com', '$2y$10$Vv8dL1EYf0PbXYOhjDEBzOEY7hxuN8iZ5O.IeZ4z2lOoP2NpttIWu', 'Admin'),
('El Amrani', 'Fatima', 'fatima.elamrani@example.com', '$2y$10$O4SfkVlzCvff5yTZqTk1CeGZbqA7fZuwFYsKBH5z5c6Qv1uoJ33Ge', 'Membre'),
('Bouhroum', 'Youssef', 'youssef.bouhroum@example.com', '$2y$10$S2uF5e3q8akA7HhU8s5hs6TpoH1Fw2KYBdJuwcu3uTxNB/.G9.XK2', 'Membre'),
('Ait Oumir', 'Khalid', 'khalid.aitoumir@example.com', '$2y$10$G4rU2gVxuyHlvCkhzZnOioLDzVrr5FCjMjw7oL8lk1n3kAfq7XKfq', 'Admin'),
('Brahimi', 'Samira', 'samira.brahimi@example.com', '$2y$10$Qk8b9m7kHbkaJgM3aqO4RkMZoFwfsV0xeFRA8Kmd7HlbZ/Otskh6u', 'Membre'),
('Cherradi', 'Tariq', 'tariq.cherradi@example.com', '$2y$10$XzTQyDdWz9Mz54K9ecVShxxBeKYrOitMjghA2jLRh1ovFk9n9ZJXe', 'Admin'),
('Fassi', 'Sara', 'sara.fassi@example.com', '$2y$10$J7h70OhkYDAF6eITzzkEbbZyyXUgEOZ6k5zAwr2HAXwnA4Jp.e7wq', 'Membre'),
('Rimawi', 'Imane', 'imane.rimawi@example.com', '$2y$10$u0PQhwbT4X2zGRmhkZWOUoMEKofcNz6hbzEjjCkZZ4oYZr1ZwdOua', 'Membre'),
('Tazi', 'Mohammed', 'mohammed.tazi@example.com', '$2y$10$No77rpXZTqElveZMOj45qYPHxoCqxPl2FjwxoEYdB17w3r9ZP3T66', 'Admin'),
('Hassan', 'Mouna', 'mouna.hassan@example.com', '$2y$10$8rFPVRA12h5J6z4TqOZ0pOZ1DZiAkOdzvXDEgf6Tkw1r.k1Bmcqlm', 'Membre'),
('Idrissi', 'Said', 'said.idrissi@example.com', '$2y$10$VANk8JcHKNh61g8qDqZTycbpfuJfdvYXXC2uDYWrmbsKwXWn1hDEq', 'Membre'),
('Sbaa', 'Nadia', 'nadia.sbaa@example.com', '$2y$10$1pEDM2Xy0QWmjpYFzUwX5SOFSdF.nOjZ6tbhSH5fFb0Ejg52qxz1O', 'Admin'),
('Boujane', 'Karim', 'karim.boujane@example.com', '$2y$10$EFhHvw1FwvPQFf2sEK0r1Xn6bSoOTY2LZngGbIIVuoU0RiXK1iFfC', 'Membre'),
('Khadir', 'Leila', 'leila.khadir@example.com', '$2y$10$V1zdwB7BxI.YiHO9mHozEkU9qGdo2F3ooxH3GflzvYle9.kfnGEla', 'Membre'),
('Achraf', 'Meryem', 'meryem.achraf@example.com', '$2y$10$gizXscM9X2pv3Q6oqsb5dWpQ.TlpuwHpJwVsM1pvq5wSkDTz.vPyC', 'Admin'),
('Benjelloun', 'Imane', 'imane.benjelloun@example.com', '$2y$10$nlz3aV9xtT9sGqZlWh9JKzfeWhUBmbH2DeLxLXjxM1AOxD5Zn7VK6', 'Membre'),
('Sadeq', 'Mohammed', 'mohammed.sadeq@example.com', '$2y$10$0DbHZ75uJzDfwgBrgXz0eIS9ZYmy.xcV7fsX5im62ey7LgkMjpQ16', 'Admin'),
('Jahroudi', 'Yassine', 'yassine.jahroudi@example.com', '$2y$10$OQMbZT2U8B99Lrk8h1O4Kc5nAcv2o1bh0NG0NmTw7teOeX2rfZ24S', 'Membre'),
('Othman', 'Zahra', 'zahra.othman@example.com', '$2y$10$Kh1Z3CpP1NhpwZQjY7yFv8vVlgKvLgVUzIzEON5vJ0O6XjkY9/4rq', 'Membre');


INSERT INTO membres (telephone, date_naissance, date_inscription, statut, id_users) VALUES
('0612345678', '1990-05-01', '2024-01-01', 'Actif', 1),
('0623456789', '1992-03-15', '2024-02-01', 'Actif', 2),
('0634567890', '1985-10-20', '2024-02-10', 'Actif', 3),
('0656789012', '1989-07-07', '2024-03-05', 'Actif', 4),
('0689012345', '1994-12-25', '2024-03-12', 'Actif', 5),
('0690123456', '1991-06-13', '2024-03-20', 'Actif', 6),
('0678901234', '1988-04-11', '2024-02-25', 'Actif', 7),
('0655678901', '1990-11-30', '2024-02-15', 'Actif', 8),
('0612345670', '1993-02-05', '2024-03-01', 'Actif', 9),
('0621234567', '1986-07-09', '2024-01-25', 'Actif', 10);


INSERT INTO activite (nom, date_debut, date_fin, capacite, statut) VALUES
('Yoga', '2024-01-01 07:00:00', '2024-01-01 08:00:00', 20, 'En cours'),
('Musculation', '2024-01-01 08:00:00', '2024-01-01 10:00:00', 15, 'En cours'),
('Cardio', '2024-01-01 10:00:00', '2024-01-01 11:00:00', 20, 'En cours'),
('Pilates', '2024-01-02 08:00:00', '2024-01-02 09:00:00', 18, 'En cours'),
('Stretching', '2024-01-02 09:00:00', '2024-01-02 10:00:00', 15, 'En cours'),
('Zumba', '2024-01-02 10:30:00', '2024-01-02 11:30:00', 25, 'En cours'),
('Cyclisme', '2024-01-03 07:00:00', '2024-01-03 08:00:00', 20, 'En cours'),
('Boxe', '2024-01-03 09:00:00', '2024-01-03 10:00:00', 15, 'En cours'),
('Body Pump', '2024-01-03 10:00:00', '2024-01-03 11:00:00', 20, 'En cours'),
('Bootcamp', '2024-01-04 06:30:00', '2024-01-04 07:30:00', 30, 'En cours');

INSERT INTO reservation (date_reservation, statut, id_activite, id_users) VALUES
('2024-01-01 06:30:00', 'Confirmé', 1, 2),
('2024-01-02 07:00:00', 'Confirmé', 2, 3),
('2024-01-03 10:30:00', 'Confirmé', 3, 4),
('2024-01-04 09:00:00', 'Confirmé', 4, 5),
('2024-01-05 11:00:00', 'Confirmé', 5, 6);

INSERT INTO annulation (date_annulation, motif, id_reservation) VALUES
('2024-01-10 12:00:00', 'Motif personnel', 1),
('2024-01-12 14:00:00', 'Problèmes de santé', 2),
('2024-01-14 15:00:00', 'Problèmes de planning', 3),
('2024-01-18 16:00:00', 'Autre engagement', 4),
('2024-01-20 18:00:00', 'Changement de programme', 5);

-- READ (Lire)
-- Lire tous les membres
SELECT * FROM Membre;
-- Lire un membre spécifique
SELECT * FROM Membre WHERE id_membre = 1;
-- Lire avec condition
SELECT * FROM Membre WHERE statut = 'Actif';

-- UPDATE (Mettre à jour)
UPDATE Membre 
SET telephone = '0687654321',email = 'nouvelle.email@email.com' 
WHERE id_membre = 1;

-- DELETE (Supprimer)
DELETE FROM Membre WHERE id_membre = 1;
-- ===============================================

-- Lire les réservations avec détails
SELECT r.*, m.nom, m.prenom, a.nom as activite_nom
FROM Reservation r
JOIN Membre m ON r.id_membre = m.id_membre
JOIN Activite a ON r.id_activite = a.id_activite;
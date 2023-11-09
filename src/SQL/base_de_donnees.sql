DROP DATABASE IF EXISTS sae_bd;
CREATE DATABASE sae_bd;
USE sae_bd;

-- Entités principales :
-- Utilisateur
-- Administrateur système
-- Administrateur web
-- Technicien
-- Ticket
-- Catégorie de problème
-- Statut du ticket
-- Niveau d'urgence
-- Journal d'activité
-- Historique des tickets
-- Adresse IP

-- Relations entre les entités :

-- Un Utilisateur peut avoir plusieurs Tickets (1-N)
-- Un Administrateur web peut gérer plusieurs Catégories de problème (1-N)
-- Un Administrateur web peut gérer plusieurs Statuts de ticket (1-N)
-- Un Administrateur web peut gérer plusieurs Niveaux d'urgence (1-N)
-- Un Administrateur web peut créer plusieurs Comptes Techniciens (1-N)

-- Un Ticket peut être attribué à un Technicien (N-1)
-- Un Ticket peut avoir un Statut de ticket (N-1)
-- Un Ticket peut avoir un Niveau d'urgence (N-1)
-- Un Ticket peut générer un Journal d'activité (1-N)

-- Un Utilisateur peut avoir un Historique de tickets (1-N)

-- Un Journal d'activité est associé à un Utilisateur (N-1)
-- Un Journal d'activité est associé à un Ticket (N-1)
-- Un Journal d'activité est associé à une Adresse IP (N-1)

-- Les Tickets fermés sont archivés dans l'Historique des tickets (1-N)

-- Supprimer les tables si elles existent :
DROP TABLE IF EXISTS HistoriqueTickets;
DROP TABLE IF EXISTS NiveauUrgence;
DROP TABLE IF EXISTS StatutTicket;
DROP TABLE IF EXISTS CategorieProbleme;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Technicien;
DROP TABLE IF EXISTS AdminWeb;
DROP TABLE IF EXISTS AdminSysteme;
DROP TABLE IF EXISTS Utilisateur;

-- Création des tables

-- Table Utilisateurs :
CREATE TABLE Utilisateur (
    id_util INTEGER PRIMARY KEY AUTO_INCREMENT,
    identifiant VARCHAR(20) NOT NULL,
    nom_util VARCHAR(50) NOT NULL,
    prenom_util VARCHAR(50) NOT NULL,
    email_util VARCHAR(100) NOT NULL UNIQUE,
    mdp VARCHAR(20) NOT NULL,
    type_util VARCHAR(30) NOT NULL
);

-- Table Administrateurs_Système :
CREATE TABLE AdminSysteme (
    id_adminsys INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_adminsys VARCHAR(50) NOT NULL,
    prenom_adminsys VARCHAR(50) NOT NULL,
    identifiant VARCHAR(30) NOT NULL,
    mdp VARCHAR(20) NOT NULL
);

-- Table Administrateurs_Web :
CREATE TABLE AdminWeb (
    id_adminw INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_adminw VARCHAR(50) NOT NULL,
    prenom_adminw VARCHAR(50) NOT NULL,
    identifiant VARCHAR(30) NOT NULL,
    mdp VARCHAR(20) NOT NULL
);

-- Table Techniciens :
CREATE TABLE Technicien (
    id_tech INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_tech VARCHAR(50) NOT NULL,
    prenom_tech VARCHAR(50) NOT NULL,
    identifiant VARCHAR(30) NOT NULL,
    mdp VARCHAR(20) NOT NULL
);
-- Table Catégories de Problème :
CREATE TABLE CategorieProbleme (
    id_cat_pb INTEGER PRIMARY KEY AUTO_INCREMENT,
    libelle_cat_pb VARCHAR(50) NOT NULL
);

-- Table Statuts de Ticket :
CREATE TABLE StatutTicket (
    id_status_tic INTEGER PRIMARY KEY AUTO_INCREMENT,
    libelle_status_tic VARCHAR(50) NOT NULL
);

-- Table Niveaux d'Urgence :
CREATE TABLE NiveauUrgence (
    id_nv_urgence INTEGER PRIMARY KEY AUTO_INCREMENT,
    libelle_nv_urgence VARCHAR(50) NOT NULL
);

-- Table l'Historique des Tickets :
CREATE TABLE HistoriqueTickets (
    id_histtic INTEGER PRIMARY KEY AUTO_INCREMENT,
    archive_tic INTEGER NOT NULL CHECK (archive_tic IN (0, 1)),
    date_archivage DATE DEFAULT CURRENT_DATE NOT NULL
);



-- Table Tickets :
CREATE TABLE Ticket (
                        id_tic INTEGER PRIMARY KEY AUTO_INCREMENT,
                        desc_pb_tic VARCHAR(255) NOT NULL,
                        date_crea_tic DATE DEFAULT CURRENT_DATE NOT NULL,
                        date_maj_tic DATE,
                        createur_tic INTEGER NOT NULL REFERENCES Utilisateur(id_util),
                        tech_charge_tic INTEGER NOT NULL REFERENCES Technicien(id_tech),
                        status_tic INTEGER NOT NULL REFERENCES StatutTicket(id_status_tic),
                        nv_urgence_tic INTEGER NOT NULL REFERENCES NiveauUrgence(id_nv_urgence)
);

-- TRIGGER :
DELIMITER //
CREATE TRIGGER trig_check_urgence
    BEFORE INSERT ON Ticket
    FOR EACH ROW
BEGIN
    IF NOT NEW.nv_urgence_tic IN (1, 2, 3, 4) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La valeur de nv_urgence_tic doit être entre 1 et 4';
END IF;
END;
//
DELIMITER ;



-- Insérer des données fictives dans la table Utilisateur
INSERT INTO Utilisateur (id_util, identifiant, nom_util, prenom_util, email_util, mdp, type_util) VALUES
(1,'util1', 'Doe', 'John', 'john.doe@example.com', 'motdepasse1', 'Utilisateur'),
(2,'util2', 'Smith', 'Alice', 'alice.smith@example.com', 'motdepasse2', 'Utilisateur'),
(3,'util3', 'Johnson', 'Bob', 'bob.johnson@example.com', 'motdepasse3', 'Utilisateur');

-- Insérer des données fictives dans la table AdminSysteme
INSERT INTO AdminSysteme (id_adminsys, nom_adminsys, prenom_adminsys, identifiant, mdp) VALUES
    (1, 'AdminSys1', 'AdminSys1', 'adminsys1', 'motdepasseadmin1');

-- Insérer des données fictives dans la table AdminWeb
INSERT INTO AdminWeb (id_adminw, nom_adminw, prenom_adminw, identifiant, mdp) VALUES
    (1, 'AdminWeb1', 'AdminWeb1', 'gestion', '#gestion#');

-- Insérer des données fictives dans la table Technicien
INSERT INTO Technicien (id_tech, nom_tech, prenom_tech, identifiant, mdp) VALUES
                                                                                        (1, 'Tech1', 'Tech1', 'tech1', 'motdepassetech1'),
                                                                                        (2, 'Tech2', 'Tech2', 'tech2', 'motdepassetech2');

-- Insérer des données fictives dans la table CatégorieProbleme
INSERT INTO CategorieProbleme (id_cat_pb, libelle_cat_pb) VALUES
                                                              (1, 'Catégorie 1'),
                                                              (2, 'Catégorie 2'),
                                                              (3, 'Catégorie 3');

-- Insérer des données fictives dans la table StatutTicket
INSERT INTO StatutTicket (id_status_tic, libelle_status_tic) VALUES
                                                                 (1, 'Ouvert'),
                                                                 (2, 'Fermé'),
                                                                 (3, 'En attente');

-- Insérer des données fictives dans la table NiveauUrgence
INSERT INTO NiveauUrgence (id_nv_urgence, libelle_nv_urgence) VALUES
                                                                  (1, 'Urgence faible'),
                                                                  (2, 'Urgence modérée'),
                                                                  (3, 'Urgence élevée'),
                                                                  (4, 'Urgence critique');

-- Insérer des données fictives dans la table Ticket
INSERT INTO Ticket (id_tic, desc_pb_tic, createur_tic, tech_charge_tic, status_tic, nv_urgence_tic, date_maj_tic)
VALUES (1, 'Problème 1', 1, 1, 1, 3, CURRENT_DATE),
       (2, 'Problème 2', 2, 2, 1, 2, CURRENT_DATE),
       (3, 'Problème 3', 3, 1, 3, 1, CURRENT_DATE);

-- Insérer des données fictives dans la table HistoriqueTickets
INSERT INTO HistoriqueTickets (id_histtic, archive_tic) VALUES
                                                            (1, 1),
                                                            (2, 1),
                                                            (3, 0);

-- AFFICHER LES TABLES :
SELECT * FROM Utilisateur;
SELECT * FROM AdminSysteme;
SELECT * FROM AdminWeb;
SELECT * FROM Technicien;
SELECT * FROM Ticket;
SELECT * FROM CategorieProbleme;
SELECT * FROM StatutTicket;
SELECT * FROM NiveauUrgence;
SELECT * FROM HistoriqueTickets;






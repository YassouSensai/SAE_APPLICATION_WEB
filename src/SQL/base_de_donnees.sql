DROP DATABASE IF EXISTS sae_bd;
CREATE DATABASE sae_bd;

DROP USER 'user_sae'@'localhost';
CREATE USER 'user_sae'@'localhost' IDENTIFIED BY 'azerty';
GRANT ALL PRIVILEGES ON sae_bd.* TO 'user_sae'@'localhost';

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
DROP TABLE IF EXISTS JournalActivite;
DROP TABLE IF EXISTS HistoriqueTickets;
DROP TABLE IF EXISTS NiveauUrgence;
DROP TABLE IF EXISTS StatutTicket;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Technicien;
DROP TABLE IF EXISTS AdminWeb;
DROP TABLE IF EXISTS AdminSysteme;
DROP TABLE IF EXISTS Utilisateur;


-- Création des tables

-- Table Utilisateurs :
CREATE TABLE Utilisateur (
                             identifiant VARCHAR(20) PRIMARY KEY,
                             nom_util VARCHAR(50) NOT NULL,
                             prenom_util VARCHAR(50) NOT NULL,
                             email_util VARCHAR(50) NOT NULL UNIQUE,
                             mdp VARCHAR(20) NOT NULL,
                             type_util VARCHAR(30) NOT NULL
);

-- Table Administrateurs_Système :
CREATE TABLE AdminSysteme (
                              identifiant VARCHAR(30) PRIMARY KEY,
                              nom_adminsys VARCHAR(50) NOT NULL,
                              prenom_adminsys VARCHAR(50) NOT NULL,
                              mdp VARCHAR(20) NOT NULL
);

-- Table Administrateurs_Web :
CREATE TABLE AdminWeb (
                          identifiant VARCHAR(30) PRIMARY KEY,
                          nom_adminw VARCHAR(50) NOT NULL,
                          prenom_adminw VARCHAR(50) NOT NULL,
                          mdp VARCHAR(20) NOT NULL
);

-- Table Techniciens :
CREATE TABLE Technicien (
                            identifiant VARCHAR(30) PRIMARY KEY,
                            nom_tech VARCHAR(50) NOT NULL,
                            prenom_tech VARCHAR(50) NOT NULL,
                            mdp VARCHAR(20) NOT NULL
);

-- Table Statuts de Ticket :
CREATE TABLE StatutTicket (
                              id_statut_tic INTEGER PRIMARY KEY AUTO_INCREMENT,
                              libelle_statut_tic VARCHAR(50) NOT NULL
);

-- Table Niveaux d'Urgence :
CREATE TABLE NiveauUrgence (
                               id_nv_urgence INTEGER PRIMARY KEY AUTO_INCREMENT,
                               libelle_nv_urgence VARCHAR(50) NOT NULL
);

-- Table Tickets :
CREATE TABLE Ticket (
                        id_tic INTEGER PRIMARY KEY AUTO_INCREMENT,
                        objet VARCHAR(50) NOT NULL,
                        desc_pb_tic VARCHAR(255),
                        date_crea_tic DATE DEFAULT CURRENT_DATE NOT NULL,
                        adresse_ip VARCHAR(15) NOT NULL,
                        salle VARCHAR(5) NOT NULL,
                        createur_tic VARCHAR(20) NOT NULL REFERENCES Utilisateur(identifiant),
                        tech_charge_tic VARCHAR(20) REFERENCES Technicien(identifiant),
                        status_tic INTEGER NOT NULL REFERENCES StatutTicket(id_statut_tic),
                        nv_urgence_tic INTEGER NOT NULL REFERENCES NiveauUrgence(id_nv_urgence)
);

-- Table l'Historique des Tickets :
CREATE TABLE HistoriqueTickets (
                                   id_histtic INTEGER NOT NULL REFERENCES Ticket(id_tic),
                                   archive_tic INTEGER NOT NULL CHECK (archive_tic IN (0, 1)), -- 0 = non, 1 = oui
                                   date_archivage DATE DEFAULT CURRENT_DATE NOT NULL
);


CREATE TABLE JournalActivite (
                                 id_journal INTEGER PRIMARY KEY AUTO_INCREMENT,
                                 date_activite DATETIME NOT NULL,
                                 adresse_ip VARCHAR(15) NOT NULL,
                                 id_utilisateur VARCHAR(20) NOT NULL REFERENCES Utilisateur(identifiant),
                                 type_activite INTEGER NOT NULL CHECK (type_activite IN(0,1)), -- il existe que 2 type_activite : Connexion représenté par 1, Création représenté par 0
                                 description_activite TEXT NOT NULL
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

DELIMITER //
CREATE TRIGGER trig_check_activite
    BEFORE INSERT ON JournalActivite
    FOR EACH ROW
BEGIN
    IF NOT NEW.type_activite IN (0,1) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La valeur de type_activite doit être entre 0 et 1';
END IF;
END;
//
DELIMITER ;


DELIMITER //
CREATE TRIGGER trig_check_salle_ticket
    BEFORE INSERT ON Ticket
    FOR EACH ROW
BEGIN
    IF NOT NEW.salle IN ('I21', 'G21', 'G22', 'G23', 'G24', 'G25') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La salle saisi est  incorrecte';
END IF;
END;
//
DELIMITER ;



-- Insérer des données fictives dans la table Utilisateur
INSERT INTO Utilisateur (identifiant, nom_util, prenom_util, email_util, mdp, type_util) VALUES
                                                                                             ('util1', 'Doe', 'John', 'john.doe@example.com', 'motdepasse1', 'Utilisateur'),
                                                                                             ('util2', 'Smith', 'Alice', 'alice.smith@example.com', 'motdepasse2', 'Utilisateur'),
                                                                                             ('util3', 'Johnson', 'Bob', 'bob.johnson@example.com', 'motdepasse3', 'Utilisateur');

-- Insérer des données fictives dans la table AdminSysteme
INSERT INTO AdminSysteme (identifiant ,nom_adminsys, prenom_adminsys, mdp) VALUES
    ('AdminSys1', 'AdminSys1', 'adminsys1', 'motdepasseadmin1');

-- Insérer des données fictives dans la table AdminWeb
INSERT INTO AdminWeb (identifiant, nom_adminw, prenom_adminw, mdp) VALUES
    ('AdminWeb1', 'AdminWeb1', 'gestion', '#gestion#');

-- Insérer des données fictives dans la table Technicien
INSERT INTO Technicien (identifiant, nom_tech, prenom_tech, mdp) VALUES
                                                                     ('Tech1', 'Tech1', 'tech1', 'motdepassetech1'),
                                                                     ('Tech2', 'Tech2', 'tech2', 'motdepassetech2');

-- Insérer des données fictives dans la table StatutTicket
INSERT INTO StatutTicket (id_statut_tic, libelle_statut_tic) VALUES
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
INSERT INTO Ticket (id_tic, objet, desc_pb_tic, adresse_ip, salle, createur_tic, status_tic, nv_urgence_tic) VALUES
                                                                                                                 (1,'Problème urgent', 'Problème technique urgent', '127.0.0.1', 'I21', 'util1', 1, 3),
                                                                                                                 (2,'Problème sérieux', 'Problème sérieux à résoudre dans les plus bref délais', '127.0.92.1', 'G25', 'util1', 2, 3),
                                                                                                                 (3,'Petit problème ', 'Problème pas très important', '127.92.0.1', 'G23', 'util1', 3, 3);

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
SELECT * FROM StatutTicket;
SELECT * FROM NiveauUrgence;
SELECT * FROM HistoriqueTickets;
SELECT * FROM JournalActivite;





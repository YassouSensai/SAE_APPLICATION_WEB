DROP DATABASE IF EXISTS sae_bd;
CREATE DATABASE sae_bd;

CREATE USER 'user_sae'@'localhost' IDENTIFIED BY 'azerty';
GRANT ALL PRIVILEGES ON sae_bd.* TO 'user_sae'@'localhost';

USE sae_bd;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 jan. 2024 à 20:06
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `adminsysteme`
--

CREATE TABLE `adminsysteme` (
                                `identifiant` varchar(30) NOT NULL,
                                `nom_adminsys` varchar(50) NOT NULL,
                                `prenom_adminsys` varchar(50) NOT NULL,
                                `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adminsysteme`
--

INSERT INTO `adminsysteme` (`identifiant`, `nom_adminsys`, `prenom_adminsys`, `mdp`) VALUES
    ('admin', 'AdminSys1', 'adminsys1', 'DC945C63255097');

-- --------------------------------------------------------

--
-- Structure de la table `adminweb`
--

CREATE TABLE `adminweb` (
                            `identifiant` varchar(30) NOT NULL,
                            `nom_adminw` varchar(50) NOT NULL,
                            `prenom_adminw` varchar(50) NOT NULL,
                            `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adminweb`
--

INSERT INTO `adminweb` (`identifiant`, `nom_adminw`, `prenom_adminw`, `mdp`) VALUES
    ('gestion', 'AdminWeb1', 'gestion', 'DC925D7D3857DBC042');

-- --------------------------------------------------------

--
-- Structure de la table `historiquetickets`
--

CREATE TABLE `historiquetickets` (
                                     `id_histtic` int(11) NOT NULL,
                                     `archive_tic` int(11) NOT NULL CHECK (`archive_tic` in (0,1)),
                                     `date_archivage` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `historiquetickets`
--

INSERT INTO `historiquetickets` (`id_histtic`, `archive_tic`, `date_archivage`) VALUES
                                                                                    (1, 1, '2023-12-29'),
                                                                                    (2, 1, '2023-12-29'),
                                                                                    (3, 0, '2023-12-29');

-- --------------------------------------------------------

--
-- Structure de la table `journalactivite`
--

CREATE TABLE `journalactivite` (
                                   `id_journal` int(11) NOT NULL,
                                   `date_activite` datetime NOT NULL,
                                   `adresse_ip` varchar(15) NOT NULL,
                                   `id_utilisateur` varchar(20) NOT NULL,
                                   `type_activite` int(11) NOT NULL CHECK (`type_activite` in (0,1)),
                                   `description_activite` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `journalactivite`
--

INSERT INTO `journalactivite` (`id_journal`, `date_activite`, `adresse_ip`, `id_utilisateur`, `type_activite`, `description_activite`) VALUES
                                                                                                                                           (1, '2024-01-03 23:29:52', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
                                                                                                                                           (2, '2024-01-03 23:32:23', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
                                                                                                                                           (3, '2024-01-03 23:38:11', '::1', 'util1', 1, 'L\'utilisateur util1 n\'a pas pu se connecter.'),
                                                                                                                                           (4, '2024-01-03 23:39:32', '::1', 'util1', 1, 'L\'utilisateur util1 s\'est connecté avec succès !'),
                                                                                                                                           (5, '2024-01-03 23:40:32', '::1', 'util1', 0, 'L\'utilisateur util1 n\'a pas réussit a créé un ticket pour la salle G23.'),
                                                                                                                                           (6, '2024-01-04 00:26:12', '::1', 'util1', 1, 'L\'utilisateur util1 s\'est déconnecté.'),
                                                                                                                                           (7, '2024-01-04 00:26:30', '::1', 'AdminSys1', 1, 'L\'utilisateur AdminSys1 s\'est connecté avec succès !'),
                                                                                                                                           (8, '2024-01-04 00:49:51', '::1', 'AdminSys1', 1, 'L\'utilisateur AdminSys1 s\'est déconnecté.'),
                                                                                                                                           (9, '2024-01-04 21:41:55', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
                                                                                                                                           (10, '2024-01-04 21:43:41', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
                                                                                                                                           (11, '2024-01-04 21:43:58', '::1', 'AdminSys1', 1, 'L\'utilisateur AdminSys1 s\'est connecté avec succès !'),
                                                                                                                                           (12, '2024-01-04 21:44:59', '::1', 'AdminSys1', 1, 'L\'utilisateur AdminSys1 s\'est déconnecté.'),
                                                                                                                                           (13, '2024-01-04 21:45:51', '::1', 'Tech1', 1, 'L\'utilisateur Tech1 s\'est connecté avec succès !'),
                                                                                                                                           (14, '2024-01-04 21:46:35', '::1', 'Tech1', 1, 'L\'utilisateur Tech1 s\'est déconnecté.'),
                                                                                                                                           (15, '2024-01-05 22:27:43', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
                                                                                                                                           (16, '2024-01-05 22:29:43', '::1', 'test', 0, 'L\'utilisateur test n\'a pas réussit a créé un ticket pour la salle G22.'),
                                                                                                                                           (17, '2024-01-05 22:34:35', '::1', 'test', 0, 'L\'utilisateur test n\'a pas réussit a créé un ticket pour la salle I21.'),
                                                                                                                                           (18, '2024-01-05 22:34:51', '::1', 'test', 0, 'L\'utilisateur test n\'a pas réussit a créé un ticket pour la salle I21.'),
                                                                                                                                           (19, '2024-01-05 22:35:06', '::1', 'test', 0, 'L\'utilisateur test s\'est trompé de mot de passe pour créé un ticket.'),
                                                                                                                                           (20, '2024-01-05 22:40:49', '::1', 'test', 0, 'L\'utilisateur test a créé un ticket pour la salle I21.'),
(21, '2024-01-06 00:17:27', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
(22, '2024-01-06 00:17:47', '::1', 'gestion', 1, 'L\'utilisateur gestion n\'a pas pu se connecter.'),
(23, '2024-01-06 00:18:11', '::1', 'AdminWeb1', 1, 'L\'utilisateur AdminWeb1 s\'est connecté avec succès !'),
(24, '2024-01-06 21:25:41', '::1', 'AdminWeb1', 1, 'L\'utilisateur AdminWeb1 s\'est connecté avec succès !'),
(25, '2024-01-07 22:31:06', '::1', 'AdminWeb1', 1, 'L\'utilisateur AdminWeb1 s\'est connecté avec succès !'),
(26, '2024-01-07 23:18:13', '::1', 'AdminWeb1', 1, 'L\'utilisateur AdminWeb1 s\'est déconnecté.'),
(27, '2024-01-07 23:18:32', '::1', 'gestion', 1, 'L\'utilisateur gestion s\'est connecté avec succès !'),
(28, '2024-01-07 23:21:16', '::1', 'gestion', 1, 'L\'utilisateur gestion s\'est déconnecté.'),
(29, '2024-01-07 23:22:55', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
(30, '2024-01-07 23:22:57', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
(31, '2024-01-07 23:26:06', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
(32, '2024-01-07 23:30:44', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
(33, '2024-01-08 22:03:53', '::1', 'admin', 1, 'L\'utilisateur admin s\'est connecté avec succès !'),
(34, '2024-01-08 22:38:56', '::1', 'NULL', 1, 'L\'utilisateur admin s\'est déconnecté.'),
(35, '2024-01-08 22:39:14', '::1', 'NULL', 1, 'L\'utilisateur admin s\'est connecté avec succès !'),
(36, '2024-01-08 22:43:14', '::1', 'NULL', 1, 'L\'utilisateur admin s\'est déconnecté.'),
(37, '2024-01-08 23:13:14', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est connecté avec succès !'),
(38, '2024-01-08 23:16:59', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 10.'),
(39, '2024-01-08 23:21:42', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 11.'),
(40, '2024-01-08 23:30:24', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 8.'),
(41, '2024-01-08 23:33:30', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 9.'),
(42, '2024-01-08 23:35:07', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 7.'),
(43, '2024-01-08 23:35:17', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est déconnecté.'),
(44, '2024-01-08 23:35:30', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est connecté avec succès !'),
(45, '2024-01-08 23:35:41', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 3.'),
(46, '2024-01-08 23:37:48', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 4.'),
(47, '2024-01-08 23:46:54', '::1', 'NULL', 0, 'L\'administrateur web a attribué le ticket avec l\'ID 5 au technicien tech2.'),
(48, '2024-01-08 23:47:45', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est déconnecté.'),
(49, '2024-01-08 23:47:54', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
(50, '2024-01-08 23:48:13', '::1', 'test', 0, 'L\'utilisateur test a créé un ticket pour la salle I21.'),
                                                                                                                                           (51, '2024-01-08 23:48:24', '::1', 'test', 0, 'L\'utilisateur test a créé un ticket pour la salle I21.'),
(52, '2024-01-08 23:48:31', '::1', 'test', 0, 'L\'utilisateur test a créé un ticket pour la salle I21.'),
                                                                                                                                           (53, '2024-01-08 23:48:33', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
                                                                                                                                           (54, '2024-01-08 23:48:58', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est connecté avec succès !'),
                                                                                                                                           (55, '2024-01-08 23:50:33', '::1', 'NULL', 0, 'L\'administrateur web a attribué le ticket avec l\'ID 12 au technicien tech2.'),
                                                                                                                                           (56, '2024-01-09 00:05:58', '::1', 'NULL', 1, 'L\'administrateur web a inscrit un nouveau technicien avec l\'identifiant tech3.'),
                                                                                                                                           (57, '2024-01-09 00:06:07', '::1', 'NULL', 0, 'L\'administrateur web a attribué le ticket avec l\'ID 13 au technicien tech3.'),
                                                                                                                                           (58, '2024-01-09 12:09:19', '::1', 'Yaya2004', 1, 'L\'utilisateur Yaya2004 s\'est connecté avec succès !'),
                                                                                                                                           (59, '2024-01-09 12:09:47', '::1', 'Yaya2004', 1, 'L\'utilisateur Yaya2004 s\'est déconnecté.'),
                                                                                                                                           (60, '2024-01-09 12:10:09', '::1', 'NULL', 1, 'L\'utilisateur admin s\'est connecté avec succès !'),
                                                                                                                                           (61, '2024-01-09 12:19:44', '::1', 'NULL', 1, 'L\'utilisateur admin s\'est déconnecté.'),
                                                                                                                                           (62, '2024-01-09 12:20:34', '::1', 'Yaya2004', 1, 'L\'utilisateur Yaya2004 s\'est connecté avec succès !'),
                                                                                                                                           (63, '2024-01-09 12:25:16', '::1', 'Yaya2004', 0, 'L\'utilisateur Yaya2004 a créé un ticket pour la salle I21.'),
(64, '2024-01-09 12:25:58', '::1', 'Yaya2004', 0, 'L\'utilisateur Yaya2004 a créé un ticket pour la salle I21.'),
                                                                                                                                           (65, '2024-01-09 12:29:33', '::1', 'Yaya2004', 1, 'L\'utilisateur Yaya2004 s\'est déconnecté.'),
                                                                                                                                           (66, '2024-01-09 12:29:51', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est connecté avec succès !'),
                                                                                                                                           (67, '2024-01-09 12:32:00', '::1', 'NULL', 1, 'L\'administrateur web a inscrit un nouveau technicien avec l\'identifiant tech4.'),
                                                                                                                                           (68, '2024-01-09 12:33:38', '::1', 'NULL', 0, 'L\'administrateur web a attribué le ticket avec l\'ID 15 au technicien tech4.'),
                                                                                                                                           (69, '2024-01-09 12:33:48', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 2.'),
                                                                                                                                           (70, '2024-01-09 12:34:23', '::1', 'NULL', 1, 'L\'administrateur web a inscrit un nouveau technicien avec l\'identifiant tech5.'),
                                                                                                                                           (71, '2024-01-09 12:34:29', '::1', 'NULL', 0, 'L\'administrateur web a attribué le ticket avec l\'ID 16 au technicien tech5.'),
                                                                                                                                           (72, '2024-01-09 12:34:33', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 15.'),
                                                                                                                                           (73, '2024-01-09 12:34:45', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est déconnecté.'),
                                                                                                                                           (74, '2024-01-09 12:35:50', '::1', 'NULL', 1, 'L\'utilisateur tech5 s\'est connecté avec succès !'),
                                                                                                                                           (75, '2024-01-09 12:36:23', '::1', 'NULL', 1, 'L\'utilisateur tech5 s\'est déconnecté.'),
                                                                                                                                           (76, '2024-01-09 23:39:22', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
                                                                                                                                           (77, '2024-01-09 23:39:25', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
                                                                                                                                           (78, '2024-01-09 23:59:12', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
                                                                                                                                           (79, '2024-01-10 00:32:23', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
                                                                                                                                           (80, '2024-01-10 00:32:50', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est connecté avec succès !'),
                                                                                                                                           (81, '2024-01-10 23:10:39', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
                                                                                                                                           (82, '2024-01-10 23:13:16', '::1', 'yass', 1, 'L\'utilisateur yass s\'est connecté avec succès !'),
                                                                                                                                           (83, '2024-01-10 23:24:09', '::1', 'yass', 1, 'L\'utilisateur yass s\'est déconnecté.'),
                                                                                                                                           (84, '2024-01-10 23:25:57', '::1', 'test', 1, 'L\'utilisateur test s\'est connecté avec succès !'),
                                                                                                                                           (85, '2024-01-10 23:33:00', '::1', 'test', 1, 'L\'utilisateur test s\'est déconnecté.'),
                                                                                                                                           (86, '2024-01-10 23:33:29', '::1', 'NULL', 1, 'L\'utilisateur gestion s\'est connecté avec succès !'),
                                                                                                                                           (87, '2024-01-10 23:34:14', '::1', 'NULL', 0, 'L\'administrateur web a supprimé le ticket avec l\'ID 1.');

--
-- Déclencheurs `journalactivite`
--
DELIMITER $$
CREATE TRIGGER `trig_check_activite` BEFORE INSERT ON `journalactivite` FOR EACH ROW BEGIN
    IF NOT NEW.type_activite IN (0,1) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La valeur de type_activite doit être entre 0 et 1';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `niveauurgence`
--

CREATE TABLE `niveauurgence` (
                                 `id_nv_urgence` int(11) NOT NULL,
                                 `libelle_nv_urgence` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `niveauurgence`
--

INSERT INTO `niveauurgence` (`id_nv_urgence`, `libelle_nv_urgence`) VALUES
                                                                        (1, 'Urgence faible'),
                                                                        (2, 'Urgence modérée'),
                                                                        (3, 'Urgence élevée'),
                                                                        (4, 'Urgence critique');

-- --------------------------------------------------------

--
-- Structure de la table `statutticket`
--

CREATE TABLE `statutticket` (
                                `id_statut_tic` int(11) NOT NULL,
                                `libelle_statut_tic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statutticket`
--

INSERT INTO `statutticket` (`id_statut_tic`, `libelle_statut_tic`) VALUES
                                                                       (1, 'Ouvert'),
                                                                       (2, 'Fermé'),
                                                                       (3, 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `technicien`
--

CREATE TABLE `technicien` (
                              `identifiant` varchar(30) NOT NULL,
                              `nom_tech` varchar(50) NOT NULL,
                              `prenom_tech` varchar(50) NOT NULL,
                              `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `technicien`
--

INSERT INTO `technicien` (`identifiant`, `nom_tech`, `prenom_tech`, `mdp`) VALUES
                                                                               ('tech1', 'Tech1', 'tech1', 'DC815D6D240F97'),
                                                                               ('tech2', 'Tech2', 'tech2', 'DC815D6D240C97'),
                                                                               ('tech3', 'Tech3', 'tech3', 'DC815D6D240D97'),
                                                                               ('tech4', 'tech4', 'tech4', 'DC815D6D240A97'),
                                                                               ('tech5', 'tech5', 'tech5', 'DC815D6D240B97');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
                          `id_tic` int(11) NOT NULL,
                          `objet` varchar(50) NOT NULL,
                          `desc_pb_tic` varchar(255) DEFAULT NULL,
                          `date_crea_tic` date NOT NULL DEFAULT curdate(),
                          `adresse_ip` varchar(15) NOT NULL,
                          `salle` varchar(5) NOT NULL,
                          `createur_tic` varchar(20) NOT NULL,
                          `tech_charge_tic` varchar(20) DEFAULT NULL,
                          `status_tic` int(11) NOT NULL,
                          `nv_urgence_tic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id_tic`, `objet`, `desc_pb_tic`, `date_crea_tic`, `adresse_ip`, `salle`, `createur_tic`, `tech_charge_tic`, `status_tic`, `nv_urgence_tic`) VALUES
                                                                                                                                                                       (5, 'gros mega probleme', 'le serveur RPI ne fonctionne plus', '2023-12-31', '::1', 'G22', 'test', 'tech2', 1, 2),
                                                                                                                                                                       (6, 'petite panne', 'la souris ne marche plus du tout', '2024-01-01', '::1', 'I21', 'test', 'Tech1', 1, 1),
                                                                                                                                                                       (12, 'qsqsqsqsqs', 'qsqsqsqsqs', '2024-01-08', '::1', 'I21', 'test', 'tech2', 1, 2),
                                                                                                                                                                       (13, 'sqsqsqsqsqsqs', 'qsqsqsqsq', '2024-01-08', '::1', 'I21', 'test', 'tech3', 1, 1),
                                                                                                                                                                       (14, 'qsqsqsqsqsqs', 'qsqsqsqsqsqsqs', '2024-01-08', '::1', 'I21', 'test', 'tech5', 3, 1),
                                                                                                                                                                       (16, 'qsqsqsq', 'sqsqsqsqs', '2024-01-09', '::1', 'I21', 'Yaya2004', 'tech5', 3, 1);

--
-- Déclencheurs `ticket`
--
DELIMITER $$
CREATE TRIGGER `trig_check_salle_ticket` BEFORE INSERT ON `ticket` FOR EACH ROW BEGIN
    IF NOT NEW.salle IN ('I21', 'G21', 'G22', 'G23', 'G24', 'G25') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La salle saisi est  incorrecte';
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig_check_urgence` BEFORE INSERT ON `ticket` FOR EACH ROW BEGIN
    IF NOT NEW.nv_urgence_tic IN (1, 2, 3, 4) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La valeur de nv_urgence_tic doit être entre 1 et 4';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
                               `identifiant` varchar(20) NOT NULL,
                               `nom_util` varchar(50) NOT NULL,
                               `prenom_util` varchar(50) NOT NULL,
                               `email_util` varchar(50) NOT NULL,
                               `mdp` varchar(20) NOT NULL,
                               `type_util` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`identifiant`, `nom_util`, `prenom_util`, `email_util`, `mdp`, `type_util`) VALUES
                                                                                                           ('test', 'test', 'test', 'test@test.fr', '8B904B7A', 'eleve'),
                                                                                                           ('util1', 'Doe', 'John', 'doe.john@mail.fr', '9291483F', 'eleve'),
                                                                                                           ('yass', 'yass', 'yass', 'yass@jdjd.fr', '86944B7D', 'eleve'),
                                                                                                           ('Yaya2004', 'Yassine', 'ELKHALKI', 'yassine.elkhalki@outlook.fr', 'A6944B7D2550D1EE5165', 'eleve');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adminsysteme`
--
ALTER TABLE `adminsysteme`
    ADD PRIMARY KEY (`identifiant`);

--
-- Index pour la table `adminweb`
--
ALTER TABLE `adminweb`
    ADD PRIMARY KEY (`identifiant`);

--
-- Index pour la table `journalactivite`
--
ALTER TABLE `journalactivite`
    ADD PRIMARY KEY (`id_journal`);

--
-- Index pour la table `niveauurgence`
--
ALTER TABLE `niveauurgence`
    ADD PRIMARY KEY (`id_nv_urgence`);

--
-- Index pour la table `statutticket`
--
ALTER TABLE `statutticket`
    ADD PRIMARY KEY (`id_statut_tic`);

--
-- Index pour la table `technicien`
--
ALTER TABLE `technicien`
    ADD PRIMARY KEY (`identifiant`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
    ADD PRIMARY KEY (`id_tic`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    ADD PRIMARY KEY (`identifiant`),
  ADD UNIQUE KEY `email_util` (`email_util`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `journalactivite`
--
ALTER TABLE `journalactivite`
    MODIFY `id_journal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `niveauurgence`
--
ALTER TABLE `niveauurgence`
    MODIFY `id_nv_urgence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `statutticket`
--
ALTER TABLE `statutticket`
    MODIFY `id_statut_tic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
    MODIFY `id_tic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;






-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 26 mars 2025 à 15:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gretagenis`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Informatique'),
(2, 'Outils'),
(3, 'Meubles');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `id_emprunt` int(11) NOT NULL,
  `id_equip` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `dateDebut` varchar(50) DEFAULT NULL,
  `dateFin` varchar(50) NOT NULL,
  `signature` varchar(50) NOT NULL,
  `rendu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`id_emprunt`, `id_equip`, `id_user`, `dateDebut`, `dateFin`, `signature`, `rendu`) VALUES
(59, 2, 18, '2025-03-24', '2025-03-26', 'signature_67e170a22df56.png', 1),
(60, 2, 18, '2025-03-12', '2025-03-20', 'signature_67e1786ddd596.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `catégorie` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lieu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `catégorie`, `libelle`, `description`, `lieu`) VALUES
(2, 1, 'Clavier', 'Clavier d&#39;ordinateurr', 1),
(11, 1, 'Souris', 'Razer Basilisk V3 Pro 35K - Souris de Jeu Ergonomique sans Fil entièrement Personnalisable avec Chroma RGB', 2),
(12, 1, 'Moniteur', 'Écran PC Incurvé | 39,7', 1),
(14, 1, 'PC Gamer Vengeance - i9 - RTX 4060', 'PC Gamer Vengeance - i9 - RTX 4060', 2),
(15, 2, 'Tronçonneuse', 'Tronçonneuse HUSQVARNA 135 Mark II avec Guide de 40 cm', 1),
(16, 3, 'Table basse', 'Dimensions : 60x40x37cm', 1),
(25, 3, 'Chaise de bureau', 'Description détaillée', 2),
(26, 2, 'Tronçonneuse', 'milwaukee', 2),
(35, 1, 'PC Tour ordinateur fixe', 'i7-6700 4x3.4GHz 16GB DDR4 240GB SSD Windows 10 Home', 2);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE `localisation` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`id`, `libelle`) VALUES
(1, 'Mulhouse'),
(2, 'Colmar');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(1, 'Admin'),
(2, 'Commercial'),
(3, 'Client');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `password`, `role`) VALUES
(18, 'bytyqi', 'genis', 'prish@hotmail.fr', '$2y$10$sn7ok0s3y6/QL40YkfJTjeyGGB6x2.sBE2p.q7CGSvQIg/RShYpdu', 1),
(20, 'Commercial', 'Comm', 'comm@a.fr', '$2y$10$blEPJh84Qpu9RCdH6AQWTuaoCpJL0zZi7WWFJbm.C4w/lhpt0FDR6', 2),
(103, 'user', 'user', 'a@a.fr', '$2y$10$toL12pKPoQnwf/wOlHQMQ.l.ZIASRmz.J2byv9zwlPahEMLCo2jyy', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_equip` (`id_equip`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catégorie` (`catégorie`),
  ADD KEY `equipement` (`lieu`);

--
-- Index pour la table `localisation`
--
ALTER TABLE `localisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_1` (`role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `id_emprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `localisation`
--
ALTER TABLE `localisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`id_equip`) REFERENCES `equipement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `equipement` FOREIGN KEY (`lieu`) REFERENCES `localisation` (`id`),
  ADD CONSTRAINT `equipement_ibfk_1` FOREIGN KEY (`catégorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

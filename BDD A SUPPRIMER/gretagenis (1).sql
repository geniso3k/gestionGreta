-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 24 mars 2025 à 16:22
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
(60, 2, 18, '2025-03-12', '2025-03-20', 'signature_67e1786ddd596.png', 0);

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
(26, 2, 'Tronçonneuse', 'milwaukee', 2);

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
(19, 'Eastwood', 'Clint', 'clint@a.fr', '$2y$10$VBpD704R4zyL5ZXUIHqBye0i/6lNQlksE8C7JWg7gC4U4m3dueBOu', 3),
(20, 'Commercial', 'Comm', 'comm@a.fr', '$2y$10$blEPJh84Qpu9RCdH6AQWTuaoCpJL0zZi7WWFJbm.C4w/lhpt0FDR6', 2),
(25, 'Nom5', 'Prenom5', 'utilisateur5@exemple.com', '$2y$10$lzZ9Q6QbbtOuOWreBwJMSu9u8Hav.fM4F3XG2gEk5iyfscDndoL1a', 3),
(26, 'Nom6', 'Prenom6', 'utilisateur6@exemple.com', '$2y$10$U.U1jbNiXH/k0D2bOylxmOqoNdyuBmqOvCNuFg51TjKLf1RrjCi02', 3),
(27, 'Nom7', 'Prenom7', 'utilisateur7@exemple.com', '$2y$10$3ktHwMgAwSmS6SKJ8JeHL.1w8W82.7JmLtaeQJqdn9hpTWZqFjP/q', 3),
(28, 'Nom8', 'Prenom8', 'utilisateur8@exemple.com', '$2y$10$ru0dQmWLv2J8VS87fLzVB.x2m1lNXo5eSXdT0BPGOA/DSiZtXgmDW', 3),
(29, 'Nom9', 'Prenom9', 'utilisateur9@exemple.com', '$2y$10$FqoABIMxCMNSKKT6FQ4bu.TB8pqktijJZxma/TLOlanaJODfK./hi', 3),
(30, 'Nom10', 'Prenom10', 'utilisateur10@exemple.com', '$2y$10$pOtHxGZeUTXQ5z27Hl0t5OiviTDn7v83KUSYVW8oWh0HwAOIi6vaq', 3),
(31, 'Nom11', 'Prenom11', 'utilisateur11@exemple.com', '$2y$10$b4O6fr1eVTBFz2AIfhZwyek6boqIhE8vtQU2U8jlbCszIzEG.YUam', 3),
(32, 'Nom12', 'Prenom12', 'utilisateur12@exemple.com', '$2y$10$.dsvS3AYo2fuErhSpHWMxO3QlH7ro63yqZnGovuMDGzCHPQiWmR/C', 3),
(33, 'Nom13', 'Prenom13', 'utilisateur13@exemple.com', '$2y$10$cVCFXzdyUvyCWewhQO54I.ks1YB/u9/qM.Z0LH3V0SlFXHxCYwgm6', 3),
(34, 'Nom14', 'Prenom14', 'utilisateur14@exemple.com', '$2y$10$OBZc24du7WTN0ANQ84hbtOqsmxWHV7LQRncUx3wrBZh24zdx9m8mK', 3),
(35, 'Nom15', 'Prenom15', 'utilisateur15@exemple.com', '$2y$10$lGwrX7PbyVMXr3OrWBZRtOwxM5spSoolsgx9hXoPZepTtzkvX.KZu', 3),
(36, 'Nom16', 'Prenom16', 'utilisateur16@exemple.com', '$2y$10$6zrkGx.S/vmwu/Wom3ExpO/ksdKgyLfoHy34F0JP9pBoGSm2.5V/G', 3),
(37, 'Nom17', 'Prenom17', 'utilisateur17@exemple.com', '$2y$10$IpdVGDv.tHM9ML0Ak1Qc5..NStbEPvXh1tIw4EPPyWc/vuxeHKX7i', 3),
(38, 'Nom18', 'Prenom18', 'utilisateur18@exemple.com', '$2y$10$h8yZPqSqc/mV.rzf6Tmxk.6DqsVOw5ubB.IOJdCav8o5i2qYkZF/6', 3),
(39, 'Nom19', 'Prenom19', 'utilisateur19@exemple.com', '$2y$10$jYqFxXHZt5LhrcsZvZzXSuj1F.7hOAn2bfoHn0BET3bfbBBAPrQ4a', 3),
(40, 'Nom20', 'Prenom20', 'utilisateur20@exemple.com', '$2y$10$kdlS7X5o1JDAa0bMf4OSwONwY5U1.glDxCZhEIMEWl0Bm2Yzo8Kr6', 3),
(41, 'Nom21', 'Prenom21', 'utilisateur21@exemple.com', '$2y$10$8ugnyxO9IxMPmloff7zqQu6oo2xdjZyPsrDb8jY/ztYZlesI3vN4q', 3),
(42, 'Nom22', 'Prenom22', 'utilisateur22@exemple.com', '$2y$10$PgcxMAFmjd1zDHQjWNAJbeGGP9MO4isO222/LaoiNcFMoE08hAVdy', 3),
(43, 'Nom23', 'Prenom23', 'utilisateur23@exemple.com', '$2y$10$oaVyqsIgBUWM4GDmZMvEVeVFLR2L5PAkKT.gaeTNVl7WAlBnTWqsG', 3),
(44, 'Nom24', 'Prenom24', 'utilisateur24@exemple.com', '$2y$10$LFKVsgKAyYRTRNUZJNqPFuKDgYto4Z/AIjIiHdlfY5POVyiBIFr6O', 3),
(45, 'Nom25', 'Prenom25', 'utilisateur25@exemple.com', '$2y$10$CvUj7ZUFMulhHIKH8VrPOu1HSabvu2De11gzkYHcDgVBxVoFCFjHC', 3),
(46, 'Nom26', 'Prenom26', 'utilisateur26@exemple.com', '$2y$10$XzA4lSnYaA4sdRynomWv4.wjl0/Gka0nDocMWo5IsBYpEaRYxliha', 3),
(47, 'Nom27', 'Prenom27', 'utilisateur27@exemple.com', '$2y$10$R4ZCUe6PTosV8SPtdZ9MIuKibNp5fFvUvJVaUDEoMeTks824nw2ha', 3),
(48, 'Nom28', 'Prenom28', 'utilisateur28@exemple.com', '$2y$10$85YwIS80Svjld2E4fVpe/.LHIOJKb7oIC57LgcliSR3VfIOsvHVZi', 3),
(49, 'Nom29', 'Prenom29', 'utilisateur29@exemple.com', '$2y$10$s4zEdww24Y8ubz2dSs39yumb/Kxetu71E8QVnnkrQf20hdlsXXdDq', 3),
(50, 'Nom30', 'Prenom30', 'utilisateur30@exemple.com', '$2y$10$w8GdcrkTrocE1xFxfyYEXuZz0pHDGmRikOD0SWoc7Ht2TaOpS1VkG', 3),
(51, 'Nom31', 'Prenom31', 'utilisateur31@exemple.com', '$2y$10$9MwiJs.6zLwmcd/Vk0jYK.hi68S024UAbzCvqW/QzvTPfYW70n3zy', 3),
(52, 'Nom32', 'Prenom32', 'utilisateur32@exemple.com', '$2y$10$CRgOap5LylKJXUSRhHMg7.ROt4N2gt/RELNG4lWHIvLaWwtyJXv5i', 3),
(53, 'Nom33', 'Prenom33', 'utilisateur33@exemple.com', '$2y$10$cfoVDES0yiU7Oe5RuyhqVOQ.VNleTZjmw9Ri8rvt80d3oae3W4nRy', 3),
(54, 'Nom34', 'Prenom34', 'utilisateur34@exemple.com', '$2y$10$RZcOUgIKtOWWhrDozT7bIeltVqcskwpHhUB8yyH5GEm8zMYjpiZNC', 3),
(55, 'Nom35', 'Prenom35', 'utilisateur35@exemple.com', '$2y$10$bi2Qs9ML3tjBKeyIzrFJLegXw1u9gBs8ZOVs2FlNlK3vOMGNIUJci', 3),
(56, 'Nom36', 'Prenom36', 'utilisateur36@exemple.com', '$2y$10$llMCAM2BsAvXZ0BRnSJ9Yu2bggfHUspGdsY7dbn7rio8tiBrOLFUm', 3),
(57, 'Nom37', 'Prenom37', 'utilisateur37@exemple.com', '$2y$10$TIUd2cLrgPMChtrWQ8rzaOsovg/jihVhepKfciUHF1B7x6V1MF/O.', 3),
(58, 'Nom38', 'Prenom38', 'utilisateur38@exemple.com', '$2y$10$5DPC1LlvnsSzSMUhf4qFxuA7oiGbsKJEuMCmFygzyaFNBqy/BCGFe', 3),
(59, 'Nom39', 'Prenom39', 'utilisateur39@exemple.com', '$2y$10$tOdoa62vmmKYzTe42v54O.uWMb3txR9dCsodCLmh1AGphXKCpgZjC', 3),
(60, 'Nom40', 'Prenom40', 'utilisateur40@exemple.com', '$2y$10$jT2xQtD1yL30KnojGrIxhOGrO3e7EWvlBpjQ533IeFtTgsPLCvAwa', 3),
(61, 'Nom41', 'Prenom41', 'utilisateur41@exemple.com', '$2y$10$ZLhxAT0yCauQj3mQzYO3/.i9HAgoD3WRRfJ0Pvpc3jZ5nkeuEGfra', 3),
(62, 'Nom42', 'Prenom42', 'utilisateur42@exemple.com', '$2y$10$IpJggBpqTbOGMhJ6jBLBnugUcLKHzOQF6Zu8CFMSzA2BHbmDVjAjC', 3),
(63, 'Nom43', 'Prenom43', 'utilisateur43@exemple.com', '$2y$10$hGdFodENBiKhAfBNvIal6eECGs/CaCJojANDBZ6iA2TupH0QbaMGe', 3),
(64, 'Nom44', 'Prenom44', 'utilisateur44@exemple.com', '$2y$10$TNEm4jHxJISIU3r0Lxzwde4QKwExo76SjKVOyOacGk3h/dEhp1sIq', 3),
(65, 'Nom45', 'Prenom45', 'utilisateur45@exemple.com', '$2y$10$B7WRBNA5D5OfaSzR0NjZ3OsqkXVKdmOVVjzMJNtTUDH6knOvLJSkO', 3),
(66, 'Nom46', 'Prenom46', 'utilisateur46@exemple.com', '$2y$10$/TIPXWXHE/VA/6SK0.oiieXNVP9.JMsurIu8v5p9GZz1KZ6.K6gAK', 3),
(67, 'Nom47', 'Prenom47', 'utilisateur47@exemple.com', '$2y$10$aHNW7LzR0EOdlzjt/0stleuNKag7D8vNR8ixVC563Ba7b4aU/M5q.', 3),
(68, 'Nom48', 'Prenom48', 'utilisateur48@exemple.com', '$2y$10$u4C/COxDe7p1v0KUJZg6j.aaODvaxgz7Gt/CQ2OGSZcVoRHBZHPay', 3),
(69, 'Nom49', 'Prenom49', 'utilisateur49@exemple.com', '$2y$10$20x/5BK3TJjwt1YIgREAzuGHomwG6Y60p.jJ4DUXk46IuGapx1A8K', 3),
(70, 'Nom50', 'Prenom50', 'utilisateur50@exemple.com', '$2y$10$gNYQvwIRr.U16E22hWf.V.0xWlhkeT2X27Ofx2u0gwE/RznR27fL6', 3),
(71, 'Nom51', 'Prenom51', 'utilisateur51@exemple.com', '$2y$10$S0GSEVlBUb5A2z05aMMMcOQIatYNPsjSoWTARSfCKKMAQgvh4oxLK', 3),
(72, 'Nom52', 'Prenom52', 'utilisateur52@exemple.com', '$2y$10$JQ9QvYryAXIrwys6HYmsD.rtTTj2NxigmFoIZkMwTmTvbbZhpAzXW', 3),
(73, 'Nom53', 'Prenom53', 'utilisateur53@exemple.com', '$2y$10$VJ.BOdxvw0AZ.p3wNejvgOfteNlbtuV1O8dPH0ZOjCcg8Hf7h22F6', 3),
(74, 'Nom54', 'Prenom54', 'utilisateur54@exemple.com', '$2y$10$B7cEqZNkoBgXO583hfTrUeNZh3TvnHHXvajVJ9iV00tM0aE95ESdu', 3),
(75, 'Nom55', 'Prenom55', 'utilisateur55@exemple.com', '$2y$10$iCn26b2A01YvUlEYvpJu2udcoKm5V12A.zBZgaiDikErmvQfaK5Va', 3),
(76, 'Nom56', 'Prenom56', 'utilisateur56@exemple.com', '$2y$10$R/MnGgSd7XIOaPmOoVDCcuwN3VBaakpt7IEcWR6bWm0p/yvHuyAmy', 3),
(77, 'Nom57', 'Prenom57', 'utilisateur57@exemple.com', '$2y$10$Z3Xn9PiGbU7GxKSAiMRM0OvqZ2/W3P3Xk9aRveu0ifw3D/JlaZpSS', 3),
(78, 'Nom58', 'Prenom58', 'utilisateur58@exemple.com', '$2y$10$02KjBYe63.2QDsC7evKDwOukPuiuxpqCR9GNmsG6hspz/RGXJmB0q', 3),
(79, 'Nom59', 'Prenom59', 'utilisateur59@exemple.com', '$2y$10$w.hNrl3FekQ9HtdA0qgrBeQpluURAHavCNex5blll5RyFA98RF24S', 3),
(80, 'Nom60', 'Prenom60', 'utilisateur60@exemple.com', '$2y$10$jQtusDbbJOpn1c6uY.VDe.2.DDgs0yo3T83QqWwlUiUZQy..40yqG', 3),
(81, 'Nom61', 'Prenom61', 'utilisateur61@exemple.com', '$2y$10$kp/96zuq5fl6ipeRNeFD9O6vJg.IE9gdm1cSvR6WueGH0MxnQFeRC', 3),
(82, 'Nom62', 'Prenom62', 'utilisateur62@exemple.com', '$2y$10$zeSv4S9.2xqxpJuA0sWxX.X0X5zsymzKfwINsCNhDWQ31t1Lko4Q6', 3),
(83, 'Nom63', 'Prenom63', 'utilisateur63@exemple.com', '$2y$10$YLBRs4Ze7T8BMsBryFKBRuTl5pAvkSIQsh80aaez/xzXbID20cD/.', 3),
(84, 'Nom64', 'Prenom64', 'utilisateur64@exemple.com', '$2y$10$vVFQknfQ/wf5qWR1gZbtmuZKTzECIeMnyMoF0v.hCdFCvGoUOj./6', 3),
(85, 'Nom65', 'Prenom65', 'utilisateur65@exemple.com', '$2y$10$xYuuCs.U87oAO0LcLcSeVebBy3dAmtkl5y4PX0mdbitYUDVhVraAC', 3),
(86, 'Nom66', 'Prenom66', 'utilisateur66@exemple.com', '$2y$10$e9yOBEZPlFncyz4wX2nv4e20X3FN8G6Mv7M9ioo1/OmCqMFFlNKaG', 3),
(87, 'Nom67', 'Prenom67', 'utilisateur67@exemple.com', '$2y$10$6Y2rRLE3vcn/m/wE.vmDS.GhN5dks5oGd9mYNAEB5zxq7O4EiCxs.', 3),
(88, 'Nom68', 'Prenom68', 'utilisateur68@exemple.com', '$2y$10$GqjJdDs8CJQIcZBjUs7pHOE7OB9Bi4JIPnXtSZUWsm2xhho9okse6', 3),
(89, 'Nom69', 'Prenom69', 'utilisateur69@exemple.com', '$2y$10$wfYB.8nyDLdVGPWH01q/2.4yddrQbYOLBsV62CX6Y0zpwiu.Ixf5W', 3),
(90, 'Nom70', 'Prenom70', 'utilisateur70@exemple.com', '$2y$10$hZhRrcLL2e6N4Iq8Vm7.6efduEyK17/tV5Z9AFJU1qTWJX39z7dYG', 3),
(91, 'Nom71', 'Prenom71', 'utilisateur71@exemple.com', '$2y$10$rarvGhfR8QY2myPcHok7kulBIizY61c/PNDvkU4VHLSJ/KHTnGkvG', 3),
(92, 'Nom72', 'Prenom72', 'utilisateur72@exemple.com', '$2y$10$4MZE4j8Xbv0WdMmzVU41p.pUJzG53BrXa660K6DNwph9onhSCWbcG', 3),
(93, 'Nom73', 'Prenom73', 'utilisateur73@exemple.com', '$2y$10$0nT5sgpYPQlWcYHuAGpSEu7M4fP8j7o1EN.XFfq7bgLYfZ/D.sLDW', 3),
(94, 'Nom74', 'Prenom74', 'utilisateur74@exemple.com', '$2y$10$KPdLTe42r4ngfjkvO2P.dOReB8ayiLaJe2yhh28V9Ez.RzgZaE5DS', 3),
(95, 'Nom75', 'Prenom75', 'utilisateur75@exemple.com', '$2y$10$4njOau1CE8BxsJGStgMPdutJ6e06dCodMKoMEaV5vXjD6zq/VlFQC', 3),
(96, 'Nom76', 'Prenom76', 'utilisateur76@exemple.com', '$2y$10$elSYFUbtvEtf7mkxHMTZI..XKxOUN3LBSG14ytpIRei2aje3GtOtO', 3),
(97, 'Nom77', 'Prenom77', 'utilisateur77@exemple.com', '$2y$10$790YrF3n7Fv5SqTNFJFqr.GpI3kxchTw2skpt8U/m0kENSYZPHHxm', 3),
(98, 'Nom78', 'Prenom78', 'utilisateur78@exemple.com', '$2y$10$7N0p1UkrjzATM3ON6rIUDuwzTMw0c.LweTNHLhcihOmgc9erMFDhe', 3),
(99, 'Nom79', 'Prenom79', 'utilisateur79@exemple.com', '$2y$10$h8NmBa3GOVi.gLWWCqeatuVOa2kJbYGtQmHcmsT5hRDTRLQmcQHSi', 3),
(100, 'Nom80', 'Prenom80', 'utilisateur80@exemple.com', '$2y$10$tQGw83TzyTrkQW41Xw4EOuX4.z2sch8viff1jS4kWhM/QFmnrW3PO', 3),
(101, 'Nom81', 'Prenom81', 'utilisateur81@exemple.com', '$2y$10$sAm/RY4h7ozCX2mWtrcrA.fTtrbkwwt4Vw6KUDeXCDM9zGaBtiYYi', 3),
(103, 'fes', 'esfsef', 'prishtinalik@hotmail.fr', '$2y$10$toL12pKPoQnwf/wOlHQMQ.l.ZIASRmz.J2byv9zwlPahEMLCo2jyy', 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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

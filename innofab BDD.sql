-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 25 avr. 2024 à 16:53
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
-- Base de données : `innofab`
--

-- --------------------------------------------------------

--
-- Structure de la table `machines`
--

CREATE TABLE `machines` (
  `id_machines` int(11) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Vues_Machine` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Déchargement des données de la table `machines`
--

INSERT INTO `machines` (`id_machines`, `Titre`, `Image`, `Description`, `Vues_Machine`) VALUES
(2, 'ZORTRAX M200', '../assets/img/imgMachines/ZORTRAX M200.jpg', 'Le Zortrax M200 est une imprimante 3D fiable et précise, offrant une qualité d&#039;impression exceptionnelle grâce à sa structure robuste et à sa technologie avancée. Parfait pour les professionnels et les passionnés, il permet de réaliser des modèles co', 5),
(3, 'UP PLUS 2', '../assets/img/imgMachines/UP PLUS 2.JPG', 'La UP Plus 2 est une imprimante 3D compacte et polyvalente, idéale pour les utilisateurs débutants et les professionnels cherchant une solution fiable. Dotée d&#039;une construction solide et d&#039;une interface conviviale, elle offre des impressions de ', 0),
(4, 'BAMBU LAB A1 MINI + AMS', '../assets/img/imgMachines/BAMBU LAB A1 MINI + AMS.JPG', 'Le Bambu Lab A1 Mini + AMS est une imprimante 3D compacte et innovante, intégrant la technologie avancée de filament métal. Cette machine allie la fiabilité et la précision des impressions 3D traditionnelles à la capacité unique de produire des pièces en ', 0),
(5, 'SCANNER SENSE 3D', '../assets/img/imgMachines/SCANNER SENSE 3D.JPG', 'Le Scanner Sense 3D est un scanner 3D portable et intuitif, conçu pour capturer des modèles 3D avec une grande précision et une grande facilité d&#039;utilisation. Grâce à sa technologie avancée de numérisation, il permet aux utilisateurs de transformer r', 0),
(6, 'SCANNER REVOPOINT INSPIRE 3D', '../assets/img/imgMachines/SCANNER REVOPOINT INSPIRE 3D.JPG', 'Le Scanner Revopoint Inspire 3D est un scanner 3D portable et polyvalent, offrant une précision exceptionnelle et une facilité d&#039;utilisation inégalée. Grâce à sa technologie avancée de numérisation, il permet aux utilisateurs de capturer rapidement d', 0),
(7, 'CARTE ARDUINO UNO', '../assets/img/imgMachines/CARTE ARDUINO UNO.JPG', 'La carte Arduino Uno est un microcontrôleur open-source populaire et polyvalent, idéal pour les débutants et les experts en électronique. Dotée d&#039;un processeur puissant et d&#039;une grande communauté de soutien, elle permet de créer une multitude de', 8),
(8, 'CARTE RASPBERRY', '../assets/img/imgMachines/CARTE RASPBERRY.JPG', 'La carte Raspberry Pi est un ordinateur monocarte abordable et polyvalent, révolutionnant le domaine de l&#039;informatique embarquée. Dotée d&#039;un processeur puissant, de ports d&#039;entrée/sortie variés et d&#039;une grande communauté de développeur', 0),
(9, 'DRONE DJI PHANTOM 3', '../assets/img/imgMachines/DRONE DJI PHANTOM 3.JPG', 'Le drone DJI Phantom 3 est un quadricoptère haut de gamme, offrant des performances de vol exceptionnelles et une capture vidéo de qualité professionnelle. Doté d&#039;un système de stabilisation avancé et d&#039;une caméra intégrée, il permet de capturer', 0),
(10, 'DRONE E011', '../assets/img/imgMachines/DRONE E011.JPG', 'Le drone E011 est un nano-drone compact et abordable, idéal pour les débutants et les amateurs de vol en intérieur. Avec sa petite taille et sa construction légère, il offre une maniabilité agile et amusante, parfaite pour les vols acrobatiques à l&#039;i', 0),
(11, 'SCIE CHANTOURNER FARTOOLS PSL 150', '../assets/img/imgMachines/SCIE CHANTOURNER FARTOOLS PSL 150.JPG', 'La scie à chantourner Fartools PSL 150 est un outil polyvalent et précis, conçu pour réaliser des coupes courbes et complexes dans une variété de matériaux tels que le bois, le plastique et même certains métaux légers. Dotée d&#039;une lame fine et d&#039', 0),
(12, 'IMPRIMANTE VINYLE PLOTTER VERSASTUDIO BN-20', '../assets/img/imgMachines/IMPRIMANTE VINYLE PLOTTER VERSASTUDIO BN-20.JPG', 'L&#039;imprimante vinyle plotter VersaStudio BN-20 est une solution tout-en-un compacte et polyvalente, idéale pour les petites entreprises et les professionnels de l&#039;impression personnalisée. Grâce à sa capacité d&#039;impression et de découpe intég', 0),
(13, 'CNC FRAISEUSE DIY', '../assets/img/imgMachines/CNC FRAISEUSE DIY.png', 'La CNC fraiseuse DIY est une solution personnalisable et abordable pour les passionnés de fabrication numérique. Avec la possibilité de construire sa propre fraiseuse à commande numérique (CNC) à partir de composants facilement disponibles et de plans ope', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL COMMENT 'Id Utilisateur',
  `Nom` varchar(255) NOT NULL COMMENT 'Nom Utilisateur',
  `Prenom` varchar(255) NOT NULL COMMENT 'Pr?nom Utilisateur',
  `email` varchar(255) NOT NULL COMMENT 'Email Utilisateur',
  `Telephone` int(10) NOT NULL COMMENT 'T?l?phone Utilisateur',
  `Password` varchar(255) NOT NULL COMMENT 'Mot de passe Utilisateur',
  `Status` varchar(11) NOT NULL DEFAULT 'Utilisateur' COMMENT 'Statut de l''utilisateur',
  `valide` tinyint(11) NOT NULL DEFAULT 0 COMMENT 'Validit? de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `Nom`, `Prenom`, `email`, `Telephone`, `Password`, `Status`, `valide`) VALUES
(7, 'Almeida', 'Lucas', 'lucas.al@gmail.com', 606060606, '$2y$10$2jjvmdrCdzK8KZ.OXbzFuOW4EDWsZv02XAGbGvrBLoqorhyVp67Yi', 'Admin', 1),
(12, 'Durand', 'Cl?ment', 'clement@gmail.com', 684713440, '$2y$10$h7HvfGeVQyXUP7CiiheN4.LR8EgWmO3hg3bZR4nTxqFRAg4L/T0Nq', 'Admin', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id_machines`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `machines`
--
ALTER TABLE `machines`
  MODIFY `id_machines` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Utilisateur', AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 03 nov. 2019 à 19:41
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `climbing`
--

-- --------------------------------------------------------

--
-- Structure de la table `places`
--

CREATE TABLE `places` (
  `Id` int(11) NOT NULL,
  `Adress` text NOT NULL,
  `Phone` int(12) NOT NULL,
  `img` text NOT NULL,
  `Name` text NOT NULL,
  `MobilPhone` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `places`
--

INSERT INTO `places` (`Id`, `Adress`, `Phone`, `img`, `Name`, `MobilPhone`) VALUES
(1, 'PARIS', 64589725, 'escalade.jpg', 'Karma', 64429565);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `Id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `CreationDate` datetime DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`Id`, `Title`, `Description`, `CreationDate`, `User_Id`) VALUES
(89, 'Sharma trouve chausson à son pied ', 'Le King change de marque de chaussons et quitte Evolv pour Tenaya. ', '2019-10-22 14:18:09', 15),
(90, 'La vénézuélienne Lianet Castillo grimpe 8a+ à 14 a', 'Pas facile de grimper au Vénézuela en ce moment alors que le pays vit une crise économique et humanitaire de grande ampleur. Ce contexte n\'a pas empêché la jeune grimpeuse Lianet Castillo de réaliser son premier 8a+', '2019-10-22 14:18:56', 15),
(91, 'VIDEO : Vadim Timonov enchaîne les croix à Magic W', 'En deux semaines à Magic Wood, le grimpeur russe Vadim Timonov s\'est payée une liste de croix plus que conséquente. Et s\'est filmé dans quelques-uns des blocs les plus relevés qu\'il a topé.', '2019-10-22 14:19:37', 15),
(29, 'Oriane Bertone s\'offre un 8c/8c+', 'Après des performances impressionnantes en bloc comme un 8B+ à Rocklands en début d\'année, c\'est en falaise que Oriane Bertone se fait remarquer, en enchainant ces dernières semaines Pari (8b+/c) et sa variante Chykungunya (8c/8c+) sur le spot réunionnais de Ouaki. A 13 ans, elle continue ainsi d\'étoffer un cv plus que fourni de réalisations en bloc et en falaise.', '2019-09-27 14:49:17', 15),
(85, 'Le Sud de la Corse en topo sur vos smartphones & t', 'La saison estivale est bien avancée et la canicule va bien finir par prendre fin. Nous allons pouvoir nous diriger vers les régions du Sud, alors pourquoi pas la Corse ? L\'escalade y a été fortement développée ces dernières années par Adrien, Nastro et d\'autres... Forts de leur savoir faire en matière d\'équipement, ils ont développé des nouveaux secteurs entiers. Tyroliana, Le Barring, 3G, Mescaline pour n\'en citer que quelques-uns, ils permettent de grimper au frais l\'été et dans tous les niveaux du 5 au projet ! Et puis le Sud c\'est aussi le magnifique col de Bavella avec ses mythiques tafonis dont les images nous font toujours autant baver ... Au final 14 sites et presque 500 voies à installer sur vos smartphones et tablettes :) L\'été indien sera Corse !', '2019-10-22 14:14:51', 15),
(86, 'Le Désert de l\'écureuil et 3 petits topos gratuits', ' L\'été est là et les grimpeurs sont nombreux à en profiter pour aller tater régulièrement du caillou ! ClimbingAway continue de vous proposer des topos numériques réalisés avec les acteurs locaux. Téléchargez l\'application ClimbingAway gratuite sur vos smartphones ou tablettes puis allez dans la partie \"Boutique\" pour installer ces topos.\r\n\r\n     Pour les plus matinaux, plus de 50 voies vous attendent au Désert de l\'écureuil . Au programme, un peu de dalle, du dévers et de la conti dans tous les niveaux histoire de bien faire chauffer les avants-bras avant d\'aller se rafraichir les doigts autour d\'un petit verre pour l\'heure de l\'apéro. Dans l\'esprit du CADO (Collectif de l\'Appel Des Ouvreurs), fidèles à notre éthique, la moitié des bénéfices de ce topo et de chaque topo payant va directement aux acteurs locaux qui développent et entretiennent les sites. Acheter un topo papier ou numérique, c\'est LA bonne action de base du grimpeur soucieux de la pérénité et du développement de notre activité :)\r\n\r\n     Nous vous offrons également 3 petits topos proposés gratuits cette fois: Ainsi les grimpeurs amateurs de voies en 5 et 6 pourront profiter sur toutes les faces de La Pierre Bécherelle au bord de la Loire ; ou alors grimper le matin dans tous les niveaux du 5 au projet sur Le Col du Roux ; ou encore les débutants pourront profiter de la belle ombre sur le site d\'initiation de La Ville au Chef ! Tous les topos gratuits se téléchargent dans vos applications dans la \"Boutique\", partie \"GRATUIT\". Vous remarquerez que les topos gratuits sont limités au nombre de 3 mais ce n\'est pas un problème puisque vous pouvez les supprimer pour les remplacer par d\'autres et ainsi toujours avoir celui qui vous intéresse ;)\r\n\r\nBonne grimpe à tous !', '2019-10-22 14:15:12', 15),
(87, 'Romain Desgranges s\'impose à Wujiang', 'Le français décroche l\'or pour la première fois de la saison après avoir joué de malchance lors des dernières compétitions.', '2019-10-22 14:17:22', 15),
(88, 'LIVE : La coupe du monde de Wujiang en direct ce d', 'Après les qualifications de ce samedi, nous vous proposons de suivre en direct la demi-finale et la finale de l\'avant-dernière étape de la coupe du monde de difficulté 2018.', '2019-10-22 14:17:46', 15);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Id` int(8) NOT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `Email` varchar(80) DEFAULT NULL,
  `Password` varchar(80) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `CreationDate` datetime DEFAULT NULL,
  `Adress` varchar(60) DEFAULT NULL,
  `City` varchar(60) DEFAULT NULL,
  `Phone` int(12) DEFAULT NULL,
  `UserAdmin` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Id`, `LastName`, `FirstName`, `Email`, `Password`, `BirthDate`, `CreationDate`, `Adress`, `City`, `Phone`, `UserAdmin`) VALUES
(9, 'ROGER', 'toto', 'roger1@hotmail.fr', '$2y$10$4CjTKvYp82dR2uDcqMfS.uc64IqZva1JFuqvujoeGI4QE4gs8aEdG', '1940-01-01', '2018-01-13 18:13:20', '23 rue', 'paris', 656763805, 0),
(12, 'TYTY', 'toto', 'tutu@gmail.com', '$2y$10$4wt3wb7n9X4HN6U25T9ci.Tdg4WA.StIftZed2KN0ngMjk/I.wfbG', '1940-01-01', '2018-02-14 10:01:14', 'turlututu', 'chapeau pointu', 659822635, 0),
(11, 'Ryane', 'JUL', 'ryaneJUL@gmail.com', '123', '2019-11-06', '2018-01-13 18:13:20', '123  rue du genie ma gueule', 'paris', 964584631, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `places`
--
ALTER TABLE `places`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

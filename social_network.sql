-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 mai 2023 à 03:57
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `social_network`
--

-- --------------------------------------------------------

--
-- Structure de la table `tweets`
--

CREATE TABLE `tweets` (
  `id_tweets` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `tag` varchar(50) DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tweets`
--

INSERT INTO `tweets` (`id_tweets`, `description`, `image`, `date`, `tag`, `userid`) VALUES
(12, 'couc', 'uploads/51003566-une-cellule-matelassée-blanche-dans-un-hôpital-psychiatrique.png', '2023-05-25 22:02:43', 'webtoon', 17),
(17, 'gtyhujyktyu', 'uploads/anime-naruto-minimalism-j9-1920x1080.jpg', '2023-05-26 01:14:30', 'webtoon', 8);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `ip` varchar(20) NOT NULL,
  `token` text NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateurs`, `pseudo`, `email`, `password`, `ip`, `token`, `date_inscription`) VALUES
(9, 'tyro', 'yggyu@gmail.com', '$2y$12$6ZhznvGMHJJRPqusFERoYeUmIDlJvKw3wAQs9mEI3lJ1HSfEYcvSC', '::1', '21054987b752b54f6885d1a381d68dc9bed935017e7a2ebe7d6378b42ee1b4341a7fd09b96717881a0df1147c6a074ffee7a9e98be24363280cbfef970248aab', '2023-02-14 15:03:18'),
(10, 'baptiste', 'coucou@gmail.com', '$2y$12$hJZ5GbnRZjr7ebY4sMKiKeP4P3vkBMS9xi1l0NUCDBIE42AgSvHKe', '::1', '73a2000d5ff386d266a2a703ab3d6f5df30f3f62a1aef497c2ed76ad47dd569738766f6f662e96e3b8fcb63880fb6fd1c264afd68d83316b23c5af967b728752', '2023-02-14 15:25:18'),
(7, 'Adam', 'adam.bakir@edu.devinci.fr', '$2y$12$Tctl.SHZAlwzzzg85tb6pOsJoFIk1/XPDhdftmubo/.pVtSY5Zo2i', '::1', 'ea27b9d312f94b0a976b1761299aeae42e673612dd9035886316d6c54e3b26fb5eef5efe343fffc4ad0c367f6779e6085edb355d9b30ca5d530891f1b6e47693', '2023-02-07 14:09:45'),
(8, 'adam2', 'bakiradam2@gmail.com', '$2y$12$qWporhNOC7FWWVHAJGhmB.joxty1F8a/Ux0zDmj0TBxivmqQada4O', '::1', '0891c8737ecab4875b0bda41e37087482a14afa0d9a304bc974f2701daf9ddcee048304f8e805cc87139a8f6bb06047d4171bca7aaaa9e9a9574e9fda8e94ed8', '2023-02-07 14:45:21'),
(11, 'seb', 'seb@gmail.com', '$2y$12$F0t2KdIRYjFj4aps5B7u9eWJDh9LL3dMcTNrCPjYVAeMznjSUeQxW', '::1', '4104f1986613b69ddd123ce8efe2db291be2d1bd02135435e439e1c648c91e4e34e2358ae941f207735bdaa160e47689e64d91ce329590c18db3e1579d4fe141', '2023-02-15 14:47:41'),
(12, 'tyro', 'tyro@gmail.com', '$2y$12$2J1640Ex.mGlUfg26FGMfO8hI1YGJnWp3sb/0MUnIsh29bSOsI4Wi', '::1', '0242cf5fffa2233c495e119ab2f8b7ac39db4245c853fb24e130556a8f49c15508a2659902e555180d5f8e98f6c480de814d5aacbddd2afe8fe360b8b4385e49', '2023-02-20 23:25:54'),
(16, 'tyrolevrai', 'cmoi@gmail.com', '$2y$12$qeN8zwDQJ8S5LdStuwH7peU0yFCrrM.7e.sHIdWCy7MBf3xtz98D6', '::1', '87aa6153ed668e8974e5d4a59417ca326589875c9a4042ff7c3bbe6c500d4d4c1e4b0dabb0663437af3f00f05722797b9910d4b3e6be4d9639a22a9ce992d1d8', '2023-04-14 17:39:22'),
(14, 'ANTOINE', 'antoine@gmail.com', '$2y$12$nqF4JzehEAj8TgqMYZn4b.iVcMx6nDOrS9MbyKxeqLT7ndeB5pRbm', '::1', '05cc5a5428250f2c9fafbe3ded1d3feb1e338ac3b8cc84a6859e3ae1a2966b41071e18f999037abe448272a211cfbe71d5c4d921f5f74083b50303f317b4afcd', '2023-02-27 17:21:40'),
(17, 'tyty', 'tyty@gmail.com', '$2y$12$tefKZkHnVBhjlQZSxYLQWumKTV2bGApYqA4mzpFq5t8aLLzW0G8xi', '::1', 'e299389f0df0ad4e5c95d42d7a39ec0c50df3858aa06ccfd5504364e1af4c773abfec3a4bd2485b4e6ea33150d6fa2d85af9b04ac3895910d988cf6d8913f809', '2023-05-25 21:58:06');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id_tweets`),
  ADD UNIQUE KEY `tag` (`description`) USING HASH;

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateurs`),
  ADD KEY `date_inscription` (`date_inscription`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id_tweets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

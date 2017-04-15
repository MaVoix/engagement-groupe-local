-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 15 Avril 2017 à 18:36
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `groupelocaux`
--

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_amended` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `departement` int(11) NOT NULL,
  `circonscription` int(11) NOT NULL,
  `path_pic` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_city` varchar(255) NOT NULL,
  `amount_promises` decimal(10,2) NOT NULL,
  `amount_donations` decimal(10,2) NOT NULL,
  `key_edit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_amended` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `groups_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ad1` varchar(255) NOT NULL,
  `ad2` varchar(255) NOT NULL,
  `ad3` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `country` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_amended` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `people_id` int(11) DEFAULT NULL,
  `login` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

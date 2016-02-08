-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Lun 08 Février 2016 à 15:44
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `csg`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `name` text NOT NULL,
  `e_mail` text NOT NULL,
  `sex` int(11) NOT NULL,
  `class` text NOT NULL,
  `img` text NOT NULL,
  `friends` varchar(5000) NOT NULL,
  `level` int(11) NOT NULL,
  `pass` text NOT NULL,
  `sessid` text NOT NULL,
  `ip` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `accounts`
--

INSERT INTO `accounts` (`id`, `first_name`, `name`, `e_mail`, `sex`, `class`, `img`, `friends`, `level`, `pass`, `sessid`, `ip`) VALUES
(24, 'Jean-Marie', 'Dupont', 'lologrum10@gmail.com', 0, '1A', './pictures/default.jpg', 'Jean-Marie Dupont/', 1, '$2y$10$.4vRuKHIgDy4T6OCeTfA5u0.6rlr1P4FRu4KsI0s/nQ6ClVUWW6cG', '151097290856afbd53a210c2.80398236', '::1'),
(25, 'ikk', '&ugrave;kjm', 'lkl', 0, '1I', './pictures/default.jpg', '/Jean-Marie Dupond/', 1, '$2y$10$AnVARBXNn4P8hyUnPkMyjOCTk5vevDVc04N5D7KEG2wjwSB9XHS02', '1354718856add00d8f6865.03984396', '::1'),
(26, 'P-I', 'Ver...', 'lologrum10@gmail.com', 1, '4F', './pictures/default.jpg', '', 1, '$2y$10$ppiRnhY9SXs4EwXy0y.eTOh7IeAzYosdKO1u06S8O/n/s9zwPbnvW', '3620975356b7820f457ba3.70232083', '::1');

-- --------------------------------------------------------

--
-- Structure de la table `heart`
--

CREATE TABLE `heart` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author` text NOT NULL,
  `pub_date` datetime NOT NULL,
  `content` varchar(1000) NOT NULL,
  `level` int(11) NOT NULL,
  `dest` text NOT NULL,
  `sticky` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `heart`
--
ALTER TABLE `heart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `heart`
--
ALTER TABLE `heart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
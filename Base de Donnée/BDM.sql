-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 29 Mai 2019 à 14:08
-- Version du serveur :  10.1.38-MariaDB-0+deb9u1
-- Version de PHP :  7.3.5-1+0~20190503093827.38+stretch~1.gbp60a41b

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `BDM`
--

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_actuality`
--

CREATE TABLE `agdjjg_actuality` (
  `id` int(11) NOT NULL,
  `article` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_article` varchar(255) NOT NULL,
  `date_actuality` varchar(10) NOT NULL,
  `id_agdjjg_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_actuality`
--

INSERT INTO `agdjjg_actuality` (`id`, `article`, `title`, `author_article`, `date_actuality`, `id_agdjjg_user`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum', 'Maxime Defretin', '2018-07-02', 1);

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_actuality_comment_visitor`
--

CREATE TABLE `agdjjg_actuality_comment_visitor` (
  `id` int(11) NOT NULL,
  `comment_article` text NOT NULL,
  `answer` text,
  `validated` tinyint(1) NOT NULL,
  `date_comment` varchar(10) NOT NULL,
  `author` varchar(255) NOT NULL,
  `id_agdjjg_actuality` int(11) NOT NULL,
  `id_answer_comment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_actuality_comment_visitor`
--

INSERT INTO `agdjjg_actuality_comment_visitor` (`id`, `comment_article`, `answer`, `validated`, `date_comment`, `author`, `id_agdjjg_actuality`, `id_answer_comment`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 1, '2017-04-01', 'Maxime Defretin', 1, NULL),
(3, 'Je suis d\'accord avec toi.', NULL, 1, '2019-04-17', 'Maxime', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_assigned`
--

CREATE TABLE `agdjjg_assigned` (
  `volunteer` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `id_agdjjg_task` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_assigned`
--

INSERT INTO `agdjjg_assigned` (`volunteer`, `id`, `id_agdjjg_task`) VALUES
('Maxime Defretin', 1, 1),
('Maxime Defretin', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_avatar`
--

CREATE TABLE `agdjjg_avatar` (
  `id` int(11) NOT NULL,
  `path_avatar` varchar(255) NOT NULL,
  `id_agdjjg_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_bookReaded`
--

CREATE TABLE `agdjjg_bookReaded` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `opinion_book` text NOT NULL,
  `date_edited` char(10) NOT NULL,
  `id_agdjjg_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `agdjjg_bookReaded`
--

INSERT INTO `agdjjg_bookReaded` (`id`, `title`, `opinion_book`, `date_edited`, `id_agdjjg_user`) VALUES
(1, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2019-02-05', 1);

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_event_association`
--

CREATE TABLE `agdjjg_event_association` (
  `id` int(11) NOT NULL,
  `description_event` text NOT NULL,
  `date_event` char(10) NOT NULL,
  `author_event` varchar(255) NOT NULL,
  `path_document_event` varchar(255) DEFAULT NULL,
  `suggested_event` varchar(255) NOT NULL,
  `id_agdjjg_user` int(11) DEFAULT NULL,
  `id_agdjjg_status_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_event_association`
--

INSERT INTO `agdjjg_event_association` (`id`, `description_event`, `date_event`, `author_event`, `path_document_event`, `suggested_event`, `id_agdjjg_user`, `id_agdjjg_status_event`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2019-03-01', 'Maxime Defretin', NULL, 'Lorem ipsum', 1, 1),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut a', '2019-04-17', '', '', 'Lorem ispum', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_participation`
--

CREATE TABLE `agdjjg_participation` (
  `volunteer_present` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `id_agdjjg_event_association` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_participation`
--

INSERT INTO `agdjjg_participation` (`volunteer_present`, `id`, `id_agdjjg_event_association`) VALUES
('Defretin Maxime', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_status_event`
--

CREATE TABLE `agdjjg_status_event` (
  `id` int(11) NOT NULL,
  `status_event` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_status_event`
--

INSERT INTO `agdjjg_status_event` (`id`, `status_event`) VALUES
(1, 'Formation'),
(2, 'Réunion'),
(3, 'Entre bénévole'),
(4, 'Sortie'),
(5, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_status_task`
--

CREATE TABLE `agdjjg_status_task` (
  `id` int(11) NOT NULL,
  `status_task` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_status_task`
--

INSERT INTO `agdjjg_status_task` (`id`, `status_task`) VALUES
(1, 'Proposée'),
(2, 'En cours'),
(3, 'Terminée');

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_status_user`
--

CREATE TABLE `agdjjg_status_user` (
  `id` int(11) NOT NULL,
  `status_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_status_user`
--

INSERT INTO `agdjjg_status_user` (`id`, `status_user`) VALUES
(1, 'Président'),
(2, 'Secrétaire'),
(3, 'Trésorier'),
(4, 'Bénévole');

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_task`
--

CREATE TABLE `agdjjg_task` (
  `id` int(11) NOT NULL,
  `suggested_task` varchar(255) NOT NULL,
  `description_task` text NOT NULL,
  `date_task` char(10) NOT NULL,
  `id_agdjjg_user` int(11) DEFAULT NULL,
  `id_agdjjg_status_task` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_task`
--

INSERT INTO `agdjjg_task` (`id`, `suggested_task`, `description_task`, `date_task`, `id_agdjjg_user`, `id_agdjjg_status_task`) VALUES
(1, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2019-02-03', 1, 3),
(2, 'Lorem ipsum', 'Lorem ipsum', '2019-04-17', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `agdjjg_user`
--

CREATE TABLE `agdjjg_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `date_signup` char(10) NOT NULL,
  `key_user` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_agdjjg_status_user` int(11) NOT NULL,
  `id_agdjjg_avatar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `agdjjg_user`
--

INSERT INTO `agdjjg_user` (`id`, `first_name`, `last_name`, `mail`, `date_signup`, `key_user`, `password`, `id_agdjjg_status_user`, `id_agdjjg_avatar`) VALUES
(1, 'Maxime', 'Defretin', 'maxime.defretin@laposte.net', '2018-12-01', 4273, '$2y$10$9CXmGoV8X1c6MnabnNWEJ.13mv9I/QleiHLWX2NDAKD4BaVLV6wFO', 1, 1),
(2, 'Teste', 'Essaie', 'maximedefertin@gmail.com', '2018-06-27', 7049, '$2y$10$G1PwEAdyNbRJ/mZjCHrhMeeq0ViXwbUaD6.qMdPgFBJdMgjxjAm/G', 4, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `agdjjg_actuality`
--
ALTER TABLE `agdjjg_actuality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agdjjg_actuality_id_agdjjg_user` (`id_agdjjg_user`);

--
-- Index pour la table `agdjjg_actuality_comment_visitor`
--
ALTER TABLE `agdjjg_actuality_comment_visitor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agdjjg_actuality_comment_visitor_id_agdjjg_actuality` (`id_agdjjg_actuality`),
  ADD KEY `FK_id_answwer_id_agdjjg_actuality` (`id_answer_comment`);

--
-- Index pour la table `agdjjg_assigned`
--
ALTER TABLE `agdjjg_assigned`
  ADD PRIMARY KEY (`id`,`id_agdjjg_task`),
  ADD KEY `agdjjg_assigned_id_agdjjg_task` (`id_agdjjg_task`);

--
-- Index pour la table `agdjjg_avatar`
--
ALTER TABLE `agdjjg_avatar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agdjjg_avatar_id_agdjjg_user` (`id_agdjjg_user`);

--
-- Index pour la table `agdjjg_bookReaded`
--
ALTER TABLE `agdjjg_bookReaded`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_agdjjg_user` (`id_agdjjg_user`);

--
-- Index pour la table `agdjjg_event_association`
--
ALTER TABLE `agdjjg_event_association`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agdjjg_event_association_id_agdjjg_user` (`id_agdjjg_user`),
  ADD KEY `agdjjg_event_association_id_agdjjg_status_event` (`id_agdjjg_status_event`);

--
-- Index pour la table `agdjjg_participation`
--
ALTER TABLE `agdjjg_participation`
  ADD PRIMARY KEY (`id`,`id_agdjjg_event_association`),
  ADD KEY `agdjjg_participation_id_agdjjg_event_association` (`id_agdjjg_event_association`);

--
-- Index pour la table `agdjjg_status_event`
--
ALTER TABLE `agdjjg_status_event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agdjjg_status_task`
--
ALTER TABLE `agdjjg_status_task`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agdjjg_status_user`
--
ALTER TABLE `agdjjg_status_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agdjjg_task`
--
ALTER TABLE `agdjjg_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agdjjg_task_id_agdjjg_user` (`id_agdjjg_user`),
  ADD KEY `agdjjg_task_id_agdjjg_status_task` (`id_agdjjg_status_task`);

--
-- Index pour la table `agdjjg_user`
--
ALTER TABLE `agdjjg_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `agdjjg_user_id_agdjjg_status_user` (`id_agdjjg_status_user`),
  ADD KEY `agdjjg_user_id_agdjjg_avatar` (`id_agdjjg_avatar`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `agdjjg_actuality`
--
ALTER TABLE `agdjjg_actuality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `agdjjg_actuality_comment_visitor`
--
ALTER TABLE `agdjjg_actuality_comment_visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `agdjjg_avatar`
--
ALTER TABLE `agdjjg_avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `agdjjg_bookReaded`
--
ALTER TABLE `agdjjg_bookReaded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `agdjjg_event_association`
--
ALTER TABLE `agdjjg_event_association`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `agdjjg_status_event`
--
ALTER TABLE `agdjjg_status_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `agdjjg_status_task`
--
ALTER TABLE `agdjjg_status_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `agdjjg_status_user`
--
ALTER TABLE `agdjjg_status_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `agdjjg_task`
--
ALTER TABLE `agdjjg_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `agdjjg_user`
--
ALTER TABLE `agdjjg_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `agdjjg_actuality`
--
ALTER TABLE `agdjjg_actuality`
  ADD CONSTRAINT `agdjjg_actuality_id_agdjjg_user` FOREIGN KEY (`id_agdjjg_user`) REFERENCES `agdjjg_user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `agdjjg_actuality_comment_visitor`
--
ALTER TABLE `agdjjg_actuality_comment_visitor`
  ADD CONSTRAINT `FK_id_answwer_id_agdjjg_actuality` FOREIGN KEY (`id_answer_comment`) REFERENCES `agdjjg_actuality_comment_visitor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agdjjg_actuality_comment_visitor_id_agdjjg_actuality` FOREIGN KEY (`id_agdjjg_actuality`) REFERENCES `agdjjg_actuality` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `agdjjg_assigned`
--
ALTER TABLE `agdjjg_assigned`
  ADD CONSTRAINT `agdjjg_assigned_id` FOREIGN KEY (`id`) REFERENCES `agdjjg_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agdjjg_assigned_id_agdjjg_task` FOREIGN KEY (`id_agdjjg_task`) REFERENCES `agdjjg_task` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `agdjjg_avatar`
--
ALTER TABLE `agdjjg_avatar`
  ADD CONSTRAINT `agdjjg_avatar_id_agdjjg_user` FOREIGN KEY (`id_agdjjg_user`) REFERENCES `agdjjg_user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `agdjjg_bookReaded`
--
ALTER TABLE `agdjjg_bookReaded`
  ADD CONSTRAINT `FK_id_agdjjg_user_id_agdjjg_bookReaded` FOREIGN KEY (`id_agdjjg_user`) REFERENCES `agdjjg_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `agdjjg_event_association`
--
ALTER TABLE `agdjjg_event_association`
  ADD CONSTRAINT `agdjjg_event_association_id_agdjjg_status_event` FOREIGN KEY (`id_agdjjg_status_event`) REFERENCES `agdjjg_status_event` (`id`),
  ADD CONSTRAINT `agdjjg_event_association_id_agdjjg_user` FOREIGN KEY (`id_agdjjg_user`) REFERENCES `agdjjg_user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `agdjjg_participation`
--
ALTER TABLE `agdjjg_participation`
  ADD CONSTRAINT `agdjjg_participation_id` FOREIGN KEY (`id`) REFERENCES `agdjjg_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agdjjg_participation_id_agdjjg_event_association` FOREIGN KEY (`id_agdjjg_event_association`) REFERENCES `agdjjg_event_association` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `agdjjg_task`
--
ALTER TABLE `agdjjg_task`
  ADD CONSTRAINT `agdjjg_task_id_agdjjg_status_task` FOREIGN KEY (`id_agdjjg_status_task`) REFERENCES `agdjjg_status_task` (`id`),
  ADD CONSTRAINT `agdjjg_task_id_agdjjg_user` FOREIGN KEY (`id_agdjjg_user`) REFERENCES `agdjjg_user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `agdjjg_user`
--
ALTER TABLE `agdjjg_user`
  ADD CONSTRAINT `agdjjg_user_id_agdjjg_avatar` FOREIGN KEY (`id_agdjjg_avatar`) REFERENCES `agdjjg_avatar` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `agdjjg_user_id_agdjjg_status_user` FOREIGN KEY (`id_agdjjg_status_user`) REFERENCES `agdjjg_status_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

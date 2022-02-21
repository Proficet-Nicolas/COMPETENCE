# Documentation projet compétences (Développeur):

## <u>Identifiants de connections:</u>

![img](https://cdn.discordapp.com/attachments/802112548115578882/806887900365062144/unknown.png)

## <u>Sommaire</u>:

### <u>1</u>) BDD

### 1.1) MCD

### 1.2) MLD

### 1.3) Script SQL

### 2) Model

### 2.1) UML

## <u>1) BDD:</u>

### <u>1.1) MCD</u>

![image-20210204161844437](C:\Users\nicol\AppData\Roaming\Typora\typora-user-images\image-20210204161844437.png)

### <u>1.2) MLD</u>

Contexte = (id_contexte INT(11), contexte TEXT);
Type_de_compte = (id_type_compte VARCHAR(50), type VARCHAR(50));
options = (id_option VARCHAR(50), option VARCHAR(50));
Liens = (id_liens INT(11), URI VARCHAR(50), details VARCHAR(50), #id_situation);
Bloc = (id_bloc INT(11), nom TEXT);
Utilisateur = (id_EGNOM VARCHAR(255), id INT(11), nom VARCHAR(50), prenom VARCHAR(50), mdp VARCHAR(50), type_de_compte VARCHAR(50), option VARCHAR(50), #id_type_compte);
Situation = (id_situation INT(11), nom VARCHAR(50), date_debut DATE, details VARCHAR(50), date_creation DATE, duree INT(11), type_duree VARCHAR(50), etat TYNINT(1), id_contexte INT(11), id_user INT(11)#id_liens*, #id_contexte*);
Activite = (id_activite INT(11), nom TEXT, drawID Int(11) #id_bloc);
Competences = (id_competence INT(11), nom TEXT, drawID INT(11), #id_activite);
choisir = (#id_EGNOM, #id_option);
creer = (#id_EGNOM, #id);
viser = (#id, #id_competence);

### <u>1.3) Script SQL</u>

```sql
-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 fév. 2021 à 15:19
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `competences`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `id_activite` int(11) NOT NULL,
  `drawID` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `id_bloc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id_activite`, `drawID`, `nom`, `id_bloc`) VALUES
(1, 1, 'Gérer le patrimoine informatique', 1),
(2, 2, 'Répondre aux incidents et aux demandes d’assistance et d’évolution', 1),
(3, 3, 'Développer la présence en ligne de l’organisation', 1),
(4, 4, 'Travailler en mode projet', 1),
(5, 5, 'Mettre à disposition des utilisateurs un service informatique', 1),
(6, 6, 'Organiser son développement professionnel', 1),
(13, 1, 'Concevoir et développer une solution applicative', 2),
(14, 2, 'Assurer la maintenance corrective ou évolutive d’une solution applicative\r\n', 2),
(15, 3, 'Gérer les données\r\n', 2),
(16, 1, 'Protéger les données à caractère personnel', 3),
(17, 2, 'Préserver l\'identité numérique de l’organisation', 3),
(18, 3, 'Sécuriser les équipements et les usages des utilisateurs', 3),
(19, 4, 'Garantir la disponibilité, l’intégrité et la confidentialité des services informatiques et des données de l’organisation face à des cyberattaques', 3),
(20, 5, 'Assurer la cybersécurité d’une solution applicative et de son développement\r\n', 3);

-- --------------------------------------------------------

--
-- Structure de la table `bloc`
--

CREATE TABLE `bloc` (
  `id_bloc` int(11) NOT NULL,
  `nom` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bloc`
--

INSERT INTO `bloc` (`id_bloc`, `nom`) VALUES
(1, 'Support et mise à disposition de services informatiques'),
(2, 'Conception et développement d’applications'),
(3, 'Cybersécurité des services informatiques');

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id_competence` int(11) NOT NULL,
  `drawID` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `id_activite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id_competence`, `drawID`, `nom`, `id_activite`) VALUES
(1, 1, 'Recenser et identifier les ressources numériques', 1),
(2, 2, 'Exploiter des référentiels, normes et standards adoptés par le prestataire informatique', 1),
(3, 3, 'Mettre en place et vérifier les niveaux d’habilitation associés à un service', 1),
(4, 4, 'Vérifier les conditions de la continuité d’un service informatique', 1),
(5, 5, 'Gérer des sauvegardes', 1),
(6, 6, 'Vérifier le respect des règles d’utilisation des ressources numériques', 1),
(7, 1, 'Collecter, suivre et orienter des demandes', 2),
(8, 2, 'Traiter des demandes concernant les services réseau et système, applicatifs', 2),
(9, 3, 'Traiter des demandes concernant les applications', 2),
(10, 1, 'Participer à la valorisation de l’image de l’organisation sur les médias numériques en tenant compte du cadre juridique et des enjeux économiques', 3),
(11, 2, 'Référencer les services en ligne de l’organisation et mesurer leur visibilité.', 3),
(12, 3, 'Participer à l’évolution d’un site Web exploitant les données de l’organisation.', 3),
(13, 1, 'Analyser les objectifs et les modalités d’organisation d’un projet', 4),
(14, 2, 'Planifier les activités', 4),
(15, 3, 'Évaluer les indicateurs de suivi d’un projet et analyser les écarts', 4),
(16, 1, 'Réaliser les tests d’intégration et d’acceptation d’un service', 5),
(17, 2, 'Déployer un service', 5),
(18, 3, 'Accompagner les utilisateurs dans la mise en place d’un service', 5),
(19, 1, 'Mettre en place son environnement d’apprentissage personnel', 6),
(20, 2, 'Mettre en œuvre des outils et stratégies de veille informationnelle', 6),
(21, 3, 'Gérer son identité professionnelle', 6),
(22, 4, 'Développer son projet professionnel', 6),
(23, 1, 'Analyser un besoin exprimé et son contexte juridique', 13),
(24, 2, 'Participer à la conception de l’architecture d’une solution applicative', 13),
(25, 3, 'Modéliser une solution applicative', 13),
(26, 4, 'Exploiter les ressources du cadre applicatif (framework)', 13),
(27, 5, 'Identifier, développer, utiliser ou adapter des composants logiciels', 13),
(28, 6, 'Exploiter les technologies Web pour mettre en œuvre les échanges entre applications, y compris de mobilité', 13),
(29, 7, 'Utiliser des composants d’accès aux données', 13),
(30, 8, 'Intégrer en continu les versions d’une solution applicative', 13),
(31, 9, 'Réaliser les tests nécessaires à la validation ou à la mise en production d’éléments adaptés ou développés', 13),
(32, 10, 'Rédiger des documentations technique et d’utilisation d’une solution applicative', 13),
(33, 11, 'Exploiter les fonctionnalités d’un environnement de développement et de tests', 13),
(34, 1, 'Recueillir, analyser et mettre à jour les informations sur une version d’une solution applicative', 14),
(35, 2, 'Évaluer la qualité d’une solution applicative', 14),
(36, 3, 'Analyser et corriger un dysfonctionnement', 14),
(37, 4, 'Mettre à jour des documentations technique et d’utilisation d’une solution applicative', 14),
(38, 5, 'Élaborer et réaliser les tests des éléments mis à jour', 14),
(39, 1, 'Exploiter des données à l’aide d’un langage de requêtes', 15),
(40, 2, 'Développer des fonctionnalités applicatives au sein d’un système de gestion de base de données (relationnel ou non)', 15),
(41, 3, 'Concevoir ou adapter une base de données', 15),
(42, 4, 'Administrer et déployer une base de données', 15),
(43, 1, 'Recenser les traitements sur les données à caractère personnel au sein de l’organisation', 16),
(44, 2, 'Identifier les risques liés à la collecte, au traitement, au stockage et à la diffusion des données à caractère personnel', 16),
(45, 3, 'Appliquer la réglementation en matière de collecte, de traitement et de conservation des données à caractère personnel', 16),
(46, 4, 'Sensibiliser les utilisateurs à la protection des données à caractère personnel', 16),
(47, 1, 'Protéger l’identité numérique d’une organisation', 17),
(48, 2, 'Déployer les moyens appropriés de preuve électronique', 17),
(49, 1, 'Informer les utilisateurs sur les risques associés à l’utilisation d’une ressource numérique et promouvoir les bons usages à adopter', 18),
(50, 2, 'Identifier les menaces et mettre en œuvre les défenses appropriées', 18),
(51, 3, 'Gérer les accès et les privilèges appropriés', 18),
(52, 4, 'Vérifier l’efficacité de la protection', 18),
(53, 1, 'Caractériser les risques liés à l’utilisation malveillante d’un service informatique', 19),
(54, 2, 'Recenser les conséquences d’une perte de disponibilité, d’intégrité ou de confidentialité', 19),
(55, 3, 'Identifier les obligations légales qui s’imposent en matière d’archivage et de protection des données de l’organisation', 19),
(56, 4, 'Organiser la collecte et la conservation des preuves numériques', 19),
(57, 5, 'Appliquer les procédures garantissant le respect des obligations légales', 19),
(58, 1, 'Participer à la vérification des éléments contribuant à la qualité d’un développement informatique', 20),
(59, 2, 'Prendre en compte la sécurité dans un projet de développement d’une solution applicative', 20),
(60, 3, 'Mettre en œuvre et vérifier la conformité d’une solution applicative et de son développement à un référentiel, une norme ou un standard de sécurité', 20),
(61, 4, 'Prévenir les attaques', 20),
(62, 5, 'Analyser les connexions (logs)', 20),
(63, 6, 'Analyser des incidents de sécurité, proposer et mettre en œuvre des contre-mesures', 20);

-- --------------------------------------------------------

--
-- Structure de la table `contexte`
--

CREATE TABLE `contexte` (
  `id_contexte` int(11) NOT NULL,
  `contexte` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contexte`
--

INSERT INTO `contexte` (`id_contexte`, `contexte`) VALUES
(1, 'Atelier'),
(2, 'TP'),
(3, 'Stage 1'),
(4, 'Stage 2'),
(5, 'Personnel');

-- --------------------------------------------------------

--
-- Structure de la table `liens`
--

CREATE TABLE `liens` (
  `id_liens` int(11) NOT NULL,
  `URI` varchar(50) DEFAULT NULL,
  `details` varchar(50) DEFAULT NULL,
  `id_situation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liens`
--

INSERT INTO `liens` (`id_liens`, `URI`, `details`, `id_situation`) VALUES
(10, 'dSQDSQDZQ.html', 'dsqdqhgdlkq', 6),
(59, '', '', 54);

-- --------------------------------------------------------

--
-- Structure de la table `situation`
--

CREATE TABLE `situation` (
  `id_situation` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `details` varchar(50) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `type_duree` varchar(50) DEFAULT NULL,
  `etat` tinyint(1) NOT NULL,
  `id_contexte` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `situation`
--

INSERT INTO `situation` (`id_situation`, `nom`, `date_debut`, `details`, `date_creation`, `duree`, `type_duree`, `etat`, `id_contexte`, `id_user`) VALUES
(6, 'blablablaopéuodq', '2013-01-16', 'oui le détail de tout ça dnqsklmhdjklqsjdmqsl', '2021-02-18', 2, 'an(s)', 0, 1, 2),
(54, 'test competencesdada', '2021-02-01', 'ceqdzq', '2021-02-18', 23, 'jour(s)', 0, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `id_EGNOM` varchar(255) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `mdp` varchar(50) DEFAULT NULL,
  `type_de_compte` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `id_EGNOM`, `nom`, `prenom`, `mdp`, `type_de_compte`) VALUES
(1, 'admin', 'ETTOUIL2', 'Adel2', 'student', 'administrateur'),
(2, 'collab', 'ETTOUIL', 'Adel', 'student', 'collaborateur');

-- --------------------------------------------------------

--
-- Structure de la table `viser`
--

CREATE TABLE `viser` (
  `id_situation` int(11) NOT NULL,
  `id_competence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `viser`
--

INSERT INTO `viser` (`id_situation`, `id_competence`) VALUES
(6, 35),
(6, 41),
(54, 2),
(54, 3),
(54, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`id_activite`),
  ADD KEY `id_bloc` (`id_bloc`);

--
-- Index pour la table `bloc`
--
ALTER TABLE `bloc`
  ADD PRIMARY KEY (`id_bloc`);

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id_competence`),
  ADD KEY `id_activite` (`id_activite`);

--
-- Index pour la table `contexte`
--
ALTER TABLE `contexte`
  ADD PRIMARY KEY (`id_contexte`);

--
-- Index pour la table `liens`
--
ALTER TABLE `liens`
  ADD PRIMARY KEY (`id_liens`),
  ADD KEY `id_situation` (`id_situation`);

--
-- Index pour la table `situation`
--
ALTER TABLE `situation`
  ADD PRIMARY KEY (`id_situation`),
  ADD KEY `id_contexte` (`id_contexte`),
  ADD KEY `situation_ibfk_2` (`id_user`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `viser`
--
ALTER TABLE `viser`
  ADD PRIMARY KEY (`id_situation`,`id_competence`),
  ADD KEY `id_competence` (`id_competence`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `bloc`
--
ALTER TABLE `bloc`
  MODIFY `id_bloc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `contexte`
--
ALTER TABLE `contexte`
  MODIFY `id_contexte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `liens`
--
ALTER TABLE `liens`
  MODIFY `id_liens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `situation`
--
ALTER TABLE `situation`
  MODIFY `id_situation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`id_bloc`) REFERENCES `bloc` (`id_bloc`);

--
-- Contraintes pour la table `competences`
--
ALTER TABLE `competences`
  ADD CONSTRAINT `competences_ibfk_1` FOREIGN KEY (`id_activite`) REFERENCES `activite` (`id_activite`);

--
-- Contraintes pour la table `liens`
--
ALTER TABLE `liens`
  ADD CONSTRAINT `liens_ibfk_1` FOREIGN KEY (`id_situation`) REFERENCES `situation` (`id_situation`);

--
-- Contraintes pour la table `situation`
--
ALTER TABLE `situation`
  ADD CONSTRAINT `situation_ibfk_1` FOREIGN KEY (`id_contexte`) REFERENCES `contexte` (`id_contexte`),
  ADD CONSTRAINT `situation_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `viser`
--
ALTER TABLE `viser`
  ADD CONSTRAINT `viser_ibfk_1` FOREIGN KEY (`id_situation`) REFERENCES `situation` (`id_situation`),
  ADD CONSTRAINT `viser_ibfk_2` FOREIGN KEY (`id_competence`) REFERENCES `competences` (`id_competence`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```




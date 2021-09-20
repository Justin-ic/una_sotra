-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 20 sep. 2021 à 18:51
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `una_sotra_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `bilan_clients`
--

CREATE TABLE `bilan_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clients_id` bigint(20) UNSIGNED NOT NULL,
  `etat` int(11) NOT NULL,
  `commentaire` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempsArrive` time NOT NULL,
  `debutService` time NOT NULL,
  `finService` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `nce` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debutService` time DEFAULT NULL,
  `finService` time DEFAULT NULL,
  `commentaire` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `servit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `genre`, `numero`, `nce`, `debutService`, `finService`, `commentaire`, `servit`, `created_at`, `updated_at`) VALUES
(2, 'BOKO', 'N\'Doko', 'F', 1234, 'NCE', '21:06:55', '21:09:12', NULL, 1, '2021-09-18 20:24:30', '2021-09-18 21:07:12'),
(3, 'KOLO', 'Justin', 'H', 777, 'NCE', '00:00:00', '00:00:00', '', 0, '2021-09-18 20:25:04', '2021-09-18 20:25:04'),
(4, 'JUJU', 'Justin', 'H', 112, 'NCE', '00:00:00', '00:00:00', '', 0, '2021-09-18 20:28:19', '2021-09-18 20:28:19'),
(5, 'BOKO', 'Justin', 'H', 222, 'CI0210044596', '21:07:12', '21:09:19', NULL, 1, '2021-09-18 20:56:32', '2021-09-18 21:07:19'),
(6, 'BOKO', 'Justin', 'H', 666, 'NCE', '21:07:19', '21:09:25', NULL, 1, '2021-09-18 20:57:01', '2021-09-18 21:07:25'),
(7, 'JUJU', 'N\'Doko', 'H', 66, 'NCE', '21:07:26', '21:09:40', NULL, 1, '2021-09-18 20:59:35', '2021-09-18 21:07:40'),
(8, 'BOKO', 'Justin', 'H', 777, 'CI0210044596', NULL, NULL, NULL, 0, '2021-09-18 21:08:30', '2021-09-18 21:08:30');

-- --------------------------------------------------------

--
-- Structure de la table `descriptions`
--

CREATE TABLE `descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `descriptions`
--

INSERT INTO `descriptions` (`id`, `detail`, `services_id`, `created_at`, `updated_at`) VALUES
(1, 'Dépôt', 1, '2021-08-18 19:04:15', '2021-08-18 19:17:41'),
(2, 'Retrait', 1, '2021-08-18 19:07:23', '2021-08-18 19:07:23'),
(3, 'Reparation de puce', 2, '2021-08-18 19:07:53', '2021-08-18 19:07:53'),
(5, 'Reparation de Live Box', 2, '2021-08-18 19:18:14', '2021-08-18 19:18:14'),
(6, 'Achat de puce', 3, '2021-09-18 20:25:54', '2021-09-18 20:25:54'),
(7, 'Achat de téléphone', 3, '2021-09-18 20:25:54', '2021-09-18 20:25:54');

-- --------------------------------------------------------

--
-- Structure de la table `guichets`
--

CREATE TABLE `guichets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lettre_guichet` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_id` bigint(20) UNSIGNED NOT NULL,
  `personnel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `guichets`
--

INSERT INTO `guichets` (`id`, `lettre_guichet`, `services_id`, `personnel_id`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, 2, '2021-08-16 11:13:28', '2021-08-18 09:57:48'),
(2, 'B', 2, 3, '2021-08-16 11:13:28', '2021-08-18 09:57:59'),
(3, 'C', 3, 5, '2021-08-18 09:26:11', '2021-08-18 10:10:01');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_08_11_192202_create_personnels_table', 1),
(2, '2021_08_11_204945_create_services_table', 1),
(3, '2021_08_11_205048_create_clients_table', 1),
(4, '2021_08_11_205109_create_guichets_table', 1),
(5, '2021_08_12_214617_create_descriptions_table', 1),
(6, '2021_08_14_111832_create_bilan_clients_table', 2),
(7, '2021_08_23_114008_create_tickets_table', 3),
(8, '2021_08_23_205259_create_tickets_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE `personnels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `user` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnels`
--

INSERT INTO `personnels` (`id`, `nom`, `prenom`, `dateNaissance`, `user`, `pass`, `type`, `created_at`, `updated_at`) VALUES
(1, 'OUATTARA', 'Gninlnafanlan Justin', '1995-06-15', 'justin@vale', 'juju', 'admin', '2021-08-16 11:08:30', '2021-08-16 11:08:30'),
(2, 'VALERIE', 'Mon coeur', '2000-03-25', 'vale@juju', 'juju', 'personnel', '2021-08-16 11:12:58', '2021-08-16 11:13:07'),
(3, 'OUATTARA', 'Gninlnafanlan', '2021-08-18', 'juju@gmail.com', 'juju', 'personnel', '2021-08-18 14:00:41', '2021-08-18 17:47:03'),
(5, 'OUATTARA', 'Justin', '1995-06-15', 'justin@valeC', 'juju', 'personnel', '2021-08-16 11:08:30', '2021-08-16 11:08:30');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Transactions', '2021-08-12 23:22:31', '2021-08-18 18:25:26'),
(2, 'Reparation', '2021-08-12 23:22:31', '2021-08-18 18:25:55'),
(3, 'Achat', '2021-08-12 23:22:31', '2021-08-12 23:22:31');

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `description` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tAttenteEstime` time NOT NULL,
  `nbClientAvant` int(11) NOT NULL,
  `clients_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `description`, `ticket`, `tAttenteEstime`, `nbClientAvant`, `clients_id`, `created_at`, `updated_at`) VALUES
(2, 'Dépôt', 'A-2', '00:30:00', 1, 2, '2021-09-18 20:24:30', '2021-09-18 20:24:30'),
(3, 'Reparation de puce', 'B-1', '00:00:00', 0, 3, '2021-09-18 20:25:04', '2021-09-18 20:25:04'),
(4, 'Achat de téléphone', 'C-1', '00:00:00', 0, 4, '2021-09-18 20:28:19', '2021-09-18 20:28:19'),
(5, 'Retrait', 'A-2', '00:30:00', 1, 5, '2021-09-18 20:56:32', '2021-09-18 20:56:32'),
(6, 'Retrait', 'A-3', '01:00:00', 2, 6, '2021-09-18 20:57:01', '2021-09-18 20:57:01'),
(7, 'Dépôt', 'A-4', '02:30:00', 3, 7, '2021-09-18 20:59:35', '2021-09-18 20:59:35'),
(8, 'Retrait', 'A-5', '00:00:00', 0, 8, '2021-09-18 21:08:30', '2021-09-18 21:08:30');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bilan_clients`
--
ALTER TABLE `bilan_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bilan_clients_clients_id_foreign` (`clients_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `descriptions`
--
ALTER TABLE `descriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descriptions_service_foreign` (`services_id`);

--
-- Index pour la table `guichets`
--
ALTER TABLE `guichets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guichets_service_index` (`services_id`),
  ADD KEY `guichets_personnel_index` (`personnel_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_id` (`clients_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bilan_clients`
--
ALTER TABLE `bilan_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `descriptions`
--
ALTER TABLE `descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `guichets`
--
ALTER TABLE `guichets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `personnels`
--
ALTER TABLE `personnels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bilan_clients`
--
ALTER TABLE `bilan_clients`
  ADD CONSTRAINT `bilan_clients_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `descriptions`
--
ALTER TABLE `descriptions`
  ADD CONSTRAINT `descriptions_service_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `guichets`
--
ALTER TABLE `guichets`
  ADD CONSTRAINT `guichets_personnel_foreign` FOREIGN KEY (`personnel_id`) REFERENCES `personnels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guichets_service_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

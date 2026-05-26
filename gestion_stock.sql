-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3307
-- Généré le : dim. 24 mai 2026 à 02:57
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
-- Base de données : `gestion_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_achat` date NOT NULL,
  `fournisseur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `date_achat`, `fournisseur_id`, `created_at`, `updated_at`) VALUES
(1, '2025-06-19', 3, '2025-06-17 21:19:42', '2025-06-19 15:25:34'),
(2, '2025-06-19', 2, '2025-06-19 14:17:37', '2025-06-19 14:17:37'),
(3, '2025-06-19', 3, '2025-06-19 15:25:58', '2025-06-19 15:25:58');

-- --------------------------------------------------------

--
-- Structure de la table `achat_produits`
--

CREATE TABLE `achat_produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `achat_id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `achat_produits`
--

INSERT INTO `achat_produits` (`id`, `achat_id`, `produit_id`, `quantite`, `prix_unitaire`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 78, 890.00, '2025-06-19 14:17:37', '2025-06-19 14:17:37'),
(3, 1, 1, 6, 900.00, '2025-06-19 15:25:34', '2025-06-19 15:25:34'),
(4, 3, 1, 34, 34.00, '2025-06-19 15:25:58', '2025-06-19 15:25:58');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Ciment', 'Matériaux de constructio', NULL, '2025-06-19 22:57:34'),
(2, 'Bois', 'Bois de menuiserie', NULL, NULL),
(3, 'Peinture', 'Peinture pour murs', NULL, NULL),
(10, 'Électronique', 'Appareils électroniques et gadgets', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(11, 'Informatique', 'Ordinateurs, périphériques et accessoires', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(12, 'Meubles', 'Meubles de bureau et domestiques', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(13, 'Fournitures de bureau', 'Articles de papeterie et consommables', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(14, 'Téléphonie', 'Smartphones et accessoires mobiles', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(15, 'Électroménager', 'Appareils ménagers et cuisine', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(16, 'Luminaires', 'Éclairage intérieur et extérieur', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(17, 'Décoration', 'Articles de décoration intérieure', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(18, 'Bricolage', 'Outils et matériaux de construction', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(19, 'Jardinage', 'Plantes, outils et accessoires de jardin', '2025-05-24 15:46:59', '2025-05-24 15:46:59'),
(20, 'test', 'test', '2025-06-19 22:59:27', '2025-06-19 22:59:27');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `email`, `telephone`, `adresse`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Client 2', 'client2@example.com', '0600000002', 'Adresse 2', '2025-05-24 11:46:42', '2025-05-24 16:21:30', '2025-05-24 16:21:30'),
(3, 'Client 3', 'client3@example.com', '0600000003', 'Adresse 3', '2025-05-24 11:46:42', '2025-05-24 16:21:35', '2025-05-24 16:21:35'),
(4, 'Client 4', 'client4@example.com', '0600000004', 'Adresse 4', '2025-05-24 11:46:42', '2025-05-24 16:21:39', '2025-05-24 16:21:39'),
(5, 'Client 5', 'client5@example.com', '0600000005', 'Adresse 5', '2025-05-24 11:46:42', '2025-05-24 16:21:44', '2025-05-24 16:21:44'),
(6, 'Client 6', 'client6@example.com', '0600000006', 'Adresse 6', '2025-05-24 11:46:42', '2025-05-24 16:21:48', '2025-05-24 16:21:48'),
(7, 'Client 7', 'client7@example.com', '0600000007', 'Adresse 7', '2025-05-24 11:46:42', '2025-05-24 16:21:52', '2025-05-24 16:21:52'),
(8, 'Client 8', 'client8@example.com', '0600000008', 'Adresse 8', '2025-05-24 11:46:42', '2025-05-24 16:21:56', '2025-05-24 16:21:56'),
(9, 'Client 9', 'client9@example.com', '0600000009', 'Adresse 9', '2025-05-24 11:46:42', '2025-05-24 16:22:01', '2025-05-24 16:22:01'),
(10, 'Client 10', 'client10@example.com', '06000000010', 'Adresse 10', '2025-05-24 11:46:42', '2025-05-24 16:22:05', '2025-05-24 16:22:05'),
(11, 'Mohamed El Amrani', 'mohamed.elamrani@example.com', '0612345678', '123 Rue Mohammed V, Casablanca', '2025-05-24 15:39:56', '2025-05-24 16:23:32', '2025-05-24 16:23:32'),
(12, 'Fatima Zahra marwan', 'fatima.benali@example.com', '0623456789', '45 Avenue Hassan II, Ra', '2025-05-24 15:39:56', '2025-07-11 07:52:15', '2025-07-11 07:52:15'),
(13, 'Karim Belhaj', 'karim.belhaj@example.com', '0634567890', '67 Boulevard Zerktouni, Marrakech', '2025-05-24 15:39:56', '2025-05-24 16:23:38', '2025-05-24 16:23:38'),
(14, 'Amina Toumi', 'amina.toumi@example.com', '0645678901', '89 Rue Palestine, Tanger', '2025-05-24 15:39:56', '2025-06-18 18:57:43', '2025-06-18 18:57:43'),
(15, 'Youssef Chahidi', 'youssef.chahidi@example.com', '0656789012', '34 Avenue Al Amir Fal Oualou, Fès', '2025-05-24 15:39:56', '2025-05-24 16:24:29', '2025-05-24 16:24:29'),
(16, 'Nadia El Fassi', NULL, '0667890123', '12 Rue Ibn Batouta, Agadir', '2025-05-24 15:39:56', '2025-05-24 16:22:24', '2025-05-24 16:22:24'),
(17, 'Hassan Berrada', 'hassan.berrada@example.com', NULL, '56 Avenue des FAR, Meknès', '2025-05-24 15:39:56', '2025-05-24 16:22:31', '2025-05-24 16:22:31'),
(18, 'Leila Mansouri', 'leila.mansouri@example.com', '0689012345', NULL, '2025-05-24 15:39:56', '2025-05-24 16:22:36', '2025-05-24 16:22:36'),
(19, 'Omar El Khattabi', 'omar.elkhattabi@example.com', '0690123456', '78 Rue de la Liberté, Oujda', '2025-05-24 15:39:56', '2025-05-24 16:23:46', '2025-05-24 16:23:46'),
(20, 'Samira El Fassi', 'samira.elfassi@example.com', '0601234567', '90 Avenue Ibn Sina, Kénitra', '2025-05-24 15:39:56', '2025-05-24 16:25:18', '2025-05-24 16:25:18'),
(21, 'Mohamed El Amrani', 'mohamed.elamrani@example.com', '0612345678', '123 Rue Mohammed V, Casablanca', '2025-05-24 15:41:21', '2025-05-24 15:41:21', NULL),
(22, 'Fatima Zahra Benali', 'fatima.benali@example.com', '0623456789', '45 Avenue Hassan II, Rabat', '2025-05-24 15:41:21', '2025-05-24 16:25:02', '2025-05-24 16:25:02'),
(23, 'Karim Belhaj', 'karim.belhaj@example.com', '0634567890', '67 Boulevard Zerktouni, Marrakech', '2025-05-24 15:41:21', '2025-05-24 15:41:21', NULL),
(24, 'Amina Toumi', 'amina.toumi@example.com', '0645678901', '89 Rue Palestine, Tanger', '2025-05-24 15:41:21', '2025-05-24 16:25:10', '2025-05-24 16:25:10'),
(25, 'Youssef Chahidi', 'youssef.chahidi@example.com', '0656789012', '34 Avenue Al Amir Fal Oualou, Fès', '2025-05-24 15:41:21', '2025-05-24 15:41:21', NULL),
(26, 'Nadia El Fassi', NULL, '0667890123', '12 Rue Ibn Batouta, Agadir', '2025-05-24 15:41:21', '2025-05-24 16:22:42', '2025-05-24 16:22:42'),
(27, 'Hassan Berrada', 'hassan.berrada@example.com', NULL, '56 Avenue des FAR, Meknès', '2025-05-24 15:41:21', '2025-05-24 16:22:48', '2025-05-24 16:22:48'),
(28, 'Leila Mansouri', 'leila.mansouri@example.com', '0689012345', NULL, '2025-05-24 15:41:21', '2025-05-24 16:22:54', '2025-05-24 16:22:54'),
(29, 'Omar El Khattabi', 'omar.elkhattabi@example.com', '0690123456', '78 Rue de la Liberté, Oujda', '2025-05-24 15:41:21', '2025-05-24 16:24:22', '2025-05-24 16:24:22'),
(30, 'Samira El Fassi', 'samira.elfassi@example.com', '0601234567', '90 Avenue Ibn Sina, Kénitra', '2025-05-24 15:41:21', '2025-05-24 15:41:21', NULL),
(31, 'Mohamed El Amrani', 'mohamed.elamrani@example.com', '0612345678', '123 Rue Mohammed V, Casablanca', '2025-05-24 15:46:59', '2025-05-24 16:25:24', '2025-05-24 16:25:24'),
(32, 'Fatima Zahra Benali', 'fatima.benali@example.com', '0623456789', '45 Avenue Hassan II, Rabat', '2025-05-24 15:46:59', '2025-05-24 16:25:31', '2025-05-24 16:25:31'),
(33, 'Karim Belhaj', 'karim.belhaj@example.com', '0634567890', '67 Boulevard Zerktouni, Marrakech', '2025-05-24 15:46:59', '2025-05-24 15:46:59', NULL),
(34, 'Amina Toumi', 'amina.toumi@example.com', '0645678901', '89 Rue Palestine, Tanger', '2025-05-24 15:46:59', '2025-05-24 16:24:15', '2025-05-24 16:24:15'),
(35, 'Youssef Chahidi', 'youssef.chahidi@example.com', '0656789012', '34 Avenue Al Amir Fal Oualou, Fès', '2025-05-24 15:46:59', '2025-05-24 15:46:59', NULL),
(36, 'Nadia El Fassi', NULL, '0667890123', '12 Rue Ibn Batouta, Agadir', '2025-05-24 15:46:59', '2025-05-24 16:22:18', '2025-05-24 16:22:18'),
(37, 'Hassan Berrada', 'hassan.berrada@example.com', NULL, '56 Avenue des FAR, Meknès', '2025-05-24 15:46:59', '2025-05-24 16:23:00', '2025-05-24 16:23:00'),
(38, 'Leila Mansouri', 'leila.mansouri@example.com', '0689012345', NULL, '2025-05-24 15:46:59', '2025-05-24 16:23:05', '2025-05-24 16:23:05'),
(39, 'Omar El Khattabi', 'omar.elkhattabi@example.com', '0690123456', '78 Rue de la Liberté, Oujda', '2025-05-24 15:46:59', '2025-05-24 15:46:59', NULL),
(40, 'Samira El Fassi', 'samira.elfassi@example.com', '0601234567', '90 Avenue Ibn Sina, Kénitra', '2025-05-24 15:46:59', '2025-05-24 16:24:44', '2025-05-24 16:24:44'),
(41, 'YAHYA ELKHAL', 'yahyaelkhal46@gmail.com', '0688703364', 'Rue 1 Jamila 2', '2025-06-17 13:06:43', '2025-06-17 13:06:43', NULL),
(42, 'SOUHAIL ID', 'yahyaelkhal46@gmail.com', '0688703364', 'Rue 1 Jamila 2', '2025-06-17 13:07:00', '2025-07-08 19:52:15', NULL),
(43, 'IKHLASS EL KHAL', 'ikh@gmail.com', '0688703364', 'Rue 1 Jamila 2', '2025-06-17 15:41:36', '2025-06-17 15:42:12', '2025-06-17 15:42:12'),
(44, 'test', 'test@gmail', '07393893', 'Rue 1 Jamila 2', '2025-06-19 23:10:07', '2025-06-19 23:10:07', NULL),
(45, 'Anwar brdani', 'anwar@gmail.com', '0688703364', 'Rue 1 Jamila 2', '2025-06-20 21:22:53', '2025-06-20 21:23:15', '2025-06-20 21:23:15');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `email`, `telephone`, `adresse`, `created_at`, `updated_at`) VALUES
(1, 'TechnoImport Maroc', 'contact@technoimport.ma', '0522228090', '45 Avenue Hassan II, Casablanca', '2025-05-24 16:36:43', '2025-06-19 20:50:09'),
(2, 'ElectroDistrib', 'info@electrodistrib.ma', '0533788990', '12 Rue Mohammed V, Rabat', '2025-05-24 16:36:43', '2025-05-24 16:36:43'),
(3, 'MegaFournitures', NULL, '0612345678', '33 Boulevard Zerktouni, Marrakech', '2025-05-24 16:36:43', '2025-05-24 16:36:43'),
(4, 'OfficePro', 'ventes@officepro.ma', '0522887766', '67 Rue Palestine, Tanger', '2025-05-24 16:36:43', '2025-05-24 16:36:43'),
(5, 'HighTech Solutions', 'contact@hightech.ma', '0667890123', '89 Avenue Al Amir Fal Oualou, Fès', '2025-05-24 16:36:43', '2025-05-24 16:36:43'),
(6, 'Bureau & Co', 'info@bureauco.ma', '0533654789', NULL, '2025-05-24 16:36:43', '2025-05-24 16:36:43'),
(7, 'ElectroPlus', 'electroplus@example.com', '0678901234', '56 Avenue des FAR, Meknès', '2025-05-24 16:36:43', '2025-05-24 16:36:43'),
(8, 'Global Import', 'import@global.ma', NULL, '78 Rue de la Liberté, Oujda', '2025-05-24 16:36:43', '2025-05-24 16:36:43'),
(9, 'TechMaroc', 'tech@maroc.ma', '0689012345', '90 Avenue Ibn Sina, Kénitra', '2025-05-24 16:36:43', '2025-05-24 16:36:43'),
(10, 'Fournitures Express', 'express@fournitures.ma', '0690123456', '123 Rue Ibn Tachfine, Agadir', '2025-05-24 16:36:43', '2025-05-24 16:36:43');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_05_01_152123_create_categories_table', 1),
(7, '2025_05_01_152134_create_produits_table', 1),
(8, '2025_05_01_152144_create_fournisseurs_table', 1),
(9, '2025_05_01_152152_create_clients_table', 1),
(10, '2025_05_01_152202_create_achats_table', 1),
(11, '2025_05_01_152215_create_achat_produits_table', 1),
(12, '2025_05_01_152225_create_ventes_table', 1),
(13, '2025_05_01_152234_create_vente_produits_table', 1),
(14, '2025_05_05_233615_create_permission_tables', 1),
(15, '2025_05_19_164852_add_deleted_at_to_clients_table', 1),
(16, '2025_06_16_213541_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view dashboard', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(2, 'manage users', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(3, 'manage roles', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(4, 'manage permissions', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(5, 'manage clients', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(6, 'manage produits', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(7, 'manage achats', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(8, 'manage ventes', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(9, 'view rapports', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `quantite_en_stock` int(11) NOT NULL DEFAULT 0,
  `prix` decimal(10,2) DEFAULT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `quantite_en_stock`, `prix`, `categorie_id`, `created_at`, `updated_at`) VALUES
(1, 'bois', 'c\'est le bois', 67, 290.00, 2, '2025-06-17 12:42:34', '2025-06-19 15:26:52'),
(2, 'fer', 'c\'est le fer', 687, 200.00, 18, '2025-06-19 18:37:48', '2025-06-19 18:37:48'),
(3, 'ciment', 'ciment', 678, 500.00, 1, '2025-06-19 18:46:02', '2025-06-19 18:46:02');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-05-24 11:34:16', '2025-06-19 18:29:54'),
(2, 'Manager', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(3, 'Vendeur', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(4, 'Magasinier', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(5, 'Consultant', 'web', '2025-05-24 11:34:16', '2025-05-24 11:34:16'),
(8, 'souhail', 'web', '2025-07-11 08:40:00', '2025-07-11 08:40:00');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 8),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 4),
(7, 1),
(7, 2),
(7, 4),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(9, 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$v5uLkILeGug5wygOZploO.ZsBVRjZxe3cP4WsaRa.BMHUtu06HQ12', NULL, '2025-05-24 11:34:16', '2025-06-13 17:42:56'),
(2, 'yahya elkhal', 'yahyaelkhal46@gmail.com', NULL, '$2y$12$EeBcXrQPnk2i5mVO8jC08uafNwflJ6Xp3xh0ez.0sd7X5XZsJhDdy', NULL, '2025-06-11 16:44:13', '2025-06-19 16:44:35'),
(3, 'LEO', 'leo@gmail.com', NULL, '$2y$12$lWsZfyHDw3UuDrdXQg//y.hxOesy.JHLFbsjOmoaFDgDjsB6TAROC', NULL, '2025-06-17 14:09:44', '2025-06-17 14:09:44'),
(7, 'souhail id', 'sou@gmail.com', NULL, '$2y$12$GgCjJo3kDOmp3hZQzwC57Oko03x0jdKkHawUts4d6cPi6OhAQ.N7S', NULL, '2025-06-19 16:47:31', '2025-06-19 16:47:31'),
(10, 'magasinier', 'magasinier@gmail.com', NULL, '$2y$12$tD4Rct.7tc7tgkZCaDGWj.t/AWsLIOKvviHspI5z6QmhgdAzi6nZa', NULL, '2025-06-21 22:15:20', '2025-06-21 22:15:20'),
(11, 'CONSULTANT', 'cons@gmail.com', NULL, '$2y$12$RjyHBujQEvi1tEs9vu4Wv.DGeG4hRNSYEKd8Xgc6NB7G/n9S5fnUS', NULL, '2025-06-21 22:15:53', '2025-06-21 22:15:53');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_vente` date NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `date_vente`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '2025-06-18', 23, '2025-06-17 21:20:52', '2025-06-19 15:20:42'),
(3, '2025-06-19', 21, '2025-06-19 14:56:58', '2025-06-19 14:56:58'),
(4, '2025-06-19', 25, '2025-06-19 15:26:52', '2025-06-19 15:26:52');

-- --------------------------------------------------------

--
-- Structure de la table `vente_produits`
--

CREATE TABLE `vente_produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vente_id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vente_produits`
--

INSERT INTO `vente_produits` (`id`, `vente_id`, `produit_id`, `quantite`, `prix_unitaire`, `created_at`, `updated_at`) VALUES
(4, 3, 1, 68, 78.00, '2025-06-19 14:56:58', '2025-06-19 14:56:58'),
(5, 1, 1, 3, 23.00, '2025-06-19 15:20:42', '2025-06-19 15:20:42'),
(6, 4, 1, 7, 34.00, '2025-06-19 15:26:52', '2025-06-19 15:26:52');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achats_fournisseur_id_foreign` (`fournisseur_id`);

--
-- Index pour la table `achat_produits`
--
ALTER TABLE `achat_produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achat_produits_achat_id_foreign` (`achat_id`),
  ADD KEY `achat_produits_produit_id_foreign` (`produit_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_categorie_id_foreign` (`categorie_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventes_client_id_foreign` (`client_id`);

--
-- Index pour la table `vente_produits`
--
ALTER TABLE `vente_produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vente_produits_vente_id_foreign` (`vente_id`),
  ADD KEY `vente_produits_produit_id_foreign` (`produit_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `achat_produits`
--
ALTER TABLE `achat_produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vente_produits`
--
ALTER TABLE `vente_produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `achats_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `achat_produits`
--
ALTER TABLE `achat_produits`
  ADD CONSTRAINT `achat_produits_achat_id_foreign` FOREIGN KEY (`achat_id`) REFERENCES `achats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `achat_produits_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vente_produits`
--
ALTER TABLE `vente_produits`
  ADD CONSTRAINT `vente_produits_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vente_produits_vente_id_foreign` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

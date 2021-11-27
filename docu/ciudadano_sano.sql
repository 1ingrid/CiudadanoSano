-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2021 a las 03:38:13
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ciudadano_sano`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, 'Cali', 1, '2021-11-26 00:58:12', '2021-11-26 00:58:12'),
(2, 1, 'Bogota', 1, '2021-11-26 01:01:18', '2021-11-26 01:00:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `no_document` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cell_phone` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `reason` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `detail` text COLLATE utf8_spanish_ci NOT NULL,
  `formula` text COLLATE utf8_spanish_ci NOT NULL,
  `formula_status` tinyint(1) NOT NULL DEFAULT '1',
  `formula_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `type_contract_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  `date_init` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `duration` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contracts`
--

INSERT INTO `contracts` (`id`, `type_contract_id`, `employe_id`, `profession_id`, `date_init`, `date_end`, `duration`, `salary`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 9, '2021-11-26', '0000-00-00', '', 6000000, 1, '2021-11-26 01:35:00', '2021-11-26 01:35:00'),
(2, 2, 2, 4, '2021-11-26', '2022-01-26', '2 Meses', 3000000, 1, '2021-11-26 02:31:36', '2021-11-26 02:31:36'),
(3, 1, 4, 11, '2021-11-26', '0000-00-00', '', 1500000, 1, '2021-11-26 03:06:28', '2021-11-26 03:06:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Colombia', 1, '2021-11-26 00:57:55', '2021-11-26 00:57:55'),
(2, 'Estados Unidos', 0, '2021-11-26 00:59:35', '2021-11-26 00:59:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `no_document` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cell_phone` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `seat_id`, `no_document`, `name`, `last_name`, `email`, `address`, `cell_phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '31123456', 'Paterson', 'Sinisterra', 'directcs@marcsoft.com.co', 'Av 6n # 10 - 45', '3114563212', 1, '2021-11-26 01:18:43', '2021-11-26 01:18:43'),
(2, 1, '31456987', 'Jesus Antonio', 'Torres', 'mediccs@marcsoft.com.co', 'Cra 10 # 45 - 78', '3104569878', 1, '2021-11-26 02:29:13', '2021-11-26 02:29:13'),
(4, 1, '31203265', 'Manuel Andres', 'Blanco', 'farmcs@marcsoft.com.co', 'Cra 45a # 12 - 45', '3157896545', 1, '2021-11-26 03:04:45', '2021-11-26 03:04:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `headquarters`
--

CREATE TABLE `headquarters` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cell_phone` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `headquarters`
--

INSERT INTO `headquarters` (`id`, `city_id`, `name`, `address`, `cell_phone`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, 'Red Norte Alfonso Lopez', 'Av 5n # 10 - 85', '6604589', 1, '2021-11-26 01:05:44', '2021-11-26 01:05:44'),
(2, 1, 'Sede Sur Caney', 'Cra 45 # 10 - 101', '5564578', 0, '2021-11-26 01:12:41', '2021-11-26 01:12:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `entries` smallint(6) NOT NULL DEFAULT '0',
  `stock` smallint(6) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `seat_id`, `entries`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 1, 10, 10, 1, '2021-11-26 21:33:18', '2021-11-26 21:33:18'),
(9, 2, 1, 15, 15, 1, '2021-11-26 21:33:25', '2021-11-26 21:33:25'),
(10, 3, 1, 20, 20, 1, '2021-11-26 21:33:32', '2021-11-26 21:33:32'),
(11, 4, 1, 25, 25, 1, '2021-11-26 21:33:41', '2021-11-26 21:33:41'),
(12, 5, 1, 30, 30, 1, '2021-11-26 21:33:51', '2021-11-26 21:33:51'),
(13, 6, 1, 35, 35, 1, '2021-11-26 21:33:59', '2021-11-26 21:33:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `iva` mediumint(9) NOT NULL DEFAULT '0',
  `total` mediumint(9) NOT NULL DEFAULT '0',
  `neto` mediumint(9) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mepas`
--

CREATE TABLE `mepas` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_invoices`
--

CREATE TABLE `mov_invoices` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` smallint(6) NOT NULL DEFAULT '0',
  `price` smallint(6) NOT NULL DEFAULT '0',
  `total` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `bank_account` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `no_account` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `payroll`
--

INSERT INTO `payroll` (`id`, `employe_id`, `bank_account`, `no_account`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Bancolombia', '050789651', '2021-12-27 15:00:00', 1, '2021-11-26 02:34:12', '2021-11-26 02:34:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `presentation` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `img` blob NOT NULL,
  `price` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `provider_id`, `name`, `presentation`, `img`, `price`, `cost`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Inhalador sabutamol', 'Aerosol', 0x696e68616c61646f725f7361627574616d6f6c5f6d6b5f3262666135632e6a7067, 20000, 7000, 1, '2021-11-26 02:07:01', '2021-11-26 02:07:01'),
(2, 1, 'Bromhexina niños', 'Jarabe', 0x62726f6d686578696e615f6a61726162655f6d6b5f3736663164612e6a7067, 25000, 10000, 1, '2021-11-26 02:09:39', '2021-11-26 02:09:39'),
(3, 2, 'Inhalador sabutamol', 'Aerosol', 0x696e68616c61646f725f73616c627574616d6f6c5f73616372757379745f6233333265332e6a7067, 12000, 5000, 1, '2021-11-26 02:11:07', '2021-11-26 02:11:07'),
(4, 3, 'Dolex acetaminofen', 'Tabletas', 0x646f6c65785f61636574616d696e6f66656e5f676b735f6330643633662e6a7067, 12000, 6000, 1, '2021-11-26 02:13:07', '2021-11-26 02:13:07'),
(5, 4, 'Ibuprofeno', 'Tabletas', 0x69627570726f66656e6f5f67656e6661725f6139653837312e6a7067, 15000, 8000, 1, '2021-11-26 02:14:04', '2021-11-26 02:14:04'),
(6, 4, 'Acetaminofen', 'Tabletas', 0x61636574616d696e6f66656e5f67656e6661725f3563613661632e6a7067, 9000, 4000, 1, '2021-11-26 02:15:02', '2021-11-26 02:15:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professions`
--

CREATE TABLE `professions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `professions`
--

INSERT INTO `professions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Odontologo', 1, '2021-10-23 18:58:31', '2021-10-23 18:58:31'),
(4, 'Medico', 1, '2021-10-23 18:58:47', '2021-10-23 18:58:47'),
(8, 'Optometra', 1, '2021-10-23 19:00:02', '2021-10-23 19:00:02'),
(9, 'Gerente', 1, '2021-10-23 19:00:56', '2021-10-23 19:00:56'),
(10, 'Administrador de empresas', 0, '2021-11-26 01:34:02', '2021-11-26 01:34:02'),
(11, 'Farmaceuta', 1, '2021-11-26 03:05:27', '2021-11-26 03:05:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id` int(11) NOT NULL,
  `nit` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cell_phone` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`id`, `nit`, `name`, `email`, `address`, `cell_phone`, `status`, `created_at`, `updated_at`) VALUES
(1, '100789654-2', 'Mk', 'info@mk.com.co', 'Cra 10a # 10 - 12', '6654783', 1, '2021-11-26 01:49:18', '2021-11-26 01:49:18'),
(2, '145789654-9', 'BCNMedical', 'info@bcnmedical.com', 'Av 9n # 10 - 45', '4569878', 1, '2021-11-26 02:00:02', '2021-11-26 02:00:02'),
(3, '123654878-1', 'GSK', 'info@gsk.com.co', 'Calle 5n # 10 - 78', '3364569', 1, '2021-11-26 02:01:18', '2021-11-26 02:01:24'),
(4, '147852361-6', 'Genfar', 'info@genfar.com.co', 'Av 10 # 15 - 78', '6547896', 1, '2021-11-26 02:02:30', '2021-11-26 02:02:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permits` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `permits`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Super usuario con todos los permisos del sistema.', ',roles,users,countries,cities,headquarters,types_contracts,professions,employees,contracts,clients,providers,mepas,products', 1, '2021-09-19 16:07:10', '2021-09-24 17:56:15'),
(2, 'Paciente', 'Rol para el ingreso de pacientes al sistema', ',my_quotes', 1, '2021-09-19 17:47:54', '2021-09-19 17:47:54'),
(3, 'Director de sedes', 'Rol asignado al director para la gestión de sedes', ',my_contracts,my_employees,my_payroll,my_inventories,my_invoices', 1, '2021-09-19 17:55:33', '2021-09-21 00:17:27'),
(4, 'Asesor de afiliación', 'Rol asignado al asesor de afiliación para la gestión de pacientes', ',clients', 1, '2021-09-19 19:36:52', '2021-09-21 00:18:25'),
(5, 'Medico', 'Rol utilizado para los médicos', ',my_consultations,my_assignments', 1, '2021-09-20 20:41:34', '2021-10-16 10:01:36'),
(6, 'Farmacia', 'Rol encargado del despacho de productos a los pacientes', ',billing,my_formulas', 1, '2021-11-17 22:16:34', '2021-11-17 22:16:34'),
(7, 'Afiliador de pacientes', 'Rol encargado del ingreso de pacientes al sistema', ',clients', 1, '2021-11-26 01:36:41', '2021-11-26 01:36:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types_contracts`
--

CREATE TABLE `types_contracts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `types_contracts`
--

INSERT INTO `types_contracts` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Indefinido', 1, '2021-10-08 21:54:26', '2021-10-08 22:01:02'),
(2, 'Temporal', 1, '2021-10-08 21:55:03', '2021-10-08 21:55:03'),
(3, 'Obra por labor', 0, '2021-11-26 01:31:07', '2021-11-26 01:31:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol_id`, `name`, `last_name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Ingrid', 'Blanco', 'admincs@marcsoft.com.co', '$2y$12$EP7CK./xpLIrrkNsOpcLJ.na29MADcclxfl4tMp6QSXYFJ0EyXA3S', 1, '2021-11-26 00:54:25', '2021-11-26 00:54:25'),
(3, 3, 'Paterson', 'Sinisterra', 'directcs@marcsoft.com.co', '$2y$12$HgewZ75AK7qMwoSruc1WJeyZG7vILP1kArCJ8QyyPFjZkZ8cHO16W', 1, '2021-11-26 01:25:53', '2021-11-26 21:21:50'),
(4, 7, 'Andres', 'Guevara', 'afilics@marcsoft.com.co', '$2y$12$oMiUBbJvnkKOXEPgcR3H4um4GsITRspq3tv3kSNBmvV7k15KPcLDe', 1, '2021-11-26 01:39:58', '2021-11-26 01:39:58'),
(6, 5, 'Jesus Antonio', 'Torres', 'mediccs@marcsoft.com.co', '$2y$12$EBI95KJISIftCdbq4PQuduVZGrWtYvMz55LsvVv0UekPZGBFiIu7C', 1, '2021-11-26 02:29:41', '2021-11-26 21:21:23'),
(7, 6, 'Manuel Andres', 'Blanco', 'farmcs@marcsoft.com.co', '$2y$12$RpOOUDTBugV5AVh0vJ/FIuWemARhZMPKgHHVkk43Qz2kCOzTzx6Py', 1, '2021-11-26 03:06:51', '2021-11-26 21:21:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usersxclients`
--

CREATE TABLE `usersxclients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usersxemployees`
--

CREATE TABLE `usersxemployees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usersxemployees`
--

INSERT INTO `usersxemployees` (`id`, `user_id`, `employe_id`) VALUES
(1, 3, 1),
(2, 6, 2),
(3, 7, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-cities_countries` (`country_id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indices de la tabla `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `employe_id` (`employe_id`);

--
-- Indices de la tabla `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_contract_id` (`type_contract_id`),
  ADD KEY `employe_id` (`employe_id`),
  ADD KEY `profession_id` (`profession_id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indices de la tabla `headquarters`
--
ALTER TABLE `headquarters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indices de la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `employe_id` (`employe_id`);

--
-- Indices de la tabla `mepas`
--
ALTER TABLE `mepas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mov_invoices`
--
ALTER TABLE `mov_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employe_id` (`employe_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indices de la tabla `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `employe_id` (`employe_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `types_contracts`
--
ALTER TABLE `types_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `usersxclients`
--
ALTER TABLE `usersxclients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indices de la tabla `usersxemployees`
--
ALTER TABLE `usersxemployees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `employe_id` (`employe_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `headquarters`
--
ALTER TABLE `headquarters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `mepas`
--
ALTER TABLE `mepas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mov_invoices`
--
ALTER TABLE `mov_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `types_contracts`
--
ALTER TABLE `types_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usersxclients`
--
ALTER TABLE `usersxclients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usersxemployees`
--
ALTER TABLE `usersxemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk-cities_countries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk-clients_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `fk-consultations_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-consultations_employees` FOREIGN KEY (`employe_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `fk-contracts_employees` FOREIGN KEY (`employe_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-contracts_professions` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-contracts_types_contracts` FOREIGN KEY (`type_contract_id`) REFERENCES `types_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk-employees_headquarters` FOREIGN KEY (`seat_id`) REFERENCES `headquarters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `headquarters`
--
ALTER TABLE `headquarters`
  ADD CONSTRAINT `fk-headquarters_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `fk-inventories_headquarters` FOREIGN KEY (`seat_id`) REFERENCES `headquarters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-inventories_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk-invoices_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-invoices_employees` FOREIGN KEY (`employe_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mov_invoices`
--
ALTER TABLE `mov_invoices`
  ADD CONSTRAINT `fk-mov_invoices_invoices` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-mov_invoices_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `fk-payroll_employees` FOREIGN KEY (`employe_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk-products_providers` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `fk-quotes_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-quotes_employees` FOREIGN KEY (`employe_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk-users_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usersxclients`
--
ALTER TABLE `usersxclients`
  ADD CONSTRAINT `fk-usersxclients_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-usersxclients_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usersxemployees`
--
ALTER TABLE `usersxemployees`
  ADD CONSTRAINT `fk-usersxemployees_employees` FOREIGN KEY (`employe_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-usersxemployees_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

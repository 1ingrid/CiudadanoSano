-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2021 a las 05:43:23
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
(1, 2, 'Cali', 1, '2021-09-30 22:38:41', '2021-09-30 22:21:23'),
(2, 2, 'Bogota', 1, '2021-10-23 18:56:02', '2021-10-23 18:56:02');

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

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `city_id`, `no_document`, `name`, `last_name`, `email`, `address`, `cell_phone`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, '31862723', 'Evelyn', 'Rodriguez Obando', 'dofustime27@gmail.com', 'Cra 96a # 45 - 106', '3137030828', 1, '2021-11-01 20:03:47', '2021-11-01 20:03:47');

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
(4, 2, 7, 9, '2021-10-25', '2021-12-24', '2 meses', 6000000, 1, '2021-10-23 19:13:04', '2021-11-14 16:34:18'),
(5, 1, 8, 4, '2021-10-25', '0000-00-00', '', 2500000, 1, '2021-10-23 19:37:42', '2021-11-14 17:40:56');

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
(2, 'Colombia', 1, '2021-09-27 08:06:49', '2021-09-27 08:06:39');

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
(7, 3, '1132456789', 'Miguel Angel', 'Cerquera Rodriguez', 'mcerquera@programarte.com.co', 'Cra 96a # 45 - 106 ', '3137030828', 1, '2021-10-23 19:03:06', '2021-10-23 19:03:06'),
(8, 3, '31456987', 'Ingrid', 'Blanco', 'miguelangelcerquerarodriguez@gmail.com', 'Cra 34 # 10 - 102', '3114562321', 1, '2021-10-23 19:37:16', '2021-10-23 19:37:16');

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
(3, 1, 'Red Sur Calicanto', 'Cra 45 # 48 - 12 ', '6646064', 1, '2021-10-27 22:33:48', '2021-10-19 00:05:10'),
(4, 2, 'Red sur Santa Isabel', 'Av 5n 45 - 47', '456123', 1, '2021-10-27 22:34:11', '2021-10-23 18:58:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock` tinyint(4) NOT NULL DEFAULT '0',
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

--
-- Volcado de datos para la tabla `mepas`
--

INSERT INTO `mepas` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cirugía plástica', 1, '2021-10-24 12:47:28', '2021-10-31 14:45:40');

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
(1, 8, 'Bancolombia', '3137030828', '2021-11-29 15:30:00', 1, '2021-11-15 10:05:48', '2021-11-15 11:21:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
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

INSERT INTO `products` (`id`, `seat_id`, `provider_id`, `name`, `presentation`, `img`, `price`, `cost`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Loratadina', 'Tabletas', 0x6c6f7261746164696e615f6465366631632e6a7067, 2500, 1000, 1, '2021-11-15 21:03:42', '2021-11-15 23:33:23'),
(2, 3, 1, 'Loratadina', 'Jarabe', 0x6c6f7261746164696e615f6a61726162655f3337636563612e6a7067, 3500, 2500, 1, '2021-11-15 22:29:53', '2021-11-15 23:33:39'),
(3, 3, 2, 'Loratadina', 'Jarabe', 0x6c6f7261746164696e615f6a61726162655f61675f3132393731392e6a7067, 2500, 1500, 1, '2021-11-15 23:34:14', '2021-11-15 23:34:14');

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
(2, 'Administrador de empresas', 1, '2021-10-19 00:08:31', '2021-10-19 00:08:31'),
(3, 'Odontologo', 1, '2021-10-23 18:58:31', '2021-10-23 18:58:31'),
(4, 'Medico', 1, '2021-10-23 18:58:47', '2021-10-23 18:58:47'),
(5, 'Enfermera', 1, '2021-10-23 18:59:04', '2021-10-23 18:59:29'),
(6, 'Enfermero', 1, '2021-10-23 18:59:35', '2021-10-23 18:59:35'),
(7, 'Jefe de enfermeros', 1, '2021-10-23 18:59:48', '2021-10-23 18:59:52'),
(8, 'Optometra', 1, '2021-10-23 19:00:02', '2021-10-23 19:00:02'),
(9, 'Gerente', 1, '2021-10-23 19:00:56', '2021-10-23 19:00:56'),
(10, 'Secretaria', 1, '2021-10-23 19:01:14', '2021-10-23 19:01:14');

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
(1, '312456769-4', 'Genfar', 'info@genfar.com.co', 'Cra 55 # 45 - 106', '45045656', 1, '2021-10-24 11:23:21', '2021-10-24 11:52:37'),
(2, '456987123-8', 'Labanderia la solución', 'info@lasolucion.com', 'Cra 45 # 12 - 41', '5607896', 1, '2021-10-24 11:24:51', '2021-10-24 11:24:51');

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

--
-- Volcado de datos para la tabla `quotes`
--

INSERT INTO `quotes` (`id`, `client_id`, `employe_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(3, 5, 8, '2021-11-10 14:00:00', 1, '2021-11-09 23:02:21', '2021-11-09 23:02:21'),
(4, 5, 8, '2021-11-10 08:00:00', 1, '2021-11-10 00:03:35', '2021-11-10 00:03:35'),
(5, 5, 8, '2021-11-11 09:20:00', 0, '2021-11-10 22:50:37', '2021-11-10 22:50:37'),
(6, 5, 8, '2021-11-12 11:00:00', 0, '2021-11-11 23:49:54', '2021-11-11 23:49:54'),
(7, 5, 8, '2021-11-12 15:00:00', 0, '2021-11-11 23:51:03', '2021-11-11 23:51:03'),
(8, 5, 8, '2021-11-12 14:40:00', 0, '2021-11-11 23:52:27', '2021-11-11 23:52:27'),
(9, 5, 8, '2021-11-12 09:20:00', 0, '2021-11-11 23:53:35', '2021-11-11 23:53:35'),
(10, 5, 8, '2021-11-12 15:20:00', 0, '2021-11-11 23:54:42', '2021-11-11 23:54:42'),
(11, 5, 8, '2021-11-13 16:00:00', 1, '2021-11-12 00:00:11', '2021-11-12 00:00:11'),
(12, 5, 8, '2021-11-13 14:00:00', 1, '2021-11-12 21:31:35', '2021-11-12 21:31:35'),
(13, 5, 8, '2021-11-15 14:40:00', 1, '2021-11-12 21:37:01', '2021-11-12 21:37:01'),
(14, 5, 8, '2021-11-13 11:00:00', 1, '2021-11-12 21:37:50', '2021-11-12 21:37:50'),
(15, 5, 8, '2021-11-13 14:40:00', 1, '2021-11-12 21:39:09', '2021-11-12 21:39:09'),
(16, 5, 8, '2021-11-13 15:40:00', 1, '2021-11-12 22:46:03', '2021-11-12 22:46:03'),
(17, 5, 8, '2021-11-14 14:40:00', 2, '2021-11-12 22:48:10', '2021-11-12 22:48:10'),
(18, 5, 8, '2021-11-14 16:20:00', 0, '2021-11-13 10:47:23', '2021-11-13 10:47:23');

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
(1, 'Administrador', 'Super usuario con todos los permisos del sistema.', ',roles,users,countries,cities,headquarters,types_contracts,professions,employees,contracts,clients,providers,mepas', 1, '2021-09-19 16:07:10', '2021-09-24 17:56:15'),
(2, 'Paciente', 'Rol para el ingreso de pacientes al sistema', ',my_quotes', 1, '2021-09-19 17:47:54', '2021-09-19 17:47:54'),
(3, 'Director de sedes', 'Rol asignado al director para la gestión de sedes', ',my_contracts,my_employees,my_payroll,my_products', 1, '2021-09-19 17:55:33', '2021-09-21 00:17:27'),
(4, 'Asesor de afiliación', 'Rol asignado al asesor de afiliación para la gestión de pacientes', ',clients', 1, '2021-09-19 19:36:52', '2021-09-21 00:18:25'),
(5, 'Medico', 'Rol utilizado para los médicos', ',my_consultations,my_assignments', 1, '2021-09-20 20:41:34', '2021-10-16 10:01:36');

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
(2, 'Temporal', 1, '2021-10-08 21:55:03', '2021-10-08 21:55:03');

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
(1, 1, 'Miguel Angel', 'Cerquera Rodriguez', 'cerquera199627@hotmail.com', '$2y$12$yA2Fjyw0EpMZk5WjB0.bT.Rlybx4uNzh1pnjrycTDpxWldgYmDL8W', 1, '2021-09-22 22:54:26', '2021-10-09 17:49:06'),
(19, 3, 'Miguel Angel', 'Cerquera Rodriguez', 'mcerquera@programarte.com.co', '$2y$12$DWTfgGgNvz9SDcZiVl3HluNXQEJRpkRRNsK3iCAnutyvoXBze1lUO', 1, '2021-10-23 19:19:41', '2021-11-14 17:31:06'),
(20, 5, 'Ingrid', 'Blanco', 'miguelangelcerquerarodriguez@gmail.com', '$2y$12$tn.YRHFs.qjRkF0uak1atOSRt5TYBqX5Xi8Pv.IwglulPzlNSfYiq', 1, '2021-10-23 19:37:54', '2021-11-12 21:50:56'),
(25, 2, 'Evelyn', 'Rodriguez Obando', 'dofustime27@gmail.com', '$2y$12$bVoeWzpBiSJCSRLVevkoH.DvV51d7V16FcmbCtruzCNiz2jfWqGTS', 1, '2021-11-01 20:03:47', '2021-11-01 20:05:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usersxclients`
--

CREATE TABLE `usersxclients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usersxclients`
--

INSERT INTO `usersxclients` (`id`, `user_id`, `client_id`) VALUES
(3, 25, 5);

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
(8, 19, 7),
(9, 20, 8);

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
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `mepas`
--
ALTER TABLE `mepas`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `seat_id` (`seat_id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `headquarters`
--
ALTER TABLE `headquarters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mepas`
--
ALTER TABLE `mepas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `types_contracts`
--
ALTER TABLE `types_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `usersxclients`
--
ALTER TABLE `usersxclients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usersxemployees`
--
ALTER TABLE `usersxemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  ADD CONSTRAINT `fk-inventories_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `fk-payroll_employees` FOREIGN KEY (`employe_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk-products_headquarters` FOREIGN KEY (`seat_id`) REFERENCES `headquarters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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

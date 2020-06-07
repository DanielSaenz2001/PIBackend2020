-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2020 a las 02:02:43
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `pais_id`) VALUES
(3, 'Amazonas', 1),
(4, 'San Martin', 1),
(5, 'Buenos Aires', 2),
(6, 'Nose', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(33, '2014_10_12_000000_create_users_table', 1),
(34, '2014_10_12_100000_create_password_resets_table', 1),
(35, '2015_01_20_084450_create_roles_table', 1),
(36, '2015_01_20_084525_create_role_user_table', 1),
(37, '2015_01_24_080208_create_permissions_table', 1),
(38, '2015_01_24_080433_create_permission_role_table', 1),
(39, '2015_12_04_003040_add_special_role_column', 1),
(40, '2017_10_17_170735_create_permission_user_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`) VALUES
(1, 'Peru'),
(2, 'Argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('asd@asdas.com', 'UMJ4iDpnBRw4vwfnZKUu6Yk5PxrPFxmRioxwcqWpRnJMgXa5Ep6rxP4dGHh2', '2020-06-05 20:19:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Navegar Egresados', 'users.index', 'Lista y navega todos los usuarios del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(2, 'Ver detalles Egresados', 'users.show', 'Ver en detalle los datos de los usuarios del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(3, 'Editar Egresados', 'users.update', 'Editar los usuarios del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(4, 'Eliminar Egresados', 'users.destroy', 'Eliminar los usuarios del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(5, 'Navegar roles', 'roles.index', 'Lista y navega todos los roles del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(6, 'Ver detalles roles', 'roles.show', 'Ver en detalle los datos de los roles del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(7, 'Editar roles', 'roles.update', 'Editar los roles del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(8, 'Eliminar roles', 'roles.destroy', 'Eliminar los roles del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(9, 'Navegar Eventos', 'eventos.index', 'Lista y navega todos los eventos del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(10, 'Ver detalles Eventos', 'eventos.show', 'Ver en detalle los datos de los eventos del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(11, 'Editar Eventos', 'eventos.update', 'Editar los eventos del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(12, 'Eliminar Eventos', 'eventos.destroy', 'Eliminar los eventos del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(13, 'Navegar Sugerencias', 'comentario.index', 'Lista y navega todos las sugerencias del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(14, 'Ver detalles Sugerencias', 'comentario.show', 'Ver en detalle los datos de las sugerencias del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(15, 'Editar Sugerencias', 'comentario.update', 'Editar las sugerencias del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(16, 'Eliminar Sugerencias', 'comentario.destroy', 'Eliminar las sugerencias del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(17, 'Navegar Documentos', 'documento.index', 'Lista y navega todos los Documentos del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(18, 'Ver detalles Documentos', 'documento.show', 'Ver en detalle los datos de los Documentos del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(19, 'Editar Documentos', 'documento.update', 'Editar los Documentos del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(20, 'Eliminar Documentos', 'documento.destroy', 'Eliminar los Documentos del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(21, 'Navegar Experiencia Laboral', 'laboral.index', 'Lista y navega todos las Experiencia Laboral del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(22, 'Ver detalles Experiencia Laboral', 'laboral.show', 'Ver en detalle las Experiencia Laboral datos de las  del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(23, 'Editar Experiencia Laboral', 'laboral.update', 'Editar las Experiencia Laboral  del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17'),
(24, 'Eliminar Experiencia Laboral', 'laboral.destroy', 'Eliminar las Experiencia Laboral  del sistema', '2020-06-02 17:45:17', '2020-06-02 17:45:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `ap_paterno` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `ap_materno` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` int(2) NOT NULL,
  `dni` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fec_nacimiento` date NOT NULL,
  `est_civil` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `dependiente` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `ap_paterno`, `ap_materno`, `provincia`, `dni`, `email`, `fec_nacimiento`, `est_civil`, `sexo`, `dependiente`) VALUES
(1, 'Manu', 'sad', 'asd', 2, '12312412', 'asd@asdas.com', '2020-06-05', 'Soltero', 'Masculino', NULL),
(2, 'da', 'sa', 'sh', 1, '70444029', 'daniel.saenz@upeu.edu.pe', '2020-06-02', 'Soltero', 'Masculino', NULL),
(3, 'Prueba1', 'd', 's', 1, '12312312', 'sd@upeu.edu.pe', '2020-06-06', 'Soltero', 'Masculino', NULL),
(4, 'Prueba1', 'd', 's', 1, '12312312', 'sd@upeu.edu.pe', '2020-06-06', 'Soltero', 'Masculino', NULL),
(5, 'Prueba1', 'd', 's', 1, '12312312', 'sd@upeu.edu.pe', '2020-06-06', 'Soltero', 'Masculino', NULL),
(6, 'Prueba1', 'd', 's', 1, '12312312', 'sd@upeu.edu.pe', '2020-06-06', 'Soltero', 'Masculino', NULL),
(7, 'Prueba1', 'd', 's', 1, '12312312', 'sd@upeu.edu.pe', '2020-06-06', 'Soltero', 'Masculino', NULL),
(8, 'Prueba1', 'd', 's', 1, '12312312', 'sd@upeu.edu.pe', '2020-06-06', 'Soltero', 'Masculino', NULL),
(9, 'Prueba1', 'asd', 'asd', 1, '12312321', 'sd@upeu.edu.pe', '1232-03-12', 'Soltero', 'Masculino', NULL),
(10, '123123', 'asdas', 'aasd', 3, '12312323', 'sd@upeu.edu.pe', '2133-03-12', 'Soltero', 'Masculino', NULL),
(11, '123123', 'asdas', 'aasd', 3, '12312323', 'sd@upeu.edu.pe', '2133-03-12', 'Soltero', 'Masculino', NULL),
(12, '123123', 'asdas', 'aasd', 3, '12312323', 'sd@upeu.edu.pe', '2133-03-12', 'Soltero', 'Masculino', NULL),
(13, '123123', 'asdas', 'aasd', 3, '12312323', 'sd@upeu.edu.pe', '2133-03-12', 'Soltero', 'Masculino', NULL),
(14, '213', 's', 's', 1, '12312312', 'sd@upeu.edu.pe', '1232-03-12', 'Casado', 'Masculino', NULL),
(15, '213', 's', 's', 1, '12312312', 'sd@upeu.edu.pe', '1232-03-12', 'Casado', 'Masculino', NULL),
(16, '213', 's', 's', 1, '12312312', 'sd@upeu.edu.pe', '1232-03-12', 'Casado', 'Masculino', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `dep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`, `dep_id`) VALUES
(1, 'San Martin', 3),
(2, 'Lamas', 4),
(3, 'Si se 2.0', 5),
(4, 'Nose 2.o', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `personaid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `personaid`) VALUES
(1, 'dadadad', 'asd@asdas.com', '$2y$10$WfUClX.pMghqEDnn36gOnO5edPrm6SMIal803gGkls5UkUW9XxDty', NULL, '2020-06-05 20:17:37', '2020-06-05 20:17:37', 1),
(2, 'DanoxDlol', 'daniel.saenz@upeu.edu.pe', '$2y$10$.3lowuDlDG0hmx2.EkZ9sO3Z6AaEm5jnRuSxGk3ccRduBnVxyKY1e', NULL, '2020-06-05 20:29:36', '2020-06-05 21:49:35', 2),
(3, 'orosco', 'asdd@gmail.com', '$2y$10$1UIVJOlZsXNg4tKXKghk5eO7FIfQoxytCfoi3VaP6Zx6EbOJed/UO', NULL, '2020-06-06 06:40:44', '2020-06-06 06:40:44', NULL),
(4, 'oro', 'asddd@asdas.com', '$2y$10$PmVvF/o.3H.liqG.YvBY7ulTbtlUbL756CvrtJ16YyzUV8YAl/bx2', NULL, '2020-06-06 20:59:47', '2020-06-06 20:59:47', NULL),
(5, NULL, 'dano.dx@upeu.edu.pe', '$2y$10$DYe4zdFxF.qBkG26tbV.JuzJ28hiQItWtS7WrCzPhH1T10YqABVnO', NULL, '2020-06-07 03:51:51', '2020-06-07 03:51:51', NULL),
(6, NULL, 'asdd@upeu.edu.pe', '$2y$10$fv.McKidgWYrbihsFHpOCOkmVaV2gZ80yRCl5FD6rKvlMb4zRRoqq', NULL, '2020-06-07 03:55:13', '2020-06-07 03:55:13', NULL),
(7, NULL, 'sd@upeu.edu.pe', '$2y$10$M9NA/7GOkGc6e/ymLoYAaeh4QSalhFLIjcbkUOfHXmIJu2poaLw5C', NULL, '2020-06-07 03:55:40', '2020-06-07 04:40:43', 16);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais_id` (`pais_id`) USING BTREE;

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2014 a las 04:23:28
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`symfony` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `symfony`;
--
-- Base de datos: `symfony`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedente`
--

CREATE TABLE IF NOT EXISTS `antecedente` (
`id` INT(11) NOT NULL,
  `usuario_id` INT(11) DEFAULT NULL,
  `tipo_antecedente_id` INT(11) DEFAULT NULL,
  `historia_clinica_id` INT(11) DEFAULT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` DATE NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_diagnostico`
--

CREATE TABLE IF NOT EXISTS `categoria_diagnostico` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_definitivo`
--

CREATE TABLE IF NOT EXISTS `diagnostico_definitivo` (
`id` INT(11) NOT NULL,
  `categoria_diagnostico_id` INT(11) DEFAULT NULL,
  `evolucion_id` INT(11) DEFAULT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` DATE NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_presuntivo`
--

CREATE TABLE IF NOT EXISTS `diagnostico_presuntivo` (
`id` INT(11) NOT NULL,
  `evolucion_id` INT(11) DEFAULT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` DATE NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `droga`
--

CREATE TABLE IF NOT EXISTS `droga` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `droga_tratamiento`
--

CREATE TABLE IF NOT EXISTS `droga_tratamiento` (
  `dosis` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `efecto_adverso_id` INT(11) NOT NULL,
  `droga_id` INT(11) NOT NULL,
  `tratamiento_id` INT(11) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `efecto_adverso`
--

CREATE TABLE IF NOT EXISTS `efecto_adverso` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad_actual`
--

CREATE TABLE IF NOT EXISTS `enfermedad_actual` (
`id` INT(11) NOT NULL,
  `usuario_id` INT(11) DEFAULT NULL,
  `historia_clinica_id` INT(11) DEFAULT NULL,
  `detalle` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` DATE NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

CREATE TABLE IF NOT EXISTS `estado_civil` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE IF NOT EXISTS `estudio` (
`id` INT(11) NOT NULL,
  `tipo_estudio_id` INT(11) DEFAULT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` DATE NOT NULL,
  `institucion` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `evolucion_id` INT(11) DEFAULT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evolucion`
--

CREATE TABLE IF NOT EXISTS `evolucion` (
`id` INT(11) NOT NULL,
  `historia_clinica_id` INT(11) DEFAULT NULL,
  `usuario_id` INT(11) DEFAULT NULL,
  `evolucion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_hora` DATETIME NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE IF NOT EXISTS `historia_clinica` (
`id` INT(11) NOT NULL,
  `paciente_id` INT(11) DEFAULT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
`id` INT(11) NOT NULL,
  `estudio_id` INT(11) DEFAULT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo`
--

CREATE TABLE IF NOT EXISTS `motivo` (
`id` INT(11) NOT NULL,
  `usuario_id` INT(11) DEFAULT NULL,
  `historia_clinica_id` INT(11) DEFAULT NULL,
  `detalle` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` DATE NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_educacional`
--

CREATE TABLE IF NOT EXISTS `nivel_educacional` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_social`
--

CREATE TABLE IF NOT EXISTS `obra_social` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
`id` INT(11) NOT NULL,
  `obra_social_id` INT(11) DEFAULT NULL,
  `estado_civil_id` INT(11) DEFAULT NULL,
  `tipo_documento_id` INT(11) DEFAULT NULL,
  `admitido_por` INT(11) DEFAULT NULL,
  `derivado_por` INT(11) DEFAULT NULL,
  `sexo_id` INT(11) DEFAULT NULL,
  `nivel_educacional_id` INT(11) DEFAULT NULL,
  `nombre` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documento` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `telefono` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `ocupacion` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otros` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_carnet` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE IF NOT EXISTS `sexo` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_antecedente`
--

CREATE TABLE IF NOT EXISTS `tipo_antecedente` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE IF NOT EXISTS `tipo_documento` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estudio`
--

CREATE TABLE IF NOT EXISTS `tipo_estudio` (
`id` INT(11) NOT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `siglas` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento_externo`
--

CREATE TABLE IF NOT EXISTS `tratamiento_externo` (
`id` INT(11) NOT NULL,
  `evolucion_id` INT(11) DEFAULT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento_interno`
--

CREATE TABLE IF NOT EXISTS `tratamiento_interno` (
`id` INT(11) NOT NULL,
  `evolucion_id` INT(11) DEFAULT NULL,
  `descripcion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `inicio` DATE NOT NULL,
  `activo` TINYINT(1) DEFAULT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` INT(11) NOT NULL,
  `estado_civil_id` INT(11) DEFAULT NULL,
  `sexo_id` INT(11) DEFAULT NULL,
  `tipo_documento_id` INT(11) DEFAULT NULL,
  `username` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` TINYINT(1) NOT NULL,
  `salt` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` DATETIME DEFAULT NULL,
  `locked` TINYINT(1) NOT NULL,
  `expired` TINYINT(1) NOT NULL,
  `expires_at` DATETIME DEFAULT NULL,
  `confirmation_token` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` DATETIME DEFAULT NULL,
  `roles` LONGTEXT COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` TINYINT(1) NOT NULL,
  `credentials_expire_at` DATETIME DEFAULT NULL,
  `nombre` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `numero_documento` VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_de_nacimiento` DATETIME NOT NULL,
  `direccion` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedente`
--
ALTER TABLE `antecedente`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_B65821F3DB38439E` (`usuario_id`), ADD KEY `IDX_B65821F3B43F0B8A` (`tipo_antecedente_id`), ADD KEY `IDX_B65821F328AD4207` (`historia_clinica_id`);

--
-- Indices de la tabla `categoria_diagnostico`
--
ALTER TABLE `categoria_diagnostico`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `diagnostico_definitivo`
--
ALTER TABLE `diagnostico_definitivo`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_72096F6D38AF91F2` (`categoria_diagnostico_id`), ADD KEY `IDX_72096F6D6F86831A` (`evolucion_id`);

--
-- Indices de la tabla `diagnostico_presuntivo`
--
ALTER TABLE `diagnostico_presuntivo`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_2FD8B6C6F86831A` (`evolucion_id`);

--
-- Indices de la tabla `droga`
--
ALTER TABLE `droga`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `droga_tratamiento`
--
ALTER TABLE `droga_tratamiento`
 ADD PRIMARY KEY (`dosis`,`efecto_adverso_id`,`droga_id`,`tratamiento_id`), ADD KEY `IDX_F9CB63A7E07ABA5E` (`efecto_adverso_id`), ADD KEY `IDX_F9CB63A7825E2ABC` (`droga_id`), ADD KEY `IDX_F9CB63A744168F7D` (`tratamiento_id`);

--
-- Indices de la tabla `efecto_adverso`
--
ALTER TABLE `efecto_adverso`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `enfermedad_actual`
--
ALTER TABLE `enfermedad_actual`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_F39CE260DB38439E` (`usuario_id`), ADD KEY `IDX_F39CE26028AD4207` (`historia_clinica_id`);

--
-- Indices de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_BF0B1A29E7A4999B` (`tipo_estudio_id`), ADD KEY `IDX_BF0B1A296F86831A` (`evolucion_id`);

--
-- Indices de la tabla `evolucion`
--
ALTER TABLE `evolucion`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_8FC247B528AD4207` (`historia_clinica_id`), ADD KEY `IDX_8FC247B5DB38439E` (`usuario_id`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_D1525DB17310DAD4` (`paciente_id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_8319D2B376229BB3` (`estudio_id`);

--
-- Indices de la tabla `motivo`
--
ALTER TABLE `motivo`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_19F93866DB38439E` (`usuario_id`), ADD KEY `IDX_19F9386628AD4207` (`historia_clinica_id`);

--
-- Indices de la tabla `nivel_educacional`
--
ALTER TABLE `nivel_educacional`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `obra_social`
--
ALTER TABLE `obra_social`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_C6CBA95E6D8BE9D2` (`obra_social_id`), ADD KEY `IDX_C6CBA95E75376D93` (`estado_civil_id`), ADD KEY `IDX_C6CBA95EF6939175` (`tipo_documento_id`), ADD KEY `IDX_C6CBA95ED93490DD` (`admitido_por`), ADD KEY `IDX_C6CBA95E2776AB72` (`derivado_por`), ADD KEY `IDX_C6CBA95E2B32DB58` (`sexo_id`), ADD KEY `IDX_C6CBA95EACEDAB15` (`nivel_educacional_id`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `tipo_antecedente`
--
ALTER TABLE `tipo_antecedente`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `tipo_estudio`
--
ALTER TABLE `tipo_estudio`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `tratamiento_externo`
--
ALTER TABLE `tratamiento_externo`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_3CFC4FB96F86831A` (`evolucion_id`);

--
-- Indices de la tabla `tratamiento_interno`
--
ALTER TABLE `tratamiento_interno`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_2ED3C44B6F86831A` (`evolucion_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`), ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`), ADD KEY `IDX_8D93D64975376D93` (`estado_civil_id`), ADD KEY `IDX_8D93D6492B32DB58` (`sexo_id`), ADD KEY `IDX_8D93D649F6939175` (`tipo_documento_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedente`
--
ALTER TABLE `antecedente`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `categoria_diagnostico`
--
ALTER TABLE `categoria_diagnostico`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `diagnostico_definitivo`
--
ALTER TABLE `diagnostico_definitivo`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `diagnostico_presuntivo`
--
ALTER TABLE `diagnostico_presuntivo`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `droga`
--
ALTER TABLE `droga`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `efecto_adverso`
--
ALTER TABLE `efecto_adverso`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `enfermedad_actual`
--
ALTER TABLE `enfermedad_actual`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estudio`
--
ALTER TABLE `estudio`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `evolucion`
--
ALTER TABLE `evolucion`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `motivo`
--
ALTER TABLE `motivo`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `nivel_educacional`
--
ALTER TABLE `nivel_educacional`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `obra_social`
--
ALTER TABLE `obra_social`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_antecedente`
--
ALTER TABLE `tipo_antecedente`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_estudio`
--
ALTER TABLE `tipo_estudio`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tratamiento_externo`
--
ALTER TABLE `tratamiento_externo`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tratamiento_interno`
--
ALTER TABLE `tratamiento_interno`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedente`
--
ALTER TABLE `antecedente`
ADD CONSTRAINT `FK_B65821F328AD4207` FOREIGN KEY (`historia_clinica_id`) REFERENCES `historia_clinica` (`id`),
ADD CONSTRAINT `FK_B65821F3B43F0B8A` FOREIGN KEY (`tipo_antecedente_id`) REFERENCES `tipo_antecedente` (`id`),
ADD CONSTRAINT `FK_B65821F3DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `diagnostico_definitivo`
--
ALTER TABLE `diagnostico_definitivo`
ADD CONSTRAINT `FK_72096F6D38AF91F2` FOREIGN KEY (`categoria_diagnostico_id`) REFERENCES `categoria_diagnostico` (`id`),
ADD CONSTRAINT `FK_72096F6D6F86831A` FOREIGN KEY (`evolucion_id`) REFERENCES `evolucion` (`id`);

--
-- Filtros para la tabla `diagnostico_presuntivo`
--
ALTER TABLE `diagnostico_presuntivo`
ADD CONSTRAINT `FK_2FD8B6C6F86831A` FOREIGN KEY (`evolucion_id`) REFERENCES `evolucion` (`id`);

--
-- Filtros para la tabla `droga_tratamiento`
--
ALTER TABLE `droga_tratamiento`
ADD CONSTRAINT `FK_F9CB63A744168F7D` FOREIGN KEY (`tratamiento_id`) REFERENCES `tratamiento_interno` (`id`),
ADD CONSTRAINT `FK_F9CB63A7825E2ABC` FOREIGN KEY (`droga_id`) REFERENCES `droga` (`id`),
ADD CONSTRAINT `FK_F9CB63A7E07ABA5E` FOREIGN KEY (`efecto_adverso_id`) REFERENCES `efecto_adverso` (`id`);

--
-- Filtros para la tabla `enfermedad_actual`
--
ALTER TABLE `enfermedad_actual`
ADD CONSTRAINT `FK_F39CE26028AD4207` FOREIGN KEY (`historia_clinica_id`) REFERENCES `historia_clinica` (`id`),
ADD CONSTRAINT `FK_F39CE260DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `estudio`
--
ALTER TABLE `estudio`
ADD CONSTRAINT `FK_BF0B1A296F86831A` FOREIGN KEY (`evolucion_id`) REFERENCES `evolucion` (`id`),
ADD CONSTRAINT `FK_BF0B1A29E7A4999B` FOREIGN KEY (`tipo_estudio_id`) REFERENCES `tipo_estudio` (`id`);

--
-- Filtros para la tabla `evolucion`
--
ALTER TABLE `evolucion`
ADD CONSTRAINT `FK_8FC247B528AD4207` FOREIGN KEY (`historia_clinica_id`) REFERENCES `historia_clinica` (`id`),
ADD CONSTRAINT `FK_8FC247B5DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
ADD CONSTRAINT `FK_D1525DB17310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
ADD CONSTRAINT `FK_8319D2B376229BB3` FOREIGN KEY (`estudio_id`) REFERENCES `estudio` (`id`);

--
-- Filtros para la tabla `motivo`
--
ALTER TABLE `motivo`
ADD CONSTRAINT `FK_19F9386628AD4207` FOREIGN KEY (`historia_clinica_id`) REFERENCES `historia_clinica` (`id`),
ADD CONSTRAINT `FK_19F93866DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
ADD CONSTRAINT `FK_C6CBA95E2776AB72` FOREIGN KEY (`derivado_por`) REFERENCES `departamento` (`id`),
ADD CONSTRAINT `FK_C6CBA95E2B32DB58` FOREIGN KEY (`sexo_id`) REFERENCES `sexo` (`id`),
ADD CONSTRAINT `FK_C6CBA95E6D8BE9D2` FOREIGN KEY (`obra_social_id`) REFERENCES `obra_social` (`id`),
ADD CONSTRAINT `FK_C6CBA95E75376D93` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`id`),
ADD CONSTRAINT `FK_C6CBA95EACEDAB15` FOREIGN KEY (`nivel_educacional_id`) REFERENCES `nivel_educacional` (`id`),
ADD CONSTRAINT `FK_C6CBA95ED93490DD` FOREIGN KEY (`admitido_por`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FK_C6CBA95EF6939175` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`);

--
-- Filtros para la tabla `tratamiento_externo`
--
ALTER TABLE `tratamiento_externo`
ADD CONSTRAINT `FK_3CFC4FB96F86831A` FOREIGN KEY (`evolucion_id`) REFERENCES `evolucion` (`id`);

--
-- Filtros para la tabla `tratamiento_interno`
--
ALTER TABLE `tratamiento_interno`
ADD CONSTRAINT `FK_2ED3C44B6F86831A` FOREIGN KEY (`evolucion_id`) REFERENCES `evolucion` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `FK_8D93D6492B32DB58` FOREIGN KEY (`sexo_id`) REFERENCES `sexo` (`id`),
ADD CONSTRAINT `FK_8D93D64975376D93` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`id`),
ADD CONSTRAINT `FK_8D93D649F6939175` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

LOCK TABLES `tipo_antecedente` WRITE;

INSERT  INTO `tipo_antecedente`(`id`,`descripcion`) VALUES (1,'Familiar'),(2,'Personal');

UNLOCK TABLES;

LOCK TABLES `user` WRITE;

INSERT  INTO `user`(`id`,`estado_civil_id`,`sexo_id`,`tipo_documento_id`,`username`,`username_canonical`,`email`,`email_canonical`,`enabled`,`salt`,`password`,`last_login`,`locked`,`expired`,`expires_at`,`confirmation_token`,`password_requested_at`,`roles`,`credentials_expired`,`credentials_expire_at`,`nombre`,`apellido`,`numero_documento`,`telefono`,`fecha_de_nacimiento`,`direccion`) VALUES (1,NULL,NULL,NULL,'admin','admin','mate.edelp@gmail.com','mate.edelp@gmail.com',1,'r7op228n12ooocc40wc44sc0owo0k44','LfohU3YKRCYePHkypE5xxAlPM6asJB3OFyj1ApgSXMAkp22DCiee9/ty1IZ+HfJZ+9zLrDg4MtjWZR2YF6MRFw==','2014-12-16 20:44:32',0,0,NULL,'kw_167r0jhjcAzmrGL0aGUgRR8qmNvGeP7LkVeM6Ztw','2014-12-14 18:03:11','a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL,'admin','admin','123456789876543','12345678','2014-12-31 00:00:00','añldskñlaskdñlaskñld');

UNLOCK TABLES;

START TRANSACTION; 
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G00 - MENINGITIS ESTAFILOCOCICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G00 - OTRAS MENINGITIS BACTERIANAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G00 - MENINGITIS BACTERIANA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G00 - MENINGITIS POR HEMOFILOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G00 - MENINGITIS NEUMOCOCICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G00 - MENINGITIS ESTREPTOCOCICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G01 - MENINGITIS EN ENFERMEDADES BACTERIANAS CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G02 - MENINGITIS EN OTRAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS ESPECIFICADAS CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G02 - MENINGITIS EN MICOSIS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G02 - MENINGITIS EN ENFERMEDADES VIRALES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G03 - MENINGITIS DEBIDAS A OTRAS CAUSAS ESPECIFICADAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G03 - MENINGITIS, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G03 - MENINGITIS RECURRENTE BENIGNA (MOLLARET)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G03 - MENINGITIS APIOGENA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G03 - MENINGITIS CRONICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G04 - OTRAS ENCEFALITIS, MIELITIS Y ENCEFALOMIELITIS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G04 - ENCEFALITIS, MIELITIS Y ENCEFALOMIELITIS, NO ESPECIFICADAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G04 - MENINGOENCEFALITIS Y MENINGOMIELITIS BACTERIANAS, NO CLASIFICADA EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G04 - ENCEFALITIS AGUDA DISEMINADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G04 - PARAPLEJIA ESPASTICA TROPICAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G05 - ENCEFALITIS, MIELITIS Y ENCEFALOMIELITIS EN OTRAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G05 - ENCEFALITIS, MIELITIS Y ENCEFALOMIELITIS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G05 - ENCEFALITIS, MIELITIS Y ENCEFALOMIELITIS EN ENFERMEDADES BACTERIANAS CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G05 - ENCEFALITIS, MIELITIS Y ENCEFALOMIELITIS EN ENFERMEDADES VIRALES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G06 - ABSCESO EXTRADURAL Y SUBDURAL, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G06 - ABSCESO Y GRANULOMA INTRARRAQUIDEO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G06 - ABSCESO Y GRANULOMA INTRACRANEAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G07 - ABSCESO Y GRANULOMA INTRACRANEAL E INTRARRAQUIDEO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G08 - FLEBITIS Y TROMBOFLEBITIS INTRACRANEAL E INTRARRAQUIDEA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G09 - SECUELAS DE ENFERMEDADES INFLAMATORIAS DEL SISTEMA NERVIOSO CENTRAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G10 - ENFERMEDAD DE HUNTINGTON');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G11 - PARAPLEJIA ESPASTICA HEREDITARIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G11 - OTRAS ATAXIAS HEREDITARIAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G11 - ATAXIA HEREDITARIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G11 - ATAXIA CEREBELOSA CON REPARACION DEFECTUOSA DEL ADN');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G11 - ATAXIA CONGENITA NO PROGRESIVA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G11 - ATAXIA CEREBELOSA DE INICIACION TEMPRANA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G11 - ATAXIA CEREBELOSA DE INICIACION TARDIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G12 - OTRAS ATROFIAS MUSCULARES ESPINALES Y SINDROMES AFINES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G12 - ATROFIA MUSCULAR ESPINAL, SIN OTRA ESPECIFICACION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G12 - ENFERMEDADES DE LAS NEURONAS MOTORAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G12 - ATROFIA MUSCULAR ESPINAL INFANTIL, TIPO I (WERDNIG-HOFFMAN)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G12 - OTRAS ATROFIAS MUSCULARES ESPINALES HEREDITARIAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G13 - ATROFIA SISTEMICA QUE AFECTA PRIMARIAMENTE EL SISTEMA NERVIOSO CENTRAL EN EL MIXEDEMA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G13 - ATROFIA SISTEMICA QUE AFECTA PRIMARIAMENTE EL SISTEMA NERVIOSO CENTRAL EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G13 - NEUROMIOPATIA Y NEUROPATIA PARANEOPLASICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G13 - OTRAS ATROFIAS SISTEMICAS QUE AFECTAN EL SISTEMA NERVIOSO CENTRAL EN ENFERMEDAD NEOPLASICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G20 - ENFERMEDAD DE PARKINSON');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G21 - PARKINSONISMO POSTENCEFALITICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G21 - OTROS TIPOS DE PARKINSONISMO SECUNDARIO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G21 - PARKINSONISMO SECUNDARIO, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G21 - SINDROME NEUROLEPTICO MALIGNO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G21 - OTRO PARKINSONISMO SECUNDARIO INDUCIDO POR DROGAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G21 - PARKINSONISMO SECUNDARIO DEBIDO A OTROS AGENTES EXTERNOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G22 - PARKINSONISMO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G23 - OTRAS ENFERMEDADES DEGENERATIVAS ESPECIFICAS DE LOS NUCLEOS DE LA BASE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G23 - ENFERMEDAD DEGENERATIVA DE LOS NUCLEOS DE LA BASE, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G23 - DEGENERACION NIGROESTRIADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G23 - ENFERMEDAD DE HALLERVORDEN-SPATZ');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G23 - OFTALMOPLEJIA SUPRANUCLEAR PROGRESIVA (STEELE-RICHARDSON-OLSZEWSKI)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G24 - BLEFAROSPASMO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G24 - DISTONIA BUCOFACIAL IDIOPATICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G24 - DISTONIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G24 - OTRAS DISTONIAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G24 - DISTONIA IDIOPATICA FAMILIAR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G24 - DISTONIA INDUCIDA POR DROGAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G24 - TORTICOLIS ESPASMODICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G24 - DISTONIA IDIOPATICA NO FAMILIAR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - TICS INDUCIDOS POR DROGAS Y OTROS TICS DE ORIGEN ORGANICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - OTRAS COREAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - TRASTORNO EXTRAPIRAMIDAL Y DEL MOVIMIENTO, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - OTROS TRASTORNOS EXTRAPIRAMIDALES Y DEL MOVIMIENTO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - COREA INDUCIDA POR DROGAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - TEMBLOR INDUCIDO POR DROGAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - TEMBLOR ESENCIAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - MIOCLONIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G25 - OTRAS FORMAS ESPECIFICADAS DE TEMBLOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G26 - TRASTORNOS EXTRAPIRAMIDALES Y DEL MOVIMIENTO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G30 - OTROS TIPOS DE ENFERMEDAD DE ALZHEIMER');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G30 - ENFERMEDAD DE ALZHEIMER, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G30 - ENFERMEDAD DE ALZHEIMER DE COMIENZO TEMPRANO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G30 - ENFERMEDAD DE ALZHEIMER DE COMIENZO TARDIO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G31 - OTRAS ENFERMEDADES DEGENERATIVAS ESPECIFICADAS DEL SISTEMA NERVIOSO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G31 - DEGENERACION DEL SISTEMA NERVIOSO, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G31 - DEGENERACION DEL SISTEMA NERVIOSO DEBIDA AL ALCOHOL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G31 - ATROFIA CEREBRAL CIRCUNSCRITA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G31 - DEGENERACION CEREBRAL SENIL NO CLASIFICADA EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G32 - OTROS TRASTORNOS DEGENERATIVOS ESPECIFICADOS DEL SISTEMA NERVIOSO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G32 - DEGENERACION COMBINADA SUBAGUDA DE LA MEDULA ESPINAL EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G35 - ESCLEROSIS MULTIPLE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G36 - OTRAS DESMIELINIZACIONES AGUDAS DISEMINADAS ESPECIFICADAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G36 - DESMIELINIZACION DISEMINADA AGUDA, SIN OTRA ESPECIFICACION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G36 - NEUROMIELITIS OPTICA (DEVIC)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G36 - LEUCOENCEFALITIS HEMORRAGICA AGUDA Y SUBAGUDA (HURST)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G37 - ESCLEROSIS CONCENTRICA (BALO)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G37 - MIELITIS NECROTIZANTE SUBAGUDA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G37 - ENFERMEDAD DESMIELINIZANTE DEL SISTEMA NERVIOSO CENTRAL, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G37 - OTRAS ENFERMEDADES DESMIELINIZANTES DEL SISTEMA NERVIOSO CENTRAL, ESPECIFICADAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G37 - DESMIELINIZACION CENTRAL DEL CUERPO CALLOSO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G37 - ESCLEROSIS DIFUSA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G37 - MIELITIS TRANSVERSA AGUDA EN ENFERMEDAD DESMIELINIZANTE DEL SISTEMA NERVIOSO CENTRAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G37 - MIELINOLISIS CENTRAL PONTINA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - ATAQUES DE GRAN MAL, NO ESPECIFICADOS (CON O SIN PEQUEҏ MAL)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - SINDROMES EPILEPTICOS ESPECIALES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - PEQUEҏ MAL, NO ESPECIFICADO (SIN ATAQUE DE GRAN MAL)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - EPILEPSIA, TIPO NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - OTRAS EPILEPSIAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - EPILEPSIA Y SINDROMES EPILEPTICOS SINTOMATICOS RELACIONADOS CON LOCALIZACIONES (FOCALES) (PARCIALES) Y CON ATAQUES PARCIALES SIMPLES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - EPILEPSIA Y SINDROMES EPILEPTICOS IDIOPATICOS RELACIONADOS CON LOCALIZACIONES (FOCALES) (PARCIALES) Y CON ATAQUES DE INICIO LOCALIZADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - EPILEPSIA Y SINDROMES EPILEPTICOS SINTOMATICOS RELACIONADOS CON LOCALIZACIONES (FOCALES) (PARCIALES) Y CON ATAQUES PARCIALES COMPLEJOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - OTRAS EPILEPSIAS Y SINDROMES EPILEPTICOS GENERALIZADOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G40 - EPILEPSIA Y SINDROMES EPILEPTICOS IDIOPATICOS GENERALIZADOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G41 - OTROS ESTADOS EPILEPTICOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G41 - ESTADO DE MAL EPILEPTICO DE TIPO NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G41 - ESTADO DE MAL EPILEPTICO PARCIAL COMPLEJO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G41 - ESTADO DE GRAN MAL EPILEPTICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G41 - ESTADO DE PEQUEҏ MAL EPILEPTICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G43 - MIGRAҁ COMPLICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G43 - OTRAS MIGRAҁS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G43 - MIGRAҁ, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G43 - MIGRAҁ SIN AURA (MIGRAҁ COMUN)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G43 - MIGRAҁ CON AURA (MIGRAҁ CLASICA)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G43 - ESTADO MIGRAҏSO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G44 - CEFALEA POSTRAUMATICA CRONICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G44 - CEFALEA INDUCIDA POR DROGAS, NO CLASIFICADA EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G44 - OTROS SINDROMES DE CEFALEA ESPECIFICADOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G44 - SINDROME DE CEFALEA EN RACIMOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G44 - CEFALEA VASCULAR, NO CLASIFICADA EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G44 - CEFALEA DEBIDA A TENSION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G45 - AMNESIA GLOBAL TRANSITORIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G45 - OTRAS ISQUEMIAS CEREBRALES TRANSITORIAS Y SINDROMES AFINES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G45 - ISQUEMIA CEREBRAL TRANSITORIA, SIN OTRA ESPECIFICACION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G45 - AMAUROSIS FUGAZ');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G45 - SINDROME ARTERIAL VERTEBRO-BASILAR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G45 - SINDROME DE LA ARTERIA CAROTIDA (HEMISFERICO)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G45 - SINDROMES ARTERIALES PRECEREBRALES BILATERALES Y MULTIPLES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - SINDROME LACUNAR SENSORIAL PURO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - SINDROME LACUNAR MOTOR PURO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - OTROS SINDROMES VASCULARES ENCEFALICOS EN ENFERMEDADES CEREBROVASCULARES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - OTROS SINDROMES LACUNARES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - SINDROME DE INFARTO CEREBELOSO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - SINDROME DE LA ARTERIA CEREBRAL ANTERIOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - SINDROME DE LA ARTERIA CEREBRAL MEDIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - SINDROMES APOPLETICOS DEL TALLO ENCEFALICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G46 - SINDROME DE LA ARTERIA CEREBRAL POSTERIOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G47 - NARCOLEPSIA Y CATAPLEXIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G47 - OTROS TRASTORNOS DEL SUEҏ');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G47 - TRASTORNO DEL SUEҏ, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G47 - APNEA DEL SUEҏ');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G47 - TRASTORNOS DEL INICIO Y DEL MANTENIMIENTO DEL SUEҏ (INSOMNIOS)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G47 - TRASTORNOS DE SOMNOLENCIA EXCESIVA (HIPERSOMNIOS)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G47 - TRASTORNOS DEL RITMO NICTAMERAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G50 - OTROS TRASTORNOS DEL TRIGEMINO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G50 - TRASTORNO DEL TRIGEMINO, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G50 - NEURALGIA DEL TRIGEMINO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G50 - DOLOR FACIAL ATIPICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G51 - MIOQUIMIA FACIAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G51 - OTROS TRASTORNOS DEL NERVIO FACIAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G51 - TRASTORNO DEL NERVIO FACIAL, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G51 - ESPASMO HEMIFACIAL CLONICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G51 - PARALISIS DE BELL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G51 - GANGLIONITIS GENICULADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G51 - SINDROME DE MELKERSSON');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G52 - TRASTORNOS DE MULTIPLES NERVIOS CRANEALES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G52 - TRASTORNOS DE OTROS NERVIOS CRANEALES ESPECIFICADOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G52 - TRASTORNO DE NERVIO CRANEAL, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G52 - TRASTORNOS DEL NERVIO HIPOGLOSO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G52 - TRASTORNOS DEL NERVIO OLFATORIO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G52 - TRASTORNOS DEL NERVIO GLOSOFARINGEO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G52 - TRASTORNOS DEL NERVIO VAGO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G53 - PARALISIS MULTIPLE DE LOS NERVIOS CRANEALES, EN ENFERMEDADES NEOPLASICAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G53 - OTROS TRASTORNOS DE LOS NERVIOS CRANEALES EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G53 - PARALISIS MULTIPLE DE LOS NERVIOS CRANEALES, EN LA SARCOIDOSIS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G53 - NEURALGIA POSTHERPES ZOSTER');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G53 - PARALISIS MULTIPLE DE LOS NERVIOS CRANEALES EN ENFERMEDADES INFECCIOSAS Y PARASITARIAS CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - SINDROME DEL MIEMBRO FANTASMA CON DOLOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - AMIOTROFIA NEURALGICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - SINDROME DEL MIEMBRO FANTASMA SIN DOLOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - TRASTORNO DE LA RAIZ Y PLEXOS NERVIOSOS, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - OTROS TRASTORNOS DE LAS RAICES Y PLEXOS NERVIOSOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - TRASTORNOS DEL PLEXO LUMBOSACRO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - TRASTORNOS DEL PLEXO BRAQUIAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - TRASTORNOS DE LA RAIZ CERVICAL, NO CLASIFICADOS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - TRASTORNOS DE LA RAIZ LUMBOSACRA, NO CLASIFICADOS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G54 - TRASTORNOS DE LA RAIZ TORACICA, NO CLASIFICADOS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G55 - COMPRESIONES DE LAS RAICES Y PLEXOS NERVIOSOS EN OTRAS DORSOPATIAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G55 - COMPRESIONES DE LAS RAICES Y PLEXOS NERVIOSOS EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G55 - COMPRESIONES DE LAS RAICES Y PLEXOS NERVIOSOS EN LA ESPONDILOSIS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G55 - COMPRESIONES DE LAS RAICES Y PLEXOS NERVIOSOS EN ENFERMEDADES NEOPLASICAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G55 - COMPRESIONES DE LAS RAICES Y PLEXOS NERVIOSOS EN TRASTORNOS DE LOS DISCOS INTERVERTEBRALES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G56 - CAUSALGIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G56 - OTRAS MONONEUROPATIAS DEL MIEMBRO SUPERIOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G56 - MONONEUROPATIA DEL MIEMBRO SUPERIOR, SIN OTRA ESPECIFICACION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G56 - LESION DEL NERVIO RADIAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G56 - SINDROME DEL TUNEL CARPIANO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G56 - OTRAS LESIONES DEL NERVIO MEDIANO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G56 - LESION DEL NERVIO CUBITAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - LESION DEL NERVIO PLANTAR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - SINDROME DEL TUNEL CALCANEO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - MONONEUROPATIA DEL MIEMBRO INFERIOR, SIN OTRA ESPECIFICACION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - OTRAS MONONEUROPATIAS DEL MIEMBRO INFERIOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - LESION DEL NERVIO CIATICO POPLITEO INTERNO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - MERALGIA PARESTESICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - LESION DEL NERVIO CIATICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - LESION DEL NERVIO CIATICO POPLITEO EXTERNO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G57 - LESION DEL NERVIO CRURAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G58 - OTRAS MONONEUROPATIAS ESPECIFICADAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G58 - MONONEUROPATIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G58 - NEUROPATIA INTERCOSTAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G58 - MONONEURITIS MULTIPLE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G59 - OTRAS MONONEUROPATIAS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G59 - MONONEUROPATIA DIABETICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G60 - NEUROPATIA PROGRESIVA IDIOPATICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G60 - OTRAS NEUROPATIAS HEREDITARIAS E IDIOPATICAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G60 - NEUROPATIA HEREDITARIA E IDIOPATICA, SIN OTRA ESPECIFICACION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G60 - NEUROPATIA HEREDITARIA MOTORA Y SENSORIAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G60 - ENFERMEDAD DE REFSUM');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G60 - NEUROPATIA ASOCIADA CON ATAXIA HEREDITARIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G61 - OTRAS POLINEUROPATIAS INFLAMATORIAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G61 - POLINEUROPATIA INFLAMATORIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G61 - SINDROME DE GUILLAIN-BARRE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G61 - NEUROPATIA AL SUERO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G62 - OTRAS POLINEUROPATIAS ESPECIFICADAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G62 - POLINEUROPATIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G62 - POLINEUROPATIA DEBIDA A OTRO AGENTE TOXICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G62 - POLINEUROPATIA INDUCIDA POR DROGAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G62 - POLINEUROPATIA ALCOHOLICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G63 - POLINEUROPATIA EN TRASTORNOS DEL TEJIDO CONECTIVO SISTEMICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G63 - POLINEUROPATIA EN DEFICIENCIA NUTRICIONAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G63 - POLINEUROPATIA EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G63 - POLINEUROPATIA EN OTROS TRASTORNOS OSTEOMUSCULARES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G63 - POLINEUROPATIA EN ENFERMEDAD NEOPLASICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G63 - POLINEUROPATIA EN ENFERMEDADES INFECCIOSAS Y PARASITARIAS CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G63 - POLINEUROPATIA EN OTRAS ENFERMEDADES ENDOCRINAS Y METABOLICAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G63 - POLINEUROPATIA DIABETICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G64 - OTROS TRASTORNOS DEL SISTEMA NERVIOSO PERIFERICO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G70 - OTROS TRASTORNOS NEUROMUSCULARES ESPECIFICADOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G70 - TRASTORNO NEUROMUSCULAR, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G70 - MIASTENIA CONGENITA O DEL DESARROLLO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G70 - MIASTENIA GRAVIS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G70 - TRASTORNOS TOXICOS NEUROMUSCULARES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G71 - MIOPATIA MITOCONDRICA, NO CLASIFICADA EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G71 - OTROS TRASTORNOS PRIMARIOS DE LOS MUSCULOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G71 - TRASTORNO PRIMARIO DEL MUSCULO, TIPO NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G71 - DISTROFIA MUSCULAR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G71 - TRASTORNOS MIOTONICOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G71 - MIOPATIAS CONGENITAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G72 - MIOPATIA INFLAMATORIA, NO CLASIFICADA EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G72 - OTRAS MIOPATIAS ESPECIFICADAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G72 - MIOPATIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G72 - PARALISIS PERIODICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G72 - MIOPATIA INDUCIDA POR DROGAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G72 - MIOPATIA ALCOHOLICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G72 - MIOPATIA DEBIDA A OTROS AGENTES TOXICOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G73 - MIOPATIA EN ENFERMEDADES ENDOCRINAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G73 - MIOPATIA EN ENFERMEDADES INFECCIOSAS Y PARASITARIAS CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G73 - MIOPATIA EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G73 - MIOPATIA EN ENFERMEDADES METABOLICAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G73 - SINDROME DE EATON-LAMBERT');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G73 - SINDROMES MIASTENICOS EN ENFERMEDADES ENDOCRINAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G73 - SINDROMES MIASTENICOS EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G73 - OTROS SINDROMES MIASTENICOS EN ENFERMEDAD NEOPLASICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G80 - PARALISIS CEREBRAL ATAXICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G80 - OTROS TIPOS DE PARALISIS CEREBRAL INFANTIL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G80 - PARALISIS CEREBRAL INFANTIL, SIN OTRA ESPECIFICACION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G80 - PARALISIS CEREBRAL DISCINETICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G80 - PARALISIS CEREBRAL ESPASTICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G80 - DIPLEJIA ESPASTICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G80 - HEMIPLEJIA INFANTIL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G81 - HEMIPLEJIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G81 - HEMIPLEJIA ESPASTICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G81 - HEMIPLEJIA FLACIDA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G82 - CUADRIPLEJIA FLACIDA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G82 - CUADRIPLEJIA ESPASTICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G82 - CUADRIPLEJIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G82 - PARAPLEJIA FLACIDA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G82 - PARAPLEJIA ESPASTICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G82 - PARAPLEJIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G83 - SINDROME DE LA COLA DE CABALLO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G83 - OTROS SINDROMES PARALITICOS ESPECIFICADOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G83 - SINDROME PARALITICO, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G83 - MONOPLEJIA, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G83 - DIPLEJIA DE LOS MIEMBROS SUPERIORES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G83 - MONOPLEJIA DE MIEMBRO INFERIOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G83 - MONOPLEJIA DE MIEMBRO SUPERIOR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G90 - DISREFLEXIA AUTONOMICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G90 - OTROS TRASTORNOS DEL SISTEMA NERVIOSO AUTONOMO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G90 - TRASTORNO DEL SISTEMA NERVIOSO AUTONOMO, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G90 - DEGENERACION DE SISTEMAS MULTIPLES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G90 - NEUROPATIA AUTONOMA PERIFERICA IDIOPATICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G90 - DISAUTONOMIA FAMILIAR (SINDROME DE RILEY-DAY)');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G90 - SINDROME DE HORNER');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G91 - HIDROCEFALO POSTRAUMATICO, SIN OTRA ESPECIFICACION');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G91 - OTROS TIPOS DE HIDROCEFALO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G91 - HIDROCEFALO, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G91 - HIDROCEFALO COMUNICANTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G91 - HIDROCEFALO OBSTRUCTIVO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G91 - HIDROCEFALO DE PRESION NORMAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G92 - ENCEFALOPATIA TOXICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - EDEMA CEREBRAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - COMPRESION DEL ENCEFALO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - SINDROME DE REYE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - TRASTORNO DEL ENCEFALO, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - OTROS TRASTORNOS ESPECIFICADOS DEL ENCEFALO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - LESION CEREBRAL ANOXICA, NO CLASIFICADA EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - QUISTE CEREBRAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - HIPERTENSION INTRACRANEAL BENIGNA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - ENCEFALOPATIA NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G93 - SINDROME DE FATIGA POSTVIRAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G94 - HIDROCEFALO EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G94 - OTROS TRASTORNOS ENCEFALICOS ESPECIFICADOS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G94 - HIDROCEFALO EN  ENFERMEDADES INFECCIOSAS Y PARASITARIAS CLASIFICADAS EN ORA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G94 - HIDROCEFALO EN ENFERMEDAD NEOPLASICA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G95 - OTRAS ENFERMEDADES ESPECIFICADAS DE LA MEDULA ESPINAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G95 - ENFERMEDAD DE LA MEDULA ESPINAL, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G95 - COMPRESION MEDULAR, NO ESPECIFICADA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G95 - SIRINGOMIELIA Y SIRINGOBULBIA');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G95 - MIELOPATIAS VASCULARES');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G96 - OTROS TRASTORNOS ESPECIFICADOS DEL SISTEMA NERVIOSO CENTRAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G96 - TRASTORNO DEL SISTEMA NERVIOSO CENTRAL, NO ESPECIFICADO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G96 - PERDIDA DE LIQUIDO CEFALORRAQUIDEO');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G96 - TRASTORNOS DE LAS MENINGES, NO CLASIFICADOS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G97 - OTROS TRASTORNOS DEL SISTEMA NERVIOSO CONSECUTIVOS A PROCEDIMIENTOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G97 - TRASTORNOS NO ESPECIFICADOS DEL SISTEMA NERVIOSO CONSECUTIVOS A PROCEDIMIENTOS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G97 - HIPOTENSION INTRACRANEAL POSTERIOR A ANASTOMOSIS VENTRICULAR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G97 - PERDIDA DE LIQUIDO CEFALORRAQUIDEO POR PUNCION ESPINAL');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G97 - OTRA REACCION A LA PUNCION ESPINAL Y LUMBAR');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G98 - OTROS TRASTORNOS DEL SISTEMA NERVIOSO, NO CLASIFICADOS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G99 - MIELOPATIA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G99 - OTROS TRASTORNOS ESPECIFICADOS DEL SISTEMA NERVIOSO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G99 - NEUROPATIA AUTONOMICA EN ENFERMEDADES METABOLICAS Y ENDOCRINAS');
INSERT INTO categoria_diagnostico (DESCRIPCION) 
VALUES('G99 - OTROS TRASTORNOS DEL SISTEMA NERVIOSO AUTONOMO EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE');

COMMIT;
END TRANSACTION;

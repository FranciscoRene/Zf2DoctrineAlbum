-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-06-2013 a las 22:02:13
-- Versión del servidor: 5.5.28
-- Versión de PHP: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `rent_a_car`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `rut_c` varchar(13) NOT NULL COMMENT '		',
  `nom_c` varchar(20) NOT NULL,
  `ape_c` varchar(20) NOT NULL,
  `dir_c` varchar(100) NOT NULL,
  `edad_c` int(2) DEFAULT NULL,
  `email_c` varchar(50) NOT NULL,
  `fono_c` varchar(20) NOT NULL,
  PRIMARY KEY (`rut_c`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`rut_c`, `nom_c`, `ape_c`, `dir_c`, `edad_c`, `email_c`, `fono_c`) VALUES
('12.328.887-4', 'Daniel', 'Fritz', 'Freire 200, ConcepciÃ³n', 27, 'dfritz@live.com', '56437728'),
('13.345.432-4', 'Juan', 'Escobar', 'Arturo Pratt 1002, ConcepciÃ³n', 45, 'jescobar3@hotmail.com', '78912341'),
('19.234.435-3', 'Francisca', 'Duran', 'Cerro Verde 2001, ConcepciÃ³n.', 29, 'fran@hotmail.com', '99744563');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_arriendos`
--

CREATE TABLE IF NOT EXISTS `contratos_arriendos` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `estado` char(2) NOT NULL,
  `f_inicio` date NOT NULL,
  `f_fin` date DEFAULT NULL,
  `h_inicio` time NOT NULL,
  `h_fin` time DEFAULT NULL,
  `clientes_rut_c` varchar(13) NOT NULL,
  `usuarios_rut_u` varchar(13) NOT NULL,
  PRIMARY KEY (`folio`),
  KEY `fk_contratos_arriendos_usuarios1_idx` (`usuarios_rut_u`),
  KEY `fk_contratos_arriendos_clientes_1` (`clientes_rut_c`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1033 ;

--
-- Volcado de datos para la tabla `contratos_arriendos`
--

INSERT INTO `contratos_arriendos` (`folio`, `estado`, `f_inicio`, `f_fin`, `h_inicio`, `h_fin`, `clientes_rut_c`, `usuarios_rut_u`) VALUES
(1032, 'NO', '2013-06-12', '2013-06-16', '09:00:00', '18:00:00', '12.328.887-4', '12.345.678-9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_de_contrato`
--

CREATE TABLE IF NOT EXISTS `detalle_de_contrato` (
  `valor_por_auto` decimal(10,3) NOT NULL,
  `contratos_arriendos_folio` int(11) NOT NULL,
  `vehiculos_patente` varchar(8) NOT NULL,
  KEY `fk_detalle_de_contrato_vehiculos1_idx` (`vehiculos_patente`),
  KEY `contratos_arriendos_folio` (`contratos_arriendos_folio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_de_contrato`
--

INSERT INTO `detalle_de_contrato` (`valor_por_auto`, `contratos_arriendos_folio`, `vehiculos_patente`) VALUES
(27.000, 1032, 'CRVD-97');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenciones`
--

CREATE TABLE IF NOT EXISTS `mantenciones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `costo` decimal(10,3) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text,
  `vehiculos_patente` varchar(8) NOT NULL,
  `servicios_tecnicos_rut_st` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mantenciones_vehiculos1_idx` (`vehiculos_patente`),
  KEY `fk_mantenciones_servicios_tecnicos1_idx` (`servicios_tecnicos_rut_st`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `mantenciones`
--

INSERT INTO `mantenciones` (`id`, `costo`, `fecha`, `descripcion`, `vehiculos_patente`, `servicios_tecnicos_rut_st`) VALUES
(3, 110.000, '2013-06-11', 'MantenciÃ³n 40.000 KilÃ³metros.', 'CRVD-97', '56.873.345-5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisiones`
--

CREATE TABLE IF NOT EXISTS `revisiones` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `rev_type` varchar(45) NOT NULL,
  `estado_r` varchar(45) NOT NULL,
  `fecha` varchar(45) NOT NULL,
  `contratos_arriendos_folio` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_revisiones_contratos_arriendos1_idx` (`contratos_arriendos_folio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `revisiones`
--

INSERT INTO `revisiones` (`id`, `rev_type`, `estado_r`, `fecha`, `contratos_arriendos_folio`) VALUES
(22, 'previa', 'Normal', '2013-06-12', 1032);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_tecnicos`
--

CREATE TABLE IF NOT EXISTS `servicios_tecnicos` (
  `rut_st` varchar(12) NOT NULL,
  `nom_st` varchar(20) NOT NULL,
  `dir_st` varchar(50) DEFAULT NULL,
  `email_st` varchar(50) DEFAULT NULL,
  `fono_st` varchar(20) DEFAULT NULL,
  `representante_st` varchar(30) NOT NULL,
  `item_st` varchar(50) NOT NULL,
  PRIMARY KEY (`rut_st`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios_tecnicos`
--

INSERT INTO `servicios_tecnicos` (`rut_st`, `nom_st`, `dir_st`, `email_st`, `fono_st`, `representante_st`, `item_st`) VALUES
('56.873.345-5', 'Derco Center', 'PaicavÃ­ 2613 ConcepciÃ³n', 'info@sergioescobar.cl', '041-2869000', 'Sergio Escobar', 'Mantenciones de Vehiculos'),
('77.348.612-5', 'Salazar Israel', 'Arturo Pratt 1000', 'info@salazarisrael.cl', '041-2659000', 'Marco Infante', 'Mantenciones de Vehiculos'),
('78.578.324-1', 'Bruno Fritsch', 'Maipu 1063 ConcepciÃ³n', 'info@toyota.cl', '041-2782000', 'Jorge Jack', 'Desabolladura y Pintura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `rut_u` varchar(13) NOT NULL,
  `nom_u` varchar(20) NOT NULL,
  `ape_u` varchar(20) NOT NULL,
  `dir_u` varchar(50) NOT NULL,
  `email_u` varchar(50) NOT NULL,
  `edad_u` int(2) DEFAULT NULL,
  `fono_u` varchar(20) NOT NULL,
  `perfil_u` int(1) NOT NULL,
  `pass_u` varchar(100) NOT NULL,
  PRIMARY KEY (`rut_u`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`rut_u`, `nom_u`, `ape_u`, `dir_u`, `email_u`, `edad_u`, `fono_u`, `perfil_u`, `pass_u`) VALUES
('12.345.678-9', 'Oscar', 'Sanhueza', 'Barros Arana 2012', 'o.sanhueza@escares.cl', 26, '7892307', 1, '123456'),
('9.456.324-8', 'Larry', 'Curton', 'Henriquez Soro 1524, ConcepciÃ³n', 'larry@lc.com', 22, '67653981', 2, '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE IF NOT EXISTS `vehiculos` (
  `patente` varchar(8) NOT NULL,
  `cilindrada` varchar(3) NOT NULL,
  `color` varchar(20) NOT NULL,
  `combustible` char(7) NOT NULL,
  `estado` char(2) DEFAULT NULL,
  `imagen` varchar(45) DEFAULT NULL,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `num_pasajeros` decimal(2,0) NOT NULL,
  `stock` decimal(3,0) DEFAULT NULL,
  `otras` text,
  `valor_arriendo` decimal(10,3) DEFAULT NULL,
  PRIMARY KEY (`patente`),
  UNIQUE KEY `patente_UNIQUE` (`patente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`patente`, `cilindrada`, `color`, `combustible`, `estado`, `imagen`, `marca`, `modelo`, `num_pasajeros`, `stock`, `otras`, `valor_arriendo`) VALUES
('CRVD-97', '2.0', 'Blanco Invierno', 'Bencina', 'SI', 'mazda3_sport_blanco_mica.jpg', 'Mazda', '3', 5, NULL, 'Aire Acondicionado Full Equipo Climatizador Cierre Centralizado DirecciÃ³n Asistida Caja de Cambios Manual ', 27.000),
('DFHJ-23', '2.5', 'Blanco Invierno', 'Bencina', 'NO', 'hyundai-santa-fe-facelift-1.jpg', 'Hyundai', 'Santa Fe', 7, NULL, 'Aire Acondicionado Full Equipo Climatizador Caja de Cambios Automatica ', 65.000),
('DWHK-92', '3.4', 'Negro Perla', 'Diesel', 'NO', 'mitsu_montero_g2.png', 'Mitsubishi', 'Montero Sport', 5, NULL, 'Aire Acondicionado Cierre Centralizado DirecciÃ³n Asistida Caja de Cambios Automatica ', 65.000);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contratos_arriendos`
--
ALTER TABLE `contratos_arriendos`
  ADD CONSTRAINT `fk_contratos_arriendos_clientes` FOREIGN KEY (`clientes_rut_c`) REFERENCES `clientes` (`rut_c`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contratos_arriendos_usuarios1` FOREIGN KEY (`usuarios_rut_u`) REFERENCES `usuarios` (`rut_u`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_de_contrato`
--
ALTER TABLE `detalle_de_contrato`
  ADD CONSTRAINT `fk_detalle_de_contrato_contratos_arriendos1` FOREIGN KEY (`contratos_arriendos_folio`) REFERENCES `contratos_arriendos` (`folio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_de_contrato_vehiculos1` FOREIGN KEY (`vehiculos_patente`) REFERENCES `vehiculos` (`patente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mantenciones`
--
ALTER TABLE `mantenciones`
  ADD CONSTRAINT `fk_mantenciones_servicios_tecnicos1` FOREIGN KEY (`servicios_tecnicos_rut_st`) REFERENCES `servicios_tecnicos` (`rut_st`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mantenciones_vehiculos1` FOREIGN KEY (`vehiculos_patente`) REFERENCES `vehiculos` (`patente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `revisiones`
--
ALTER TABLE `revisiones`
  ADD CONSTRAINT `fk_revisiones_contratos_arriendos1` FOREIGN KEY (`contratos_arriendos_folio`) REFERENCES `contratos_arriendos` (`folio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

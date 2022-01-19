-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.21 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para konecta
CREATE DATABASE IF NOT EXISTS `konecta` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `konecta`;

-- Volcando estructura para tabla konecta.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria_id` int NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla konecta.categorias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
REPLACE INTO `categorias` (`categoria_id`, `categoria_nombre`) VALUES
	(1, 'Desayunos'),
	(2, 'Postres'),
	(3, 'Expresso'),
	(4, 'Sandwiches');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla konecta.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `producto_id` int NOT NULL AUTO_INCREMENT,
  `producto_nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_referencia` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_precio` decimal(10,2) NOT NULL,
  `producto_peso` decimal(10,2) NOT NULL,
  `categoria_id` int NOT NULL,
  `producto_stock` int NOT NULL,
  `producto_estado` enum('1','0') COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1',
  `producto_fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`producto_id`),
  KEY `FK_productos_categorias` (`categoria_id`),
  CONSTRAINT `FK_productos_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla konecta.productos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
REPLACE INTO `productos` (`producto_id`, `producto_nombre`, `producto_referencia`, `producto_precio`, `producto_peso`, `categoria_id`, `producto_stock`, `producto_estado`, `producto_fechacreacion`) VALUES
	(1, 'Cafe Negro', 'caliente', 43.00, 43.00, 1, 39, '1', '2022-01-19 15:30:36'),
	(2, 'Cafe Maron', 'rico', 123.00, 123.00, 1, 121, '1', '2022-01-19 15:40:34');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla konecta.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `venta_id` int NOT NULL AUTO_INCREMENT,
  `producto_id` int NOT NULL,
  `venta_cantidad` int NOT NULL,
  `venta_soles` decimal(10,2) NOT NULL DEFAULT '0.00',
  `venta_fechacompra` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`venta_id`),
  KEY `FK_ventas_productos` (`producto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla konecta.ventas: 0 rows
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
REPLACE INTO `ventas` (`venta_id`, `producto_id`, `venta_cantidad`, `venta_soles`, `venta_fechacompra`) VALUES
	(1, 1, 1, 43.00, '2022-01-19 17:12:40'),
	(2, 1, 2, 86.00, '2022-01-19 17:41:07'),
	(3, 1, 1, 43.00, '2022-01-19 17:41:57'),
	(4, 2, 2, 246.00, '2022-01-19 17:52:06');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

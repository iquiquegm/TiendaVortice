# ************************************************************
# Antares - SQL Client
# Version 0.7.17
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 (MySQL Community Server  5.7.24)
# Database: tienda
# Generation time: 2023-10-26T18:20:35-06:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table carritos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carritos`;

CREATE TABLE `carritos` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_cliente` tinyint(4) NOT NULL,
  `fecha` datetime NOT NULL,
  `subtotal` float NOT NULL,
  `descuento` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Todos los pedidos que se han realizado.';





# Dump of table clientes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) NOT NULL,
  `whatsapp` char(20) NOT NULL,
  `correo` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lista de todos los clientes.';





# Dump of table colores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `colores`;

CREATE TABLE `colores` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` char(30) NOT NULL,
  `valor` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lista de colores disponibles';





# Dump of table inventario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inventario`;

CREATE TABLE `inventario` (
  `id_producto` tinyint(4) NOT NULL,
  `id_color` tinyint(4) NOT NULL,
  `cantidad` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lista de existencias de productos.';





# Dump of table productos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) NOT NULL,
  `descripcion` char(255) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de todos los productos.';





# Dump of table ventas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ventas`;

CREATE TABLE `ventas` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_carrito` tinyint(4) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_producto` tinyint(4) NOT NULL,
  `precio_producto` float NOT NULL,
  `cantidad` tinyint(4) NOT NULL,
  `subtotal` float NOT NULL,
  `descuento` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lista de productos vendidos';





# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2023-10-26T18:20:35-06:00

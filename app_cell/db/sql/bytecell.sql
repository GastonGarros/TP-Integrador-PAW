CREATE DATABASE  IF NOT EXISTS `bytecell` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bytecell`;
-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: bytecell
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  PRIMARY KEY (`idCategoria`),
  UNIQUE KEY `idCategoria_UNIQUE` (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categoria`
--

LOCK TABLES `Categoria` WRITE;
/*!40000 ALTER TABLE `Categoria` DISABLE KEYS */;
INSERT INTO `Categoria` VALUES (1,'pines',0),(2,'cargadores',0);
/*!40000 ALTER TABLE `Categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Detalle`
--

DROP TABLE IF EXISTS `Detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Detalle` (
  `IdVenta` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Subtotal` decimal(10,0) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  PRIMARY KEY (`IdVenta`,`IdProducto`),
  KEY `fk_Detalle_Producto1_idx` (`IdProducto`),
  CONSTRAINT `fk_Detalle_Producto1` FOREIGN KEY (`IdProducto`) REFERENCES `Producto` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Detalle_Venta1` FOREIGN KEY (`IdVenta`) REFERENCES `Venta` (`IdVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Detalle`
--

LOCK TABLES `Detalle` WRITE;
/*!40000 ALTER TABLE `Detalle` DISABLE KEYS */;
INSERT INTO `Detalle` VALUES (1,1,60,1);
/*!40000 ALTER TABLE `Detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Persona`
--

DROP TABLE IF EXISTS `Persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Persona` (
  `nro_doc` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `tipo_doc` varchar(45) NOT NULL,
  `fecha_nac` date NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`nro_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `Producto`
--

DROP TABLE IF EXISTS `Producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Producto` (
  `idProductos` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `PrecioLista` decimal(10,0) NOT NULL,
  `PrecioVenta` decimal(10,0) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `tipo_publico` varchar(45) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idProductos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Producto`
--


--
-- Table structure for table `Producto_has_Categoria`
--

DROP TABLE IF EXISTS `Producto_has_Categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Producto_has_Categoria` (
  `Producto_idProducto` int(11) NOT NULL,
  `Categoria_idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`Producto_idProducto`,`Categoria_idCategoria`),
  KEY `fk_Producto_has_Categoria_Categoria1_idx` (`Categoria_idCategoria`),
  KEY `fk_Producto_has_Categoria_Producto_idx` (`Producto_idProducto`),
  CONSTRAINT `fk_Producto_has_Categoria_Categoria1` FOREIGN KEY (`Categoria_idCategoria`) REFERENCES `Categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Producto_has_Categoria_Producto` FOREIGN KEY (`Producto_idProducto`) REFERENCES `Producto` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Producto_has_Categoria`
--

LOCK TABLES `Producto_has_Categoria` WRITE;
/*!40000 ALTER TABLE `Producto_has_Categoria` DISABLE KEYS */;
INSERT INTO `Producto_has_Categoria` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `Producto_has_Categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Stock`
--

DROP TABLE IF EXISTS `Stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Stock` (
  `Producto_idProducto` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  KEY `fk_Stock_Producto1_idx` (`Producto_idProducto`),
  CONSTRAINT `fk_Stock_Producto1` FOREIGN KEY (`Producto_idProducto`) REFERENCES `Producto` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Stock`
--

LOCK TABLES `Stock` WRITE;
/*!40000 ALTER TABLE `Stock` DISABLE KEYS */;
INSERT INTO `Stock` VALUES (1,5),(2,5);
/*!40000 ALTER TABLE `Stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Venta`
--

DROP TABLE IF EXISTS `Venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Venta` (
  `IdVenta` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `ValorTotal` decimal(10,0) DEFAULT NULL,
  `DireccionLocal` varchar(45) DEFAULT NULL,
  `user_IdUser` int(11) NOT NULL,
  PRIMARY KEY (`IdVenta`),
  KEY `fk_Venta_user1_idx` (`user_IdUser`),
  CONSTRAINT `fk_Venta_user1` FOREIGN KEY (`user_IdUser`) REFERENCES `user` (`nro_doc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nro_doc` int(11) NOT NULL,
  `Rol` varchar(45) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  PRIMARY KEY (`nro_doc`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  CONSTRAINT `fk_user_Persona1` FOREIGN KEY (`nro_doc`) REFERENCES `Persona` (`nro_doc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-26 17:41:00

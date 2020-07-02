CREATE DATABASE  IF NOT EXISTS `bytecell` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
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
-- Dumping data for table `Persona`
--

LOCK TABLES `Persona` WRITE;
/*!40000 ALTER TABLE `Persona` DISABLE KEYS */;
INSERT INTO `Persona` VALUES (36342604,'Gaston','Garros','DNI','2020-02-02','etcheverry 207','2325593915',0,''),(36342605,'Gaston','Garros','DNI','2020-02-02','etcheverry 207','2325593915',0,''),(36342606,'manuel','Garros-h','dni','2020-02-02','etcheverry 207','2325593915',0,''),(36342607,'manuel','Garros-h','dni','2020-02-02','etcheverry 207','2325593915',0,'gasto@gaston.com'),(36342608,'manuel','Garros-h','dni','2020-02-02','etcheverry 207','2325593915',0,'gasto@gaston.com'),(36342609,'manuel','Garros-h','dni','2020-02-02','etcheverry 207','2325593915',0,'gasto@gaston.com'),(36342610,'manuel','Garros-h','dni','2020-02-02','etcheverry 207','2325593915',0,'gasto@gaston.com'),(36342611,'manuel','Garros-h','dni','2020-02-02','etcheverry 207','2325593915',0,'gasto@gaston.com'),(36342612,'manuel','Garros-h','dni','2020-02-02','etcheverry 207','2325593915',0,'gasto@gaston.com'),(36342613,'nombr','apellido','otros','2020-02-02','etcheverry 207','2325593915',0,'prueba@prueba.com');
/*!40000 ALTER TABLE `Persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Producto`
--

DROP TABLE IF EXISTS `Producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Producto` (
  `idProductos` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `PrecioLista` decimal(10,0) NOT NULL,
  `PrecioVenta` decimal(10,0) NOT NULL,
  `estado` varchar(45) DEFAULT '1',
  `tipo_publico` varchar(45) DEFAULT 'publico',
  `imagen` varchar(100) DEFAULT NULL,
  `visitas` int(11) DEFAULT '0',
  PRIMARY KEY (`idProductos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Producto`
--

LOCK TABLES `Producto` WRITE;
/*!40000 ALTER TABLE `Producto` DISABLE KEYS */;
INSERT INTO `Producto` VALUES (1,'pin motorola g4','Conector de carga compatible con los siguiente modelos de celulares; xt1032 moto g, xt1033 moto g, xt10336 moto g ',35,60,'0','gremio','view/images/1/pin.jpg',0),(2,'cargador','Cargador para telefono celular, tablet, gps, rapido, seguro. Entrada 220v 50HZ. Salida 5v',200,350,'1','general','view/images/2/cargador.jpg',46),(3,'modulo iphone 7','Modulo pantalla completa iphone 7 plus. modelos compatibles: A1661. A1784 y A1785. Si tu celular no da imagen, no funciona el tactil o tiene roto el vidrio, este es el repuesto que necesita.',3500,4500,'1','gremio','view/images/3/modulo.jpg',16),(4,'funda iphone 11','funda de silicona realizada por Aple  para iphone 11 pro, se adapta perfectamente a los botones, el boton lateral y las curvas del telefono sin abultar nada.',110,250,'1','general','view/images/4/funda.jpg',61),(5,'Samsun A50','El Samsung Galaxy A50 es un celular de gama media con lector de huellas en pantalla, tres cÃ¡maras traseras que pueden tomar fotos con fondo borroso y una baterÃ­a como la del Galaxy Note 9.',40000,45000,'1','general','view/images/5/A50.jpg',0),(6,'motorola g8 plus','Motorola Moto G8 Plus 64 Gb 4 Gb Ram Libre Modelo: XT2019-2',23000,28000,'1','general','view/images/6/g8plus.jpg',0),(7,'parlante bluetooth','PARLANTE BLUETOOTH PORTÃTIL DAEWOO TORRE 1500 WATTS',9999,11999,'1','general','view/images/7/parlante.jpg',0);
/*!40000 ALTER TABLE `Producto` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `Stock` VALUES (1,5),(2,5),(4,19),(3,45);
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
-- Dumping data for table `Venta`
--

LOCK TABLES `Venta` WRITE;
/*!40000 ALTER TABLE `Venta` DISABLE KEYS */;
INSERT INTO `Venta` VALUES (1,'2020-02-02',60,'Rawson 2324',36342604);
/*!40000 ALTER TABLE `Venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
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
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('gaston','gaston@gmail.com','1234','1970-01-01 03:00:01',36342604,'gremio',1),('prueba','prueba1@prueba.com','123456','2020-01-01 03:00:01',36342605,'publico',1),('pruebas','pruebas@prueba.com','123456','1970-01-01 03:00:01',36342611,'gremio',0),('usuario','prueba@prueba.com','$2y$10$TLGuETVMKKGpbkStZq7B1ObYTicRt8JGongnQwcng9.7yPMqRinwa','1970-01-01 03:00:01',36342612,'general',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-02 17:24:35

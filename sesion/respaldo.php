<?php

echo "<!Probando LogOut>
            <script type='text/javascript'>alert('respaldo.php');</script>";

session_start();
    $_SESSION['conectar']=true;
    require ('../sesion/conexion.php');
    require ('../sesion/usuario_conectado.php');

$venta=$conexion->query('SELECT * FROM venta;');
$pa_ve=$conexion->query('SELECT * FROM pago_venta;');
$pago=$conexion->query('SELECT * FROM pago WHERE stat=1;');
$cliente=$conexion->query('SELECT * FROM cliente WHERE stat=1;');
$usuario=$conexion->query('SELECT * FROM deuda WHERE stat=1;');

$clientes="";
foreach ($cliente as $clientex)
{
    $clientes=$clientes."(".$clientex['ci'].",'".$clientex['nombre']."',".$clientex['stat']."),";
}
$clientes=trim($clientes, ',');
$clientes=$clientes.";";

$pa_ves="";
foreach ($pa_ve as $pa_vex)
{
    $pa_ves=$pa_ves."(".$pa_vex['pagoid'].",".$pa_vex['ventaid'].",".$pa_vex['monto'].",".$pa_vex['stat']."),";
}
$pa_ves=trim($pa_ves, ',');
$pa_ves=$pa_ves.";";

$pagos="";
foreach ($pago as $pagox)
{
    $pagos=$pagos."(".$pagox['idpago'].",".$pagox['clienteid'].",'".$pagox['usuarioid']."',".$pagox['monto'].",'".$pagox['fecha']."',".$pagox['stat']."),";
}
$pagos=trim($pagos, ',');
$pagos=$pagos.";";

$usuarios="";
foreach ($usuario as $usuariox)
{
    $usuarios=$usuarios."('".$usuariox['usuario']."','".$usuariox['clave']."',".$usuariox['estatus']."),";
}
$usuarios=trim($usuarios, ',');
$usuarios=$usuarios.";";

$ventas="";
foreach ($venta as $ventax)
{
    $ventas=$ventas."(".$ventax['idventa'].",'".$ventax['fecha']."','".$ventax['articulos']."',".$ventax['precio'].",'".$ventax['usuarioid']."',".$ventax['clienteid'].",".$ventax['stat']."),";
}
$ventas=trim($ventas, ',');
$ventas=$ventas.";";

$txt="-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: test
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Current Database: `test`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `test`;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `ci` int(8) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ci`)
) ENGINE=InnoDB AUTO_INCREMENT=987654322 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES ".$clientes
."/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deuda`
--

DROP TABLE IF EXISTS `deuda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deuda` (
  `iddeuda` int(5) NOT NULL AUTO_INCREMENT,
  `clienteid` int(8) NOT NULL,
  `monto` float NOT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iddeuda`),
  KEY `deuda_cliente_idx` (`clienteid`),
  CONSTRAINT `deuda_cliente` FOREIGN KEY (`clienteid`) REFERENCES `cliente` (`ci`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deuda`
--

LOCK TABLES `deuda` WRITE;
/*!40000 ALTER TABLE `deuda` DISABLE KEYS */;
/*!40000 ALTER TABLE `deuda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `clienteid` int(8) NOT NULL,
  `usuarioid` varchar(16) NOT NULL,
  `monto` float NOT NULL,
  `fecha` date NOT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpago`),
  KEY `pago_usuario_idx` (`usuarioid`),
  KEY `pago_cliente_idx` (`clienteid`),
  CONSTRAINT `pago_cliente` FOREIGN KEY (`clienteid`) REFERENCES `cliente` (`ci`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pago_usuario` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
INSERT INTO `pago` VALUES ".$pagos
."/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago_venta`
--

DROP TABLE IF EXISTS `pago_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago_venta` (
  `pagoid` int(11) NOT NULL,
  `ventaid` int(11) NOT NULL,
  `monto` float NOT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pagoid`,`ventaid`),
  KEY `pv_venta_idx` (`ventaid`),
  CONSTRAINT `pv_pago` FOREIGN KEY (`pagoid`) REFERENCES `pago` (`idpago`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pv_venta` FOREIGN KEY (`ventaid`) REFERENCES `venta` (`idventa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago_venta`
--

LOCK TABLES `pago_venta` WRITE;
/*!40000 ALTER TABLE `pago_venta` DISABLE KEYS */;
INSERT INTO `pago` VALUES ".$pa_ves
."/*!40000 ALTER TABLE `pago_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario` varchar(16) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ".$usuarios
."/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `articulos` varchar(400) NOT NULL DEFAULT 'No se registraron los articulos vendidos',
  `precio` float NOT NULL,
  `usuarioid` varchar(16) NOT NULL,
  `clienteid` int(8) NOT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idventa`),
  KEY `venta_usuario_idx` (`usuarioid`),
  KEY `venta_cliente_idx` (`clienteid`),
  CONSTRAINT `venta_cliente` FOREIGN KEY (`clienteid`) REFERENCES `cliente` (`ci`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `venta_usuario` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES ".$ventas
."/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'test'
--

--
-- Dumping routines for database 'test'
--
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on ".$hoy= date('Y-m-d H:i:s');

$_SESSION['respaldo']=$txt;

?>
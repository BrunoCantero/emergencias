# Host: localhost  (Version 5.5.5-10.1.32-MariaDB)
# Date: 2018-09-04 07:44:20
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "category"
#

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "category"
#


#
# Structure for table "codigos"
#

DROP TABLE IF EXISTS `codigos`;
CREATE TABLE `codigos` (
  `Id_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "codigos"
#

INSERT INTO `codigos` VALUES (1,'2000'),(2,'5000'),(3,'9000'),(4,'1000'),(5,'3000');

#
# Structure for table "moviles"
#

DROP TABLE IF EXISTS `moviles`;
CREATE TABLE `moviles` (
  `Id_movil` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_movil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "moviles"
#

INSERT INTO `moviles` VALUES (1,'43'),(2,'41');

#
# Structure for table "obras_sociales"
#

DROP TABLE IF EXISTS `obras_sociales`;
CREATE TABLE `obras_sociales` (
  `id_obrasocial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_obrasocial` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_obrasocial`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "obras_sociales"
#

INSERT INTO `obras_sociales` VALUES (1,'Iasep'),(2,'Salud integral'),(3,'Pami');

#
# Structure for table "status"
#

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "status"
#

INSERT INTO `status` VALUES (1,'activo'),(2,'inactivo');

#
# Structure for table "sys_areas_protegidas"
#

DROP TABLE IF EXISTS `sys_areas_protegidas`;
CREATE TABLE `sys_areas_protegidas` (
  `id_area_protegida` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(180) DEFAULT NULL,
  PRIMARY KEY (`id_area_protegida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "sys_areas_protegidas"
#


#
# Structure for table "sys_medicos"
#

DROP TABLE IF EXISTS `sys_medicos`;
CREATE TABLE `sys_medicos` (
  `id_medico` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "sys_medicos"
#


#
# Structure for table "sys_perfiles_permisos"
#

DROP TABLE IF EXISTS `sys_perfiles_permisos`;
CREATE TABLE `sys_perfiles_permisos` (
  `id_perfiles` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_perfiles`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "sys_perfiles_permisos"
#

INSERT INTO `sys_perfiles_permisos` VALUES (1,'administrador'),(2,'recepcion'),(3,'despachante'),(4,'administrativo');

#
# Structure for table "sys_planes"
#

DROP TABLE IF EXISTS `sys_planes`;
CREATE TABLE `sys_planes` (
  `Id_planes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_plan` varchar(120) DEFAULT NULL,
  `precio_plan` decimal(10,2) DEFAULT '0.00',
  `descripcion_plan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_planes`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "sys_planes"
#

INSERT INTO `sys_planes` VALUES (1,'Junior',450.00,'prueba'),(2,'Fenix',0.00,NULL),(3,'Basico',0.00,NULL),(4,'Integral',0.00,NULL);

#
# Structure for table "sys_tipo_cobro"
#

DROP TABLE IF EXISTS `sys_tipo_cobro`;
CREATE TABLE `sys_tipo_cobro` (
  `Id_tipo_cobro` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_cobro` varchar(180) DEFAULT NULL,
  PRIMARY KEY (`Id_tipo_cobro`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "sys_tipo_cobro"
#

INSERT INTO `sys_tipo_cobro` VALUES (1,'efectivo'),(2,'debito'),(3,'cobrador'),(4,'base'),(5,'credito'),(6,'cheque');

#
# Structure for table "sys_tipo_doc"
#

DROP TABLE IF EXISTS `sys_tipo_doc`;
CREATE TABLE `sys_tipo_doc` (
  `id_tipo_doc` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "sys_tipo_doc"
#

INSERT INTO `sys_tipo_doc` VALUES (1,'Dni'),(2,'cuit'),(3,'LC.'),(4,'LE.'),(5,'Pasaporte');

#
# Structure for table "sys_afiliados"
#

DROP TABLE IF EXISTS `sys_afiliados`;
CREATE TABLE `sys_afiliados` (
  `id_afiliado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_afiliado` varchar(80) NOT NULL DEFAULT '',
  `apellido_afiliado` varchar(255) NOT NULL DEFAULT '',
  `rela_tipo_doc` int(11) DEFAULT NULL,
  `rela_planes` int(11) DEFAULT NULL,
  `numero_afiliado` int(1) NOT NULL DEFAULT '0',
  `fecha_nacimiento_afiliado` date NOT NULL DEFAULT '0000-00-00',
  `precio_plan` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion_afiliado` varchar(180) DEFAULT '',
  `observaciones_afiliado` varchar(255) DEFAULT NULL,
  `patologias_afiliado` varchar(255) DEFAULT '',
  `imagen_afiliado` varchar(255) DEFAULT NULL,
  `numero_documento_afiliado` int(1) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `rela_tipo_cobro` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `obrasocial_afiliado` varchar(180) DEFAULT NULL,
  `telefono_afiliado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_afiliado`),
  KEY `rela_tipo_doc` (`rela_tipo_doc`),
  KEY `rela_planes` (`rela_planes`),
  KEY `rela_tipo_cobro` (`rela_tipo_cobro`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `sys_afiliados_ibfk_1` FOREIGN KEY (`rela_tipo_doc`) REFERENCES `sys_tipo_doc` (`id_tipo_doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sys_afiliados_ibfk_2` FOREIGN KEY (`rela_planes`) REFERENCES `sys_planes` (`Id_planes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sys_afiliados_ibfk_3` FOREIGN KEY (`rela_tipo_cobro`) REFERENCES `sys_tipo_cobro` (`Id_tipo_cobro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sys_afiliados_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

#
# Data for table "sys_afiliados"
#

INSERT INTO `sys_afiliados` VALUES (1,'cristian','perez',1,1,3518,'2018-08-08',600.00,'yunka 189','obesrvacion','asd',NULL,27845698,'2018-08-08 22:08:16',1,1,'ospecon','0'),(12,'Bruno','Cantero',1,4,3519,'1996-09-18',1600.00,'juan manuel de rosas 25','lol','migraÃ±as',NULL,39721494,'2018-08-13 11:08:00',1,1,'osde','3704'),(14,'asdasd','asdasda',1,1,123,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(15,'asdasd','asdasda',1,1,234,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(16,'asdasd','asdasda',1,1,2345,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(17,'asdasd','asdasda',1,1,1,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(18,'asdasd','asdasda',1,1,12,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(19,'asdasd','asdasda',1,1,1234,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(20,'asdasd','asdasda',1,1,12345,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(21,'asdasd','asdasda',1,1,3345,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(22,'asdasd','asdasda',1,1,45,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(23,'asdasd','asdasda',1,1,5,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(24,'asdasd6','asdasda',1,1,7,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(25,'asdasd6','asdasda',1,1,76767,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(26,'asdasd6','asdasda',1,1,764564,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:36',1,1,'no tiene','54564654'),(35,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(36,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(37,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(38,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(39,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(40,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(41,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(42,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(43,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(44,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(45,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(46,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(47,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(48,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(49,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(50,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(51,'asdasd6','asdasda',1,1,2147483647,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(52,'asdasd6','asdasda',1,1,2,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(53,'asdasd6','asdasda',1,1,6575,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654'),(54,'asdasd6','asdasda',1,1,65758,'1996-12-18',455.00,'54564','546546','45456',NULL,123123132,'2018-08-25 21:08:37',1,1,'no tiene','54564654');

#
# Structure for table "sys_afiliados_adherentes"
#

DROP TABLE IF EXISTS `sys_afiliados_adherentes`;
CREATE TABLE `sys_afiliados_adherentes` (
  `id_afiliado_adherente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_adherente` varchar(180) DEFAULT NULL,
  `dni_adherente` decimal(11,0) DEFAULT NULL,
  `rela_afiliado` int(11) DEFAULT NULL,
  `fecha_nacimiento_adherente` date DEFAULT NULL,
  `sexo_adherente` tinyint(3) DEFAULT NULL,
  `patologias_adherente` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_afiliado_adherente`),
  KEY `rela_afiliado` (`rela_afiliado`),
  CONSTRAINT `sys_afiliados_adherentes_ibfk_1` FOREIGN KEY (`rela_afiliado`) REFERENCES `sys_afiliados` (`id_afiliado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "sys_afiliados_adherentes"
#

INSERT INTO `sys_afiliados_adherentes` VALUES (7,'juan pereira',12312312,12,'2018-09-03',1,'21312312'),(8,'asdasda',12312312,12,'2018-08-27',1,'asdadas');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `kind` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `rela_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rela_perfil` (`rela_perfil`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rela_perfil`) REFERENCES `sys_perfiles_permisos` (`id_perfiles`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'admin','Bruno Cantero','brunocantero01@gmail.com','90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad','bruno.jpg',1,1,'2017-07-15 12:05:45',1),(3,NULL,'Nicolas  Labarthe','NicoLabarthe@user.com','63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1','bruno.jpg',1,1,'2018-07-06 21:04:12',2),(4,NULL,'juan perez','brunocantero02@gmail.com','ceedf12f8fe3dc63d35b2567a59b93bd62ff729a','default.png',1,1,'2018-08-27 09:21:33',2);

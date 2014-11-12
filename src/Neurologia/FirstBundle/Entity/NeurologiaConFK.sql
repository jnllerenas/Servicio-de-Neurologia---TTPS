/*
SQLyog Ultimate v8.8 
MySQL - 5.6.12-log : Database - neurologiabd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`neurologiabd` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `neurologiabd`;

/*Table structure for table `antecedente` */

DROP TABLE IF EXISTS `antecedente`;

CREATE TABLE `antecedente` (
  `id_antecedente` int(11) NOT NULL AUTO_INCREMENT,
  `id_historia_clinica` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `id_tipo_antecedente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_antecedente`),
  KEY `id_historia_clinica` (`id_historia_clinica`),
  KEY `id_tipo_antecedente` (`id_tipo_antecedente`),
  CONSTRAINT `antecedente_ibfk_2` FOREIGN KEY (`id_tipo_antecedente`) REFERENCES `tipo_antecedente` (`id_tipo_antecedente`),
  CONSTRAINT `antecedente_ibfk_1` FOREIGN KEY (`id_historia_clinica`) REFERENCES `historia_clinica` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `antecedente` */

/*Table structure for table `categoria_diagnostico` */

DROP TABLE IF EXISTS `categoria_diagnostico`;

CREATE TABLE `categoria_diagnostico` (
  `id_categoria_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categoria_diagnostico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `categoria_diagnostico` */

/*Table structure for table `definitivo` */

DROP TABLE IF EXISTS `definitivo`;

CREATE TABLE `definitivo` (
  `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria_diagnostico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_diagnostico`),
  KEY `id_categoria_diagnostico` (`id_categoria_diagnostico`),
  CONSTRAINT `definitivo_ibfk_2` FOREIGN KEY (`id_diagnostico`) REFERENCES `diagnostico` (`id_diagnostico`),
  CONSTRAINT `definitivo_ibfk_1` FOREIGN KEY (`id_categoria_diagnostico`) REFERENCES `categoria_diagnostico` (`id_categoria_diagnostico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `definitivo` */

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `departamento` */

/*Table structure for table `diagnostico` */

DROP TABLE IF EXISTS `diagnostico`;

CREATE TABLE `diagnostico` (
  `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `id_evolucion` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_diagnostico`),
  KEY `id_evolucion` (`id_evolucion`),
  CONSTRAINT `diagnostico_ibfk_1` FOREIGN KEY (`id_evolucion`) REFERENCES `evolucion` (`id_evolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `diagnostico` */

/*Table structure for table `droga` */

DROP TABLE IF EXISTS `droga`;

CREATE TABLE `droga` (
  `id_droga` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_droga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `droga` */

/*Table structure for table `droga_tratamiento` */

DROP TABLE IF EXISTS `droga_tratamiento`;

CREATE TABLE `droga_tratamiento` (
  `id_interno` int(11) NOT NULL,
  `id_droga` int(11) NOT NULL,
  `id_efecto_adverso` int(11) NOT NULL,
  `dosis` varchar(255) NOT NULL,
  PRIMARY KEY (`id_interno`,`id_droga`,`id_efecto_adverso`,`dosis`),
  KEY `id_droga` (`id_droga`),
  KEY `id_efecto_adverso` (`id_efecto_adverso`),
  CONSTRAINT `droga_tratamiento_ibfk_3` FOREIGN KEY (`id_efecto_adverso`) REFERENCES `efecto_adverso` (`id_efecto_adverso`),
  CONSTRAINT `droga_tratamiento_ibfk_1` FOREIGN KEY (`id_droga`) REFERENCES `droga` (`id_droga`),
  CONSTRAINT `droga_tratamiento_ibfk_2` FOREIGN KEY (`id_interno`) REFERENCES `interno` (`id_tratamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `droga_tratamiento` */

/*Table structure for table `efecto_adverso` */

DROP TABLE IF EXISTS `efecto_adverso`;

CREATE TABLE `efecto_adverso` (
  `id_efecto_adverso` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_efecto_adverso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `efecto_adverso` */

/*Table structure for table `enfermedad_actual` */

DROP TABLE IF EXISTS `enfermedad_actual`;

CREATE TABLE `enfermedad_actual` (
  `id_enfermedad_actual` int(11) NOT NULL AUTO_INCREMENT,
  `id_historia_clinica` int(11) DEFAULT NULL,
  `detalle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_enfermedad_actual`),
  KEY `id_historia_clinica` (`id_historia_clinica`),
  CONSTRAINT `enfermedad_actual_ibfk_1` FOREIGN KEY (`id_historia_clinica`) REFERENCES `historia_clinica` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `enfermedad_actual` */

/*Table structure for table `estado_civil` */

DROP TABLE IF EXISTS `estado_civil`;

CREATE TABLE `estado_civil` (
  `id_estado_civil` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_estado_civil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `estado_civil` */

insert  into `estado_civil`(`id_estado_civil`,`descripcion`) values (1,'Soltero');

/*Table structure for table `estudio` */

DROP TABLE IF EXISTS `estudio`;

CREATE TABLE `estudio` (
  `id_estudio` int(11) NOT NULL AUTO_INCREMENT,
  `id_evolucion` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `institucion` varchar(255) DEFAULT NULL,
  `id_tipo_estudio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_estudio`),
  KEY `id_evolucion` (`id_evolucion`),
  KEY `id_tipo_estudio` (`id_tipo_estudio`),
  CONSTRAINT `estudio_ibfk_2` FOREIGN KEY (`id_tipo_estudio`) REFERENCES `tipo_estudio` (`id_tipo_estudio`),
  CONSTRAINT `estudio_ibfk_1` FOREIGN KEY (`id_evolucion`) REFERENCES `evolucion` (`id_evolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `estudio` */

/*Table structure for table `evolucion` */

DROP TABLE IF EXISTS `evolucion`;

CREATE TABLE `evolucion` (
  `id_evolucion` int(11) NOT NULL AUTO_INCREMENT,
  `id_historia_clinica` int(11) DEFAULT NULL,
  `evolucion` varchar(255) DEFAULT NULL,
  `fecha_hora_consulta` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evolucion`),
  KEY `id_historia_clinica` (`id_historia_clinica`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `evolucion_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_persona`),
  CONSTRAINT `evolucion_ibfk_1` FOREIGN KEY (`id_historia_clinica`) REFERENCES `historia_clinica` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `evolucion` */

/*Table structure for table `externo` */

DROP TABLE IF EXISTS `externo`;

CREATE TABLE `externo` (
  `id_tratamiento` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_tratamiento`),
  CONSTRAINT `externo_ibfk_1` FOREIGN KEY (`id_tratamiento`) REFERENCES `tratamiento` (`id_tratamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `externo` */

/*Table structure for table `historia_clinica` */

DROP TABLE IF EXISTS `historia_clinica`;

CREATE TABLE `historia_clinica` (
  `id_paciente` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_paciente`),
  CONSTRAINT `historia_clinica_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `historia_clinica` */

/*Table structure for table `imagen` */

DROP TABLE IF EXISTS `imagen`;

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `id_estudio` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_imagen`),
  KEY `id_estudio` (`id_estudio`),
  CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_estudio`) REFERENCES `estudio` (`id_estudio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `imagen` */

/*Table structure for table `interno` */

DROP TABLE IF EXISTS `interno`;

CREATE TABLE `interno` (
  `id_tratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_tratamiento`),
  CONSTRAINT `interno_ibfk_1` FOREIGN KEY (`id_tratamiento`) REFERENCES `tratamiento` (`id_tratamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `interno` */

/*Table structure for table `motivo` */

DROP TABLE IF EXISTS `motivo`;

CREATE TABLE `motivo` (
  `id_motivo` int(11) NOT NULL AUTO_INCREMENT,
  `id_historia_clinica` int(11) DEFAULT NULL,
  `detalle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_motivo`),
  KEY `id_historia_clinica` (`id_historia_clinica`),
  CONSTRAINT `motivo_ibfk_1` FOREIGN KEY (`id_historia_clinica`) REFERENCES `historia_clinica` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `motivo` */

/*Table structure for table `nivel_educacional` */

DROP TABLE IF EXISTS `nivel_educacional`;

CREATE TABLE `nivel_educacional` (
  `id_nivel_educacional` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_nivel_educacional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `nivel_educacional` */

/*Table structure for table `obra_social` */

DROP TABLE IF EXISTS `obra_social`;

CREATE TABLE `obra_social` (
  `id_obra_social` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_obra_social`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `obra_social` */

/*Table structure for table `paciente` */

DROP TABLE IF EXISTS `paciente`;

CREATE TABLE `paciente` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `id_nivel_educacional` int(11) DEFAULT NULL,
  `ocupacion` varchar(255) DEFAULT NULL,
  `otros` varchar(255) DEFAULT NULL,
  `id_obra_social` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `id_nivel_educacional` (`id_nivel_educacional`),
  KEY `id_obra_social` (`id_obra_social`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_departamento` (`id_departamento`),
  CONSTRAINT `paciente_ibfk_4` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`),
  CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`id_nivel_educacional`) REFERENCES `nivel_educacional` (`id_nivel_educacional`),
  CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`id_obra_social`) REFERENCES `obra_social` (`id_obra_social`),
  CONSTRAINT `paciente_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `paciente` */

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado_civil` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `numero_documento` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `id_sexo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `id_estado_civil` (`id_estado_civil`),
  KEY `id_tipo_documento` (`id_tipo_documento`),
  KEY `id_sexo` (`id_sexo`),
  CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`),
  CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`id_estado_civil`) REFERENCES `estado_civil` (`id_estado_civil`),
  CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `persona` */

insert  into `persona`(`id_persona`,`id_estado_civil`,`nombre`,`apellido`,`numero_documento`,`telefono`,`email`,`fecha_de_nacimiento`,`direccion`,`id_tipo_documento`,`id_sexo`) values (1,1,'Alberto','Mateico','12658968','4598798',NULL,'1988-12-12','564',1,1);

/*Table structure for table `presuntivo` */

DROP TABLE IF EXISTS `presuntivo`;

CREATE TABLE `presuntivo` (
  `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_diagnostico`),
  CONSTRAINT `presuntivo_ibfk_1` FOREIGN KEY (`id_diagnostico`) REFERENCES `diagnostico` (`id_diagnostico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `presuntivo` */

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `rol` */

insert  into `rol`(`id_rol`,`descripcion`) values (1,'Administrador');

/*Table structure for table `sexo` */

DROP TABLE IF EXISTS `sexo`;

CREATE TABLE `sexo` (
  `id_sexo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sexo` */

insert  into `sexo`(`id_sexo`,`descripcion`) values (1,'Masculino');

/*Table structure for table `tipo_antecedente` */

DROP TABLE IF EXISTS `tipo_antecedente`;

CREATE TABLE `tipo_antecedente` (
  `id_tipo_antecedente` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_antecedente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tipo_antecedente` */

/*Table structure for table `tipo_documento` */

DROP TABLE IF EXISTS `tipo_documento`;

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tipo_documento` */

insert  into `tipo_documento`(`id_tipo_documento`,`descripcion`) values (1,'DNI');

/*Table structure for table `tipo_estudio` */

DROP TABLE IF EXISTS `tipo_estudio`;

CREATE TABLE `tipo_estudio` (
  `id_tipo_estudio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `siglas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_estudio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tipo_estudio` */

/*Table structure for table `tratamiento` */

DROP TABLE IF EXISTS `tratamiento`;

CREATE TABLE `tratamiento` (
  `id_tratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_evolucion` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tratamiento`),
  KEY `id_evolucion` (`id_evolucion`),
  CONSTRAINT `tratamiento_ibfk_1` FOREIGN KEY (`id_evolucion`) REFERENCES `evolucion` (`id_evolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tratamiento` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `usuario` */

insert  into `usuario`(`id_persona`,`id_rol`,`username`,`password`,`habilitado`) values (1,1,'admin','admin',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

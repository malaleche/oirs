/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50511
Source Host           : localhost:3306
Source Database       : oirsdigital

Target Server Type    : MYSQL
Target Server Version : 50511
File Encoding         : 65001

Date: 2015-05-27 17:30:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alternativas
-- ----------------------------
DROP TABLE IF EXISTS `alternativas`;
CREATE TABLE `alternativas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `alternativa` varchar(45) DEFAULT NULL COMMENT 'Cuerpo de la alternativa',
  `pregunta_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la pregunta a la que pertenece la alternativa',
  PRIMARY KEY (`id`),
  KEY `fk_alternativas_preguntas1_idx` (`pregunta_id`),
  CONSTRAINT `fk_alternativas_preguntas1` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of alternativas
-- ----------------------------

-- ----------------------------
-- Table structure for anotaciones
-- ----------------------------
DROP TABLE IF EXISTS `anotaciones`;
CREATE TABLE `anotaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `titulo` varchar(45) DEFAULT NULL COMMENT 'Titulo representativo de la anotación',
  `cuerpo` text COMMENT 'Cuerpo de la anotación en donde se describe la solicitud en cuestión',
  `correo` varchar(100) DEFAULT NULL,
  `extension_plazo` int(11) DEFAULT NULL COMMENT 'Numero de dias que se extendera el plazo para responder la solicitud',
  `publica` tinyint(3) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL COMMENT 'Fecha de creación de la anotación',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea del usuario creador de la anotación',
  `tipo_ingreso_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea que indica cual fue el medio por el cual se realizo la solicitud',
  `tipo_anotacion_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea que indica el tipo de anotación',
  `tipo_plazo_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea que indica el plazo con que debe darce respuesta a la anotación',
  `estado_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea que muestra el estado en que se encuentra la anotación',
  `area_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea que indica el área o tema relacionado con la anotación',
  PRIMARY KEY (`id`),
  KEY `fk_anotaciones_users1_idx` (`user_id`),
  KEY `fk_anotaciones_tipos_ingresos1_idx` (`tipo_ingreso_id`),
  KEY `fk_anotaciones_tipos_anotaciones1_idx` (`tipo_anotacion_id`),
  KEY `fk_anotaciones_tipos_plazos1_idx` (`tipo_plazo_id`),
  KEY `fk_anotaciones_estados1_idx` (`estado_id`),
  KEY `fk_anotaciones_areas1_idx` (`area_id`),
  CONSTRAINT `anotaciones_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `anotaciones_ibfk_2` FOREIGN KEY (`tipo_ingreso_id`) REFERENCES `tipos_ingresos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `anotaciones_ibfk_3` FOREIGN KEY (`tipo_anotacion_id`) REFERENCES `tipos_anotaciones` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `anotaciones_ibfk_4` FOREIGN KEY (`tipo_plazo_id`) REFERENCES `tipos_plazos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `anotaciones_ibfk_5` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `anotaciones_ibfk_6` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of anotaciones
-- ----------------------------

-- ----------------------------
-- Table structure for anotaciones_unidades
-- ----------------------------
DROP TABLE IF EXISTS `anotaciones_unidades`;
CREATE TABLE `anotaciones_unidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `unidad_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la unidad municipal responsable de la anotación',
  `anotacion_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la anotación que debe encargarce la unidad municipal',
  PRIMARY KEY (`id`),
  KEY `fk_anotaciones_unidades_unidades1_idx` (`unidad_id`),
  KEY `fk_anotaciones_unidades_anotaciones1_idx` (`anotacion_id`),
  CONSTRAINT `anotaciones_unidades_ibfk_1` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `anotaciones_unidades_ibfk_2` FOREIGN KEY (`anotacion_id`) REFERENCES `anotaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of anotaciones_unidades
-- ----------------------------

-- ----------------------------
-- Table structure for areas
-- ----------------------------
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `area` varchar(45) DEFAULT NULL COMMENT 'Nombre del área o tema de la anotación',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of areas
-- ----------------------------

-- ----------------------------
-- Table structure for comentarios_internos
-- ----------------------------
DROP TABLE IF EXISTS `comentarios_internos`;
CREATE TABLE `comentarios_internos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `comentario` text COMMENT 'Cuerpo del comentario a la anotación',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de creación del comentario',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea al usuario creador del comentario',
  `anotacion_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la anotación que va dirijido el comentario',
  PRIMARY KEY (`id`),
  KEY `fk_comentarios_internos_users1_idx` (`user_id`),
  KEY `fk_comentarios_internos_anotaciones1_idx` (`anotacion_id`),
  CONSTRAINT `comentarios_internos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comentarios_internos_ibfk_2` FOREIGN KEY (`anotacion_id`) REFERENCES `anotaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comentarios_internos
-- ----------------------------

-- ----------------------------
-- Table structure for comunas
-- ----------------------------
DROP TABLE IF EXISTS `comunas`;
CREATE TABLE `comunas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `comuna` varchar(45) DEFAULT NULL COMMENT 'Nombre de la comuna',
  PRIMARY KEY (`id`),
  UNIQUE KEY `comuna` (`comuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comunas
-- ----------------------------

-- ----------------------------
-- Table structure for encuestas
-- ----------------------------
DROP TABLE IF EXISTS `encuestas`;
CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `encuesta` varchar(45) DEFAULT NULL COMMENT 'Titulo de la encuesta',
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of encuestas
-- ----------------------------

-- ----------------------------
-- Table structure for encuestas_users
-- ----------------------------
DROP TABLE IF EXISTS `encuestas_users`;
CREATE TABLE `encuestas_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de creación del registro',
  `encuesta_id` int(11) DEFAULT NULL COMMENT 'Clave foránea a la encuesta',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea al usuario que contesto la encuesta',
  `pregunta_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la pregunta contestada',
  `alternativa_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la alternativa seleccionada por el usuario',
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_encuestas_encuestas1_idx` (`encuesta_id`),
  KEY `fk_usuarios_encuestas_users1_idx` (`user_id`),
  KEY `fk_encuestas_usuarios_preguntas1_idx` (`pregunta_id`),
  KEY `fk_encuestas_usuarios_alternativas1_idx` (`alternativa_id`),
  CONSTRAINT `fk_encuestas_usuarios_alternativas1` FOREIGN KEY (`alternativa_id`) REFERENCES `alternativas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_encuestas_usuarios_preguntas1` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_encuestas_encuestas1` FOREIGN KEY (`encuesta_id`) REFERENCES `encuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_encuestas_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of encuestas_users
-- ----------------------------

-- ----------------------------
-- Table structure for estados
-- ----------------------------
DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `estado` varchar(45) DEFAULT NULL COMMENT 'Nombre del estado en que puede estar la anotación',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estados
-- ----------------------------
INSERT INTO `estados` VALUES ('1', 'Sin Asignar');
INSERT INTO `estados` VALUES ('2', 'Cerrado');
INSERT INTO `estados` VALUES ('3', 'Con Respuesta');
INSERT INTO `estados` VALUES ('4', 'En Proceso');
INSERT INTO `estados` VALUES ('5', 'Rechazado');
INSERT INTO `estados` VALUES ('6', 'Solicitud Reasignacion');
INSERT INTO `estados` VALUES ('7', 'Solicitud Tiempo Extendido');
INSERT INTO `estados` VALUES ('8', 'Pendiente');
INSERT INTO `estados` VALUES ('9', 'Solucion Pendiente');

-- ----------------------------
-- Table structure for perfiles
-- ----------------------------
DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE `perfiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `rut` varchar(45) DEFAULT NULL COMMENT 'Rut del usuario propietario del perfil',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del usuario',
  `telefono` varchar(45) DEFAULT NULL COMMENT 'Teléfono de contacto del usuario',
  `celular` varchar(45) DEFAULT NULL COMMENT 'Celular de contacto del usuario',
  `direccion` varchar(100) DEFAULT NULL COMMENT 'Dirección del usuario sin comuna',
  `sexo` varchar(45) DEFAULT NULL COMMENT 'Sexo del usuario (Masculino, Femenino)',
  `comuna_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la comuna donde reside el usuario',
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_comunas1_idx` (`comuna_id`),
  CONSTRAINT `perfiles_ibfk_1` FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of perfiles
-- ----------------------------

-- ----------------------------
-- Table structure for preguntas
-- ----------------------------
DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE `preguntas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `pregunta` varchar(100) DEFAULT NULL COMMENT 'Cuerpo de la pregunta',
  `encuesta_id` int(11) DEFAULT NULL COMMENT 'Clave foránea a la encuesta a la que pertenece la pregunta',
  PRIMARY KEY (`id`),
  KEY `fk_preguntas_encuestas1_idx` (`encuesta_id`),
  CONSTRAINT `fk_preguntas_encuestas1` FOREIGN KEY (`encuesta_id`) REFERENCES `encuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of preguntas
-- ----------------------------

-- ----------------------------
-- Table structure for respuestas
-- ----------------------------
DROP TABLE IF EXISTS `respuestas`;
CREATE TABLE `respuestas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `respuesta` text COMMENT 'Cuerpo de la respuesta a la anotación',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de creaciópn de la respuesta',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea al usuario creador de la respuesta',
  `anotacion_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la anotación que va dirijida la respuesta',
  PRIMARY KEY (`id`),
  KEY `fk_respuestas_users1_idx` (`user_id`),
  KEY `fk_respuestas_anotaciones1_idx` (`anotacion_id`),
  CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`anotacion_id`) REFERENCES `anotaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of respuestas
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre completo del rol',
  `rol` varchar(10) DEFAULT NULL COMMENT 'Nombre corto del rol',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rol` (`rol`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Administrador', 'admin');
INSERT INTO `roles` VALUES ('2', 'Usuario', 'user');
INSERT INTO `roles` VALUES ('3', 'Encargado OIRS', 'oirs');
INSERT INTO `roles` VALUES ('4', 'Unidad Municipal', 'unidad');

-- ----------------------------
-- Table structure for tipos_anotaciones
-- ----------------------------
DROP TABLE IF EXISTS `tipos_anotaciones`;
CREATE TABLE `tipos_anotaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `tipo` varchar(45) DEFAULT NULL COMMENT 'Nombre del tipo de anotación',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipos_anotaciones
-- ----------------------------
INSERT INTO `tipos_anotaciones` VALUES ('1', 'Solicitud de Informacion');
INSERT INTO `tipos_anotaciones` VALUES ('2', 'Presentacion de reclamos');
INSERT INTO `tipos_anotaciones` VALUES ('3', 'Presentacion de sugerencias');
INSERT INTO `tipos_anotaciones` VALUES ('4', 'Felicitaciones');
INSERT INTO `tipos_anotaciones` VALUES ('5', 'Solicitud o Peticion');
INSERT INTO `tipos_anotaciones` VALUES ('6', 'Envio de noticias');

-- ----------------------------
-- Table structure for tipos_ingresos
-- ----------------------------
DROP TABLE IF EXISTS `tipos_ingresos`;
CREATE TABLE `tipos_ingresos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `tipo` varchar(45) DEFAULT NULL COMMENT 'Nombre del tipo de ingreso',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipos_ingresos
-- ----------------------------
INSERT INTO `tipos_ingresos` VALUES ('1', 'Digital');
INSERT INTO `tipos_ingresos` VALUES ('2', 'Telefonico');
INSERT INTO `tipos_ingresos` VALUES ('3', 'Presencial');

-- ----------------------------
-- Table structure for tipos_plazos
-- ----------------------------
DROP TABLE IF EXISTS `tipos_plazos`;
CREATE TABLE `tipos_plazos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `tipo` varchar(45) DEFAULT NULL COMMENT 'Nombre del tipo de plazo',
  `dias` int(11) DEFAULT NULL COMMENT 'Numero de dias correspondiente al tipo de plazo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipos_plazos
-- ----------------------------
INSERT INTO `tipos_plazos` VALUES ('1', 'Normal', '10');
INSERT INTO `tipos_plazos` VALUES ('2', 'Urgente', '5');
INSERT INTO `tipos_plazos` VALUES ('3', 'Extendido', '0');

-- ----------------------------
-- Table structure for unidades
-- ----------------------------
DROP TABLE IF EXISTS `unidades`;
CREATE TABLE `unidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `unidad` varchar(50) DEFAULT NULL COMMENT 'Nombre de la unidad municipal',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unidad` (`unidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of unidades
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único',
  `username` varchar(50) DEFAULT NULL COMMENT 'Nombre de usuario',
  `password` varchar(50) DEFAULT NULL COMMENT 'Clave del usuario',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de creación del usuario',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de modificación del usuario',
  `rol_id` int(11) DEFAULT NULL COMMENT 'Clave foránea al rol designado al usuario',
  `perfil_id` int(10) unsigned DEFAULT NULL,
  `unidad_id` int(10) unsigned DEFAULT NULL COMMENT 'Clave foránea a la unidad a la que pertenece el usuario(unicamente si su rol es \\''unidad municipal\\'')',
  `correo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_users_roles1_idx` (`rol_id`),
  KEY `fk_users_unidades1_idx` (`unidad_id`),
  KEY `fk_users_perfiles1_idx` (`perfil_id`),
  CONSTRAINT `users_ibfk_4` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_6` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_7` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------

INSERT INTO `users` VALUES (1, 'admin', '907387e5e9aff8f7d40d8fb3d63685c3f8b0acd9', NULL, NULL, 1, NULL, NULL, NULL);

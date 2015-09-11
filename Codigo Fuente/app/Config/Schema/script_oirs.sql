SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `oirs` ;
CREATE SCHEMA IF NOT EXISTS `oirs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `oirs` ;

-- -----------------------------------------------------
-- Table `oirs`.`comunas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`comunas` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`comunas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `comuna` VARCHAR(45) NULL COMMENT 'Nombre de la comuna' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`perfiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`perfiles` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`perfiles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `rut` VARCHAR(45) NULL COMMENT 'Rut del usuario propietario del perfil' ,
  `nombre` VARCHAR(45) NULL COMMENT 'Nombre del usuario' ,
  `apellido` VARCHAR(45) NULL COMMENT 'Apellido del usuario' ,
  `telefono` VARCHAR(45) NULL COMMENT 'Teléfono de contacto del usuario' ,
  `celular` VARCHAR(45) NULL COMMENT 'Celular de contacto del usuario' ,
  `direccion` VARCHAR(100) NULL COMMENT 'Dirección del usuario sin comuna' ,
  `sexo` VARCHAR(45) NULL COMMENT 'Sexo del usuario (Masculino, Femenino)' ,
  `correo` VARCHAR(100) NULL COMMENT 'Email de contacto del usuario' ,
  `comuna_id` INT UNSIGNED NULL COMMENT 'Clave foránea a la comuna donde reside el usuario' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuarios_comunas1_idx` (`comuna_id` ASC) ,
  CONSTRAINT `fk_usuarios_comunas1`
    FOREIGN KEY (`comuna_id` )
    REFERENCES `oirs`.`comunas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`roles` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `nombre` VARCHAR(45) NULL COMMENT 'Nombre completo del rol' ,
  `rol` VARCHAR(10) NULL COMMENT 'Nombre corto del rol' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`unidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`unidades` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`unidades` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `unidad` VARCHAR(50) NULL COMMENT 'Nombre de la unidad municipal' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`users` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `username` VARCHAR(50) NULL COMMENT 'Nombre de usuario' ,
  `password` VARCHAR(50) NULL COMMENT 'Clave del usuario' ,
  `created` DATETIME NULL COMMENT 'Fecha de creación del usuario' ,
  `modified` DATETIME NULL COMMENT 'Fecha de modificación del usuario' ,
  `rol_id` INT NULL COMMENT 'Clave foránea al rol designado al usuario' ,
  `perfil_id` INT UNSIGNED NULL ,
  `unidad_id` INT UNSIGNED NULL COMMENT 'Clave foránea a la unidad a la que pertenece el usuario(unicamente si su rol es \\\'unidad municipal\\\')' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_roles1_idx` (`rol_id` ASC) ,
  INDEX `fk_users_unidades1_idx` (`unidad_id` ASC) ,
  INDEX `fk_users_perfiles1_idx` (`perfil_id` ASC) ,
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`rol_id` )
    REFERENCES `oirs`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_unidades1`
    FOREIGN KEY (`unidad_id` )
    REFERENCES `oirs`.`unidades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_perfiles1`
    FOREIGN KEY (`perfil_id` )
    REFERENCES `oirs`.`perfiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`tipos_ingresos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`tipos_ingresos` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`tipos_ingresos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `tipo` VARCHAR(45) NULL COMMENT 'Nombre del tipo de ingreso' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`tipos_anotaciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`tipos_anotaciones` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`tipos_anotaciones` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `tipo` VARCHAR(45) NULL COMMENT 'Nombre del tipo de anotación' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`tipos_plazos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`tipos_plazos` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`tipos_plazos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `tipo` VARCHAR(45) NULL COMMENT 'Nombre del tipo de plazo' ,
  `dias` INT NULL COMMENT 'Numero de dias correspondiente al tipo de plazo' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`estados` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`estados` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `estado` VARCHAR(45) NULL COMMENT 'Nombre del estado en que puede estar la anotación' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`areas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`areas` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`areas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `area` VARCHAR(45) NULL COMMENT 'Nombre del área o tema de la anotación' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`anotaciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`anotaciones` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`anotaciones` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `titulo` VARCHAR(45) NULL COMMENT 'Titulo representativo de la anotación' ,
  `cuerpo` TEXT NULL COMMENT 'Cuerpo de la anotación en donde se describe la solicitud en cuestión' ,
  `correo` VARCHAR(100) NULL ,
  `extension_plazo` INT NULL COMMENT 'Numero de dias que se extendera el plazo para responder la solicitud' ,
  `publica` TINYINT UNSIGNED NULL ,
  `created` DATETIME NULL COMMENT 'Fecha de creación de la anotación' ,
  `user_id` INT UNSIGNED NULL COMMENT 'Clave foránea del usuario creador de la anotación' ,
  `tipo_ingreso_id` INT UNSIGNED NULL COMMENT 'Clave foránea que indica cual fue el medio por el cual se realizo la solicitud' ,
  `tipo_anotacion_id` INT UNSIGNED NULL COMMENT 'Clave foránea que indica el tipo de anotación' ,
  `tipo_plazo_id` INT UNSIGNED NULL COMMENT 'Clave foránea que indica el plazo con que debe darce respuesta a la anotación' ,
  `estado_id` INT UNSIGNED NULL COMMENT 'Clave foránea que muestra el estado en que se encuentra la anotación' ,
  `area_id` INT UNSIGNED NULL COMMENT 'Clave foránea que indica el área o tema relacionado con la anotación' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_anotaciones_users1_idx` (`user_id` ASC) ,
  INDEX `fk_anotaciones_tipos_ingresos1_idx` (`tipo_ingreso_id` ASC) ,
  INDEX `fk_anotaciones_tipos_anotaciones1_idx` (`tipo_anotacion_id` ASC) ,
  INDEX `fk_anotaciones_tipos_plazos1_idx` (`tipo_plazo_id` ASC) ,
  INDEX `fk_anotaciones_estados1_idx` (`estado_id` ASC) ,
  INDEX `fk_anotaciones_areas1_idx` (`area_id` ASC) ,
  CONSTRAINT `fk_anotaciones_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `oirs`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotaciones_tipos_ingresos1`
    FOREIGN KEY (`tipo_ingreso_id` )
    REFERENCES `oirs`.`tipos_ingresos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotaciones_tipos_anotaciones1`
    FOREIGN KEY (`tipo_anotacion_id` )
    REFERENCES `oirs`.`tipos_anotaciones` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotaciones_tipos_plazos1`
    FOREIGN KEY (`tipo_plazo_id` )
    REFERENCES `oirs`.`tipos_plazos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotaciones_estados1`
    FOREIGN KEY (`estado_id` )
    REFERENCES `oirs`.`estados` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotaciones_areas1`
    FOREIGN KEY (`area_id` )
    REFERENCES `oirs`.`areas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`encuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`encuestas` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`encuestas` (
  `id` INT NOT NULL COMMENT 'Identificador único' ,
  `encuesta` VARCHAR(45) NULL COMMENT 'Titulo de la encuesta' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`preguntas` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`preguntas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `pregunta` VARCHAR(100) NULL COMMENT 'Cuerpo de la pregunta' ,
  `encuesta_id` INT NULL COMMENT 'Clave foránea a la encuesta a la que pertenece la pregunta' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_preguntas_encuestas1_idx` (`encuesta_id` ASC) ,
  CONSTRAINT `fk_preguntas_encuestas1`
    FOREIGN KEY (`encuesta_id` )
    REFERENCES `oirs`.`encuestas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`alternativas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`alternativas` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`alternativas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `alternativa` VARCHAR(45) NULL COMMENT 'Cuerpo de la alternativa' ,
  `pregunta_id` INT UNSIGNED NULL COMMENT 'Clave foránea a la pregunta a la que pertenece la alternativa' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_alternativas_preguntas1_idx` (`pregunta_id` ASC) ,
  CONSTRAINT `fk_alternativas_preguntas1`
    FOREIGN KEY (`pregunta_id` )
    REFERENCES `oirs`.`preguntas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`encuestas_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`encuestas_users` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`encuestas_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `created` DATETIME NULL COMMENT 'Fecha de creación del registro' ,
  `encuesta_id` INT NULL COMMENT 'Clave foránea a la encuesta' ,
  `user_id` INT UNSIGNED NULL COMMENT 'Clave foránea al usuario que contesto la encuesta' ,
  `pregunta_id` INT UNSIGNED NULL COMMENT 'Clave foránea a la pregunta contestada' ,
  `alternativa_id` INT UNSIGNED NULL COMMENT 'Clave foránea a la alternativa seleccionada por el usuario' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuarios_encuestas_encuestas1_idx` (`encuesta_id` ASC) ,
  INDEX `fk_usuarios_encuestas_users1_idx` (`user_id` ASC) ,
  INDEX `fk_encuestas_usuarios_preguntas1_idx` (`pregunta_id` ASC) ,
  INDEX `fk_encuestas_usuarios_alternativas1_idx` (`alternativa_id` ASC) ,
  CONSTRAINT `fk_usuarios_encuestas_encuestas1`
    FOREIGN KEY (`encuesta_id` )
    REFERENCES `oirs`.`encuestas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_encuestas_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `oirs`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_encuestas_usuarios_preguntas1`
    FOREIGN KEY (`pregunta_id` )
    REFERENCES `oirs`.`preguntas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_encuestas_usuarios_alternativas1`
    FOREIGN KEY (`alternativa_id` )
    REFERENCES `oirs`.`alternativas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`comentarios_internos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`comentarios_internos` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`comentarios_internos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `comentario` TEXT NULL COMMENT 'Cuerpo del comentario a la anotación' ,
  `created` DATETIME NULL COMMENT 'Fecha de creación del comentario' ,
  `user_id` INT UNSIGNED NULL COMMENT 'Clave foránea al usuario creador del comentario' ,
  `anotacion_id` INT UNSIGNED NULL COMMENT 'Clave foránea a la anotación que va dirijido el comentario' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_comentarios_internos_users1_idx` (`user_id` ASC) ,
  INDEX `fk_comentarios_internos_anotaciones1_idx` (`anotacion_id` ASC) ,
  CONSTRAINT `fk_comentarios_internos_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `oirs`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_internos_anotaciones1`
    FOREIGN KEY (`anotacion_id` )
    REFERENCES `oirs`.`anotaciones` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`respuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`respuestas` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`respuestas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `respuesta` TEXT NULL COMMENT 'Cuerpo de la respuesta a la anotación' ,
  `created` DATETIME NULL COMMENT 'Fecha de creación de la respuesta' ,
  `user_id` INT UNSIGNED NULL COMMENT 'Clave foránea al usuario creador de la respuesta' ,
  `anotacion_id` INT UNSIGNED NULL COMMENT 'Clave foránea a la anotación que va dirijida la respuesta' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_respuestas_users1_idx` (`user_id` ASC) ,
  INDEX `fk_respuestas_anotaciones1_idx` (`anotacion_id` ASC) ,
  CONSTRAINT `fk_respuestas_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `oirs`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_respuestas_anotaciones1`
    FOREIGN KEY (`anotacion_id` )
    REFERENCES `oirs`.`anotaciones` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oirs`.`anotaciones_unidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oirs`.`anotaciones_unidades` ;

CREATE  TABLE IF NOT EXISTS `oirs`.`anotaciones_unidades` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único' ,
  `unidad_id` INT UNSIGNED NULL COMMENT 'Clave foránea a la unidad municipal responsable de la anotación' ,
  `anotacion_id` INT UNSIGNED NULL COMMENT 'Clave forénea a la anotación que debe encargarce la unidad municipal' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_anotaciones_unidades_unidades1_idx` (`unidad_id` ASC) ,
  INDEX `fk_anotaciones_unidades_anotaciones1_idx` (`anotacion_id` ASC) ,
  CONSTRAINT `fk_anotaciones_unidades_unidades1`
    FOREIGN KEY (`unidad_id` )
    REFERENCES `oirs`.`unidades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotaciones_unidades_anotaciones1`
    FOREIGN KEY (`anotacion_id` )
    REFERENCES `oirs`.`anotaciones` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

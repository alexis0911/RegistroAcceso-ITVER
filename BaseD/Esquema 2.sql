-- MySQL Script generated by MySQL Workbench
-- Thu Nov  9 19:09:02 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `registro` ;

-- -----------------------------------------------------
-- Schema registro
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `registro` DEFAULT CHARACTER SET utf8mb3 ;
USE `registro` ;

-- -----------------------------------------------------
-- Table `registro`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `registro`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `registro`.`usuarios` (
  `idUsuario` INT NOT NULL,
  `nombreUsuario` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `accessLevel` INT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;

USE `registro` ;

-- -----------------------------------------------------
-- Table `registro`.`alumno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `registro`.`alumno` ;

CREATE TABLE IF NOT EXISTS `registro`.`alumno` (
  `idAlumno` INT NOT NULL AUTO_INCREMENT,
  `nControl` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `carrera` INT NULL DEFAULT NULL,
  `semestre` INT NULL DEFAULT NULL,
  `sexo` INT NULL DEFAULT NULL,
  PRIMARY KEY (`idAlumno`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `registro`.`ubicacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `registro`.`ubicacion` ;

CREATE TABLE IF NOT EXISTS `registro`.`ubicacion` (
  `idUbicacion` INT NOT NULL AUTO_INCREMENT,
  `nombreUbicacion` VARCHAR(45) NOT NULL,
  `pisos` INT NULL DEFAULT NULL,
  `descripcion` CHAR(80) NULL DEFAULT NULL,
  PRIMARY KEY (`idUbicacion`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `registro`.`salon`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `registro`.`salon` ;

CREATE TABLE IF NOT EXISTS `registro`.`salon` (
  `idSalon` INT NOT NULL AUTO_INCREMENT,
  `identificador` VARCHAR(45) NOT NULL,
  `piso` INT NULL DEFAULT NULL,
  `categoria` INT NULL DEFAULT NULL,
  `capacidadUso` INT NULL DEFAULT NULL,
  `climas` BINARY(1) NULL DEFAULT NULL,
  `horaApertura` TIME NULL DEFAULT NULL,
  `horaCierre` TIME NULL DEFAULT NULL,
  `Ubicacion_idUbicacion` INT NOT NULL,
  PRIMARY KEY (`idSalon`),
  INDEX `fk_Salon_Ubicacion1_idx` (`Ubicacion_idUbicacion` ASC) VISIBLE,
  CONSTRAINT `fk_Salon_Ubicacion1`
    FOREIGN KEY (`Ubicacion_idUbicacion`)
    REFERENCES `registro`.`ubicacion` (`idUbicacion`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `registro`.`uso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `registro`.`uso` ;

CREATE TABLE IF NOT EXISTS `registro`.`uso` (
  `idUso` INT NOT NULL AUTO_INCREMENT,
  `Alumno_idAlumno` INT NOT NULL,
  `Salon_idSalon` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  `dia` DATE NULL DEFAULT NULL,
  `horaEntrada` TIME NULL DEFAULT NULL,
  PRIMARY KEY (`idUso`),
  INDEX `fk_Uso_Alumno_idx` (`Alumno_idAlumno` ASC) VISIBLE,
  INDEX `fk_Uso_Salon1_idx` (`Salon_idSalon` ASC) VISIBLE,
  INDEX `fk_uso_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_Uso_Alumno`
    FOREIGN KEY (`Alumno_idAlumno`)
    REFERENCES `registro`.`alumno` (`idAlumno`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Uso_Salon1`
    FOREIGN KEY (`Salon_idSalon`)
    REFERENCES `registro`.`salon` (`idSalon`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_uso_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `registro`.`usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
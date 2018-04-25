-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema infosci
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema infosci
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `infosci` DEFAULT CHARACTER SET utf8 ;
USE `infosci` ;

-- -----------------------------------------------------
-- Table `infosci`.`contact`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infosci`.`contact` (
  `contact_id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `phone_number` INT NULL,
  `l_name` MEDIUMTEXT NOT NULL,
  `f_name` MEDIUMTEXT NOT NULL,
  `uid` INT(9) NULL,
  `spam_bool` TINYINT NOT NULL,
  `message` LONGTEXT NOT NULL,
  `datetime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contact_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

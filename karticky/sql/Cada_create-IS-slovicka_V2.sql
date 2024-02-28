-- MySQL Workbench Forward Engineering

/**
Change-Log:	Jakub Čada	30.11.2023 - created script
						3.12.2023 -	rename
                        4.12.2023 - rename
								  - opravení primary key
								  - sety datetime



*/

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


CREATE SCHEMA IF NOT EXISTS `karticky_DB` DEFAULT CHARACTER SET utf8 ;
USE `karticky_DB` ;

-- -----------------------------------------------------
-- Table `karticky_DB`.`uzivatele`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS uzivatele (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NOT NULL,
  `heslo` VARCHAR(50) NOT NULL,
  `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  `jmeno` VARCHAR(45) NULL,
  `prijmeni` VARCHAR(45) NULL,
  `telefon` INT(9) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `karticky_DB`.`sety`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS sety (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `nazev` VARCHAR(45) NOT NULL,
  `jazyk` VARCHAR(45) NOT NULL,
  `pozn` VARCHAR(999) NULL,
  `sdilene` ENUM("Ano", "Ne") NULL DEFAULT 'Ne',
  `uzivatele_id` INT NOT NULL,
  INDEX `fk_sety_uzivatele_idx` (`uzivatele_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_sety_uzivatele`
    FOREIGN KEY (`uzivatele_id`)
    REFERENCES `karticky_db`.`uzivatele` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

alter table sety
add vytvoreno datetime default NOW();

-- -----------------------------------------------------
-- Table `karticky_DB`.`slovicko`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS slovicko (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `slovicko` VARCHAR(45) NOT NULL,
  `definice` VARCHAR(45) NOT NULL,
  `sety_id` INT NOT NULL,
  `sety_uzivatele_id` INT NOT NULL,
  INDEX `fk_slovicko_sety1_idx` (`sety_id` ASC, `sety_uzivatele_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_slovicko_sety1`
    FOREIGN KEY (`sety_id`)
    REFERENCES `karticky_db`.`sety` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

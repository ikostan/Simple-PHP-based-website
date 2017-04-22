-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema channelwatchdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema channelwatchdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `channelwatchdb` DEFAULT CHARACTER SET utf8 ;
USE `channelwatchdb` ;

-- -----------------------------------------------------
-- Table `channelwatchdb`.`channeltbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `channelwatchdb`.`channeltbl` ;

CREATE TABLE IF NOT EXISTS `channelwatchdb`.`channeltbl` (
  `ch_id` INT(7) NOT NULL AUTO_INCREMENT,
  `ch_title` VARCHAR(50) NOT NULL,
  `ch_genere` ENUM('e', 'f', 'i', 'm', 'n', 'o', 's', 't') NOT NULL,
  `ch_price` DECIMAL(8,2) NOT NULL,
  `cha_logo` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`ch_id`))
ENGINE = MYISAM;


-- -----------------------------------------------------
-- Table `channelwatchdb`.`customertbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `channelwatchdb`.`customertbl` ;

CREATE TABLE IF NOT EXISTS `channelwatchdb`.`customertbl` (
  `cust_id` INT(5) NOT NULL AUTO_INCREMENT,
  `cust_fname` VARCHAR(20) NOT NULL,
  `cust_lname` VARCHAR(20) NOT NULL,
  `cust_email` VARCHAR(20) NOT NULL,
  `cust_passw` VARCHAR(7) NOT NULL,
  PRIMARY KEY (`cust_id`),
  UNIQUE INDEX `cust_id_UNIQUE` (`cust_id` ASC))
ENGINE = MYISAM;


-- -----------------------------------------------------
-- Table `channelwatchdb`.`ordertbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `channelwatchdb`.`ordertbl` ;

CREATE TABLE IF NOT EXISTS `channelwatchdb`.`ordertbl` (
  `ord_id` INT(5) NOT NULL,
  `ord_in_cart_ordered` ENUM('n', 'y') NOT NULL,
  `ord_price` DECIMAL(8,2) NOT NULL,
  `ord_cust_id` INT(5) NOT NULL,
  `ord_ch_id` INT(7) NOT NULL,
  PRIMARY KEY (`ord_id`),
  INDEX `fk_ordertbl_customertbl_idx` (`ord_cust_id` ASC),
  INDEX `fk_ordertbl_channeltbl1_idx` (`ord_ch_id` ASC),
  CONSTRAINT `fk_ordertbl_customertbl`
    FOREIGN KEY (`ord_cust_id`)
    REFERENCES `channelwatchdb`.`customertbl` (`cust_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ordertbl_channeltbl1`
    FOREIGN KEY (`ord_ch_id`)
    REFERENCES `channelwatchdb`.`channeltbl` (`ch_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MYISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

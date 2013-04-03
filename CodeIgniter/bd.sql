SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `suggest` DEFAULT CHARACTER SET utf8 ;
USE `suggest` ;

-- -----------------------------------------------------
-- Table `suggest`.`sg_gameartist`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_gameartist` (
  `gameartist_id` INT(11) NOT NULL ,
  `artist_name` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`gameartist_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_gamecategory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_gamecategory` (
  `gamecategory_id` INT(11) NOT NULL ,
  `category_name` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`gamecategory_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_gamedesigner`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_gamedesigner` (
  `gamedesigner_id` INT(11) NOT NULL ,
  `designer_name` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`gamedesigner_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_gamefamily`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_gamefamily` (
  `gamefamily_id` INT(11) NOT NULL ,
  `family_name` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`gamefamily_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_gamename`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_gamename` (
  `gamename_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `game_name` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`gamename_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_games`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_games` (
  `game_id` INT(11) NOT NULL ,
  `game_minplayers` VARCHAR(4) NOT NULL ,
  `game_maxplayers` VARCHAR(4) NOT NULL ,
  `game_duration` VARCHAR(20) NOT NULL ,
  `game_age` VARCHAR(4) NOT NULL ,
  `game_gamename_id` INT(11) NOT NULL ,
  `game_description` TEXT NOT NULL ,
  `game_thumbnail` VARCHAR(255) NOT NULL ,
  `game_image` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`game_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_games_gameartist`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_games_gameartist` (
  `game_id` INT(11) NOT NULL ,
  `gameartist_id` INT(11) NOT NULL ,
  PRIMARY KEY (`game_id`, `gameartist_id`) ,
  INDEX `gameartist_id_idx` (`gameartist_id` ASC) ,
  INDEX `game_id_idx` (`game_id` ASC) ,
  CONSTRAINT `game_id_sggga`
    FOREIGN KEY (`game_id` )
    REFERENCES `suggest`.`sg_games` (`game_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `gameartist_id_sggga`
    FOREIGN KEY (`gameartist_id` )
    REFERENCES `suggest`.`sg_gameartist` (`gameartist_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_games_gamecategory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_games_gamecategory` (
  `game_id` INT(11) NOT NULL ,
  `gamecategory_id` INT(11) NOT NULL ,
  PRIMARY KEY (`game_id`, `gamecategory_id`) ,
  INDEX `game_id_idx` (`game_id` ASC) ,
  INDEX `gamecategory_id_idx` (`gamecategory_id` ASC) ,
  CONSTRAINT `game_id_sgggc`
    FOREIGN KEY (`game_id` )
    REFERENCES `suggest`.`sg_games` (`game_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `gamecategory_id_sgggc`
    FOREIGN KEY (`gamecategory_id` )
    REFERENCES `suggest`.`sg_gamecategory` (`gamecategory_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_games_gamedesigner`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_games_gamedesigner` (
  `game_id` INT(11) NOT NULL ,
  `gamedesigner_id` INT(11) NOT NULL ,
  PRIMARY KEY (`game_id`, `gamedesigner_id`) ,
  INDEX `game_id_idx` (`game_id` ASC) ,
  INDEX `gamedesigner_id_idx` (`gamedesigner_id` ASC) ,
  CONSTRAINT `game_id_sgggd`
    FOREIGN KEY (`game_id` )
    REFERENCES `suggest`.`sg_games` (`game_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `gamedesigner_id_sgggd`
    FOREIGN KEY (`gamedesigner_id` )
    REFERENCES `suggest`.`sg_gamedesigner` (`gamedesigner_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_games_gameexpansion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_games_gameexpansion` (
  `game_id` INT(11) NOT NULL ,
  `gameexpansion_id` INT(11) NOT NULL ,
  PRIMARY KEY (`game_id`, `gameexpansion_id`) ,
  INDEX `game_id_sggge2` (`gameexpansion_id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_games_gamefamily`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_games_gamefamily` (
  `game_id` INT(11) NOT NULL ,
  `gamefamily_id` INT(11) NOT NULL ,
  PRIMARY KEY (`game_id`, `gamefamily_id`) ,
  INDEX `game_id_idx` (`game_id` ASC) ,
  INDEX `gamefamily_id_idx` (`gamefamily_id` ASC) ,
  CONSTRAINT `game_id_sgggf`
    FOREIGN KEY (`game_id` )
    REFERENCES `suggest`.`sg_games` (`game_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `gamefamily_id_sgggf`
    FOREIGN KEY (`gamefamily_id` )
    REFERENCES `suggest`.`sg_gamefamily` (`gamefamily_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `suggest`.`sg_games_gamename`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_games_gamename` (
  `game_id` INT NOT NULL ,
  `gamename_id` INT NOT NULL ,
  `gamename_priority` TINYINT(1) NULL ,
  PRIMARY KEY (`game_id`, `gamename_id`) ,
  INDEX `fk_sg_games_gamename_1` (`game_id` ASC) ,
  INDEX `fk_sg_games_gamename_2` (`gamename_id` ASC) ,
  CONSTRAINT `fk_sg_games_gamename_1`
    FOREIGN KEY (`game_id` )
    REFERENCES `suggest`.`sg_games` (`game_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_sg_games_gamename_2`
    FOREIGN KEY (`gamename_id` )
    REFERENCES `suggest`.`sg_gamename` (`gamename_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `suggest`.`sg_gameeditorial`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_gameeditorial` (
  `gameeditorial_id` INT NOT NULL ,
  `editorial_name` VARCHAR(150) NULL ,
  PRIMARY KEY (`gameeditorial_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `suggest`.`sg_games_gameeditorial`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `suggest`.`sg_games_gameeditorial` (
  `game_id` INT NOT NULL ,
  `gameeditorial_id` INT NOT NULL ,
  PRIMARY KEY (`game_id`, `gameeditorial_id`) ,
  INDEX `fk_sg_games_gameeditorial_1` (`game_id` ASC) ,
  INDEX `fk_sg_games_gameeditorial_2` (`gameeditorial_id` ASC) ,
  CONSTRAINT `fk_sg_games_gameeditorial_1`
    FOREIGN KEY (`game_id` )
    REFERENCES `suggest`.`sg_games` (`game_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_sg_games_gameeditorial_2`
    FOREIGN KEY (`gameeditorial_id` )
    REFERENCES `suggest`.`sg_gameeditorial` (`gameeditorial_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-04-2013 a las 17:16:45
-- Versión del servidor: 5.5.29
-- Versión de PHP: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `suggest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gameartist`
--

DROP TABLE IF EXISTS `sg_gameartist`;
CREATE TABLE IF NOT EXISTS `sg_gameartist` (
  `gameartist_id` int(11) NOT NULL,
  `artist_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gameartist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamecategory`
--

DROP TABLE IF EXISTS `sg_gamecategory`;
CREATE TABLE IF NOT EXISTS `sg_gamecategory` (
  `gamecategory_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamecategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamedesigner`
--

DROP TABLE IF EXISTS `sg_gamedesigner`;
CREATE TABLE IF NOT EXISTS `sg_gamedesigner` (
  `gamedesigner_id` int(11) NOT NULL,
  `designer_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamedesigner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gameeditorial`
--

DROP TABLE IF EXISTS `sg_gameeditorial`;
CREATE TABLE IF NOT EXISTS `sg_gameeditorial` (
  `gameeditorial_id` int(11) NOT NULL,
  `editorial_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`gameeditorial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamefamily`
--

DROP TABLE IF EXISTS `sg_gamefamily`;
CREATE TABLE IF NOT EXISTS `sg_gamefamily` (
  `gamefamily_id` int(11) NOT NULL,
  `family_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamefamily_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamelanguagedep`
--

DROP TABLE IF EXISTS `sg_gamelanguagedep`;
CREATE TABLE IF NOT EXISTS `sg_gamelanguagedep` (
  `gamelanguagedep_id` int(11) NOT NULL,
  `language_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`gamelanguagedep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamemechanic`
--

DROP TABLE IF EXISTS `sg_gamemechanic`;
CREATE TABLE IF NOT EXISTS `sg_gamemechanic` (
  `gamemechanic_id` int(11) NOT NULL,
  `mechanic_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`gamemechanic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamename`
--

DROP TABLE IF EXISTS `sg_gamename`;
CREATE TABLE IF NOT EXISTS `sg_gamename` (
  `gamename_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamename_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164916 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games`
--

DROP TABLE IF EXISTS `sg_games`;
CREATE TABLE IF NOT EXISTS `sg_games` (
  `game_id` int(11) NOT NULL,
  `game_minplayers` varchar(4) NOT NULL,
  `game_maxplayers` varchar(4) NOT NULL,
  `game_duration` varchar(20) NOT NULL,
  `game_age` varchar(4) NOT NULL,
  `game_description` text NOT NULL,
  `game_thumbnail` varchar(255) NOT NULL,
  `game_image` varchar(255) NOT NULL,
  `game_yearpub` varchar(5) NOT NULL,
  `game_totalRating` int(11) DEFAULT '0',
  `game_totalVotes` int(11) DEFAULT '0',
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gameartist`
--

DROP TABLE IF EXISTS `sg_games_gameartist`;
CREATE TABLE IF NOT EXISTS `sg_games_gameartist` (
  `game_id` int(11) NOT NULL,
  `gameartist_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gameartist_id`),
  KEY `gameartist_id_idx` (`gameartist_id`),
  KEY `game_id_idx` (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamecategory`
--

DROP TABLE IF EXISTS `sg_games_gamecategory`;
CREATE TABLE IF NOT EXISTS `sg_games_gamecategory` (
  `game_id` int(11) NOT NULL,
  `gamecategory_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamecategory_id`),
  KEY `game_id_idx` (`game_id`),
  KEY `gamecategory_id_idx` (`gamecategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamedesigner`
--

DROP TABLE IF EXISTS `sg_games_gamedesigner`;
CREATE TABLE IF NOT EXISTS `sg_games_gamedesigner` (
  `game_id` int(11) NOT NULL,
  `gamedesigner_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamedesigner_id`),
  KEY `game_id_idx` (`game_id`),
  KEY `gamedesigner_id_idx` (`gamedesigner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gameeditorial`
--

DROP TABLE IF EXISTS `sg_games_gameeditorial`;
CREATE TABLE IF NOT EXISTS `sg_games_gameeditorial` (
  `game_id` int(11) NOT NULL,
  `gameeditorial_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gameeditorial_id`),
  KEY `fk_sg_games_gameeditorial_1` (`game_id`),
  KEY `fk_sg_games_gameeditorial_2` (`gameeditorial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gameexpansion`
--

DROP TABLE IF EXISTS `sg_games_gameexpansion`;
CREATE TABLE IF NOT EXISTS `sg_games_gameexpansion` (
  `game_id` int(11) NOT NULL,
  `gameexpansion_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gameexpansion_id`),
  KEY `game_id_sggge2` (`gameexpansion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamefamily`
--

DROP TABLE IF EXISTS `sg_games_gamefamily`;
CREATE TABLE IF NOT EXISTS `sg_games_gamefamily` (
  `game_id` int(11) NOT NULL,
  `gamefamily_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamefamily_id`),
  KEY `game_id_idx` (`game_id`),
  KEY `gamefamily_id_idx` (`gamefamily_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamelanguagedep`
--

DROP TABLE IF EXISTS `sg_games_gamelanguagedep`;
CREATE TABLE IF NOT EXISTS `sg_games_gamelanguagedep` (
  `game_id` int(11) NOT NULL,
  `gamelanguagedep_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamelanguagedep_id`),
  KEY `fk_sg_games_gamelanguagedep_1` (`game_id`),
  KEY `fk_sg_games_gamelanguagedep_2` (`gamelanguagedep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamemechanic`
--

DROP TABLE IF EXISTS `sg_games_gamemechanic`;
CREATE TABLE IF NOT EXISTS `sg_games_gamemechanic` (
  `game_id` int(11) NOT NULL,
  `gamemechanic_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamemechanic_id`),
  KEY `fk_sg_games_gamemechanic_1` (`game_id`),
  KEY `fk_sg_games_gamemechanic_2` (`gamemechanic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamename`
--

DROP TABLE IF EXISTS `sg_games_gamename`;
CREATE TABLE IF NOT EXISTS `sg_games_gamename` (
  `game_id` int(11) NOT NULL,
  `gamename_id` int(11) NOT NULL,
  `gamename_priority` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`game_id`,`gamename_id`),
  KEY `fk_sg_games_gamename_1` (`game_id`),
  KEY `fk_sg_games_gamename_2` (`gamename_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_comments`
--

DROP TABLE IF EXISTS `si_comments`;
CREATE TABLE IF NOT EXISTS `si_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_title` varchar(100) DEFAULT NULL,
  `comment_text` text,
  `comment_type_id` int(11) DEFAULT NULL,
  `comment_votes` int(11) DEFAULT '0',
  `game_id` int(11) DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL,
  `usr_identifier` int(11) DEFAULT NULL,
  `comment_parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ucv_users_comments_votes`
--

DROP TABLE IF EXISTS `ucv_users_comments_votes`;
CREATE TABLE IF NOT EXISTS `ucv_users_comments_votes` (
  `usr_identifier` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  PRIMARY KEY (`usr_identifier`,`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_users`
--

DROP TABLE IF EXISTS `usr_users`;
CREATE TABLE IF NOT EXISTS `usr_users` (
  `usr_identifier` varchar(45) NOT NULL,
  `usr_profileURL` varchar(200) DEFAULT NULL,
  `usr_photoURL` varchar(200) DEFAULT NULL COMMENT '        ',
  `usr_name` varchar(150) DEFAULT NULL,
  `usr_email` varchar(75) DEFAULT NULL,
  `usr_provider` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usr_identifier`),
  KEY `PROVIDER_ID` (`usr_identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_users_games`
--

DROP TABLE IF EXISTS `usr_users_games`;
CREATE TABLE IF NOT EXISTS `usr_users_games` (
  `usr_identifier` varchar(45) NOT NULL COMMENT '        ',
  `game_id` int(11) NOT NULL,
  `game_rating` int(2) DEFAULT NULL,
  `game_timeplayed` int(11) DEFAULT NULL,
  PRIMARY KEY (`usr_identifier`,`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sg_games_gameartist`
--
ALTER TABLE `sg_games_gameartist`
  ADD CONSTRAINT `gameartist_id_sggga` FOREIGN KEY (`gameartist_id`) REFERENCES `sg_gameartist` (`gameartist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_id_sggga` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sg_games_gamecategory`
--
ALTER TABLE `sg_games_gamecategory`
  ADD CONSTRAINT `gamecategory_id_sgggc` FOREIGN KEY (`gamecategory_id`) REFERENCES `sg_gamecategory` (`gamecategory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_id_sgggc` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sg_games_gamedesigner`
--
ALTER TABLE `sg_games_gamedesigner`
  ADD CONSTRAINT `gamedesigner_id_sgggd` FOREIGN KEY (`gamedesigner_id`) REFERENCES `sg_gamedesigner` (`gamedesigner_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_id_sgggd` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sg_games_gameeditorial`
--
ALTER TABLE `sg_games_gameeditorial`
  ADD CONSTRAINT `fk_sg_games_gameeditorial_1` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sg_games_gameeditorial_2` FOREIGN KEY (`gameeditorial_id`) REFERENCES `sg_gameeditorial` (`gameeditorial_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sg_games_gamefamily`
--
ALTER TABLE `sg_games_gamefamily`
  ADD CONSTRAINT `gamefamily_id_sgggf` FOREIGN KEY (`gamefamily_id`) REFERENCES `sg_gamefamily` (`gamefamily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_id_sgggf` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sg_games_gamelanguagedep`
--
ALTER TABLE `sg_games_gamelanguagedep`
  ADD CONSTRAINT `fk_sg_games_gamelanguagedep_1` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sg_games_gamelanguagedep_2` FOREIGN KEY (`gamelanguagedep_id`) REFERENCES `sg_gamelanguagedep` (`gamelanguagedep_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sg_games_gamemechanic`
--
ALTER TABLE `sg_games_gamemechanic`
  ADD CONSTRAINT `fk_sg_games_gamemechanic_1` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sg_games_gamemechanic_2` FOREIGN KEY (`gamemechanic_id`) REFERENCES `sg_gamemechanic` (`gamemechanic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sg_games_gamename`
--
ALTER TABLE `sg_games_gamename`
  ADD CONSTRAINT `fk_sg_games_gamename_1` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sg_games_gamename_2` FOREIGN KEY (`gamename_id`) REFERENCES `sg_gamename` (`gamename_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

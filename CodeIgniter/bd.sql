-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-04-2013 a las 18:37:18
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

CREATE TABLE IF NOT EXISTS `sg_gameartist` (
  `gameartist_id` int(11) NOT NULL,
  `artist_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gameartist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamecategory`
--

CREATE TABLE IF NOT EXISTS `sg_gamecategory` (
  `gamecategory_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamecategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamedesigner`
--

CREATE TABLE IF NOT EXISTS `sg_gamedesigner` (
  `gamedesigner_id` int(11) NOT NULL,
  `designer_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamedesigner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamefamily`
--

CREATE TABLE IF NOT EXISTS `sg_gamefamily` (
  `gamefamily_id` int(11) NOT NULL,
  `family_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamefamily_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamename`
--

CREATE TABLE IF NOT EXISTS `sg_gamename` (
  `gamename_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `game_name` varchar(150) NOT NULL,
  `name_primary` tinyint(1) NOT NULL,
  PRIMARY KEY (`gamename_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games`
--

CREATE TABLE IF NOT EXISTS `sg_games` (
  `game_id` int(11) NOT NULL,
  `game_minplayers` varchar(4) NOT NULL,
  `game_maxplayers` varchar(4) NOT NULL,
  `game_duration` varchar(20) NOT NULL,
  `game_age` varchar(4) NOT NULL,
  `game_gamename_id` int(11) NOT NULL,
  `game_description` text NOT NULL,
  `game_thumbnail` varchar(255) NOT NULL,
  `game_image` varchar(255) NOT NULL,
  `game_gameexpansion_id` int(11) NOT NULL,
  `game_gamedesigner_id` int(11) NOT NULL,
  `game_gameartist_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gameartist`
--

CREATE TABLE IF NOT EXISTS `sg_games_gameartist` (
  `game_id` int(11) NOT NULL,
  `gameartists_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gameartists_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamecategory`
--

CREATE TABLE IF NOT EXISTS `sg_games_gamecategory` (
  `game_id` int(11) NOT NULL,
  `gamecategory_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamecategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamedesigner`
--

CREATE TABLE IF NOT EXISTS `sg_games_gamedesigner` (
  `game_id` int(11) NOT NULL,
  `gamedesigner_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamedesigner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gameexpansion`
--

CREATE TABLE IF NOT EXISTS `sg_games_gameexpansion` (
  `game_id` int(11) NOT NULL,
  `gameexpansion_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gameexpansion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamefamily`
--

CREATE TABLE IF NOT EXISTS `sg_games_gamefamily` (
  `game_id` int(11) NOT NULL,
  `gamefamily_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamefamily_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


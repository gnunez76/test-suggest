-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generaci√≥n: 03-04-2013 a las 00:13:49
-- Versi√≥n del servidor: 5.1.44
-- Versi√≥n de PHP: 5.3.1

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

--
-- Volcado de datos para la tabla `sg_gameartist`
--

INSERT INTO `sg_gameartist` (`gameartist_id`, `artist_name`) VALUES
(5, 'Jean du Po√´l'),
(10, 'Uwe Rosenberg'),
(17, 'Pascal Trigaux'),
(74, 'Doris Matth√§us'),
(233, 'Johann R√ºttinger'),
(280, 'Brian Snoddy'),
(308, 'Guido Hoffmann'),
(616, 'Phil Foglio'),
(1038, 'Larry Elmore'),
(4959, 'Harald Lieske'),
(5442, 'Jason Hawkins'),
(6815, 'John Kovalic'),
(11507, 'Klemens Franz'),
(11825, 'Michael Menzel'),
(11883, 'Franz Vohwinkel'),
(11901, 'Oliver Freudenreich'),
(12024, 'Bj√∂rn Pertoft'),
(12035, 'Andrea Boekhoff'),
(12036, 'Volkan Baga'),
(12038, 'Markus Wagner'),
(12063, 'Stephen Graham Walsh'),
(12102, 'Barbara Stachuletz'),
(12123, 'Alexander Jung'),
(12369, 'John Blanche'),
(12382, 'Tanja Donner'),
(12424, 'Bob Pepper'),
(12500, 'Peter Bergting'),
(12517, 'Marcus Gschwendtner'),
(12658, 'Scott Okumura'),
(13034, 'Pete Fenlon'),
(14508, 'Daniel Gelon'),
(15161, 'Lori Walls'),
(15492, 'Gerald Brom'),
(17547, 'Stefan Theurer'),
(18283, 'Ryan Kinnaird'),
(18317, 'Peter Whitley'),
(18431, 'Jennifer Lathrop'),
(20789, 'Allison Kline'),
(24191, 'Marion Pott'),
(24642, 'Atelier L√∂wentor'),
(25612, 'Matt Schwabel'),
(26874, 'Michaela Kienle'),
(27686, 'Chris Ferguson'),
(27879, 'Oliver Vogel'),
(28004, 'Fr√©deric Bertrand'),
(28512, 'Paul Sottosanti'),
(28513, 'Bob Carasca'),
(35234, 'Chris McGloughlin'),
(35334, 'Paul Render'),
(36624, 'S. Mattusek'),
(36807, 'Bryan King'),
(37332, 'L√ºders & Baran'),
(44242, 'Marek Blaha'),
(65041, 'Inge George');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamecategory`
--

CREATE TABLE IF NOT EXISTS `sg_gamecategory` (
  `gamecategory_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamecategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_gamecategory`
--

INSERT INTO `sg_gamecategory` (`gamecategory_id`, `category_name`) VALUES
(1001, 'Political'),
(1002, 'Card Game'),
(1008, 'Nautical'),
(1009, 'Abstract Strategy'),
(1010, 'Fantasy'),
(1013, 'Farming'),
(1015, 'Civilization'),
(1016, 'Science Fiction'),
(1017, 'Dice'),
(1020, 'Exploration'),
(1021, 'Economic'),
(1023, 'Bluffing'),
(1026, 'Negotiation'),
(1031, 'Racing'),
(1035, 'Medieval'),
(1037, 'Real-time'),
(1044, 'Collectible Components'),
(1046, 'Fighting'),
(1047, 'Miniatures'),
(1050, 'Ancient'),
(1082, 'Mythology'),
(1097, 'Travel'),
(1120, 'Print & Play');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamedesigner`
--

CREATE TABLE IF NOT EXISTS `sg_gamedesigner` (
  `gamedesigner_id` int(11) NOT NULL,
  `designer_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamedesigner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_gamedesigner`
--

INSERT INTO `sg_gamedesigner` (`gamedesigner_id`, `designer_name`) VALUES
(1, 'Karl-Heinz Schmiel'),
(2, 'Reiner Knizia'),
(4, 'Sid Sackson'),
(5, 'Jean du Po√´l'),
(6, 'Martin Wallace'),
(7, 'Wolfgang Kramer'),
(8, 'Richard Ulrich'),
(9, 'Alan R. Moon'),
(10, 'Uwe Rosenberg'),
(11, 'Klaus Teuber'),
(12, 'Reinhard Staupe'),
(13, 'Stefan Dorra'),
(14, 'Richard Garfield'),
(15, 'Gerard Delfanti'),
(17, 'Pascal Trigaux'),
(34, 'Bill Eberle'),
(35, 'Jack Kittredge'),
(36, 'Peter Olotka'),
(61, 'James Ernest'),
(684, 'G√©rard Mathieu'),
(1335, 'Robert P. Moore'),
(8008, 'Christian Beierer'),
(8384, 'G. W. \\"Jerry\\" D\\''Arcey'),
(10774, 'Bill Norton');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamefamily`
--

CREATE TABLE IF NOT EXISTS `sg_gamefamily` (
  `gamefamily_id` int(11) NOT NULL,
  `family_name` varchar(150) NOT NULL,
  PRIMARY KEY (`gamefamily_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_gamefamily`
--

INSERT INTO `sg_gamefamily` (`gamefamily_id`, `family_name`) VALUES
(3, 'Catan'),
(5, 'Bohnanza'),
(18, 'Lookout Bean Games'),
(42, 'Knizia tile-laying trilogy'),
(58, 'Alea Big Box'),
(91, 'Valley Games Classic Line'),
(133, 'Cosmic Encounter'),
(3867, 'Ra'),
(4891, '3M Bookshelf Series'),
(5607, '3D Games'),
(6428, 'Vampires'),
(6471, 'Country: Egypt'),
(6485, 'Mensa Select'),
(7005, 'Animals: Dragons'),
(9470, 'Asian Theme'),
(9959, 'El Grande'),
(10634, 'Country: Japan'),
(10643, 'Country: Germany'),
(11505, 'Promotional Board Games'),
(19299, 'Fairies, Elves and Pixies'),
(19450, 'Country: Morocco'),
(19451, 'Cities: Marrakech');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_gamename`
--

CREATE TABLE IF NOT EXISTS `sg_gamename` (
  `gamename_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `game_name` varchar(150) NOT NULL,
  `name_primary` tinyint(1) NOT NULL,
  PRIMARY KEY (`gamename_id`),
  KEY `game_id_idx` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=244 ;

--
-- Volcado de datos para la tabla `sg_gamename`
--

INSERT INTO `sg_gamename` (`gamename_id`, `game_id`, `game_name`, `name_primary`) VALUES
(111, 1, 'Die Macher', 1),
(112, 2, 'Dragonmaster', 1),
(113, 3, 'Samurai', 1),
(114, 3, 'Samuraj', 0),
(115, 3, '–°–∞–º—É—Ä–∞–π', 0),
(116, 3, '‰æç', 0),
(117, 4, 'Tal der K√∂nige', 1),
(118, 5, 'Acquire', 1),
(119, 5, 'Cartel', 0),
(120, 5, 'Grand H√¥tel', 0),
(121, 5, 'Hotel-Haie', 0),
(122, 5, 'Hotel-K√∂nig', 0),
(123, 5, 'Investor', 0),
(124, 5, 'Trust', 0),
(125, 6, 'Mare Mediterraneum', 1),
(126, 7, 'Castle City', 0),
(127, 7, 'Catedral', 0),
(128, 7, 'Cathedral', 1),
(129, 7, 'Cathedral - World', 0),
(130, 7, 'Kathedrale', 0),
(131, 7, 'Monumental Moves', 0),
(132, 8, 'Lords of Creation', 1),
(133, 9, 'El Caballero', 1),
(134, 9, 'Conquistador', 0),
(135, 10, 'Elfenland', 1),
(136, 1, 'Die Macher', 1),
(137, 2, 'Dragonmaster', 1),
(138, 3, 'Samurai', 1),
(139, 3, 'Samuraj', 0),
(140, 3, '–°–∞–º—É—Ä–∞–π', 0),
(141, 3, '‰æç', 0),
(142, 4, 'Tal der K√∂nige', 1),
(143, 5, 'Acquire', 1),
(144, 5, 'Cartel', 0),
(145, 5, 'Grand H√¥tel', 0),
(146, 5, 'Hotel-Haie', 0),
(147, 5, 'Hotel-K√∂nig', 0),
(148, 5, 'Investor', 0),
(149, 5, 'Trust', 0),
(150, 6, 'Mare Mediterraneum', 1),
(151, 7, 'Castle City', 0),
(152, 7, 'Catedral', 0),
(153, 7, 'Cathedral', 1),
(154, 7, 'Cathedral - World', 0),
(155, 7, 'Kathedrale', 0),
(156, 7, 'Monumental Moves', 0),
(157, 8, 'Lords of Creation', 1),
(158, 9, 'El Caballero', 1),
(159, 9, 'Conquistador', 0),
(160, 10, 'Elfenland', 1),
(161, 11, 'Babsz√ºret', 0),
(162, 11, 'Bohnanza', 1),
(163, 11, 'Bohnanza Pocket-Version', 0),
(164, 11, 'Bohnanza: Fan Edition', 0),
(165, 11, 'Bohnanza: Jubil√§umsedition', 0),
(166, 11, 'Bohnanza: Œ¶Œ±œÉŒøœçŒªŒØ œÑŒø Œ¶Œ±œÉŒøœçŒªŒπ', 0),
(167, 11, 'Bohnil√§um', 0),
(168, 11, 'Bonanza', 0),
(169, 11, 'Boonanza', 0),
(170, 11, 'Fasolki', 0),
(171, 11, 'Fazole', 0),
(172, 11, 'Semenza', 0),
(173, 11, '–ë–æ–Ω–∞–Ω–∑–∞', 0),
(174, 11, '„Éú„Éº„Éä„É≥„Ç∂', 0),
(175, 11, 'Á®ÆË±Ü', 0),
(176, 11, 'Î≥¥ÎÇúÏûê', 0),
(177, 12, 'Ra', 1),
(178, 12, 'Â§™ÈôΩÁ•û', 0),
(179, 12, 'ÌÉúÏñëÏã† Îùº', 0),
(180, 13, 'Catan', 0),
(181, 13, 'Catan Telepesei', 0),
(182, 13, 'Catan: Landnemarnir', 0),
(183, 13, 'Catane', 0),
(184, 13, 'Catanin Uudisasukkaat', 0),
(185, 13, 'I Coloni di Catan', 0),
(186, 13, 'I Coloni di Katan', 0),
(187, 13, 'Colonistii din Catan', 0),
(188, 13, 'Colonizadores de Catan', 0),
(189, 13, 'Los Colonos de Cat√°n', 0),
(190, 13, 'Les Colons de Catane', 0),
(191, 13, 'Les Colons de Katane', 0),
(192, 13, 'Os Descobridores de Catan', 0),
(193, 13, 'Los Descubridores de Cat√°n', 0),
(194, 13, 'Els Colons de Catan', 0),
(195, 13, 'Katan no Kaitakusya', 0),
(196, 13, 'Katanas iece√Øot√¢ji', 0),
(197, 13, 'Katanas IeceƒºotƒÅji', 0),
(198, 13, 'Katani Asustajad', 0),
(199, 13, 'Katano salos naujakuriai', 0),
(200, 13, 'Katano Salos Naujakuriai', 0),
(201, 13, 'De Kolonisten van Catan', 0),
(202, 13, 'Naseljenci otoka Catan', 0),
(203, 13, 'Osadn√≠ci z Katanu', 0),
(204, 13, 'Osadnicy z Catanu', 0),
(205, 13, 'The Settlers', 0),
(206, 13, 'Settlers fra Catan', 0),
(207, 13, 'The Settlers fra Catan', 0),
(208, 13, 'Settlers fr√•n Catan', 0),
(209, 13, 'The Settlers fr√•n Catan', 0),
(210, 13, 'The Settlers of Catan', 1),
(211, 13, 'Die Siedler von Catan', 0),
(212, 13, 'ŒüŒπ ŒÜœÄŒøŒπŒ∫ŒøŒπ œÑŒøœÖ ŒöŒ±œÑŒ¨ŒΩ', 0),
(213, 13, '–ó–∞—Å–µ–ª–Ω–∏—Ü–∏—Ç–µ –Ω–∞ –ö–∞—Ç–∞–Ω', 0),
(214, 13, '–ö–æ–ª–æ–Ω–∏–∑–∞—Ç–æ—Ä—ã', 0),
(215, 13, '◊î◊û◊™◊ô◊ô◊©◊ë◊ô◊ù ◊©◊ú ◊ß◊ò◊ê◊ü', 0),
(216, 13, '‡∏ô‡∏±‡∏Å‡∏ö‡∏∏‡∏Å‡πÄ‡∏ö‡∏¥‡∏Å‡πÅ‡∏´‡πà‡∏á Catan', 0),
(217, 13, '„Ç´„Çø„É≥„ÅÆÈñãÊãìËÄÖ', 0),
(218, 13, '„Ç´„Çø„É≥„ÅÆÈñãÊãìËÄÖ„Åü„Å°', 0),
(219, 13, 'Âç°Âù¶Â≤õ', 0),
(220, 13, 'Âç°Âù¶Â≥∂', 0),
(221, 13, 'Ïπ¥ÌÉÑ', 0),
(222, 13, 'Ïπ¥ÌÉÑÏùò Í∞úÏ≤ôÏûê', 0),
(223, 14, 'Basari', 1),
(224, 15, 'Contatos C√≥smicos', 0),
(225, 15, 'Contatos C√≥smicos', 0),
(226, 15, 'Cosmic Encounter', 1),
(227, 15, 'K√∂nig der Sterne', 0),
(228, 15, 'Rencontre cosmique', 0),
(229, 15, 'Universumin valtiaat', 0),
(230, 15, 'Universums h√§rskare', 0),
(231, 16, 'Marracash', 1),
(232, 17, 'Button Broccoli', 0),
(233, 17, 'Button Men', 1),
(234, 17, 'Button Men Freaks', 0),
(235, 17, 'Button Men Vampires', 0),
(236, 17, 'Button Men What\\''s New with Phil and Dixie', 0),
(237, 17, 'Buttonmen', 0),
(238, 18, 'Robo Rally', 0),
(239, 18, 'RoboRally', 1),
(240, 19, 'Drunter und Dr√ºber', 0),
(241, 19, 'Sans dessus dessous', 0),
(242, 19, 'Wacky Wacky West', 1),
(243, 20, 'Full Metal Planete', 1);

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
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_games`
--

INSERT INTO `sg_games` (`game_id`, `game_minplayers`, `game_maxplayers`, `game_duration`, `game_age`, `game_gamename_id`, `game_description`, `game_thumbnail`, `game_image`) VALUES
(1, '3', '5', '240', '14', 1, 'Die Macher is a game about seven sequential political races in different regions of Germany. Players are in charge of national political parties, and must manage limited resources to help their party to victory. The winning party will have the most victory points after all the regional elections. There are four different ways of scoring victory points. First, each regional election can supply one to eighty victory points, depending on the size of the region and how well your party does in it. Second, if a party wins a regional election and has some media influence in the region, then the party will receive some media-control victory points. Third, each party has a national party membership which will grow as the game progresses and this will supply a fair number of victory points. Lastly, parties score some victory points if their party platform matches the national opinions at the end of the game.<br/><br/>The 1986 edition featured 4 parties from the old West Germany and supported 3-4 players. The 1997 edition supports up to 5 players in the re-united Germany and updated several features of the rules as well.  The 2006 edition also supports up to 5 players and adds a shorter 5 round variant and additional rules updates by the original designer.<br/><br/>Die Macher is #1 in the Valley Games Classic Line<br/><br/>', '''pic159509_t.jpg''', '''pic159509.jpg'''),
(2, '3', '4', '30', '12', 1, 'Dragonmaster is a trick-taking card game based on an older game called Coup d\\''etat. Each player is given a supply of plastic gems, which represent points. Each player will get to be the dealer for five different hands, with slightly different goals for each hand. After all cards have been dealt out, the dealer decides which hand best suits his or her current cards, and the other players are penalized points (in the form of crystals) for taking certain tricks or cards. For instance, if &quot;first&quot; or &quot;last&quot; is called, then a player is penalized for taking the first or last tricks. All players will get a chance to be dealer for five hands, but other players can steal this opportunity by taking all of the tricks during certain hands. At the end, the biggest pile of gems wins the game<br/><br/>', '''pic184174_t.jpg''', '''pic184174.jpg'''),
(3, '2', '4', '45', '10', 1, 'Part of the Knizia tile-laying trilogy, this game is ostensibly set in medieval Japan.  Players use hexagonal tiles to surround cities, which have one to three different figures: rice paddies, Buddhas, or high hats.  The tiles represent influence on particular facets of the cities, and the highest influence on a figure when the city is surrounded takes that figure.  The object of the game is to have more of any one else in one category, and then have the most remaining figures.<br/><br/>', '''pic1352240_t.jpg''', '''pic1352240.jpg'''),
(4, '2', '4', '60', '12', 1, 'When you see the triangular box and the luxurious, large blocks, you can tell this game was designed to be beautiful as well as functional.  The object of the game is to build pyramids out of the different colored blocks.  A pyramid scores more points when it\\''s made from a few colors, but it\\''s much harder to consistently outbid the other players for the necessary blocks.  The game is over when the Pharoah\\''s Pyramid in the center is completed, which is built using all the blocks that the players don\\''t use during the course of the game.<br/><br/>Final round 1990 Hippodice Spieleautorenwettbewerb.<br/><br/>', '''pic285299_t.jpg''', '''pic285299.jpg'''),
(5, '3', '6', '90', '12', 1, 'This Sid Sackson classic has taken many different forms over the years depending on the publisher.  Each player strategically invests in businesses, trying to retain a majority of stock.  As the businesses grow with tile placements, they also start merging, giving the majority stockholders of the acquired business sizable bonuses, which can then be used to reinvest into other chains.  All of the investors in the acquired company can then cash in their stocks for current value or trade them 2-for-1 for shares of the newer, larger business.  The game is a race to acquire the greatest wealth.<br/><br/>Some versions of the 3M bookshelf edition included rules for a 2-player variant.<br/><br/>The original version is part of the 3M Bookshelf Series.<br/><br/>', '''pic342163_t.jpg''', '''pic342163.jpg'''),
(6, '2', '6', '240', '12', 1, 'In the ancient lands along the Mediterranean, players attempt to satisfy their unique victory conditions via trade, war and construction.  This lavishly produced game contains tons of wooden game components and a beautiful roll-out vinyl map.  Players produce a score of different commodities to trade with other cities in the hope of creating enough income to fill their capitals with buildings, produce artwork, and fill warehouses with goods.<br/><br/>', '''pic28424_t.jpg''', '''pic28424.jpg'''),
(7, '2', '2', '20', '8', 1, 'In Cathedral, each player has a set of pieces of a different color. The pieces are in the shapes of buildings, covering from one to five square units. The first player takes the single neutral Cathedral piece and places it onto the board. Players then alternate placing one of their buildings onto the board until neither player can place another building. Players capture territory by surrounding areas that are occupied by at most one opponent or neutral building. A captured piece is removed and captured territory becomes off-limits to the opponent. The player with the fewest \\''square units\\'' of buildings that can\\''t be placed wins.<br/><br/>', '''pic181642_t.jpg''', '''pic181642.jpg'''),
(8, '2', '5', '120', '12', 1, 'In this interesting offering from Warfrog, players become Gods seeking to dominate a world with their followers.  The first part of the game involves constructing the game board, after which players take turns using cards to determine how many new people should appear and what type of terrain they will inhabit.  All tribes start off as barbarians, but soon the calming effect of civilization settles the marauding bands; although civilized tribes score more, they can no longer attack.  What they can do, though, is civilize other players\\'' followers.  Sure it gives opponents more points, but at least those followers won\\''t come after you!<br/><br/>', '''pic374320_t.jpg''', '''pic374320.jpg'''),
(9, '2', '4', '90', '10', 1, 'Although called the sequel to El Grande, El Caballero shares very few aspects with its namesake.  This game is a fun but intense brain-burner in which players explore and attempt to control the lands and waterways of the New World.  \\''Exploration\\'' in El Caballero consists of picking and placing land tiles that are most favorable to you, and \\''control\\'' is attained by having the most caballeros camped on the edges of the resulting land masses.<br/><br/>', '''pic288615_t.jpg''', '''pic288615.jpg'''),
(10, '2', '6', '60', '10', 1, 'Elfenland is a redesign of the original White Wind game Elfenroads.  The game is set in the mythical world of the elves.  A group of fledgling elves (the players) are charged with visiting as many of the twenty Elfencities as they can over a short period of time.  To accomplish the task they will use various forms of transportation such as Pigs, Elfbikes, Magic Clouds, Trollwagons, and Dragons.<br/><br/>Re-implements:<br/><br/><br/>     Elfenroads<br/><br/><br/>Expanded by:<br/><br/><br/>     Elfengold<br/><br/><br/>', '''pic168036_t.jpg''', '''pic168036.jpg'''),
(11, '2', '7', '45', '13', 1, 'Bohnanza is the first in the Bohnanza family of games and has been published in several different editions.<br/><br/>As card games go, this one is quite revolutionary.  Perhaps its oddest feature is that you cannot rearrange your hand, as you need to play the cards in the order that you draw them.  The cards are colorful depictions of beans in various descriptive poses, and the object is to make coins by planting fields (sets) of these beans and then harvesting them.  To help players match their cards up, the game features extensive trading and deal making.<br/><br/>The original German edition supports 3-5 players.<br/><br/>The newest English version is from Rio Grande Games and it comes with the first edition of the first German expansion included in a slightly oversized box.  One difference in the contents, however, is that bean #22\\''s Weinbrandbohne (Brandy Bean) was replaced by the Wachsbohne, or Wax Bean.  This edition includes rules for up to seven players, like the Erweiterungs-Set, but also adapts the two-player rules of Al Cabohne in order to allow two people to play Bohnanza.<br/><br/>Note: As mentioned above, the Rio Grande Games edition supports more players than the Amigo release, and also sports two-player rules.  You should keep that in mind when perusing the ratings.<br/><br/>Expanded By:<br/><br/>     Mutabohn<br/>     Bohnanza Erweiterungs-Set<br/>     La Isla Bohnit√¢<br/>     High Bohn<br/>     Bohnanza Erweiterungs-Set (Revised Edition)<br/>     High Bohn: Bohnenduell um 12 Uhr mittags<br/>     Ladybohn<br/>     High Bohn Plus<br/>     Bohnaparte<br/>     Dschingis Bohn<br/>     Bohnanza Counters<br/>     Bohnanza: Amigo Bohnentaler<br/>     Bohnr√∂schen<br/>     Telebohn<br/>     Auf der schw√§b\\''schen Eisenbohn<br/>     Bohnanza: Spiderbeans<br/><br/><br/><br/><br/>Re-implemented by:<br/><br/>     Wendy Pferdebasar<br/>     Bohnanza Fun & Easy<br/><br/><br/><br/><br/>', '''pic69366_t.jpg''', '''pic69366.jpg'''),
(12, '2', '5', '60', '12', 1, 'Ra is an auction and set-collection game with an Ancient Egyptian theme.  Each turn players are able to purchase lots of tiles with their bidding tiles (suns).  Once a player has used up his or her suns, the other players continue until they do likewise, which may set up a situation with a single uncontested player bidding on tiles before the end of the round occurs.  Tension builds because the round may end before all players have had a chance to win their three lots for the epoch.  The various tiles either give immediate points, prevent negative points for not having certain types at the end of the round (epoch), or give points after the final round.  The game lasts for three &quot;epochs&quot; (rounds).  The game offers a short learning curve, and experienced players find it both fast-moving and a quick play.<br/><br/>From the Box:<br/>The game spans 1500 years of Egyptian history in less than an hour!<br/>The players seek to expand their power and fame and there are many ways to accomplish this: Influencing Pharaohs, Building monuments, Farming on the Nile, Paying homage to the Gods, Advancing the technology and culture of the people. Ra is an auction and set collecting game where players may choose to take risks for great rewards or... And all this is for the glory of the Sun God Ra!<br/><br/>', '''pic1603278_t.jpg''', '''pic1603278.jpg'''),
(13, '3', '4', '90', '10', 1, 'In Settlers of Catan, players try to be the dominant force on the island of Catan by building settlements, cities, and roads.  On each turn dice are rolled to determine what resources the island produces.  Players collect these resources to build up their civilizations to get to 10 victory points and win the game.  Multi-award-winning and one of the most popular games in recent history due to its amazing ability to appeal to non-gamers and gamers alike.<br/><br/>Die Siedler von Catan was originally published by Kosmos and has gone through multiple editions. It was licensed by Mayfair and has undergone at least 4 editions as Settlers of Catan. It has also been re-published in a travel edition by Kosmos and in yet another edition for Japan/Asia, Settlers of Catan: Rockman Edition.<br/><br/>Settlers of Catan is the original game in the Catan Series.<br/><br/>', '''pic268839_t.jpg''', '''pic268839.jpg'''),
(14, '3', '4', '25', '10', 1, 'Several games use the simultaneous action selection mechanism, but this is perhaps one of the best.<br/><br/>Basari is a game of gem merchants competing in a marketplace, racing, collecting, trading, and predicting what the other merchants will do.<br/><br/>To start the game, players receive 12 gemstones (3 each of 4 colors). <br/>Each turn there will be a movement phase and an action phase:<br/><br/>For movement, everyone simultaneously rolls their die and moves their markers around a track.<br/><br/>They then choose one of three different actions to perform. The actions are:<br/>- to take a variety of gems from a market stall, <br/>- to immediately score from between 4 and 7 points, or <br/>- to roll and move again and also collect points.<br/><br/>The action cards are revealed simultaneously. If only 1 player chose a particular action, they simply perform that action. If 2 players chose the same action, they barter back and forth with gemstones. One player will eventually accept the other\\''s offer of gems, and the other will take the action. If 3 or 4 players all chose the same action card, that action is cancelled. Note that in 4-player games, there will always be a conflict in choice of 3 actions, so much more negotiating goes on.<br/><br/>A new turn begins with everyone rolling their die, moving, then choosing and revealing their action cards. When any merchant piece completes a lap around the board, the round ends and bonus points are awarded based on who has the majority in each gem color and who has completed a lap. After three rounds, the game is over and the highest score wins.<br/><br/>Re-implemented by:<br/><br/><br/>     Edel, Stein & Reich<br/><br/><br/>', '''pic48605_t.jpg''', '''pic48605.jpg'''),
(15, '2', '6', '90', '12', 1, 'Highly regarded by many people, this game definitely deserves a place in the Gaming Hall of Fame, if only because it was so original for its time. By request of Fantasy Flight Games, Board Game Geek lists the various editions of Cosmic Encounter in separate entries. Each edition is the same game at its core, but the features, compatible expansions, and production differ among them. This entry is for the original 1977 Eon version.<br/><br/>Players represent alien races that are seeking to spread themselves onto five foreign worlds.  To accomplish this, they make challenges against other players and enlist the aid of interested parties.  But alien powers, which are unique to each race, give players ways to bend or outright break some rule in the game.<br/><br/>Expanded By:<br/><br/>     Cosmic Encounter: Expansion Set #1<br/>     Cosmic Encounter: Expansion Set #2<br/>     Cosmic Encounter: Expansion Set #3<br/>     Cosmic Encounter: Expansion Set #4<br/>     Cosmic Encounter: Expansion Set #5<br/>     Cosmic Encounter: Expansion Set #6<br/>     Cosmic Encounter: Expansion Set #7<br/>     Cosmic Encounter: Expansion Set #8<br/>     Cosmic Encounter: Expansion Set #9<br/>     Rencontre Cosmique Extension 1 (for Descartes Editeur\\''s French version)<br/><br/><br/><br/><br/>Re-Implemented by<br/><br/>     Mayfair\\''s Cosmic Encounter (1991)<br/>     Mayfair\\''s Simply Cosmic (1995)<br/>     Avalon Hill\\''s Cosmic Encounter (2000)<br/>     Fantasy Flight\\''s Cosmic Encounter (2008)<br/><br/><br/><br/><br/>', '''pic428608_t.jpg''', '''pic428608.jpg'''),
(16, '3', '4', '60', '12', 1, 'Taking on the roles of shop owners in the Moroccan marketplace, players buy various shops, as color-coded tourists in the form of neat little wooden people in hats start showing up at the entry gate. Players can then move them into their own like-colored shops to earn money or move them into opponents\\'' shops for a share of the profits. After all the tourists have been placed onto the board, the player with the biggest bankroll takes the victory. This game combines some great auction elements with spatial relationships for an appealing overall effect.<br/><br/>', '''pic573942_t.jpg''', '''pic573942.jpg'''),
(17, '2', '2', '5', '10', 1, 'This game gained a quick following after one of the major gaming conventions of 1999.  It features several characters, represented on actual stickpin buttons, that each have a unique allowance of polyhedral dice.  These dice endow each  character with fairly unique combat abilities.  Players roll the dice against each other and take their opponents\\'' dice as casualties.  The object of the game is take out the most die \\''sides\\'' during the combat.  It\\''s quite simple, quite inventive, and deeper than it would seem at first.<br/><br/>Dogfight was a precursor of Button Men.<br/><br/>', '''pic59279_t.jpg''', '''pic59279.jpg'''),
(18, '2', '8', '120', '12', 1, 'Imagine that you\\''re a supercomputer.  Now imagine that you\\''re bored.  So you dream up a little contest for you and a couple of your supercomputing buddies.  Your task is to move one of the stupid little robots out on the factory floor through a series of checkpoints scattered throughout the factory.  The wrinkle, however, is that the factory floor is filled with all kinds of inconvenient (if not down-right deadly) obstacles located in various locations: conveyor belts, crushers, flame-throwers, pushers, teleporters, oil slicks, pits, et cetera.  But the real fun comes when the robots cross each other\\''s path, and suddenly your perfect route is something less than that...<br/><br/>The game was reprinted by Avalon Hill (Hasbro/WotC) in 2005.<br/><br/>', '''pic249264_t.jpg''', '''pic249264.jpg'''),
(19, '2', '4', '60', '9', 1, 'A long time ago, in a village far, far away, some disturbed townsfolk decided to destroy their entire town in order to rid themselves of an evil menace (it\\''s technically a dog-mouse, but I think it\\''s an idiomatic thing).  Anyway, so the villagers rebuilt all the buildings in the town (including their precious outhouses), but forgot to include city walls, a river, or roads.  To rectify this, players lay tiles with one of these three things onto the board, and any building caught underneath them is automatically eliminated, except for outhouses.  When an outhouse would be destroyed, players take a vote on whether to place that particular section.  Each player is trying to retain the most of one type of building, and once all the pieces have been placed the winner is the person with the highest valued buildings still standing.<br/><br/>Wacky, Wacky West re-make description:<br/><br/>Fans of Klaus Teuber will be interested in this remake/redesign of Drunter und Dr&uuml;ber, a 1991 Spiel des Jahres winner.<br/><br/><br/>Just south of nowhere, there\\''s the junction of the Mayfair &amp; Rossdorf RR and the Turvy Trunk Line. Springing up from the desert like a tumbleweed lies the eccentric little town of Rossdorf. Like most western towns, Rossdorf has a Land Agent: Guy Dough, the brother of that wicked varmint Black Benny. A shrewd opportunist, Guy\\''s done sold all the town land (\\''ceptin\\'' the outhouses) four times over! Every acre in town that ain\\''t got an outhouse on it is owned by the miners, the railroads, AND the fort captain. Just about a year ago, miners digging in the shadow of Fort Rossdorf struck the mother lode! But it wasn\\''t gold, and it wasn\\''t silver. No, my friend, it was just a little spring. Not any ordinary spring, though! It was a torrent of that mind-marbling drink the locals call &quot;Wacky Water!&quot; <br/><br/><br/>Now that water\\''s done what the sun and the wind couldn\\''t do: it\\''s made those landholders brave enough to take matters into their own hands. Now they\\''ll use whatever means they can to bowl over the competition and lay claim to the only fertile spots left in town! Now the only thing stoppin\\'' \\''em is the Town Charter Amendment #5, which states: &quot;no landholder may move, remove, or detonate any outhouse without a majority vote of the Town Citizens...&quot; Now one thing\\''s for sure: something\\''s gonna stink in Rossdorf, purty darn soon.....<br/><br/><br/>In Wacky Wacky West you and your fellow townfolk place track tiles, street tiles, and river tiles hoping to destroy your rivals\\'' buildings. Every time someone tries to build over a precious outhouse, the town votes! You try to enlist your supporters (represented by cards) to vote with you to stop or encourage the play of certain tiles-perhaps saving some of your buildings or taking out those of your dastardly opponents.<br/><br/>', '''pic786075_t.jpg''', '''pic786075.jpg'''),
(20, '2', '4', '90', '12', 1, 'In this game of science fiction strip mining, players land on a planet and try and grab as much ore as possible and take off before the game is over.  Each player has tanks, boats, barges, mining equipment and a base ship at his disposal and will have to contend with the weather and the other miners.  The game uses an action point allowance system and thus is dice free.  Each player on his turn has a pool of points that he can divide in a variety of ways, putting all the points into one unit\\''s movement or dividing them among several units.  Each turn is timed so players have to think quickly, and once a move has been made it cannot be retracted.  The game itself is beautifully put together, with a detailed hex grid and real metal miniatures for all of the units.<br/><br/>Online Play: <br/><br/>    Full Metal Galaxy<br/>    Full Metal Program<br/>    VASSAL module<br/><br/><br/><br/><br/>Re-implemented by:<br/><br/>    Full Metal Conqu√™te (as a two-player version)<br/><br/><br/><br/><br/>Expanded by:<br/><br/>    Full Metal Planete: Plateau Modulaire.<br/><br/><br/><br/><br/>Microbadges:<br/> Buy It<br/><br/>', '''pic451783_t.jpg''', '''pic451783.jpg''');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gameartist`
--

CREATE TABLE IF NOT EXISTS `sg_games_gameartist` (
  `game_id` int(11) NOT NULL,
  `gameartist_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gameartist_id`),
  KEY `gameartist_id_idx` (`gameartist_id`),
  KEY `game_id_idx` (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_games_gameartist`
--

INSERT INTO `sg_games_gameartist` (`game_id`, `gameartist_id`) VALUES
(6, 5),
(11, 10),
(20, 17),
(9, 74),
(11, 233),
(17, 280),
(11, 308),
(17, 616),
(17, 1038),
(11, 4959),
(13, 5442),
(14, 6815),
(11, 11507),
(13, 11825),
(3, 11883),
(11, 11901),
(11, 12024),
(11, 12035),
(13, 12036),
(11, 12038),
(13, 12063),
(11, 12102),
(11, 12123),
(15, 12369),
(13, 12382),
(2, 12424),
(18, 12500),
(1, 12517),
(5, 12658),
(13, 13034),
(18, 14508),
(15, 15161),
(17, 15492),
(14, 17547),
(17, 18283),
(18, 18317),
(18, 18431),
(12, 20789),
(13, 24191),
(11, 24642),
(13, 25612),
(13, 26874),
(15, 27686),
(16, 27879),
(11, 28004),
(18, 28512),
(18, 28513),
(19, 35234),
(15, 35334),
(7, 36624),
(8, 36807),
(14, 37332),
(11, 44242),
(11, 65041);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamecategory`
--

CREATE TABLE IF NOT EXISTS `sg_games_gamecategory` (
  `game_id` int(11) NOT NULL,
  `gamecategory_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamecategory_id`),
  KEY `game_id_idx` (`game_id`),
  KEY `gamecategory_id_idx` (`gamecategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_games_gamecategory`
--

INSERT INTO `sg_games_gamecategory` (`game_id`, `gamecategory_id`) VALUES
(1, 1001),
(1, 1021),
(2, 1002),
(2, 1010),
(3, 1035),
(4, 1050),
(6, 1008),
(6, 1015),
(7, 1009),
(9, 1020),
(10, 1097),
(11, 1013),
(11, 1026),
(12, 1082),
(15, 1016),
(15, 1023),
(17, 1017),
(17, 1044),
(17, 1046),
(17, 1120),
(18, 1031),
(18, 1037),
(18, 1047);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamedesigner`
--

CREATE TABLE IF NOT EXISTS `sg_games_gamedesigner` (
  `game_id` int(11) NOT NULL,
  `gamedesigner_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamedesigner_id`),
  KEY `game_id_idx` (`game_id`),
  KEY `gamedesigner_id_idx` (`gamedesigner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_games_gamedesigner`
--

INSERT INTO `sg_games_gamedesigner` (`game_id`, `gamedesigner_id`) VALUES
(1, 1),
(2, 8384),
(3, 2),
(4, 8008),
(5, 4),
(6, 5),
(7, 1335),
(8, 6),
(9, 7),
(9, 8),
(10, 9),
(11, 10),
(13, 11),
(14, 12),
(15, 34),
(15, 35),
(15, 36),
(15, 10774),
(16, 13),
(17, 61),
(18, 14),
(20, 15),
(20, 17),
(20, 684);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gameexpansion`
--

CREATE TABLE IF NOT EXISTS `sg_games_gameexpansion` (
  `game_id` int(11) NOT NULL,
  `gameexpansion_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gameexpansion_id`),
  KEY `game_id_sggge2` (`gameexpansion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_games_gameexpansion`
--

INSERT INTO `sg_games_gameexpansion` (`game_id`, `gameexpansion_id`) VALUES
(10, 158),
(13, 306),
(13, 325),
(11, 453),
(11, 467),
(11, 913),
(13, 926),
(13, 1137),
(13, 1361),
(11, 1494),
(18, 1569),
(18, 1966),
(18, 1967),
(18, 1968),
(11, 2571),
(13, 2807),
(13, 4101),
(13, 4103),
(11, 4377),
(15, 4715),
(15, 4716),
(15, 4717),
(15, 4718),
(15, 4719),
(15, 4720),
(15, 4721),
(15, 4722),
(15, 4723),
(11, 6264),
(20, 6467),
(11, 8174),
(13, 10817),
(11, 12677),
(11, 13474),
(11, 14118),
(11, 18793),
(13, 19343),
(13, 20038),
(13, 20247),
(13, 21046),
(13, 21097),
(13, 21098),
(13, 21099),
(13, 21100),
(13, 21101),
(13, 21443),
(13, 22598),
(13, 26079),
(13, 26352),
(13, 27760),
(11, 31419),
(13, 31933),
(13, 32270),
(13, 34691),
(11, 35428),
(11, 35589),
(13, 37690),
(13, 37969),
(15, 38969),
(13, 39093),
(13, 41161),
(13, 42147),
(11, 43237),
(13, 54528),
(13, 56157),
(11, 59416),
(13, 60134),
(13, 73809),
(13, 84977),
(13, 86008),
(13, 86669),
(18, 88354),
(13, 89606),
(13, 90100),
(13, 91061),
(13, 95940),
(13, 101942),
(11, 103186),
(13, 104774),
(13, 110794),
(13, 111377),
(11, 111734),
(10, 122213),
(13, 128751),
(13, 131362),
(13, 131958),
(13, 132481),
(13, 134277),
(13, 135378),
(13, 138548);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sg_games_gamefamily`
--

CREATE TABLE IF NOT EXISTS `sg_games_gamefamily` (
  `game_id` int(11) NOT NULL,
  `gamefamily_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`gamefamily_id`),
  KEY `game_id_idx` (`game_id`),
  KEY `gamefamily_id_idx` (`gamefamily_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sg_games_gamefamily`
--

INSERT INTO `sg_games_gamefamily` (`game_id`, `gamefamily_id`) VALUES
(1, 91),
(1, 10643),
(2, 7005),
(3, 42),
(3, 9470),
(3, 10634),
(4, 6471),
(4, 11505),
(5, 4891),
(7, 5607),
(9, 9959),
(10, 19299),
(11, 5),
(11, 18),
(12, 58),
(12, 3867),
(13, 3),
(14, 6485),
(15, 133),
(16, 19450),
(16, 19451),
(17, 6428);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sg_gamename`
--
ALTER TABLE `sg_gamename`
  ADD CONSTRAINT `game_id_sggn` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sg_games_gameartist`
--
ALTER TABLE `sg_games_gameartist`
  ADD CONSTRAINT `game_id_sggga` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gameartist_id_sggga` FOREIGN KEY (`gameartist_id`) REFERENCES `sg_gameartist` (`gameartist_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sg_games_gamecategory`
--
ALTER TABLE `sg_games_gamecategory`
  ADD CONSTRAINT `game_id_sgggc` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gamecategory_id_sgggc` FOREIGN KEY (`gamecategory_id`) REFERENCES `sg_gamecategory` (`gamecategory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sg_games_gamedesigner`
--
ALTER TABLE `sg_games_gamedesigner`
  ADD CONSTRAINT `game_id_sgggd` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gamedesigner_id_sgggd` FOREIGN KEY (`gamedesigner_id`) REFERENCES `sg_gamedesigner` (`gamedesigner_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sg_games_gamefamily`
--
ALTER TABLE `sg_games_gamefamily`
  ADD CONSTRAINT `game_id_sgggf` FOREIGN KEY (`game_id`) REFERENCES `sg_games` (`game_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gamefamily_id_sgggf` FOREIGN KEY (`gamefamily_id`) REFERENCES `sg_gamefamily` (`gamefamily_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2013 at 10:22 PM
-- Server version: 5.1.68-cll
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `harvardy_p4`
--

-- --------------------------------------------------------

--
-- Table structure for table `gamerecord`
--

CREATE TABLE IF NOT EXISTS `gamerecord` (
  `user_game_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `guess_score` int(11) NOT NULL,
  `score_timecreated` int(11) NOT NULL,
  `guess_time` int(11) NOT NULL,
  `time_timecreated` int(11) NOT NULL,
  PRIMARY KEY (`user_game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gamerecord`
--

INSERT INTO `gamerecord` (`user_game_id`, `user_id`, `guess_score`, `score_timecreated`, `guess_time`, `time_timecreated`) VALUES
(1, 3, 75, 1387519384, 189, 1387518258),
(2, 4, 45, 1387513232, 0, 0),
(3, 1, 85, 1387516892, 66, 1387513185),
(4, 2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `created`, `modified`, `user_id`, `content`) VALUES
(1, 1387437745, 1387437745, 3, 'Hello, all!'),
(2, 1387512317, 1387512317, 4, 'Hello, guys!'),
(3, 1387513064, 1387513064, 1, 'Awesome! I have a new game record. It only takes 195 seconds to figure out the 5-digit number.'),
(4, 1387513236, 1387513236, 1, 'Awesome! I have a new game record. I got 75 in the number guess game.'),
(5, 1387518108, 1387518108, 3, 'Awesome! I have a new game record. I got 75 in the number guess game.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `token` varchar(225) CHARACTER SET utf8 NOT NULL,
  `password` varchar(225) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(225) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(225) CHARACTER SET utf8 NOT NULL,
  `email` varchar(225) CHARACTER SET utf8 NOT NULL,
  `image` varchar(225) CHARACTER SET utf8 NOT NULL,
  `chatroom` tinyint(1) NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `token`, `password`, `first_name`, `last_name`, `email`, `image`, `chatroom`, `modified`) VALUES
(1, 1387003518, 'a30ad7057a969fd44dc23ca40a648d4ec58064c3', '3d79ff75cda0241aa822c75ab60e921d8cd30ca6', 'aa', 'aa', 'zy_clerk@yahoo.com', 'placeholder.jpg', 0, 0),
(2, 1387003546, '933ffa68b7793e5792327bfc0012d462291dd9fb', '3d79ff75cda0241aa822c75ab60e921d8cd30ca6', 'bb', 'bb', 'zyclerk85@gmail.com', 'placeholder.jpg', 0, 0),
(3, 1387437380, '711d4a83a99dac145fa2ae102709685c9af1380c', '3d79ff75cda0241aa822c75ab60e921d8cd30ca6', 'Yan', 'Zhang', 'yanzhang01@g.harvard.edu', '3.JPG', 0, 1387439353),
(4, 1387512259, 'ce3bd62fa92fe9a8f7ba62b7ac8940a3e06aaf73', '3d79ff75cda0241aa822c75ab60e921d8cd30ca6', 'Yen', 'Yen', 'hawkyan13@gmail.com', '4.jpg', 0, 1387512292);

-- --------------------------------------------------------

--
-- Table structure for table `users_users`
--

CREATE TABLE IF NOT EXISTS `users_users` (
  `user_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_id_followed` int(11) NOT NULL,
  PRIMARY KEY (`user_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users_users`
--

INSERT INTO `users_users` (`user_user_id`, `created`, `user_id`, `user_id_followed`) VALUES
(1, 1387003518, 1, 1),
(2, 1387003546, 2, 2),
(3, 1387437380, 3, 3),
(4, 1387437549, 3, 1),
(5, 1387512259, 4, 4),
(6, 1387512326, 4, 2),
(8, 1387512448, 1, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

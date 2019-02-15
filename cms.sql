-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 06. led 2019, 21:57
-- Verze serveru: 10.1.35-MariaDB
-- Verze PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `cms`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(1) NOT NULL,
  `cat_title` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'JavaScript'),
(2, 'PHP'),
(3, 'CSS3'),
(4, 'C#'),
(5, 'Bootstrap');

-- --------------------------------------------------------

--
-- Struktura tabulky `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_tags` varchar(255) CHARACTER SET latin1 NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'draft',
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `post_author` varchar(255) CHARACTER SET latin1 NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text CHARACTER SET latin1 NOT NULL,
  `post_content` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `posts`
--

INSERT INTO `posts` (`post_id`, `post_tags`, `post_comment_count`, `post_status`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`) VALUES
(1, 'vitek, javasript, php', 0, 'draft', 1, 'Testing CMS First', 'Vít Pergler', '2019-01-03', 'img1.png', 'Lorem ispum sit dolor amet random picoviny nevim, co sem mam psat.'),
(2, 'david, tomas, linda', 0, 'draft', 1, 'Testing CMS Second', 'Vít Pergler', '2019-01-03', '', 'Lorem ispum sisadasdt dolor ameasdast rasdasd asdas das dsad asdas dsa jhjksadh k ahjfh jkasdhj ndsfjk nms dabhsdjk jjdsfh fjjsjs jfjjfj fjjfjsjfadbj sanndsnsd djjjf jfjs bjbsajd sadjbsda andom asdasdpiasdasdcoviny nevim, co sem mam psat.');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Klíče pro tabulku `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Czas generowania: 30 Gru 2019, 20:39
-- Wersja serwera: 5.7.26
-- Wersja PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep_studia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `cart`
--

INSERT INTO `cart` (`id`, `token`, `user_id`) VALUES
(8, 'y4V2U2ZraZI3OiRLlBs8QILk6w6KOqiQs84yNYZ4mdNcO2nTeS', 3),
(9, 'hxJR4D4PFMCGckHiKRfTaM5QFYQoH1ZPKawRHMQJau05trabwl', 3),
(10, 'DebWrhsYo8GJIduudjoplZlYOzyVdx3RNsPSVEZ0mbZRj7YJJm', 3),
(11, '88bmkW9DGhtmghH5mzLL7P847u1sVCvEZMiHZXynWQYhSq2gMs', 3),
(12, 'Jx4QgZQc2BQDWTTjfpGljGAAAuVA06vkIfiqSGWXFNEOQqwNZ0', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart_products`
--

CREATE TABLE `cart_products` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `cart_products`
--

INSERT INTO `cart_products` (`id`, `cart_id`, `product_id`, `price`, `count`) VALUES
(16, 8, 2, 100, 2),
(17, 8, 3, 99.99, 3),
(18, 9, 2, 100, 6),
(19, 10, 4, 999, 2),
(20, 11, 2, 100, 1),
(21, 12, 2, NULL, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(190) DEFAULT NULL,
  `code_name` varchar(190) DEFAULT NULL,
  `description` text NOT NULL,
  `added_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `name`, `code_name`, `description`, `added_date`) VALUES
(2, 'Pierwszy', 'pierwszy', 'fasda', '2019-12-24 15:34:07'),
(3, 'Drugi ', 'drugi-', 'dasdas', '2019-12-24 15:34:11'),
(4, 'Trzecie', 'trzecie', 'fasd', '2019-12-24 15:34:15'),
(5, 'Czwarty', 'czwarty', 'fasd', '2019-12-24 15:34:19'),
(6, 'Piatyg', 'piatyg', 'asdas', '2019-12-24 15:34:24');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news_comments`
--

CREATE TABLE `news_comments` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `added_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `news_comments`
--

INSERT INTO `news_comments` (`id`, `news_id`, `user_id`, `comment`, `added_date`) VALUES
(2, 2, 3, 'afsdas', '2019-12-28 13:49:00'),
(3, 2, 3, 'fasdasdas', '2019-12-28 13:55:35');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `address` varchar(190) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `delivery_type` int(11) DEFAULT NULL,
  `added_date` datetime DEFAULT NULL,
  `sum` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `cart_id`, `user_id`, `status`, `first_name`, `last_name`, `address`, `city`, `post_code`, `delivery_type`, `added_date`, `sum`) VALUES
(9, 8, 3, 20, 'a', 'b', 'c', 'd', 'e', 1, '2019-12-30 18:11:35', 515.97),
(10, 9, 3, 10, 'a', 'b', 'c', 'd', 'e', 2, '2019-12-30 18:11:56', 610),
(11, 10, 3, 20, 'a', 'b', 'c', 'd', 'e', 3, '2019-12-30 18:12:58', 1998),
(12, 11, 3, 30, 'a', 'b', 'c', 'd', 'e', 1, '2019-12-30 18:19:50', 116);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(190) NOT NULL,
  `code_name` varchar(190) DEFAULT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `code_name`, `price`, `description`, `image`, `deleted`) VALUES
(1, 'fasd1', NULL, 2132, 'dasfasd3', '', 1),
(2, 'Produkt pierwszy', 'produkt-pierwszy', 100, 'asfasd', '1577195038_product.jpg', 0),
(3, 'produkt drugi', 'produkt-drugi', 99.99, 'dasdfasd', '1577195209_product.jpg', 0),
(4, 'produkt trzeci', 'produkt-trzeci', 999, 'gasdasdas', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(3, 'bartoszp90@gmail.com', '$2y$10$2qm7hVQ0B6qVVn8xKoN6juofXGXpyBMxp8EtOjljyqrqOao2jrTSW', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `token` (`token`);

--
-- Indeksy dla tabeli `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `count` (`count`),
  ADD KEY `price` (`price`);

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`name`),
  ADD KEY `added_date` (`added_date`),
  ADD KEY `code_name` (`code_name`);

--
-- Indeksy dla tabeli `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `added_date` (`added_date`),
  ADD KEY `news_id` (`news_id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `status` (`status`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `address` (`address`),
  ADD KEY `city` (`city`),
  ADD KEY `post_code` (`post_code`),
  ADD KEY `delivery_type` (`delivery_type`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `added_date` (`added_date`),
  ADD KEY `sum` (`sum`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `price` (`price`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `code_name` (`code_name`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `password` (`password`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

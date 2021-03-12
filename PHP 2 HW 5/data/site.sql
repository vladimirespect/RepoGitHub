-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 10 2021 г., 10:19
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `session_id` text NOT NULL,
  `goods_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `session_id`, `goods_id`) VALUES
(46, 'ch8niidpi0ccb20e37h7c09f0efs3ip4', 2),
(47, 'ch8niidpi0ccb20e37h7c09f0efs3ip4', 2),
(48, 'ch8niidpi0ccb20e37h7c09f0efs3ip4', 3),
(49, 'ch8niidpi0ccb20e37h7c09f0efs3ip4', 1),
(50, 'ch8niidpi0ccb20e37h7c09f0efs3ip4', 2),
(51, 'q6hgpd5nvngfc41h0e58vrrbdr5pe9fs', 2),
(52, 'q6hgpd5nvngfc41h0e58vrrbdr5pe9fs', 3),
(53, 'q6hgpd5nvngfc41h0e58vrrbdr5pe9fs', 1),
(54, 'q6hgpd5nvngfc41h0e58vrrbdr5pe9fs', 2),
(55, 'q6hgpd5nvngfc41h0e58vrrbdr5pe9fs', 1),
(56, 'q6hgpd5nvngfc41h0e58vrrbdr5pe9fs', 1),
(57, 'q6hgpd5nvngfc41h0e58vrrbdr5pe9fs', 1),
(66, 'lf5polq4nfoshi30u01uisdkjui1b6p5', 1),
(67, 'lf5polq4nfoshi30u01uisdkjui1b6p5', 2),
(68, 'lf5polq4nfoshi30u01uisdkjui1b6p5', 3),
(71, 'a6necdhvmotkk7gifgubbqvkmv9c0ad7', 2),
(72, 'a6necdhvmotkk7gifgubbqvkmv9c0ad7', 2),
(73, 'hkpq6kgr38aaudk615i933cslefpaapl', 2),
(74, 'hkpq6kgr38aaudk615i933cslefpaapl', 3),
(76, 'hkpq6kgr38aaudk615i933cslefpaapl', 1),
(79, '91u2unshofnkvej31nq9lt4qulo6oi0d', 1),
(89, '7', 8),
(90, '70', 80),
(91, '75', 550),
(92, '75', 550),
(93, '75', 550),
(94, '55', 555),
(95, '5885', 55885);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `feedback` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`) VALUES
(18, 'Здравствуй', 'Здравствуйте'),
(19, 'Студент', 'Доброго времени суток!'),
(25, 'php', 'hi');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `likes` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `likes`) VALUES
(1, '01.jpg', 1),
(2, '02.jpg', 11),
(3, '03.jpg', 1),
(4, '04.jpg', 2),
(5, '05.jpg', 3),
(6, '06.jpg', 5),
(7, '07.jpg', 1),
(8, '08.jpg', 3),
(9, '09.jpg', 0),
(10, '10.jpg', 2),
(11, '11.jpg', 1),
(12, '12.jpg', 1),
(13, '13.jpg', 2),
(14, '14.jpg', 0),
(15, '15.jpg', 13),
(19, 'IMG_3464-11-08-19-07-04.JPG', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `price` int NOT NULL DEFAULT '0',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `image`, `price`, `description`) VALUES
(1, 'Виски Dewar\'s 12 years old, 0.5 л', '1.jpg', 2050, 'Фильтрация:\r\nХолодная фильтрация<br>\r\nВыдержка:\r\n12 лет<br>\r\nТип бочки:\r\nДубовые бочки\r\n'),
(2, 'Виски Dewar\'s Caribbean Smooth 8 years, gift box, 0,7', '2.jpg', 1851, 'Фильтрация:\r\nХолодная фильтрация<br>\r\nВыдержка:\r\n8 лет<br>\r\nТип бочки:\r\nДубовые бочки\r\n'),
(3, 'Виски Dewar\'s White Label, gift box, 1 л', '3.jpg', 2666, 'Страна:\r\nШотландия<br>\r\n \r\nПроизводитель:\r\nJohn Dewar and Sons<br>\r\n \r\nБренд:\r\nDewar\'s<br>\r\n\r\nФильтрация:\r\nХолодная фильтрация<br>\r\nТип бочки:\r\nДубовые бочки\r\n'),
(4, 'самогон', '4.jpg', 120, 'хороший'),
(5, 'кофе', '5.jpg', 120, 'хороший');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `session_id` text NOT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `session_id`, `status`) VALUES
(2, 'Vladimir', '8-985-265-97-90', 'hkpq6kgr38aaudk615i933cslefpaapl', 0),
(3, 'Alex', '89852659790', 'hkpq6kgr38aaudk615i933cslefpaapl', 0),
(4, 'Alex', '+79852659790', 'hkpq6kgr38aaudk615i933cslefpaapl', 0),
(5, 'weee', '+7 (987) 831-38-20', '91u2unshofnkvej31nq9lt4qulo6oi0d', 0),
(6, 'weee2', '+7 (916) 105-18-22', '1mll8tld02qvoli8d5rd5l4pmaaqemj1', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `hash`) VALUES
(1, 'admin', '123', '10065291606030a51171a164.75698763');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

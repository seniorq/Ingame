-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 06 2023 г., 17:30
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `towar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Дамп данных таблицы `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `towar_id`) VALUES
(0, 'watch dogs', '10.00', 9873),
(0, 'watch dogs', '10.00', 9874),
(0, 'CALL OF DUTY', '10.00', 9877),
(0, 'CS GO', '10.00', 9878),
(0, 'CALL OF DUTY', '10.00', 9879),
(0, 'ARK', '10.00', 9880),
(0, 'watch dogs', '10.00', 9881),
(0, 'Dark Souls III', '10.00', 9882);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `user_id`, `is_admin`) VALUES
(2, 'qsadasd', 'sadfzf', '111@111', '$2y$10$Fk3zs5vmUtGEi/qsWUb3Uuc8lUJzZxx/qoF2HcE2B9UDYqD1biBeS', 0, 0),
(3, 'Zurab', 'Dorsigov', 'ggbet@gmail.com', '$2y$10$e4nkiUDvyX1V08yrSe3uN.cKm9eDoHYSlQ2NaYU4Rl97TK4QlMPeq', 0, 0),
(4, 'shshs', 'hshshsh', 'zzz@zzz', '$2y$10$6PfHaKf4zGgyRemc7fqJWujzo6dCaGnppp02rjnAbchlS.JmH4Evu', 0, 0),
(5, 'admin', 'admin', 'admin@gmail.com', 'haslo', 0, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`towar_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `produkty`
--
ALTER TABLE `produkty`
  MODIFY `towar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9885;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

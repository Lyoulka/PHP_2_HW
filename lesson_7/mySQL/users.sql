-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 15 2019 г., 16:20
-- Версия сервера: 5.6.41
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `geekbrains`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_login` varchar(50) NOT NULL,
  `user_hash_password` text NOT NULL,
  `admin` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_login`, `user_hash_password`, `admin`) VALUES
(1, 'Илья', 'wind', '$2y$10$W7ug5esA46YZ/xHnL6Tecu9TM/i2azas4IBgWtrqkCigmpkALZl.C', 0),
(2, 'Маша', 'Masha', '$2a$08$Y2U5NGYzODA4MjczNDBiO.VtPnQJ2q6paK10bo2k8o2zod6n4y3Oi', 0),
(3, 'Александр', 'Alex', '$2a$08$YjM4OGFjYTJiY2NhNDc1ZeKfZ/bemsnmk0tphO6BmCXJYbzh81opS', 0),
(4, 'Tan', 'tan', '$2a$08$OGJhN2ZlYmZjNzc5MTc0N.YKDX1DsfvZh0DsatXVth8Kst63YNZkS', 0),
(5, 'Оля', 'olya', '$2a$08$Y2ZjMjc1MGZhMzJhNGNhM.BreuBUplZGkqHqPG6W1KZCwBtieXsTO', 0),
(6, 'Аня', 'anna', '$2a$08$YjRkZGYzNjM1N2FjNzMwM.qE2URQ4vIm55CuyWEe7MtKA7FcUwOz6', 0),
(7, 'Katya', 'Kate', '$2a$08$MWM4YzI3MjMyNzgzZDE0YuPozmsvM3sM9Plq3MHqLOiBcshF/IQVq', 0),
(11, 'admin', 'admin', '$2a$08$OGU3N2JiODA0ZGY2OTBjYuYFwnT0Qb8.HeEKhfQ8bP7Ys8zN1Ylmi', 1),
(12, 'Женя', 'genya', '$2a$08$NGY2NjZjMDVlN2ZjNWEyNe56c3iaMTQI0wbrcED1MqzXrysDKIvBG', 0),
(13, 'Глаша', 'Glasha', '$2a$08$ZjkwMmYzYzFkNzcwMzFkMOSLepmwubIcTEYUg139.SaQQ/S3.yNGG', 0),
(14, 'Новенький', 'NewOne', '$2a$08$MjlkMzk1NTQ4NDAwMTliYOL/Hh9YO6FFgEJUmJYUewecq3SA6AfkS', 0),
(15, 'Наташа', 'Nata', '$2a$08$ZWRkYjU0M2YwNWE1OGU3NujxK9e2md2SrNm4oTPhA0q.DbijvANrK', 0),
(16, 'Ксения', 'Ksy', '$2a$08$ZDQ2YTZjMGY3YzdiNzBlYOsURw3m6LxeF.3LPaMTaC2BffC8B/xzC', 0),
(17, 'Татьяна', 'Tany', '$2a$08$MTcwYjM4YzFlMDgzM2NkMOldLCko4iLt6EPcxhRz6VFE9v3YkVIpq', 0),
(18, 'Sasha', 'Sasha', '$2a$08$MTkwOTcyYjg5ZTVlZTRiNu.m2TLZ41A.kXy.oVsazbCZv8ONOQ8eO', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_login` (`user_login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 18 2019 г., 17:29
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
-- Структура таблицы `temp_orders`
--

CREATE TABLE `temp_orders` (
  `id` int(10) NOT NULL,
  `goods_id` int(10) NOT NULL,
  `goods_img` varchar(11) NOT NULL,
  `goods_name` text NOT NULL,
  `goods_price` int(100) NOT NULL,
  `numbers` int(10) NOT NULL,
  `user_login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `temp_orders`
--

INSERT INTO `temp_orders` (`id`, `goods_id`, `goods_img`, `goods_name`, `goods_price`, `numbers`, `user_login`) VALUES
(63, 10, '10.png', 'Марио супергерой', 646, 2, 'wind'),
(72, 2, '2.png', 'Яйцо дракона', 500, 2, 'wind'),
(73, 3, '3.png', 'Марио и Луиджи', 1500, 2, 'wind'),
(77, 1, '1.png', 'Марио и дракон', 1000, 1, 'Masha'),
(78, 2, '2.png', 'Яйцо дракона', 500, 1, 'Masha'),
(79, 3, '3.png', 'Марио и Луиджи', 1500, 2, 'Masha'),
(80, 4, '4.png', 'Марио', 750, 1, 'Masha'),
(81, 7, '7.png', 'Семья драконов', 3000, 1, 'wind');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `temp_orders`
--
ALTER TABLE `temp_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `temp_orders`
--
ALTER TABLE `temp_orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

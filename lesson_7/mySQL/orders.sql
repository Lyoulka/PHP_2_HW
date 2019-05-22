-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 22 2019 г., 12:44
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
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_login` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_surname` varchar(100) NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_adress` text NOT NULL,
  `goods_id` int(11) NOT NULL,
  `goods_name` text NOT NULL,
  `numbers` int(11) NOT NULL,
  `goods_price` int(11) NOT NULL,
  `order_status` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_login`, `user_name`, `user_surname`, `user_city`, `user_adress`, `goods_id`, `goods_name`, `numbers`, `goods_price`, `order_status`, `date`) VALUES
(45, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 1, 'Марио и дракон', 2, 1000, 'Доставляется', '2019-02-03 00:00:00'),
(46, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 2, 'Яйцо дракона', 2, 500, 'Доставляется', '2019-02-03 00:00:00'),
(47, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 3, 'Марио', 2, 1500, 'Доставляется', '2019-02-03 00:00:00'),
(48, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 4, 'Марио', 1, 750, 'Доставляется', '2019-02-03 00:00:00'),
(51, 2, 'Masha', 'Мария', 'Марина', 'Маркс', 'ул. К.Маркса, д. 2, кв. 2', 1, 'Марио и дракон', 1, 1000, 'В обработке', '2019-03-12 00:00:00'),
(52, 2, 'Masha', 'Мария', 'Марина', 'Маркс', 'ул. К.Маркса, д. 2, кв. 2', 3, 'Марио', 1, 1500, 'В обработке', '2019-03-12 00:00:00'),
(53, 2, 'Masha', 'Мария', 'Марина', 'Маркс', 'ул. К.Маркса, д. 2, кв. 2', 4, 'Марио', 1, 750, 'В обработке', '2019-03-12 00:00:00'),
(74, 11, 'admin', 'Admin', 'Admin', 'Central Office', 'Central Office', 1, 'Марио и дракон', 10, 1000, 'Ожидает подтверждения', '2019-04-22 00:00:00'),
(75, 11, 'admin', 'Admin', 'Admin', 'Central Office', 'Central Office', 3, 'Марио', 10, 1500, 'Ожидает подтверждения', '2019-04-22 00:00:00'),
(80, 13, 'Glasha', 'Глаша', 'Сидорова', 'Тюмень', 'ул. Мичурина, д. 8', 1, 'Марио и дракон', 3, 1000, 'Ожидает подтверждения', '2019-05-01 15:20:00'),
(81, 13, 'Glasha', 'Глаша', 'Сидорова', 'Тюмень', 'ул. Мичурина, д. 8', 7, 'Семья драконов', 3, 3000, 'Ожидает подтверждения', '2019-05-01 15:20:00'),
(82, 13, 'Glasha', 'Глаша', 'Сидорова', 'Тюмень', 'ул. Мичурина, д. 8', 5, 'Марио и дракон', 3, 1250, 'Ожидает подтверждения', '2019-05-01 15:20:00'),
(88, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 6, 'Дракон', 1, 1250, 'TEST', '2019-05-21 13:58:10'),
(89, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 7, 'Семья драконов', 1, 3000, 'TEST', '2019-05-21 13:58:10'),
(90, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 10, 'Марио супергерой', 1, 646, 'TEST', '2019-05-21 13:58:10'),
(91, 20, 'Liza', 'Елизавета ', 'Сидорова', 'Санкт-Петербург ', 'ул. Сиреневая, д. 125, кв. 8', 14, 'Марио', 6, 1100, 'В обработке', '2019-05-21 19:25:01'),
(92, 36, 'Lena', 'Лена', 'Еленина', 'Санкт-Петербург', 'ул. Сиреневая, д. 125, кв. 8', 4, 'Марио', 1, 750, 'Отправлен', '2019-05-22 13:05:28');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 29 2019 г., 10:05
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
-- Структура таблицы `done_orders`
--

CREATE TABLE `done_orders` (
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
-- Дамп данных таблицы `done_orders`
--

INSERT INTO `done_orders` (`id`, `user_id`, `user_login`, `user_name`, `user_surname`, `user_city`, `user_adress`, `goods_id`, `goods_name`, `numbers`, `goods_price`, `order_status`, `date`) VALUES
(91, 20, 'Liza', 'Елизавета ', 'Сидорова', 'Санкт-Петербург ', 'ул. Сиреневая, д. 125, кв. 8', 14, 'Марио', 6, 1100, 'Выполнен', '2019-05-21 19:25:01'),
(91, 20, 'Liza', 'Елизавета ', 'Сидорова', 'Санкт-Петербург ', 'ул. Сиреневая, д. 125, кв. 8', 14, 'Марио', 6, 1100, 'Выполнен', '2019-05-21 19:25:01'),
(88, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 6, 'Дракон', 1, 1250, 'Выполнен', '2019-05-21 13:58:10'),
(89, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 7, 'Семья драконов', 1, 3000, 'Выполнен', '2019-05-21 13:58:10'),
(90, 1, 'wind', 'Илья', 'Ильичев', 'Ильинск', 'ул. Ильинская, д. 1, кв. 1', 10, 'Марио супергерой', 1, 646, 'Выполнен', '2019-05-21 13:58:10'),
(80, 13, 'Glasha', 'Глаша', 'Сидорова', 'Тюмень', 'ул. Мичурина, д. 8', 1, 'Марио и дракон', 3, 1000, 'Выполнен', '2019-05-01 15:20:00'),
(81, 13, 'Glasha', 'Глаша', 'Сидорова', 'Тюмень', 'ул. Мичурина, д. 8', 7, 'Семья драконов', 3, 3000, 'Выполнен', '2019-05-01 15:20:00'),
(82, 13, 'Glasha', 'Глаша', 'Сидорова', 'Тюмень', 'ул. Мичурина, д. 8', 5, 'Марио и дракон', 3, 1250, 'Выполнен', '2019-05-01 15:20:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

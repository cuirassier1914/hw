-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 12 2018 г., 12:49
-- Версия сервера: 5.7.21-log
-- Версия PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `goods`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `imageUrl` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `imageUrl`, `name`, `description`) VALUES
(1, '../data/img/canari.jpg', 'Canari', 'Le Canari est la forme domestiquée du Serin des Canaries (Serinus canaria).'),
(2, '../data/img/chouette.jpg', 'Chouette', 'Chouette est le nom vernaculaire de certains oiseaux de la famille des Strigidaes'),
(3, '../data/img/hirondelle.jpg', 'Hirondelle', 'es hirondelles sont des oiseaux appartenant à la famille des Hirundinidae. '),
(4, '../data/img/messange.jpg', 'Messange', 'Mésange est un nom vernaculaire ambigu en français.'),
(5, '../data/img/perroquet.jpg', 'Perroquet', 'Le terme perroquet ([pɛ.ʁɔ.kɛ]) est un terme du vocabulaire courant qui désigne'),
(6, '../data/img/rossignol.jpg', 'Rossignol', 'Rossignol est un oeseau qui chante');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url/` (`imageUrl`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

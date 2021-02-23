-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 23 2021 г., 23:50
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2advanced`
--

-- --------------------------------------------------------

--
-- Структура таблицы `apple`
--

CREATE TABLE `apple` (
  `id` int(11) UNSIGNED NOT NULL,
  `color` varchar(500) NOT NULL,
  `status` enum('висит на дереве','упало') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'висит на дереве',
  `appearance_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fallout_date` timestamp NULL DEFAULT NULL,
  `size` decimal(4,3) NOT NULL DEFAULT '1.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `apple`
--

INSERT INTO `apple` (`id`, `color`, `status`, `fallout_date`, `size`) VALUES
(679, 'красное', 'упало', '2021-02-23 20:08:22', '0.500'),
(680, 'темно-красное', 'висит на дереве', NULL, '1.000'),
(681, 'зеленое', 'висит на дереве', NULL, '1.000'),
(682, 'красное', 'висит на дереве', NULL, '1.000'),
(683, 'светло-желтое', 'висит на дереве', NULL, '1.000'),
(684, 'светло-желтое', 'висит на дереве', NULL, '1.000');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1613742753),
('m130524_201442_init', 1613742856),
('m190124_110200_add_verification_token_column_to_user_table', 1613742857);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `created_at`, `updated_at`, `group_id`) VALUES
(4, 'user1', 'usr1@ya.ru', 1614012592, 1614012592, 1),
(5, 'user2', 'usr2@ya.ru', 1614012679, 1614012679, 1),
(6, 'user3', 'usr3@ya.ru', 1614012757, 1614012757, 2),
(7, 'user4', 'usr4@ya.ru', 1614062955, 1614062955, 2),
(8, 'user5', 'usr5@ya.ru', 1614062955, 1614062955, 3),
(9, 'user6', 'usr6@ya.ru', 1614062955, 1614062955, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `usergroup`
--

CREATE TABLE `usergroup` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `$created_at` timestamp NOT NULL,
  `$updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `usergroup`
--

INSERT INTO `usergroup` (`id`, `name`, `password_hash`, `verification_token`, `auth_key`, `status`, `$created_at`, `$updated_at`) VALUES
(1, 'group1', '$2y$13$0n6uhKZBLwlpInkMHjHCpuQKGUqfo8wXXti02nay4ghW18bApQ1ai', NULL, '', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'group2', '$2y$13$e42fBuO9n/Ui87Bv/PsknuH91SRcfYo4XGsb8/l8MqKzvMTeHZ.dO', NULL, '', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'group3', '$2y$13$1Va2s1Z8qAUpGo2SopunJOxKhcZdmAGEiE0bzVDrcToUcDDfKfHam', NULL, '', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `apple`
--
ALTER TABLE `apple`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `group_id` (`group_id`);

--
-- Индексы таблицы `usergroup`
--
ALTER TABLE `usergroup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `apple`
--
ALTER TABLE `apple`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=685;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `usergroup`
--
ALTER TABLE `usergroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `usergroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

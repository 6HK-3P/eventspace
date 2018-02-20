-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 17 2018 г., 00:48
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `eventspace`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_statuses`
--

CREATE TABLE IF NOT EXISTS `order_statuses` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `colorcode` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `colorcode`) VALUES
(1, 'Ожидается оплата', '#000000'),
(2, 'Оплачен', '#000000'),
(3, 'Отказ', '#FF0000');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `pricings`
--

CREATE TABLE IF NOT EXISTS `pricings` (
  `id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `view` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `deposit` varchar(255) NOT NULL,
  `info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pricings`
--

INSERT INTO `pricings` (`id`, `worker_id`, `view`, `city`, `date`, `price`, `deposit`, `info`) VALUES
(4, 1, 'По месяцам', '["1","2","3","4","5","6","7","8"]', '["1","7","2","8","9","10","5","11","6","12"]', '[{"1":null},{"2":"22"},{"3":"5555"}]', '[{"1":null},{"2":"22"},{"3":"55"}]', ''),
(5, 1, 'По дням', '["4"]', '["2018-01-19","2018-01-28"]', '[{"3":"655"}]', '[{"3":"55"}]', ''),
(6, 1, 'По месяцам', '["1","2","3","4","5","6","7","8"]', '["1","7","2","8","3","9","4","10","5","11","6","12"]', '[{"2":"34"},{"3":"23242"}]', '[{"2":"423"},{"3":"42342"}]', ''),
(10, 8, 'По месяцам', '["1","3","4","5","6","7","8"]', '["1","7","2","8","3","9","10","11","6","12"]', '["23413","23412"]', '["3","235"]', ''),
(12, 8, 'По месяцам', '["4"]', '["7"]', '["23413","23345"]', '["23413","23412"]', ''),
(13, 8, 'По месяцам', '["4"]', '["7"]', '["23413","23412"]', '["23413","23412"]', ''),
(14, 8, 'По месяцам', '["6"]', '["2","9"]', '["23413","2352"]', '["23413","23412"]', ''),
(15, 8, 'По месяцам', '["4"]', '["7","8"]', '["23413","23412"]', '["23","23412"]', ''),
(17, 8, 'По месяцам', '["2"]', '["7"]', '["23413","23412"]', '["23413","23412"]', ''),
(18, 8, 'По дням', '["1","4"]', '["2018-01-11","2018-01-19"]', '["23413","112"]', '["23413","23412"]', ''),
(19, 8, 'По дням', '["4"]', '["03.01.2018","13.01.2018"]', '["23413","23412"]', '["23413","23412"]', ''),
(20, 9, 'По месяцам', '["6"]', '["3"]', '["123555555"]', '["123\\u0430"]', ''),
(21, 9, 'По месяцам', '["8"]', '["11"]', '["452"]', '[]', ''),
(37, 10, 'По месяцам', '["6"]', '["7"]', '["888","",""]', '["88","",""]', ''),
(38, 6, 'По месяцам', '["1","3"]', '["1","2","3"]', '["555","",""]', '["666","",""]', ''),
(39, 6, 'По месяцам', '["1","4"]', '["1","7","8"]', '["1111","",""]', '["11","",""]', ''),
(40, 16, 'По месяцам', '["1","3"]', '["1"]', '["25500"]', '["200"]', ''),
(41, 13, 'По месяцам', '["2","4"]', '["1","2"]', '["1222","",""]', '["22","",""]', ''),
(63, 17, 'По месяцам', '["6"]', '["1"]', '["1"]', '["4"]', ''),
(64, 17, 'По месяцам', '["7"]', '["7"]', '["3","2"]', '["6","5"]', ''),
(65, 17, 'По месяцам', '["4"]', '["12"]', '["13"]', '["1"]', ''),
(66, 17, 'По месяцам', '["2"]', '["1"]', '["22"]', '["2"]', ''),
(67, 17, 'По месяцам', '["4"]', '["1"]', '["20","11"]', '["2","1"]', ''),
(68, 14, 'По месяцам', '["4"]', '["10"]', '["3333","","","",""]', '["3","","","",""]', ''),
(69, 13, 'По месяцам', '["4"]', '["7"]', '["5","6","87","",""]', '["6","8","9","",""]', ''),
(72, 18, 'По месяцам', '["8"]', '["11"]', '["444"]', '["444"]', '2'),
(73, 17, 'По месяцам', '["8"]', '["9"]', '["8",""]', '["7",""]', ''),
(74, 14, 'По месяцам', '["6"]', '["5"]', '["4","","",""]', '["4","","",""]', ''),
(75, 14, 'По месяцам', '["8"]', '["10"]', '["","","77",""]', '["","","7",""]', ''),
(76, 14, 'По месяцам', '["8"]', '["5"]', '["","55",""]', '["","5",""]', ''),
(77, 18, 'По месяцам', '["8"]', '["11"]', '["8577"]', '["777"]', '3'),
(78, 18, 'По месяцам', '["2"]', '["7"]', '["15000"]', '["1500"]', '5'),
(83, 21, 'По дням', '["1"]', '["11.01.2018","23.02.2018"]', '["","20000"]', '["","20"]', ''),
(84, 21, 'По месяцам', '["1"]', '["1","2","3","10"]', '["2555555","1000"]', '["255","10"]', '');

-- --------------------------------------------------------

--
-- Структура таблицы `ranking_groups`
--

CREATE TABLE IF NOT EXISTS `ranking_groups` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `minprice` int(11) NOT NULL,
  `maxprice` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `ranking_groups`
--

INSERT INTO `ranking_groups` (`id`, `name`, `description`, `minprice`, `maxprice`) VALUES
(1, 'cheapest', 'Разумный выбор', 3000, 6000),
(2, 'average', 'Золотая середина', 7000, 12000),
(3, 'best', 'Лучшие из лучших', 13000, 17000);

-- --------------------------------------------------------

--
-- Структура таблицы `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `site_settings`
--

INSERT INTO `site_settings` (`id`, `value`) VALUES
(1, '{"number":"8 925 912-29-12","vk":"https:\\/\\/vk.com\\/hi","whatsapp":"https:\\/\\/whatsapp.com\\/hi","instagram":"https:\\/\\/instagram.com\\/HH","copyright":"\\u041f\\u043e\\u0436\\u0430\\u043b\\u0443\\u0439\\u0441\\u0442\\u0430, \\u0441\\u0442\\u0430\\u0432\\u044c\\u0442\\u0435 \\u0441\\u0441\\u044b\\u043b\\u043a\\u0443 \\r\\n\\u043d\\u0430 Event Space, \\u0435\\u0441\\u043b\\u0438 \\u0438\\u0441\\u043f\\u043e\\u043b\\u044c\\u0437\\u0443\\u0435\\u0442\\u0435 \\u043c\\u0430\\u0442\\u0435\\u0440\\u0438\\u0430\\u043b\\u044b \\u0441 \\u0441\\u0430\\u0439\\u0442\\u0430","support":"8 925 075-82-81","affilate":"8 925 075-82-81"}');

-- --------------------------------------------------------

--
-- Структура таблицы `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `reserve_user` text COLLATE utf8_bin NOT NULL,
  `reserve_worker` text COLLATE utf8_bin NOT NULL,
  `reserve_manager` text COLLATE utf8_bin NOT NULL,
  `payment_user` text COLLATE utf8_bin NOT NULL,
  `afterpay_user` text COLLATE utf8_bin NOT NULL,
  `afterpay_worker` text COLLATE utf8_bin NOT NULL,
  `afterpay_manager` text COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `sms`
--

INSERT INTO `sms` (`reserve_user`, `reserve_worker`, `reserve_manager`, `payment_user`, `afterpay_user`, `afterpay_worker`, `afterpay_manager`, `id`) VALUES
('уважаемый $user_name проверяется доступность $worker_name  на $date', 'Уважаемый исполнитель есть заказ на $date,  город $city , услуга - $service ,  дополнительно - $equipment ,  цена - $price.', '$user_name , телефон $user_phone -  совершил заказ на  $worker_name,  дата $date , город - $city , услуга - $service ,   дополнительно - $equipment ,  цена - $price.', '$worker_name доступен на $date цена - $price, залог - $deposit  ', '$worker_name - $worker_phone доступен на $date, город $city,  цена - $price, залог - $deposit.', 'Оформлен заказ. Клиент -  $user_name, телефон - $user_phone, на $date, город $city,  цена - $price, залог - $deposit.', 'Оформлен заказ. Исполнитель - $worker_name, телефон - $worker_phone . Клиент -  $user_name , телефон - $user_phone , на $date , город $city,  цена - $price, залог - $deposit.', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `teasers`
--

CREATE TABLE IF NOT EXISTS `teasers` (
  `id` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `logo` text,
  `title` text,
  `text` text
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teasers`
--

INSERT INTO `teasers` (`id`, `position`, `logo`, `title`, `text`) VALUES
(1, 3, '/public/img/tizer1.png', NULL, 'вы не в перый раз организуете свадьбу, вы, должно быть, знаете, как тяжело наладить коммуникацию с исполнителями: они не берут трубку, постоянно заняты. Даже договориться о встрече большая проблема. Мы решим ее сами. Наш менеджер обо всем позаботиться. Просто оставьте заявку.'),
(11, 10, '/public/img/teasers/3278Безымянный.jpg', 'kikikiik', 'kiki'),
(12, 11, '/public/img/teasers/4027Screenshot_334.jpg', 'aaa', 'kikikiii'),
(13, 6, '/public/img/teasers/empty.png', '123123', 'fsdgdsfggsdgsg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `root` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `root`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Братство пингвинов', '+7 432-543-52-35', '123123', 1, NULL, '2018-01-25 16:55:40', '2018-02-04 15:28:02'),
(9, 'Лопата', '+7 453-223-45-23', '123123', 1, NULL, '2018-01-25 16:58:57', '2018-02-04 15:28:47'),
(10, 'Гидра', '+7 907-896-78-45', '123123', 1, NULL, '2018-01-25 16:59:30', '2018-02-04 15:29:25'),
(11, 'Gidra', '1289319283', '123123', 2, NULL, '2018-01-25 18:53:19', '2018-01-25 18:53:19'),
(15, 'АУЕ', '+7 781-236-81-23', '123123', 1, NULL, '2018-02-04 15:41:41', '2018-02-04 15:41:41'),
(16, 'thth', '+7 777-777-77-77', '77777777', 1, NULL, '2018-02-04 18:01:04', '2018-02-04 18:01:04'),
(18, 'cs', '+7 888-999-99-99', '999999', 1, NULL, '2018-02-09 13:36:52', '2018-02-09 13:36:52'),
(19, 'Мишки Гамми', '+7 788-888-88-88', '787878', 1, NULL, '2018-02-09 13:39:13', '2018-02-09 13:39:13'),
(20, 'Gazirovka', '+7 787-889-98-88', '1111111', 1, NULL, '2018-02-09 13:45:36', '2018-02-09 13:45:36'),
(21, 'Пхотограпъхер', '+7 444-444-44-44', '4444', 1, NULL, '2018-02-09 14:12:24', '2018-02-09 14:12:24'),
(24, '99дд9', '+7 777-771-11-11', '111', 1, NULL, '2018-02-09 17:54:08', '2018-02-09 17:54:08'),
(25, 'lol', '+7 345-341-23-41', '123123', 1, NULL, '2018-02-10 13:56:26', '2018-02-10 13:56:26'),
(26, 'Пьяный батя', '+7 754-521-71-45', '123123', 1, NULL, '2018-02-13 15:41:09', '2018-02-13 15:41:09'),
(27, 'Arion', '+7 789-423-78-90', '123123', 1, NULL, '2018-02-16 16:19:47', '2018-02-16 16:19:47');

-- --------------------------------------------------------

--
-- Структура таблицы `workers`
--

CREATE TABLE IF NOT EXISTS `workers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `city_id` int(11) NOT NULL DEFAULT '1',
  `ava` text,
  `audio` text,
  `logo` text,
  `about` text,
  `manager_id` int(11) DEFAULT NULL,
  `manager_comment` text,
  `worker_contacts` text,
  `workers_additional_info` text,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id`, `user_id`, `category_id`, `city_id`, `ava`, `audio`, `logo`, `about`, `manager_id`, `manager_comment`, `worker_contacts`, `workers_additional_info`, `updated_at`, `created_at`) VALUES
(6, 7, 4, 1, '/public/img/2559205.jpg', '[{"name":"Kalimba.mp3","link":"\\/public\\/audio\\/5965271.mp3"},{"name":"Maid with the Flaxen Hair.mp3","link":"\\/public\\/audio\\/1798707.mp3"},{"name":"Sleep Away.mp3","link":"\\/public\\/audio\\/8513184.mp3"},{"name":"Maid with the Flaxen Hair.mp3","link":"\\/public\\/audio\\/4834290.mp3"}]', '[{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/l3XIJgA8OZk","poster":"http:\\/\\/img.youtube.com\\/vi\\/l3XIJgA8OZk\\/hqdefault.jpg"},{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/La47ePCb0c0","poster":"http:\\/\\/img.youtube.com\\/vi\\/La47ePCb0c0\\/hqdefault.jpg"},{"type":"photo","src":"\\/public\\/img\\/163Penguins.jpg"},{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/","poster":"http:\\/\\/img.youtube.com\\/vi\\/\\/hqdefault.jpg"},{"type":"photo","src":"\\/public\\/img\\/5596924"},{"type":"photo","src":"\\/public\\/img\\/3207093.jpg"},{"type":"photo","src":"\\/public\\/img\\/2559205.jpg"},{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/l3XIJgA8OZk","poster":"http:\\/\\/img.youtube.com\\/vi\\/l3XIJgA8OZk\\/hqdefault.jpg"}]', 'улыбаемся и машем', 11, 'тикаем', '[{"name":"\\u0440\\u0435\\u0431\\u044f\\u0442\\u0430","phone":"+7 123-123-41-23"}]', '{"lang":["2","3","4"],"basic_lang":"3","types":["2"],"basic_types":"2"}', '2018-02-04', '2018-01-25'),
(8, 9, 4, 1, '/public/img/6908265.jpg', '[{"name":"Kalimba.mp3","link":"\\/public\\/audio\\/5965271.mp3"},{"name":"Sleep Away.mp3","link":"\\/public\\/audio\\/8513184.mp3"},{"name":"Maid with the Flaxen Hair.mp3","link":"\\/public\\/audio\\/4834290.mp3"},{"name":"Maid with the Flaxen Hair.mp3","link":"\\/public\\/audio\\/1798707.mp3"}]', '[{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/La47ePCb0c0","poster":"http:\\/\\/img.youtube.com\\/vi\\/La47ePCb0c0\\/hqdefault.jpg"},{"type":"photo","src":"\\/public\\/img\\/163Penguins.jpg"},{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/","poster":"http:\\/\\/img.youtube.com\\/vi\\/\\/hqdefault.jpg"},{"type":"photo","src":"\\/public\\/img\\/5596924"},{"type":"photo","src":"\\/public\\/img\\/3207093.jpg"},{"type":"photo","src":"\\/public\\/img\\/2559205.jpg"},{"type":"photo","src":"\\/public\\/img\\/6908265.jpg"}]', 'Бьёт больно', 11, 'ваще трабл', '[{"name":"\\u0436\\u0438\\u0437\\u043d\\u044c \\u0431\\u043e\\u043b\\u044c","phone":"+7 123-123-15-43"}]', '{"lang":["4","5"],"basic_lang":"4","types":["2"],"basic_types":"2"}', '2018-02-04', '2018-01-25'),
(9, 10, 4, 7, '/public/img/986939.jpg', '[{"name":"Kalimba.mp3","link":"\\/public\\/audio\\/5965271.mp3"},{"name":"Sleep Away.mp3","link":"\\/public\\/audio\\/8513184.mp3"},{"name":"Maid with the Flaxen Hair.mp3","link":"\\/public\\/audio\\/4834290.mp3"},{"name":"Maid with the Flaxen Hair.mp3","link":"\\/public\\/audio\\/1798707.mp3"}]', '[{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/La47ePCb0c0","poster":"http:\\/\\/img.youtube.com\\/vi\\/La47ePCb0c0\\/hqdefault.jpg"},{"type":"photo","src":"\\/public\\/img\\/163Penguins.jpg"},{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/","poster":"http:\\/\\/img.youtube.com\\/vi\\/\\/hqdefault.jpg"},{"type":"photo","src":"\\/public\\/img\\/5596924"},{"type":"photo","src":"\\/public\\/img\\/3207093.jpg"},{"type":"photo","src":"\\/public\\/img\\/2559205.jpg"},{"type":"photo","src":"\\/public\\/img\\/6908265.jpg"}]', 'Самая топовая организация', 11, 'совсм топ', '[{"name":"\\u0432\\u0430\\u0449\\u0435 \\u0442\\u043e\\u043f","phone":"+7 548-937-25-98"}]', '{"lang":["2","3"],"basic_lang":"3","types":["1","2"],"basic_types":"1"}', '2018-02-04', '2018-01-25'),
(10, 15, 4, 4, '/public/img/1508790.jpg', '[{"name":"Kalimba.mp3","link":"\\/public\\/audio\\/3108216.mp3"},{"name":"Kalimba.mp3","link":"\\/public\\/audio\\/7406617.mp3"},{"name":"Maid with the Flaxen Hair.mp3","link":"\\/public\\/audio\\/6401063.mp3"},{"name":"Sleep Away.mp3","link":"\\/public\\/audio\\/7889405.mp3"}]', '[{"type":"photo","src":"\\/public\\/img\\/7172852.png"},{"type":"video","src":"https:\\/\\/www.youtube.com\\/embed\\/Rr7wFKV8ZUo","poster":"http:\\/\\/img.youtube.com\\/vi\\/Rr7wFKV8ZUo\\/hqdefault.jpg"},{"type":"photo","src":"\\/public\\/img\\/1508790.jpg"},{"type":"photo","src":"\\/public\\/img\\/5725403.png"},{"type":"photo","src":"\\/public\\/img\\/2680054.png"}]', 'жизнь ворам', 11, 'да ну их этих поваров....', '[{"name":"\\u043d\\u0438\\u0447\\u0435\\u0433\\u043e \\u043f\\u043e\\u0432\\u0430\\u0440\\u0430\\u043c","phone":"+7 189-273-48-12"},{"name":"\\u0432\\u0430\\u0449\\u0435 \\u043d\\u0438\\u0447\\u0435\\u0433\\u043e","phone":"+7 327-846-12-87"}]', '{"lang":["1","2","3","4","5"],"basic_lang":"3","types":["1","2"],"basic_types":"1"}', '2018-02-04', '2018-02-04'),
(11, 16, 4, 1, NULL, NULL, NULL, 'hthtth', 11, '577557', '[{"name":"\\u0421\\u0435\\u0440\\u0433\\u0435\\u0435\\u0432\\u043d\\u0430","phone":"+7 775-555-55-55"}]', '{"lang":["1","2"],"basic_lang":"1","types":["1"],"basic_types":"1"}', '2018-02-04', '2018-02-04'),
(13, 18, 5, 1, NULL, NULL, NULL, 'sc', 11, 'sccs', '[{"name":"sccs","phone":"+7 666-666-64-44"}]', '{"lang":["1"],"basic_lang":"1","types_conf":["1"]}', '2018-02-09', '2018-02-09'),
(14, 19, 5, 1, '/public/img/364075.jpg', '[{"name":"\\u041c\\u0430\\u043b\\u044c\\u0431\\u044d\\u043a \\u2013 \\u0420\\u0430\\u0432\\u043d\\u043e\\u0434\\u0443\\u0448\\u0438\\u0435..mp3","link":"\\/public\\/audio\\/3295289.mp3"},{"name":"Don Omar Ft. Zion y Lennox - Ella, Ella.mp3","link":"\\/public\\/audio\\/3266297.mp3"}]', '[{"type":"photo","src":"\\/public\\/img\\/2514649.png"},{"type":"photo","src":"\\/public\\/img\\/364075.jpg"}]', 'цввццв', 11, NULL, '[{"name":"\\u0446\\u0432\\u0432\\u0446\\u0432\\u0446","phone":"+7 989-898-98-98"}]', '{"lang":["2"],"basic_lang":"2","types_conf":["1","2"]}', '2018-02-09', '2018-02-09'),
(15, 20, 4, 1, '/public/img/5187073.jpg', '[{"name":"1DON AMAR - BANDOLERO_mp3cut.foxcom\\u0432\\u0440.su_.mp3","link":"\\/public\\/audio\\/1556092.mp3"},{"name":"\\u25cf Tony Dize - Cast\\u00edgala (OST \\u0424\\u043e\\u0440\\u0441\\u0430\\u0436 6) .mp3","link":"\\/public\\/audio\\/4627076.mp3"}]', '[{"type":"photo","src":"\\/public\\/img\\/5187073.jpg"}]', 'GGGG', 11, NULL, '[{"name":"egegeg","phone":"+7 988-988-77-77"}]', '{"lang":["1"],"basic_lang":"1","types":["2"],"basic_types":"2"}', '2018-02-09', '2018-02-09'),
(16, 21, 1, 1, '/public/img/6605835.jpg', NULL, '[{"type":"photo","src":"\\/public\\/img\\/6605835.jpg"}]', 'ЫЫЫ', 11, '4е4', '[{"name":"\\u0435\\u0435\\u0435","phone":"+7 444-444-44-44"}]', '[]', '2018-02-09', '2018-02-09'),
(18, 24, 6, 1, '/public/img/8309021.png', NULL, '[{"type":"photo","src":"\\/public\\/img\\/8309021.png"}]', 'д9д9д9', 11, NULL, '[{"name":"\\u043e\\u043e","phone":"+7 777-777-77-77"}]', '{"lang":["1"],"basic_lang":"1","types":["2"],"basic_types":"2"}', '2018-02-13', '2018-02-09'),
(19, 25, 2, 1, NULL, NULL, NULL, 'fdgdsfgsdfg', 11, 'sdf', '[{"name":"dfgsdfgsadf","phone":"+7 124-512-34-21"}]', '{"lang":["1"],"basic_lang":"1","types":["2"],"basic_types":"2"}', '2018-02-10', '2018-02-10'),
(20, 26, 5, 1, NULL, NULL, NULL, 'Рюмка водки на СТОЛЕ', 11, '123123', '[{"name":"lalalala","phone":"+7 845-137-63-42"}]', '{"lang":["1","2","3","4"],"basic_lang":"2","types_conf":["1","2"]}', '2018-02-13', '2018-02-13'),
(21, 27, 3, 1, '/public/img/4095765.jpg', NULL, '[{"type":"photo","src":"\\/public\\/img\\/4095765.jpg"}]', 'Poyas', 11, '34234', '[{"name":"kurma","phone":"+7 742-387-92-43"}]', '{"capacity":{"start":"1","end":"100"}}', '2018-02-16', '2018-02-16');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_banned_dates`
--

CREATE TABLE IF NOT EXISTS `workers_banned_dates` (
  `id` int(11) NOT NULL,
  `worker` int(11) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `workers_cars`
--

CREATE TABLE IF NOT EXISTS `workers_cars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `mark_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_cars`
--

INSERT INTO `workers_cars` (`id`, `name`, `type_id`, `color_id`, `mark_id`, `worker_id`) VALUES
(1, ';p;pp;', 1, 1, 1, 18),
(2, 'qqqqqqqqq', 1, 1, 5, 18),
(3, 'ddddddddddddd', 3, 4, 7, 18),
(4, '9oo9o9o9', 2, 3, 5, 18),
(5, 'МОЯ ЛАСТОЧКА', 4, 1, 1, 18),
(6, 'aa', 1, 1, 1, 18);

-- --------------------------------------------------------

--
-- Структура таблицы `workers_cars_colors`
--

CREATE TABLE IF NOT EXISTS `workers_cars_colors` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_cars_colors`
--

INSERT INTO `workers_cars_colors` (`id`, `title`) VALUES
(1, 'Белый'),
(2, 'Золотой'),
(3, 'Серебристый'),
(4, 'Красный'),
(5, 'Черный');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_cars_marks`
--

CREATE TABLE IF NOT EXISTS `workers_cars_marks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_cars_marks`
--

INSERT INTO `workers_cars_marks` (`id`, `title`) VALUES
(1, 'Audi'),
(2, 'Bentley'),
(3, 'BMW'),
(4, 'Cadillac'),
(5, 'Chevrolet'),
(6, 'Chrysler'),
(7, 'Ford'),
(8, 'Hummer'),
(9, 'Infinity'),
(10, 'Jaguar'),
(11, 'Lexus'),
(12, ' Mazda'),
(13, 'Porsche'),
(14, 'Rolls-Royce'),
(15, ' Toyota'),
(16, 'Volkswagen');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_cars_types`
--

CREATE TABLE IF NOT EXISTS `workers_cars_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_cars_types`
--

INSERT INTO `workers_cars_types` (`id`, `title`) VALUES
(1, 'Лимузин'),
(2, 'Ретро-мобиль'),
(3, 'Кабриолет'),
(4, 'Стандарт');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_categories`
--

CREATE TABLE IF NOT EXISTS `workers_categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_categories`
--

INSERT INTO `workers_categories` (`id`, `name`) VALUES
(1, 'Фотографы'),
(2, 'Видеостудии'),
(3, 'Залы'),
(4, 'Музыканты'),
(5, 'Ведущие'),
(6, 'Автомобили');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_cities`
--

CREATE TABLE IF NOT EXISTS `workers_cities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_cities`
--

INSERT INTO `workers_cities` (`id`, `title`) VALUES
(1, 'Махачкала'),
(2, 'Каспийск'),
(3, 'Хасавюрт'),
(4, 'Дербент'),
(5, 'Кизляр'),
(6, 'Кизилюрт'),
(7, 'Даг. огни'),
(8, 'Буйнакск');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_count_camers`
--

CREATE TABLE IF NOT EXISTS `workers_count_camers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_count_camers`
--

INSERT INTO `workers_count_camers` (`id`, `title`) VALUES
(1, '3-камерная'),
(2, '2-камерная'),
(3, '1-камерная');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_languages`
--

CREATE TABLE IF NOT EXISTS `workers_languages` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_languages`
--

INSERT INTO `workers_languages` (`id`, `name`) VALUES
(1, 'Русский'),
(2, 'Аварский'),
(3, 'Даргинский'),
(4, 'Табасаранский'),
(5, 'Кумыкский'),
(6, 'Лакский'),
(7, 'Лезгинский');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_medias`
--

CREATE TABLE IF NOT EXISTS `workers_medias` (
  `id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `src` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `workers_musicians_types`
--

CREATE TABLE IF NOT EXISTS `workers_musicians_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_musicians_types`
--

INSERT INTO `workers_musicians_types` (`id`, `title`) VALUES
(1, 'Народная'),
(2, 'Эстрадная');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_toastmaster_types`
--

CREATE TABLE IF NOT EXISTS `workers_toastmaster_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_toastmaster_types`
--

INSERT INTO `workers_toastmaster_types` (`id`, `title`) VALUES
(1, 'Ведущий'),
(2, 'Ведущий + исполнитель');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_video_equipments`
--

CREATE TABLE IF NOT EXISTS `workers_video_equipments` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_video_equipments`
--

INSERT INTO `workers_video_equipments` (`id`, `title`) VALUES
(1, 'Видеокран'),
(2, 'Квадрокоптер');

-- --------------------------------------------------------

--
-- Структура таблицы `workers_video_qualities`
--

CREATE TABLE IF NOT EXISTS `workers_video_qualities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers_video_qualities`
--

INSERT INTO `workers_video_qualities` (`id`, `title`) VALUES
(1, 'Full HD'),
(2, '4K');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ranking_groups`
--
ALTER TABLE `ranking_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teasers`
--
ALTER TABLE `teasers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`phone`);

--
-- Индексы таблицы `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city` (`city_id`),
  ADD KEY `category` (`category_id`);

--
-- Индексы таблицы `workers_banned_dates`
--
ALTER TABLE `workers_banned_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker` (`worker`);

--
-- Индексы таблицы `workers_cars`
--
ALTER TABLE `workers_cars`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_cars_colors`
--
ALTER TABLE `workers_cars_colors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_cars_marks`
--
ALTER TABLE `workers_cars_marks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_cars_types`
--
ALTER TABLE `workers_cars_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_categories`
--
ALTER TABLE `workers_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_cities`
--
ALTER TABLE `workers_cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_count_camers`
--
ALTER TABLE `workers_count_camers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_languages`
--
ALTER TABLE `workers_languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_medias`
--
ALTER TABLE `workers_medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`worker_id`);

--
-- Индексы таблицы `workers_musicians_types`
--
ALTER TABLE `workers_musicians_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_toastmaster_types`
--
ALTER TABLE `workers_toastmaster_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_video_equipments`
--
ALTER TABLE `workers_video_equipments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers_video_qualities`
--
ALTER TABLE `workers_video_qualities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT для таблицы `ranking_groups`
--
ALTER TABLE `ranking_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `teasers`
--
ALTER TABLE `teasers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT для таблицы `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `workers_banned_dates`
--
ALTER TABLE `workers_banned_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `workers_cars`
--
ALTER TABLE `workers_cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `workers_cars_colors`
--
ALTER TABLE `workers_cars_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `workers_cars_marks`
--
ALTER TABLE `workers_cars_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `workers_cars_types`
--
ALTER TABLE `workers_cars_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `workers_categories`
--
ALTER TABLE `workers_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `workers_cities`
--
ALTER TABLE `workers_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `workers_count_camers`
--
ALTER TABLE `workers_count_camers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `workers_languages`
--
ALTER TABLE `workers_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `workers_medias`
--
ALTER TABLE `workers_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `workers_musicians_types`
--
ALTER TABLE `workers_musicians_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `workers_toastmaster_types`
--
ALTER TABLE `workers_toastmaster_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `workers_video_equipments`
--
ALTER TABLE `workers_video_equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `workers_video_qualities`
--
ALTER TABLE `workers_video_qualities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `workers_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

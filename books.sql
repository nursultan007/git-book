-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 07 2017 г., 19:16
-- Версия сервера: 5.7.14
-- Версия PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `books`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL COMMENT 'ид автора',
  `author_name` varchar(250) DEFAULT NULL COMMENT 'имя автора'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(2, 'Магжан Жумабаев'),
(3, 'Исай Калашников'),
(4, 'Дейл карнеги'),
(6, 'Пушкин');

-- --------------------------------------------------------

--
-- Структура таблицы `authors_to_books`
--

CREATE TABLE `authors_to_books` (
  `ab_id` int(11) NOT NULL COMMENT 'ид записей',
  `author_id` int(11) NOT NULL COMMENT 'ид автора книги',
  `book_id` int(11) NOT NULL COMMENT 'ид книги'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors_to_books`
--

INSERT INTO `authors_to_books` (`ab_id`, `author_id`, `book_id`) VALUES
(7, 2, 7),
(11, 2, 8),
(17, 3, 7),
(18, 4, 9),
(19, 2, 9),
(20, 3, 1),
(21, 3, 10),
(22, 3, 11),
(23, 6, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL COMMENT 'ид книги',
  `book_name` varchar(70) DEFAULT NULL COMMENT 'название книги'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`book_id`, `book_name`) VALUES
(1, 'Легенда Чингиз хан 2'),
(7, 'Песня льда и пламени'),
(8, 'Большие игры 2'),
(9, 'Организационная поведения'),
(10, 'Игра престолов 7 сезон'),
(11, 'Все или ничего'),
(12, 'Золотая рыбка');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.ru', '$2y$10$0gkKlvJNIK.tS9TTqGvwmeDLNV8lTT0FWCoG.hdOMYRorEjc/1xsm', 'CJwkrNXeHi0IoRSAu126IDHojEwzQlNHe0kv18dj6gY7OUHXwFhgYCTNsBql', '2017-10-07 00:17:04', '2017-10-07 00:17:04');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Индексы таблицы `authors_to_books`
--
ALTER TABLE `authors_to_books`
  ADD PRIMARY KEY (`ab_id`),
  ADD KEY `ab_to_author` (`author_id`),
  ADD KEY `ab_to_books` (`book_id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ид автора', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `authors_to_books`
--
ALTER TABLE `authors_to_books`
  MODIFY `ab_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ид записей', AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ид книги', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `authors_to_books`
--
ALTER TABLE `authors_to_books`
  ADD CONSTRAINT `ab_to_author` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `ab_to_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

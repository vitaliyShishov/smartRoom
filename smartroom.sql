-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 02 2016 г., 21:39
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `smartroom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `company` varchar(40) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `custom_field` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `api`
--

CREATE TABLE `api` (
  `api_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `api`
--

INSERT INTO `api` (`api_id`, `username`, `firstname`, `lastname`, `password`, `status`, `date_added`, `date_modified`) VALUES
(1, 'F8pWOEBgmEJUeg2RbZBUdd3SqktfBmvHkbdzgfVIjfdECVVeuXyN0rghRPCT2ybd', '', '', 'P5Svao3AKXFNsardyfrpNNMfdPzVDQzSLHDmw7n6UsJDJ1g7WNmjbzE5E4RHKGaVNe89bl6wUG0d7WaTkD3C28762OEDUeYh8Xha8eNTkDwhaN0BQuDJtAGmOLpipEGoboFaIStsWfPwtGxA11Jk1QMGb1pH5vvXa0xiJgQfCgRwmFwd66EyMQ4oIjvDVhavXOUhvkCxHUjtaWNXSRLeiGJqq4uCbKxzZIWKsZ80tikK4xhMFtro00UgvEjMPXCo', 1, '2015-06-10 13:14:45', '2015-06-10 13:14:45');

-- --------------------------------------------------------

--
-- Структура таблицы `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banner`
--

INSERT INTO `banner` (`banner_id`, `name`, `status`) VALUES
(6, 'HP Products', 1),
(7, 'Баннер на главной', 1),
(8, 'Manufacturers', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `banner_image`
--

CREATE TABLE `banner_image` (
  `banner_image_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banner_image`
--

INSERT INTO `banner_image` (`banner_image_id`, `banner_id`, `link`, `image`, `sort_order`) VALUES
(87, 6, 'index.php?route=product/manufacturer/info&amp;manufacturer_id=7', 'catalog/demo/compaq_presario.jpg', 0),
(94, 8, '', 'catalog/demo/manufacturer/nfl.png', 0),
(95, 8, '', 'catalog/demo/manufacturer/redbull.png', 0),
(96, 8, '', 'catalog/demo/manufacturer/sony.png', 0),
(91, 8, '', 'catalog/demo/manufacturer/cocacola.png', 0),
(92, 8, '', 'catalog/demo/manufacturer/burgerking.png', 0),
(93, 8, '', 'catalog/demo/manufacturer/canon.png', 0),
(88, 8, '', 'catalog/demo/manufacturer/harley.png', 0),
(89, 8, '', 'catalog/demo/manufacturer/dell.png', 0),
(90, 8, '', 'catalog/demo/manufacturer/disney.png', 0),
(97, 8, '', 'catalog/demo/manufacturer/starbucks.png', 0),
(98, 8, '', 'catalog/demo/manufacturer/nintendo.png', 0),
(164, 7, 'http://smartroom/index.php?route=product/category&amp;category_id=7', 'catalog/slider-img-1.jpg', 0),
(165, 7, 'http://smartroom/index.php?route=product/category&amp;category_id=8', 'catalog/slider-img-2.jpg', 1),
(166, 7, 'http://smartroom/index.php?route=product/category&amp;category_id=10', 'catalog/slider-img-3.jpg', 2),
(167, 7, 'http://smartroom/index.php?route=product/category&amp;category_id=11', 'catalog/slider-img-4.jpg', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `banner_image_description`
--

CREATE TABLE `banner_image_description` (
  `banner_image_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banner_image_description`
--

INSERT INTO `banner_image_description` (`banner_image_id`, `language_id`, `banner_id`, `title`) VALUES
(87, 1, 6, 'HP Banner'),
(93, 1, 8, 'Canon'),
(92, 1, 8, 'Burger King'),
(91, 1, 8, 'Coca Cola'),
(90, 1, 8, 'Disney'),
(89, 1, 8, 'Dell'),
(88, 1, 8, 'Harley Davidson'),
(94, 1, 8, 'NFL'),
(95, 1, 8, 'RedBull'),
(96, 1, 8, 'Sony'),
(97, 1, 8, 'Starbucks'),
(98, 1, 8, 'Nintendo'),
(164, 1, 7, 'Выберите интересуемую модель'),
(165, 1, 7, 'Выберите интересуемую модель'),
(166, 1, 7, 'Выберите интересуемую модель'),
(167, 1, 7, 'Выберите интересуемую модель');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `hover_image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `top` tinyint(1) NOT NULL,
  `column` int(3) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `add_parent` tinyint(4) NOT NULL DEFAULT '0',
  `repost_discount` int(255) NOT NULL DEFAULT '0',
  `repost_discount_type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `category_kod` varchar(255) DEFAULT NULL COMMENT '1C_business_key'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `image`, `hover_image`, `parent_id`, `top`, `column`, `sort_order`, `status`, `add_parent`, `repost_discount`, `repost_discount_type`, `date_added`, `date_modified`, `category_kod`) VALUES
(7, 'catalog/img-2.jpg', NULL, 0, 0, 0, 0, 1, 0, 0, 0, '2016-08-13 16:36:58', '2016-08-13 21:40:31', NULL),
(8, 'catalog/froz.jpg', NULL, 0, 0, 0, 1, 1, 0, 0, 0, '2016-08-13 16:37:17', '2016-08-13 21:40:52', NULL),
(10, 'catalog/proj.jpg', NULL, 0, 0, 0, 2, 1, 0, 0, 0, '2016-08-13 16:37:46', '2016-08-13 21:41:00', NULL),
(11, 'catalog/photo.jpg', NULL, 0, 0, 0, 3, 1, 0, 0, 0, '2016-08-13 16:38:03', '2016-08-13 21:41:12', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category_description`
--

CREATE TABLE `category_description` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `single_name` varchar(255) DEFAULT NULL,
  `category_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_description`
--

INSERT INTO `category_description` (`category_id`, `language_id`, `name`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `single_name`, `category_title`) VALUES
(7, 1, 'Телевизоры', '', '', '', '', NULL, NULL),
(8, 1, 'Холодильники', '', '', '', '', NULL, NULL),
(10, 1, 'Проекторы', '', '', '', '', NULL, NULL),
(11, 1, 'Фотоаппараты', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category_path`
--

CREATE TABLE `category_path` (
  `category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_path`
--

INSERT INTO `category_path` (`category_id`, `path_id`, `level`) VALUES
(7, 7, 0),
(8, 8, 0),
(10, 10, 0),
(11, 11, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `category_to_layout`
--

CREATE TABLE `category_to_layout` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_to_layout`
--

INSERT INTO `category_to_layout` (`category_id`, `store_id`, `layout_id`) VALUES
(7, 0, 0),
(8, 0, 0),
(10, 0, 0),
(11, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `category_to_store`
--

CREATE TABLE `category_to_store` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_to_store`
--

INSERT INTO `category_to_store` (`category_id`, `store_id`) VALUES
(7, 0),
(8, 0),
(10, 0),
(11, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`country_id`, `name`, `iso_code_2`, `iso_code_3`, `address_format`, `postcode_required`, `status`) VALUES
(20, 'Белоруссия (Беларусь)', 'BY', 'BLR', '', 0, 1),
(80, 'Грузия', 'GE', 'GEO', '', 0, 1),
(109, 'Казахстан', 'KZ', 'KAZ', '', 0, 1),
(115, 'Киргизия (Кыргызстан)', 'KG', 'KGZ', '', 0, 1),
(176, 'Российская Федерация', 'RU', 'RUS', '', 0, 1),
(220, 'Украина', 'UA', 'UKR', '', 0, 1),
(226, 'Узбекистан', 'UZ', 'UZB', '', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` char(1) NOT NULL,
  `discount` decimal(15,4) NOT NULL,
  `logged` tinyint(1) NOT NULL,
  `shipping` tinyint(1) NOT NULL,
  `total` decimal(15,4) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `uses_total` int(11) NOT NULL,
  `uses_customer` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `name`, `code`, `type`, `discount`, `logged`, `shipping`, `total`, `date_start`, `date_end`, `uses_total`, `uses_customer`, `status`, `date_added`) VALUES
(1, 'Тест', '22321', 'P', '2.0000', 0, 0, '0.0000', '2015-07-24 00:00:00', '2015-08-24 00:00:00', 15, '1', 1, '2015-07-24 11:54:55');

-- --------------------------------------------------------

--
-- Структура таблицы `coupon_category`
--

CREATE TABLE `coupon_category` (
  `coupon_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coupon_category`
--

INSERT INTO `coupon_category` (`coupon_id`, `category_id`) VALUES
(1, 63);

-- --------------------------------------------------------

--
-- Структура таблицы `coupon_history`
--

CREATE TABLE `coupon_history` (
  `coupon_history_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `amount` decimal(15,4) DEFAULT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `coupon_product`
--

CREATE TABLE `coupon_product` (
  `coupon_product_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coupon_product`
--

INSERT INTO `coupon_product` (`coupon_product_id`, `coupon_id`, `product_id`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(12) NOT NULL,
  `symbol_right` varchar(12) NOT NULL,
  `decimal_place` char(1) NOT NULL,
  `value` float(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`currency_id`, `title`, `code`, `symbol_left`, `symbol_right`, `decimal_place`, `value`, `status`, `date_modified`) VALUES
(1, 'Гривна', 'грн', '', 'грн.', '2', 1.00000000, 1, '2016-08-13 14:21:03');

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `cart` text,
  `wishlist` text,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `safe` tinyint(1) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `secondname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `warehouse` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `own_referal` varchar(255) NOT NULL,
  `referal_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_activity`
--

CREATE TABLE `customer_activity` (
  `activity_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `data` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_ban_ip`
--

CREATE TABLE `customer_ban_ip` (
  `customer_ban_ip_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_group`
--

CREATE TABLE `customer_group` (
  `customer_group_id` int(11) NOT NULL,
  `approval` int(1) NOT NULL,
  `sort_order` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_group_description`
--

CREATE TABLE `customer_group_description` (
  `customer_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_history`
--

CREATE TABLE `customer_history` (
  `customer_history_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_ip`
--

CREATE TABLE `customer_ip` (
  `customer_ip_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_login`
--

CREATE TABLE `customer_login` (
  `customer_login_id` int(11) NOT NULL,
  `email` varchar(96) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `total` int(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_online`
--

CREATE TABLE `customer_online` (
  `ip` varchar(40) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `referer` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_reward`
--

CREATE TABLE `customer_reward` (
  `customer_reward_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `points` int(8) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_social`
--

CREATE TABLE `customer_social` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `network` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_transaction`
--

CREATE TABLE `customer_transaction` (
  `customer_transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_field`
--

CREATE TABLE `custom_field` (
  `custom_field_id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `value` text NOT NULL,
  `location` varchar(7) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort_order` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_field_customer_group`
--

CREATE TABLE `custom_field_customer_group` (
  `custom_field_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `required` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_field_description`
--

CREATE TABLE `custom_field_description` (
  `custom_field_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_field_value`
--

CREATE TABLE `custom_field_value` (
  `custom_field_value_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_field_value_description`
--

CREATE TABLE `custom_field_value_description` (
  `custom_field_value_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `download`
--

CREATE TABLE `download` (
  `download_id` int(11) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `mask` varchar(128) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `download_description`
--

CREATE TABLE `download_description` (
  `download_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `trigger` text NOT NULL,
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `extension`
--

CREATE TABLE `extension` (
  `extension_id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `extension`
--

INSERT INTO `extension` (`extension_id`, `type`, `code`) VALUES
(1, 'payment', 'liqpay'),
(2, 'module', 'carousel'),
(3, 'module', 'html'),
(5, 'shipping', 'flat');

-- --------------------------------------------------------

--
-- Структура таблицы `geo_zone`
--

CREATE TABLE `geo_zone` (
  `geo_zone_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `geo_zone`
--

INSERT INTO `geo_zone` (`geo_zone_id`, `name`, `description`, `date_modified`, `date_added`) VALUES
(3, 'Зона НДС', 'Облагаемые НДС', '2014-09-09 11:48:13', '2014-05-21 22:30:20');

-- --------------------------------------------------------

--
-- Структура таблицы `import_log`
--

CREATE TABLE `import_log` (
  `id` int(11) NOT NULL,
  `import_date` datetime NOT NULL,
  `import_products` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `import_log`
--

INSERT INTO `import_log` (`id`, `import_date`, `import_products`) VALUES
(3, '2016-08-21 00:00:00', 'a:49:{i:0;a:2:{s:10:"product_id";i:102;s:12:"product_code";s:15:"R-T310ERU1-2PWH";}i:1;a:2:{s:10:"product_id";i:103;s:12:"product_code";s:15:"R-T310ERU1-2SLS";}i:2;a:2:{s:10:"product_id";i:104;s:12:"product_code";s:13:"R-Z400ERU9PWH";}i:3;a:2:{s:10:"product_id";i:105;s:12:"product_code";s:14:"R-VG400PUC3GBK";}i:4;a:2:{s:10:"product_id";i:106;s:12:"product_code";s:14:"R-VG440PUC3GBK";}i:5;a:2:{s:10:"product_id";i:107;s:12:"product_code";s:14:"R-VG470PUC3GBK";}i:6;a:2:{s:10:"product_id";i:108;s:12:"product_code";s:14:"R-VG470PUC3GBW";}i:7;a:2:{s:10:"product_id";i:109;s:12:"product_code";s:14:"R-V540PUC3KSLS";}i:8;a:2:{s:10:"product_id";i:110;s:12:"product_code";s:15:"R-V540PUC3KXINX";}i:9;a:2:{s:10:"product_id";i:111;s:12:"product_code";s:14:"R-V610PUC3KSLS";}i:10;a:2:{s:10:"product_id";i:112;s:12:"product_code";s:15:"R-V610PUC3KXINX";}i:11;a:2:{s:10:"product_id";i:113;s:12:"product_code";s:14:"R-V660PUC3KSLS";}i:12;a:2:{s:10:"product_id";i:114;s:12:"product_code";s:14:"R-VG540PUC3GBK";}i:13;a:2:{s:10:"product_id";i:115;s:12:"product_code";s:14:"R-VG540PUC3GGR";}i:14;a:2:{s:10:"product_id";i:116;s:12:"product_code";s:14:"R-VG610PUC3GBK";}i:15;a:2:{s:10:"product_id";i:117;s:12:"product_code";s:14:"R-VG610PUC3GGR";}i:16;a:2:{s:10:"product_id";i:118;s:12:"product_code";s:14:"R-VG660PUC3GBK";}i:17;a:2:{s:10:"product_id";i:119;s:12:"product_code";s:14:"R-VG660PUC3GGR";}i:18;a:2:{s:10:"product_id";i:120;s:12:"product_code";s:14:"R-WB480PUC2GBK";}i:19;a:2:{s:10:"product_id";i:121;s:12:"product_code";s:14:"R-WB480PUC2GBW";}i:20;a:2:{s:10:"product_id";i:122;s:12:"product_code";s:13:"R-WB480PUC2GS";}i:21;a:2:{s:10:"product_id";i:123;s:12:"product_code";s:14:"R-V720PUC1KSLS";}i:22;a:2:{s:10:"product_id";i:124;s:12:"product_code";s:14:"R-V720PUC1KTWH";}i:23;a:2:{s:10:"product_id";i:125;s:12:"product_code";s:13:"R-W610PUC4GBK";}i:24;a:2:{s:10:"product_id";i:126;s:12:"product_code";s:14:"R-WB550PUC2GBK";}i:25;a:2:{s:10:"product_id";i:127;s:12:"product_code";s:14:"R-WB550PUC2GBW";}i:26;a:2:{s:10:"product_id";i:128;s:12:"product_code";s:13:"R-WB550PUC2GS";}i:27;a:2:{s:10:"product_id";i:129;s:12:"product_code";s:15:"R-V720PUC1KXINX";}i:28;a:2:{s:10:"product_id";i:130;s:12:"product_code";s:13:"R-W660PUC3GBK";}i:29;a:2:{s:10:"product_id";i:131;s:12:"product_code";s:13:"R-W660PUC3INX";}i:30;a:2:{s:10:"product_id";i:132;s:12:"product_code";s:14:"R-V910PUC1KSLS";}i:31;a:2:{s:10:"product_id";i:133;s:12:"product_code";s:14:"R-V910PUC1KTWH";}i:32;a:2:{s:10:"product_id";i:134;s:12:"product_code";s:15:"R-V910PUC1KXINX";}i:33;a:2:{s:10:"product_id";i:135;s:12:"product_code";s:15:"R-W660FPUC3XGBK";}i:34;a:2:{s:10:"product_id";i:136;s:12:"product_code";s:15:"R-W660FPUC3XINX";}i:35;a:2:{s:10:"product_id";i:137;s:12:"product_code";s:13:"R-W720PUC1GBK";}i:36;a:2:{s:10:"product_id";i:138;s:12:"product_code";s:13:"R-W910PUC4GBK";}i:37;a:2:{s:10:"product_id";i:139;s:12:"product_code";s:13:"R-W910PUC4INX";}i:38;a:2:{s:10:"product_id";i:140;s:12:"product_code";s:15:"R-W720FPUC1XGBK";}i:39;a:2:{s:10:"product_id";i:141;s:12:"product_code";s:13:"R-S700PUC2GBK";}i:40;a:2:{s:10:"product_id";i:142;s:12:"product_code";s:12:"R-S700PUC2GS";}i:41;a:2:{s:10:"product_id";i:143;s:12:"product_code";s:13:"R-M700PUC2GBK";}i:42;a:2:{s:10:"product_id";i:144;s:12:"product_code";s:12:"R-M700PUC2GS";}i:43;a:2:{s:10:"product_id";i:145;s:12:"product_code";s:14:"R-S700GPUC2GBK";}i:44;a:2:{s:10:"product_id";i:146;s:12:"product_code";s:13:"R-S700GPUC2GS";}i:45;a:2:{s:10:"product_id";i:147;s:12:"product_code";s:14:"R-M700GPUC2GBK";}i:46;a:2:{s:10:"product_id";i:148;s:12:"product_code";s:13:"R-M700GPUC2GS";}i:47;a:2:{s:10:"product_id";i:149;s:12:"product_code";s:15:"R-M700GPUC2XMIR";}i:48;a:2:{s:10:"product_id";i:150;s:12:"product_code";s:16:"R-M700AGPUC4XMIR";}}'),
(9, '2016-08-21 00:00:00', 'a:3:{i:0;a:2:{s:10:"product_id";s:3:"146";s:12:"product_code";s:13:"R-S700GPUC2GS";}i:1;a:2:{s:10:"product_id";s:3:"149";s:12:"product_code";s:15:"R-M700GPUC2XMIR";}i:2;a:2:{s:10:"product_id";s:3:"150";s:12:"product_code";s:16:"R-M700AGPUC4XMIR";}}'),
(10, '2016-08-21 00:00:00', ''),
(11, '2016-08-21 00:00:00', 'a:1:{i:0;a:2:{s:10:"product_id";s:3:"149";s:12:"product_code";s:15:"R-M700GPUC2XMIR";}}'),
(12, '2016-08-21 00:00:11', ''),
(13, '2016-08-28 21:42:08', ''),
(14, '2016-08-28 22:55:43', '');

-- --------------------------------------------------------

--
-- Структура таблицы `information`
--

CREATE TABLE `information` (
  `information_id` int(11) NOT NULL,
  `is_bottom` int(1) NOT NULL DEFAULT '0',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `is_blog` int(1) NOT NULL DEFAULT '0',
  `is_publish` int(1) NOT NULL DEFAULT '0',
  `publish_date` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `is_add_form` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `information`
--

INSERT INTO `information` (`information_id`, `is_bottom`, `sort_order`, `is_blog`, `is_publish`, `publish_date`, `image`, `banner`, `is_add_form`) VALUES
(18, 0, 0, 0, 0, NULL, '', NULL, 0),
(19, 0, 0, 0, 0, NULL, 'catalog/ukraine-map.png', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `information_description`
--

CREATE TABLE `information_description` (
  `information_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `tags` varchar(64) DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `information_description`
--

INSERT INTO `information_description` (`information_id`, `language_id`, `title`, `short_description`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `tags`, `product_title`) VALUES
(18, 1, 'О нас', '', '&lt;p&gt;&lt;b&gt;smart-room&lt;/b&gt; никогда не был и не будет интернет-магазином. Вы не найдете на нашем сайте 100 тысяч наименований товара, но вы найдете здесь то, что Вам нужно. Совершенство определяется качеством, а не количеством.  Мы – Ваш персональный консультант в мире эксклюзивной качественной техники для дома, которая создана вызывать эмоции и восхищение! &lt;/p&gt;', 'О нас', '', '', NULL, NULL),
(19, 1, 'Доставка', '', ' &lt;h3&gt;САМОВЫВОЗ СО СКЛАДА&lt;/h3&gt;\r\n                    &lt;p&gt;Вы можете самостоятельно забрать вашу технику с нашего склада в г. Киев&lt;/p&gt;\r\n                    &lt;h3&gt;АДРЕСНАЯ ДОСТАВКА курьером&lt;/h3&gt;\r\n                    &lt;p&gt;Технику доставит выбранная вами курьерская служба доставки в кратчайшие сроки&lt;/p&gt;', 'Доставка', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `information_to_layout`
--

CREATE TABLE `information_to_layout` (
  `information_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `information_to_product`
--

CREATE TABLE `information_to_product` (
  `id` int(11) NOT NULL,
  `information_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `information_to_store`
--

CREATE TABLE `information_to_store` (
  `information_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `information_to_store`
--

INSERT INTO `information_to_store` (`information_id`, `store_id`) VALUES
(18, 0),
(19, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` varchar(64) NOT NULL,
  `directory` varchar(32) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`language_id`, `name`, `code`, `locale`, `image`, `directory`, `sort_order`, `status`) VALUES
(1, 'Russian', 'ru', 'ru_RU.UTF-8,ru_RU,russian', 'ru.png', 'russian', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `layout`
--

CREATE TABLE `layout` (
  `layout_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `layout`
--

INSERT INTO `layout` (`layout_id`, `name`) VALUES
(0, 'Default'),
(1, 'Home'),
(2, 'Product'),
(3, 'Category'),
(5, 'Manufacturer'),
(6, 'Account'),
(7, 'Checkout'),
(8, 'Contact'),
(9, 'Sitemap'),
(10, 'Affiliate'),
(11, 'Information'),
(12, 'Compare'),
(13, 'Search');

-- --------------------------------------------------------

--
-- Структура таблицы `layout_module`
--

CREATE TABLE `layout_module` (
  `layout_module_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `position` varchar(14) NOT NULL,
  `sort_order` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `layout_module`
--

INSERT INTO `layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
(8, 0, 'html.5', 'content_bottom', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `layout_route`
--

CREATE TABLE `layout_route` (
  `layout_route_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `geocode` varchar(32) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `open` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `marketing`
--

CREATE TABLE `marketing` (
  `marketing_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(64) NOT NULL,
  `clicks` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `modification`
--

CREATE TABLE `modification` (
  `modification_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  `version` varchar(32) NOT NULL,
  `link` varchar(255) NOT NULL,
  `xml` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(32) NOT NULL,
  `setting` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `module`
--

INSERT INTO `module` (`module_id`, `name`, `code`, `setting`) VALUES
(1, 'Карусель на главной', 'carousel', 'a:5:{s:4:"name";s:36:"Карусель на главной";s:9:"banner_id";s:1:"7";s:5:"width";s:4:"1200";s:6:"height";s:3:"650";s:6:"status";s:1:"1";}'),
(5, 'Главная', 'html', 'a:3:{s:4:"name";s:14:"Главная";s:18:"module_description";a:1:{i:1;a:2:{s:5:"title";s:14:"Главная";s:11:"description";s:2455:"&lt;p&gt;Свет играет важную роль в существовании нашей цивилизации. Это естественное явление, без которого невозможно делать элементарные повседневные действия: работать, полноценно общаться с людьми, свободно передвигаться по улице или помещению. &lt;br&gt;&lt;br&gt;Современные технологии сделали огромный шаг в развитии светового оборудования, которое применяется в различных сферах нашей жизни. Существуют осветительные приборы, которые применяются в узких назначениях, большинство из них мы созерцаем каждый день. Это уличные фонари, сверкающие рекламные вывески и витрины, шикарные потолки со всевозможными световыми эффектами.&lt;br&gt;&lt;br&gt;Широкий ассортимент товаров может удовлетворить потребности любого клиента, так как современные разработки имеют высокие&amp;nbsp; показатели. Они экономны, материалы, из которых они изготовлены, не несут вреда человеку и окружающей среде, высокое качество света приятно для человеческого глаза. Без проблем можно подобрать прожекторы для декоративного освещения фасадов, специальные лампы для производственных помещений, оборудовать офис эргономичными и долговечными светильниками, оборудовать свое жилище теплым и уютным светом.&lt;br&gt;&lt;br&gt;О преимуществах современной световой техники можно говорить много, но лучше убедиться в этом самостоятельно подобрав для себя необходимый товар.&lt;br&gt;&lt;/p&gt;";}}s:6:"status";s:1:"1";}');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `telephone` varchar(32) NOT NULL,
  `payment_method` varchar(128) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_address` varchar(128) DEFAULT NULL,
  `shipping_city` varchar(128) DEFAULT NULL,
  `shipping_warehouse` varchar(255) DEFAULT NULL,
  `comment` text,
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `order_status_id` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `shipping_method` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`order_id`, `store_id`, `customer_id`, `firstname`, `email`, `telephone`, `payment_method`, `is_paid`, `shipping_address`, `shipping_city`, `shipping_warehouse`, `comment`, `total`, `order_status_id`, `date_added`, `date_modified`, `shipping_method`) VALUES
(4, 0, 0, 'Виталий Шишов', '', '+380990367376', '', 0, NULL, '', '', NULL, '18500.0000', 2, '2016-08-24 22:10:18', '2016-08-24 22:18:18', ''),
(5, 0, 0, 'vitaliy', '', '0992993939454', NULL, 0, NULL, NULL, NULL, NULL, '10500.0000', 1, '2016-08-28 23:15:16', '2016-08-28 23:15:16', NULL),
(6, 0, 0, 'vitaliy', '', '0992993939454', NULL, 0, NULL, NULL, NULL, NULL, '10500.0000', 1, '2016-08-28 23:15:17', '2016-08-28 23:15:17', NULL),
(7, 0, 0, 'vitaliy', '', '0992993939454', NULL, 0, NULL, NULL, NULL, NULL, '10500.0000', 1, '2016-08-28 23:15:17', '2016-08-28 23:15:17', NULL),
(8, 0, 0, 'vitaliy', '', '0992993939454', NULL, 0, NULL, NULL, NULL, NULL, '10500.0000', 1, '2016-08-28 23:15:17', '2016-08-28 23:15:17', NULL),
(9, 0, 0, 'vitaliy', '', '+09929939394544553', '', 0, NULL, '', '', NULL, '10500.0000', 1, '2016-08-28 23:15:29', '2016-08-28 23:17:22', ''),
(10, 0, 0, 'vitaliy', '', '837474747433fdsfdsf', NULL, 0, NULL, NULL, NULL, NULL, '10500.0000', 1, '2016-08-28 23:18:57', '2016-08-28 23:18:57', NULL),
(11, 0, 0, 'vitaliy', '', '83747474743354543', NULL, 0, NULL, NULL, NULL, NULL, '10500.0000', 1, '2016-08-28 23:19:08', '2016-08-28 23:19:08', NULL),
(12, 0, 0, 'vitaliy', '', '83747474743354543', NULL, 0, NULL, NULL, NULL, NULL, '10500.0000', 1, '2016-08-28 23:19:17', '2016-08-28 23:19:17', NULL),
(13, 0, 0, 'fdsafas', '', 'ffdsafdsaffdsaf', NULL, 0, NULL, NULL, NULL, NULL, '10500.0000', 1, '2016-09-02 22:32:54', '2016-09-02 22:32:54', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `order_history`
--

CREATE TABLE `order_history` (
  `id` int(64) NOT NULL,
  `order_id` int(64) NOT NULL,
  `order_status_id` int(64) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_history`
--

INSERT INTO `order_history` (`id`, `order_id`, `order_status_id`, `comment`, `date_added`) VALUES
(1, 4, 2, '', '2016-08-24 22:12:01');

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_status_id` int(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(64) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_added` date NOT NULL,
  `date_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`order_product_id`, `order_id`, `product_id`, `order_status_id`, `name`, `model`, `quantity`, `price`, `total`, `date_added`, `date_modified`) VALUES
(3, 4, 103, 2, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '0000-00-00', NULL),
(4, 4, 3, 2, 'Samsung', 'KDL-42R553C', 1, '8000.0000', '8000.0000', '0000-00-00', NULL),
(5, 5, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '2016-08-28', '2016-08-28'),
(6, 6, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '2016-08-28', '2016-08-28'),
(7, 7, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '2016-08-28', '2016-08-28'),
(8, 8, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '2016-08-28', '2016-08-28'),
(10, 9, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '0000-00-00', NULL),
(11, 10, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '2016-08-28', '2016-08-28'),
(12, 11, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '2016-08-28', '2016-08-28'),
(13, 12, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '2016-08-28', '2016-08-28'),
(14, 13, 103, 1, 'Холодильник Hitachi', 'R-T310', 1, '10500.0000', '10500.0000', '2016-09-02', '2016-09-02');

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `sort_order` int(64) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `language_id`, `name`, `sort_order`) VALUES
(1, 1, 'Новый заказ', 3),
(2, 1, 'В процессе', 2),
(3, 1, 'Ожидание оплаты', 1),
(4, 1, 'Завершенный заказ', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `order_voucher`
--

CREATE TABLE `order_voucher` (
  `order_voucher_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `from_name` varchar(64) NOT NULL,
  `from_email` varchar(96) NOT NULL,
  `to_name` varchar(64) NOT NULL,
  `to_email` varchar(96) NOT NULL,
  `voucher_theme_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `amount` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `param`
--

CREATE TABLE `param` (
  `param_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sort_order` int(255) NOT NULL,
  `is_description` tinyint(1) NOT NULL DEFAULT '0',
  `is_filter` int(1) NOT NULL,
  `is_in_category` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `param`
--

INSERT INTO `param` (`param_id`, `name`, `title`, `sort_order`, `is_description`, `is_filter`, `is_in_category`) VALUES
('obemholodilnoikameri(l)', 'Обьем холодильной камеры (л)', '', 2, 0, 0, 1),
('raspolojeniemorozilnoikameri', 'Расположение морозильной камеры', '', 3, 0, 0, 1),
('tipholodilnika', 'Тип холодильника', '', 4, 0, 0, 1),
('visota(sm)', 'Высота (см)', '', 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `param_filters`
--

CREATE TABLE `param_filters` (
  `id` int(11) NOT NULL,
  `param_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `min_value` varchar(255) DEFAULT NULL,
  `max_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `param_filters`
--

INSERT INTO `param_filters` (`id`, `param_id`, `title`, `min_value`, `max_value`) VALUES
(7, 'visota(sm)', '60-89         ', '60', '89'),
(8, 'visota(sm)', '90-119', '90', '119'),
(9, 'visota(sm)', '120-149', '120', '149'),
(10, 'visota(sm)', '150-179', '150', '179'),
(11, 'visota(sm)', ' 180-200', '180', '200'),
(12, 'visota(sm)', 'Свыше 200 ', '200', ''),
(13, 'obemholodilnoikameri(l)', 'Менее 130', '0', '130'),
(14, 'obemholodilnoikameri(l)', '130-249', '130', '249'),
(15, 'obemholodilnoikameri(l)', '250-349', '250', '349'),
(16, 'obemholodilnoikameri(l)', '350-400', '350', '400'),
(17, 'obemholodilnoikameri(l)', 'Более 400', '400', '9999'),
(18, 'raspolojeniemorozilnoikameri', 'Верхнее', 'Верхнее', ''),
(19, 'raspolojeniemorozilnoikameri', 'Нижнее', 'Нижнее', ''),
(20, 'raspolojeniemorozilnoikameri', 'Сбоку', 'Сбоку', ''),
(21, 'raspolojeniemorozilnoikameri', 'Отсутствует', 'Отсутствует', ''),
(27, 'tipholodilnika', 'Однокамерный', 'Однокамерный', ''),
(28, 'tipholodilnika', 'Двухкамерный', 'Двухкамерный', ''),
(29, 'tipholodilnika', 'Многодверный', 'Многодверный', ''),
(30, 'tipholodilnika', 'Холодильник для вина', 'Холодильник для вина', ''),
(31, 'tipholodilnika', 'Side-by-side', 'Side-by-side', '');

-- --------------------------------------------------------

--
-- Структура таблицы `param_to_category`
--

CREATE TABLE `param_to_category` (
  `id` int(255) NOT NULL,
  `param_id` varchar(255) NOT NULL,
  `category_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `param_to_category`
--

INSERT INTO `param_to_category` (`id`, `param_id`, `category_id`) VALUES
(25, 'visota(sm)', 8),
(26, 'obemholodilnoikameri(l)', 8),
(27, 'raspolojeniemorozilnoikameri', 8),
(29, 'tipholodilnika', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `param_value`
--

CREATE TABLE `param_value` (
  `id` int(11) NOT NULL,
  `param_value_id` varchar(255) NOT NULL,
  `param_id` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `param_value_kod` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `param_value`
--

INSERT INTO `param_value` (`id`, `param_value_id`, `param_id`, `value`, `param_value_kod`) VALUES
(41, 'visota(sm)-62', 'visota(sm)', '62', NULL),
(42, 'visota(sm)-90', 'visota(sm)', '90', NULL),
(43, 'visota(sm)-125', 'visota(sm)', '125', NULL),
(44, 'visota(sm)-159', 'visota(sm)', '159', NULL),
(45, 'visota(sm)-190', 'visota(sm)', '190', NULL),
(46, 'visota(sm)-220', 'visota(sm)', '220', NULL),
(47, 'obemholodilnoikameri(l)-120', 'obemholodilnoikameri(l)', '120', NULL),
(48, 'obemholodilnoikameri(l)-180', 'obemholodilnoikameri(l)', '180', NULL),
(49, 'obemholodilnoikameri(l)-250', 'obemholodilnoikameri(l)', '250', NULL),
(50, 'obemholodilnoikameri(l)-380', 'obemholodilnoikameri(l)', '380', NULL),
(51, 'obemholodilnoikameri(l)-420', 'obemholodilnoikameri(l)', '420', NULL),
(52, 'raspolojeniemorozilnoikameri-verhnee', 'raspolojeniemorozilnoikameri', 'Верхнее', NULL),
(53, 'raspolojeniemorozilnoikameri-nijnee', 'raspolojeniemorozilnoikameri', 'Нижнее', NULL),
(54, 'raspolojeniemorozilnoikameri-sboky', 'raspolojeniemorozilnoikameri', 'Сбоку', NULL),
(55, 'raspolojeniemorozilnoikameri-otsytstvyet', 'raspolojeniemorozilnoikameri', 'Отсутствует', NULL),
(56, 'tipholodilnika-odnokamernii', 'tipholodilnika', 'Однокамерный', NULL),
(57, 'tipholodilnika-dvyhkamernii', 'tipholodilnika', 'Двухкамерный', NULL),
(58, 'tipholodilnika-mnogodvernii', 'tipholodilnika', 'Многодверный', NULL),
(59, 'tipholodilnika-holodilnik-dlya-vina', 'tipholodilnika', 'Холодильник для вина', NULL),
(60, 'tipholodilnika-side-by-side', 'tipholodilnika', 'Side-by-side', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `param_value_to_product`
--

CREATE TABLE `param_value_to_product` (
  `id` int(11) NOT NULL,
  `param_value_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `param_value_to_product`
--

INSERT INTO `param_value_to_product` (`id`, `param_value_id`, `product_id`) VALUES
(6, 'obemholodilnoikameri(l)-120', 102),
(7, 'raspolojeniemorozilnoikameri-verhnee', 102),
(8, 'tipholodilnika-holodilnik-dlya-vina', 102),
(9, 'visota(sm)-159', 102),
(10, 'obemholodilnoikameri(l)-380', 103),
(11, 'raspolojeniemorozilnoikameri-sboky', 103),
(12, 'tipholodilnika-side-by-side', 103),
(13, 'visota(sm)-190', 103),
(14, 'obemholodilnoikameri(l)-380', 104),
(15, 'raspolojeniemorozilnoikameri-verhnee', 104),
(16, 'tipholodilnika-holodilnik-dlya-vina', 104),
(17, 'visota(sm)-125', 104),
(18, 'obemholodilnoikameri(l)-420', 105),
(19, 'raspolojeniemorozilnoikameri-sboky', 105),
(20, 'tipholodilnika-mnogodvernii', 105),
(21, 'visota(sm)-220', 105),
(22, 'obemholodilnoikameri(l)-380', 106),
(23, 'raspolojeniemorozilnoikameri-otsytstvyet', 106),
(24, 'tipholodilnika-odnokamernii', 106),
(25, 'visota(sm)-125', 106),
(26, 'obemholodilnoikameri(l)-380', 107),
(27, 'raspolojeniemorozilnoikameri-sboky', 107),
(28, 'tipholodilnika-side-by-side', 107),
(29, 'visota(sm)-190', 107),
(30, 'obemholodilnoikameri(l)-250', 108),
(31, 'raspolojeniemorozilnoikameri-verhnee', 108),
(32, 'tipholodilnika-mnogodvernii', 108),
(33, 'visota(sm)-125', 108),
(34, 'obemholodilnoikameri(l)-250', 109),
(35, 'raspolojeniemorozilnoikameri-otsytstvyet', 109),
(36, 'tipholodilnika-mnogodvernii', 109),
(37, 'visota(sm)-90', 109),
(38, 'obemholodilnoikameri(l)-380', 110),
(39, 'raspolojeniemorozilnoikameri-nijnee', 110),
(40, 'tipholodilnika-side-by-side', 110),
(41, 'visota(sm)-90', 110),
(42, 'obemholodilnoikameri(l)-380', 111),
(43, 'raspolojeniemorozilnoikameri-sboky', 111),
(44, 'tipholodilnika-holodilnik-dlya-vina', 111),
(45, 'visota(sm)-90', 111);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `model` varchar(64) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_available` datetime NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `product_kod` varchar(255) DEFAULT NULL,
  `article` varchar(255) DEFAULT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`product_id`, `model`, `image`, `price`, `date_available`, `sort_order`, `status`, `date_added`, `date_modified`, `product_kod`, `article`, `in_stock`) VALUES
(1, 'KDL-40R553C', 'catalog/category-item-img.png', '10500.0000', '0000-00-00 00:00:00', 1, 1, '2016-08-14 21:28:30', '0000-00-00 00:00:00', NULL, '', 1),
(2, 'KDL-41R553C', 'catalog/category-item-img.png', '9500.0000', '0000-00-00 00:00:00', 1, 1, '2016-08-14 21:30:44', '0000-00-00 00:00:00', NULL, '', 1),
(3, 'KDL-42R553C', 'catalog/category-item-img.png', '8000.0000', '0000-00-00 00:00:00', 1, 1, '2016-08-14 21:31:41', '2016-08-17 07:52:48', NULL, '', 1),
(102, 'R-T310', 'catalog/froz.jpg', '10500.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:12', '2016-08-21 14:14:33', 'R-T310ERU1-2PWH', '', 1),
(103, 'R-T310', 'catalog/froz.jpg', '10500.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:12', '2016-08-21 14:14:49', 'R-T310ERU1-2SLS', '', 1),
(104, 'R-Z400', 'catalog/froz.jpg', '11700.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:13', '2016-08-21 14:15:05', 'R-Z400ERU9PWH', '', 1),
(105, 'R-VG400', 'catalog/froz.jpg', '18699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:13', '2016-08-21 14:15:37', 'R-VG400PUC3GBK', '', 1),
(106, 'R-VG440', 'catalog/froz.jpg', '19999.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:14', '2016-08-21 14:15:55', 'R-VG440PUC3GBK', '', 1),
(107, 'R-VG470', 'catalog/froz.jpg', '20999.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:14', '2016-08-21 14:16:16', 'R-VG470PUC3GBK', '', 1),
(108, 'R-VG470', 'catalog/froz.jpg', '20999.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:14', '2016-08-21 14:16:31', 'R-VG470PUC3GBW', '', 1),
(109, 'R-V540', 'catalog/froz.jpg', '21699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:15', '2016-08-21 14:16:54', 'R-V540PUC3KSLS', '', 1),
(110, 'R-V540', 'catalog/froz.jpg', '21699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:15', '2016-08-21 14:17:16', 'R-V540PUC3KXINX', '', 1),
(111, 'R-V610', 'catalog/froz.jpg', '22999.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:15', '2016-08-21 14:17:35', 'R-V610PUC3KSLS', '', 1),
(112, 'R-V610', '', '23199.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:15', '0000-00-00 00:00:00', 'R-V610PUC3KXINX', '', 1),
(113, 'R-V660', '', '24299.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:16', '0000-00-00 00:00:00', 'R-V660PUC3KSLS', '', 1),
(114, 'R-VG540', '', '24299.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:16', '0000-00-00 00:00:00', 'R-VG540PUC3GBK', '', 1),
(115, 'R-VG540', '', '24299.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:16', '0000-00-00 00:00:00', 'R-VG540PUC3GGR', '', 1),
(116, 'R-VG610', '', '25499.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:16', '0000-00-00 00:00:00', 'R-VG610PUC3GBK', '', 1),
(117, 'R-VG610', '', '25499.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:17', '0000-00-00 00:00:00', 'R-VG610PUC3GGR', '', 1),
(118, 'R-VG660', '', '26299.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:17', '0000-00-00 00:00:00', 'R-VG660PUC3GBK', '', 1),
(119, 'R-VG660', '', '26299.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:17', '0000-00-00 00:00:00', 'R-VG660PUC3GGR', '', 1),
(120, 'R-WB480', '', '26799.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:17', '0000-00-00 00:00:00', 'R-WB480PUC2GBK', '', 1),
(121, 'R-WB480', '', '26799.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:18', '0000-00-00 00:00:00', 'R-WB480PUC2GBW', '', 1),
(122, 'R-WB480', '', '26799.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:18', '0000-00-00 00:00:00', 'R-WB480PUC2GS', '', 1),
(123, 'R-V720', '', '26799.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:18', '0000-00-00 00:00:00', 'R-V720PUC1KSLS', '', 1),
(124, 'R-V720', '', '26799.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:19', '0000-00-00 00:00:00', 'R-V720PUC1KTWH', '', 1),
(125, 'R-W610', '', '28599.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:19', '0000-00-00 00:00:00', 'R-W610PUC4GBK', '', 1),
(126, 'R-WB550', '', '28699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:19', '0000-00-00 00:00:00', 'R-WB550PUC2GBK', '', 1),
(127, 'R-WB550', '', '28699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:20', '0000-00-00 00:00:00', 'R-WB550PUC2GBW', '', 1),
(128, 'R-WB550', '', '28699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:20', '0000-00-00 00:00:00', 'R-WB550PUC2GS', '', 1),
(129, 'R-V720', '', '29399.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:20', '0000-00-00 00:00:00', 'R-V720PUC1KXINX', '', 1),
(130, 'R-W660', '', '30099.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:21', '0000-00-00 00:00:00', 'R-W660PUC3GBK', '', 1),
(131, 'R-W660', '', '30099.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:21', '0000-00-00 00:00:00', 'R-W660PUC3INX', '', 1),
(132, 'R-V910', '', '31299.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:21', '0000-00-00 00:00:00', 'R-V910PUC1KSLS', '', 1),
(133, 'R-V910', '', '31299.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:22', '0000-00-00 00:00:00', 'R-V910PUC1KTWH', '', 1),
(134, 'R-V910', '', '31899.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:22', '0000-00-00 00:00:00', 'R-V910PUC1KXINX', '', 1),
(135, 'R-W660F', '', '32699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:22', '0000-00-00 00:00:00', 'R-W660FPUC3XGBK', '', 1),
(136, 'R-W660F', '', '32699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:22', '0000-00-00 00:00:00', 'R-W660FPUC3XINX', '', 1),
(137, 'R-W720', '', '35099.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:23', '0000-00-00 00:00:00', 'R-W720PUC1GBK', '', 1),
(138, 'R-W910', '', '36999.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:23', '0000-00-00 00:00:00', 'R-W910PUC4GBK', '', 1),
(139, 'R-W910', '', '36999.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:23', '0000-00-00 00:00:00', 'R-W910PUC4INX', '', 1),
(140, 'R-W720F', '', '37699.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:23', '0000-00-00 00:00:00', 'R-W720FPUC1XGBK', '', 1),
(141, 'R-S700', '', '39599.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:24', '0000-00-00 00:00:00', 'R-S700PUC2GBK', '', 1),
(142, 'R-S700', '', '39599.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:24', '0000-00-00 00:00:00', 'R-S700PUC2GS', '', 1),
(143, 'R-M700', '', '48499.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:24', '0000-00-00 00:00:00', 'R-M700PUC2GBK', '', 1),
(144, 'R-M700', '', '48499.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:24', '0000-00-00 00:00:00', 'R-M700PUC2GS', '', 1),
(145, 'R-S700GP', '', '48499.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:25', '0000-00-00 00:00:00', 'R-S700GPUC2GBK', '', 1),
(146, 'R-S700GP', '', '10000.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:25', '0000-00-00 00:00:00', 'R-S700GPUC2GS', '', 1),
(147, 'R-M700GP', '', '60599.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:25', '0000-00-00 00:00:00', 'R-M700GPUC2GBK', '', 1),
(148, 'R-M700GP', '', '60599.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:25', '0000-00-00 00:00:00', 'R-M700GPUC2GS', '', 1),
(149, 'R-M700GP_X', '', '70000.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:26', '0000-00-00 00:00:00', 'R-M700GPUC2XMIR', '', 1),
(150, 'R-M700AGP_X', '', '45000.0000', '0000-00-00 00:00:00', 0, 1, '2016-08-21 00:23:26', '0000-00-00 00:00:00', 'R-M700AGPUC4XMIR', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_description`
--

CREATE TABLE `product_description` (
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tag` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `product_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_description`
--

INSERT INTO `product_description` (`product_id`, `language_id`, `name`, `description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`, `product_title`) VALUES
(1, 1, 'Sony', '', '', 'sony', '', '', NULL),
(2, 1, 'Sony', '', '', 'Sony', '', '', NULL),
(3, 1, 'Samsung', 'Телевизор SONY KDL32R503CBR обеспечит вам комфортный просмотр ваших любимых телепередач как в будний день, так и в выходной. Простой и стильный дизайн телевизора отлично подойдёт к любому оформлению комнаты. Сам корпус телевизора представлен в двух расцветках: черный и серебристый. Красивое и реалистичное изображение обеспечит 32-дюймовый экран, выполненный по технологии LED с разрешением HD 1366х768. Данная модель обладает углом обзора 178 градусов, что позволяет смотреть телевизор из любой удобной для вас позиции. Матовое покрытие экрана минимализирует блики, как от света, так и от солнца и от внутрикомнатных ламп, гарантируя чистую картинку без бликов и отсвечиваний. Обновление экрана с частотой 50 Гц дает возможность защитить глаза от утомления.', '', 'Samsung', '', '', NULL),
(102, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(103, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(104, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(105, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(106, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(107, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(108, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(109, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(110, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(111, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(112, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(113, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(114, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(115, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(116, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(117, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(118, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(119, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(120, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(121, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(122, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(123, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(124, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(125, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(126, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(127, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(128, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(129, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(130, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(131, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(132, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(133, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(134, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(135, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(136, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(137, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(138, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(139, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(140, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(141, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(142, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(143, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(144, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(145, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(146, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(147, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(148, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(149, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL),
(150, 1, 'Холодильник Hitachi', '', '', 'Холодильник Hitachi', 'Холодильник Hitachi', 'Холодильник Hitachi', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `image`, `sort_order`) VALUES
(1, 1, 'catalog/category-item-img.png', 1),
(2, 1, 'catalog/category-item-img.png', 2),
(15, 3, 'catalog/category-item-img.png', 1),
(16, 3, 'catalog/category-item-img.png', 2),
(17, 3, 'catalog/category-item-img.png', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `product_special`
--

CREATE TABLE `product_special` (
  `product_special_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_special`
--

INSERT INTO `product_special` (`product_special_id`, `product_id`, `customer_group_id`, `priority`, `price`, `date_start`, `date_end`) VALUES
(3, 3, NULL, 1, '9000.0000', '2016-08-17 00:00:00', '2016-08-31 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `product_to_category`
--

CREATE TABLE `product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_to_category`
--

INSERT INTO `product_to_category` (`product_id`, `category_id`, `is_main`) VALUES
(1, 7, 0),
(2, 7, 0),
(3, 7, 0),
(102, 8, 0),
(103, 8, 0),
(104, 8, 0),
(105, 8, 0),
(106, 8, 0),
(107, 8, 0),
(108, 8, 0),
(109, 8, 0),
(110, 8, 0),
(111, 8, 0),
(112, 8, 0),
(113, 8, 0),
(114, 8, 0),
(115, 8, 0),
(116, 8, 0),
(117, 8, 0),
(118, 8, 0),
(119, 8, 0),
(120, 8, 0),
(121, 8, 0),
(122, 8, 0),
(123, 8, 0),
(124, 8, 0),
(125, 8, 0),
(126, 8, 0),
(127, 8, 0),
(128, 8, 0),
(129, 8, 0),
(130, 8, 0),
(131, 8, 0),
(132, 8, 0),
(133, 8, 0),
(134, 8, 0),
(135, 8, 0),
(136, 8, 0),
(137, 8, 0),
(138, 8, 0),
(139, 8, 0),
(140, 8, 0),
(141, 8, 0),
(142, 8, 0),
(143, 8, 0),
(144, 8, 0),
(145, 8, 0),
(146, 8, 0),
(147, 8, 0),
(148, 8, 0),
(149, 8, 0),
(150, 8, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `product_to_layout`
--

CREATE TABLE `product_to_layout` (
  `product_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_to_layout`
--

INSERT INTO `product_to_layout` (`product_id`, `layout_id`) VALUES
(3, 0),
(102, 0),
(103, 0),
(104, 0),
(105, 0),
(106, 0),
(107, 0),
(108, 0),
(109, 0),
(110, 0),
(111, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `product_to_store`
--

CREATE TABLE `product_to_store` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_to_store`
--

INSERT INTO `product_to_store` (`product_id`, `store_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(102, 0),
(103, 0),
(104, 0),
(105, 0),
(106, 0),
(107, 0),
(108, 0),
(109, 0),
(110, 0),
(111, 0),
(112, 0),
(113, 0),
(114, 0),
(115, 0),
(116, 0),
(117, 0),
(118, 0),
(119, 0),
(120, 0),
(121, 0),
(122, 0),
(123, 0),
(124, 0),
(125, 0),
(126, 0),
(127, 0),
(128, 0),
(129, 0),
(130, 0),
(131, 0),
(132, 0),
(133, 0),
(134, 0),
(135, 0),
(136, 0),
(137, 0),
(138, 0),
(139, 0),
(140, 0),
(141, 0),
(142, 0),
(143, 0),
(144, 0),
(145, 0),
(146, 0),
(147, 0),
(148, 0),
(149, 0),
(150, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `return`
--

CREATE TABLE `return` (
  `return_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `product` varchar(255) NOT NULL,
  `model` varchar(64) NOT NULL,
  `quantity` int(4) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `return_reason_id` int(11) NOT NULL,
  `return_action_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `comment` text,
  `date_ordered` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `return_action`
--

CREATE TABLE `return_action` (
  `return_action_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `return_history`
--

CREATE TABLE `return_history` (
  `return_history_id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `return_reason`
--

CREATE TABLE `return_reason` (
  `return_reason_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `return_status`
--

CREATE TABLE `return_status` (
  `return_status_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `setting`
--

INSERT INTO `setting` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
(1, 0, 'shipping', 'shipping_sort_order', '3', 0),
(2, 0, 'sub_total', 'sub_total_sort_order', '1', 0),
(3, 0, 'sub_total', 'sub_total_status', '1', 0),
(5, 0, 'total', 'total_sort_order', '9', 0),
(6, 0, 'total', 'total_status', '1', 0),
(8, 0, 'free_checkout', 'free_checkout_sort_order', '1', 0),
(9, 0, 'cod', 'cod_sort_order', '5', 0),
(10, 0, 'cod', 'cod_total', '0.01', 0),
(11, 0, 'cod', 'cod_order_status_id', '1', 0),
(12, 0, 'cod', 'cod_geo_zone_id', '0', 0),
(13, 0, 'cod', 'cod_status', '1', 0),
(14, 0, 'shipping', 'shipping_status', '1', 0),
(15, 0, 'shipping', 'shipping_estimator', '1', 0),
(27, 0, 'coupon', 'coupon_sort_order', '4', 0),
(28, 0, 'coupon', 'coupon_status', '1', 0),
(42, 0, 'credit', 'credit_sort_order', '7', 0),
(43, 0, 'credit', 'credit_status', '1', 0),
(53, 0, 'reward', 'reward_sort_order', '2', 0),
(54, 0, 'reward', 'reward_status', '1', 0),
(146, 0, 'category', 'category_status', '1', 0),
(158, 0, 'account', 'account_status', '1', 0),
(159, 0, 'affiliate', 'affiliate_status', '1', 0),
(94, 0, 'voucher', 'voucher_sort_order', '8', 0),
(95, 0, 'voucher', 'voucher_status', '1', 0),
(103, 0, 'free_checkout', 'free_checkout_status', '1', 0),
(104, 0, 'free_checkout', 'free_checkout_order_status_id', '1', 0),
(50583, 0, 'liqpay', 'liqpay_status', '1', 0),
(50582, 0, 'liqpay', 'liqpay_geo_zone_id', '0', 0),
(50581, 0, 'liqpay', 'liqpay_order_status_id', '2', 0),
(50580, 0, 'liqpay', 'liqpay_total', '', 0),
(50578, 0, 'liqpay', 'liqpay_action', 'https://www.liqpay.com/api/checkout', 0),
(50579, 0, 'liqpay', 'liqpay_pay_way', 'card,privat24,', 0),
(62587, 0, 'config', 'config_meta_keyword_blog', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ', 0),
(62588, 0, 'config', 'config_meta_title_search', 'Поиск', 0),
(62589, 0, 'config', 'config_meta_description_search', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ', 0),
(62590, 0, 'config', 'config_meta_keyword_search', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ', 0),
(62591, 0, 'social', 'social_facebook', '', 0),
(62592, 0, 'social', 'social_vkontakte', '', 0),
(62593, 0, 'social', 'social_instagram', '', 0),
(50577, 0, 'liqpay', 'liqpay_private_key', 'n08VQcWohnlqyDvj9pKlKsxDjbeKaKbKVuHdFQKq', 0),
(50576, 0, 'liqpay', 'liqpay_public_key', 'i48274333880', 0),
(50584, 0, 'liqpay', 'liqpay_language', 'ru', 0),
(50585, 0, 'liqpay', 'liqpay_sort_order', '', 0),
(50586, 0, 'liqpay', 'liqpay_sandbox', '1', 0),
(62586, 0, 'config', 'config_meta_description_blog', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ', 0),
(62584, 0, 'config', 'config_meta_keyword_product', '', 0),
(62585, 0, 'config', 'config_meta_title_blog', 'Новости', 0),
(62581, 0, 'config', 'config_meta_keyword_category', 'smart-room', 0),
(62582, 0, 'config', 'config_meta_title_product', 'Купить %%name%%  — цена от smart-room', 0),
(62583, 0, 'config', 'config_meta_description_product', 'Покупайте %name% от компании smart-room прямо сейчас!', 0),
(62580, 0, 'config', 'config_meta_description_category', ' Покупайте %%name%% от компании smart-room прямо сейчас!', 0),
(62579, 0, 'config', 'config_meta_title_category', '%%name%% купить в Киеве оптом и в розницу, цена — smart-room', 0),
(62576, 0, 'config', 'config_meta_title_main', 'smart-room', 0),
(62577, 0, 'config', 'config_meta_description_main', 'smart-room', 0),
(62578, 0, 'config', 'config_meta_keyword_main', 'smart-room', 0),
(62554, 0, 'config', 'config_maintenance', '0', 0),
(62555, 0, 'config', 'config_password', '0', 0),
(62556, 0, 'config', 'config_encryption', '5daf19bb190c9048dc1db57515a089f0', 0),
(62557, 0, 'config', 'config_compression', '0', 0),
(62558, 0, 'config', 'config_error_display', '1', 0),
(62559, 0, 'config', 'config_error_log', '1', 0),
(62560, 0, 'config', 'config_error_filename', 'error.log', 0),
(62561, 0, 'config', 'config_google_map', '', 0),
(62562, 0, 'config', 'config_social_share_js', '', 0),
(62563, 0, 'config', 'config_social_share_buttons', '', 0),
(62564, 0, 'config', 'config_apikey_novaposhta', '341f35ecd3e40ff6ce6eda8fbda50393', 0),
(62565, 0, 'config', 'config_turbosms_login', 'evrosvet', 0),
(62566, 0, 'config', 'config_turbosms_password', '854461', 0),
(62567, 0, 'config', 'config_sms_phones', '', 0),
(62568, 0, 'config', 'config_client_sms_text', 'Заказ №%order_id% успешно оформлен', 0),
(62569, 0, 'config', 'config_admin_sms_text', '', 0),
(62570, 0, 'config', 'config_about_information', '18', 0),
(62571, 0, 'config', 'config_delivery_information', '19', 0),
(62572, 0, 'config', 'config_seo_google', '', 0),
(62573, 0, 'config', 'config_seo_yandex', '', 0),
(62550, 0, 'config', 'config_seo_url', '0', 0),
(62551, 0, 'config', 'config_file_max_size', '300000', 0),
(62552, 0, 'config', 'config_file_ext_allowed', 'zip\r\ntxt\r\npng\r\njpe\r\njpeg\r\njpg\r\ngif\r\nbmp\r\nico\r\ntiff\r\ntif\r\nsvg\r\nsvgz\r\nzip\r\nrar\r\nmsi\r\ncab\r\nmp3\r\nqt\r\nmov\r\npdf\r\npsd\r\nai\r\neps\r\nps\r\ndoc', 0),
(62553, 0, 'config', 'config_file_mime_allowed', 'text/plain\r\nimage/png\r\nimage/jpeg\r\nimage/gif\r\nimage/bmp\r\nimage/ico\r\nimage/tiff\r\nimage/svg+xml\r\napplication/zip\r\n&quot;application/zip&quot;\r\napplication/x-zip\r\n&quot;application/x-zip&quot;\r\napplication/x-zip-compressed\r\n&quot;application/x-zip-compressed&quot;\r\napplication/rar\r\n&quot;application/rar&quot;\r\napplication/x-rar\r\n&quot;application/x-rar&quot;\r\napplication/x-rar-compressed\r\n&quot;application/x-rar-compressed&quot;\r\napplication/octet-stream\r\n&quot;application/octet-stream&quot;\r\naudio/mpeg\r\nvideo/quicktime\r\napplication/pdf', 0),
(62547, 0, 'config', 'config_secure', '0', 0),
(62548, 0, 'config', 'config_shared', '0', 0),
(62549, 0, 'config', 'config_robots', 'abot\r\ndbot\r\nebot\r\nhbot\r\nkbot\r\nlbot\r\nmbot\r\nnbot\r\nobot\r\npbot\r\nrbot\r\nsbot\r\ntbot\r\nvbot\r\nybot\r\nzbot\r\nbot.\r\nbot/\r\n_bot\r\n.bot\r\n/bot\r\n-bot\r\n:bot\r\n(bot\r\ncrawl\r\nslurp\r\nspider\r\nseek\r\naccoona\r\nacoon\r\nadressendeutschland\r\nah-ha.com\r\nahoy\r\naltavista\r\nananzi\r\nanthill\r\nappie\r\narachnophilia\r\narale\r\naraneo\r\naranha\r\narchitext\r\naretha\r\narks\r\nasterias\r\natlocal\r\natn\r\natomz\r\naugurfind\r\nbackrub\r\nbannana_bot\r\nbaypup\r\nbdfetch\r\nbig brother\r\nbiglotron\r\nbjaaland\r\nblackwidow\r\nblaiz\r\nblog\r\nblo.\r\nbloodhound\r\nboitho\r\nbooch\r\nbradley\r\nbutterfly\r\ncalif\r\ncassandra\r\nccubee\r\ncfetch\r\ncharlotte\r\nchurl\r\ncienciaficcion\r\ncmc\r\ncollective\r\ncomagent\r\ncombine\r\ncomputingsite\r\ncsci\r\ncurl\r\ncusco\r\ndaumoa\r\ndeepindex\r\ndelorie\r\ndepspid\r\ndeweb\r\ndie blinde kuh\r\ndigger\r\nditto\r\ndmoz\r\ndocomo\r\ndownload express\r\ndtaagent\r\ndwcp\r\nebiness\r\nebingbong\r\ne-collector\r\nejupiter\r\nemacs-w3 search engine\r\nesther\r\nevliya celebi\r\nezresult\r\nfalcon\r\nfelix ide\r\nferret\r\nfetchrover\r\nfido\r\nfindlinks\r\nfireball\r\nfish search\r\nfouineur\r\nfunnelweb\r\ngazz\r\ngcreep\r\ngenieknows\r\ngetterroboplus\r\ngeturl\r\nglx\r\ngoforit\r\ngolem\r\ngrabber\r\ngrapnel\r\ngralon\r\ngriffon\r\ngromit\r\ngrub\r\ngulliver\r\nhamahakki\r\nharvest\r\nhavindex\r\nhelix\r\nheritrix\r\nhku www octopus\r\nhomerweb\r\nhtdig\r\nhtml index\r\nhtml_analyzer\r\nhtmlgobble\r\nhubater\r\nhyper-decontextualizer\r\nia_archiver\r\nibm_planetwide\r\nichiro\r\niconsurf\r\niltrovatore\r\nimage.kapsi.net\r\nimagelock\r\nincywincy\r\nindexer\r\ninfobee\r\ninformant\r\ningrid\r\ninktomisearch.com\r\ninspector web\r\nintelliagent\r\ninternet shinchakubin\r\nip3000\r\niron33\r\nisraeli-search\r\nivia\r\njack\r\njakarta\r\njavabee\r\njetbot\r\njumpstation\r\nkatipo\r\nkdd-explorer\r\nkilroy\r\nknowledge\r\nkototoi\r\nkretrieve\r\nlabelgrabber\r\nlachesis\r\nlarbin\r\nlegs\r\nlibwww\r\nlinkalarm\r\nlink validator\r\nlinkscan\r\nlockon\r\nlwp\r\nlycos\r\nmagpie\r\nmantraagent\r\nmapoftheinternet\r\nmarvin/\r\nmattie\r\nmediafox\r\nmediapartners\r\nmercator\r\nmerzscope\r\nmicrosoft url control\r\nminirank\r\nmiva\r\nmj12\r\nmnogosearch\r\nmoget\r\nmonster\r\nmoose\r\nmotor\r\nmultitext\r\nmuncher\r\nmuscatferret\r\nmwd.search\r\nmyweb\r\nnajdi\r\nnameprotect\r\nnationaldirectory\r\nnazilla\r\nncsa beta\r\nnec-meshexplorer\r\nnederland.zoek\r\nnetcarta webmap engine\r\nnetmechanic\r\nnetresearchserver\r\nnetscoop\r\nnewscan-online\r\nnhse\r\nnokia6682/\r\nnomad\r\nnoyona\r\nnutch\r\nnzexplorer\r\nobjectssearch\r\noccam\r\nomni\r\nopen text\r\nopenfind\r\nopenintelligencedata\r\norb search\r\nosis-project\r\npack rat\r\npageboy\r\npagebull\r\npage_verifier\r\npanscient\r\nparasite\r\npartnersite\r\npatric\r\npear.\r\npegasus\r\nperegrinator\r\npgp key agent\r\nphantom\r\nphpdig\r\npicosearch\r\npiltdownman\r\npimptrain\r\npinpoint\r\npioneer\r\npiranha\r\nplumtreewebaccessor\r\npogodak\r\npoirot\r\npompos\r\npoppelsdorf\r\npoppi\r\npopular iconoclast\r\npsycheclone\r\npublisher\r\npython\r\nrambler\r\nraven search\r\nroach\r\nroad runner\r\nroadhouse\r\nrobbie\r\nrobofox\r\nrobozilla\r\nrules\r\nsalty\r\nsbider\r\nscooter\r\nscoutjet\r\nscrubby\r\nsearch.\r\nsearchprocess\r\nsemanticdiscovery\r\nsenrigan\r\nsg-scout\r\nshai''hulud\r\nshark\r\nshopwiki\r\nsidewinder\r\nsift\r\nsilk\r\nsimmany\r\nsite searcher\r\nsite valet\r\nsitetech-rover\r\nskymob.com\r\nsleek\r\nsmartwit\r\nsna-\r\nsnappy\r\nsnooper\r\nsohu\r\nspeedfind\r\nsphere\r\nsphider\r\nspinner\r\nspyder\r\nsteeler/\r\nsuke\r\nsuntek\r\nsupersnooper\r\nsurfnomore\r\nsven\r\nsygol\r\nszukacz\r\ntach black widow\r\ntarantula\r\ntempleton\r\n/teoma\r\nt-h-u-n-d-e-r-s-t-o-n-e\r\ntheophrastus\r\ntitan\r\ntitin\r\ntkwww\r\ntoutatis\r\nt-rex\r\ntutorgig\r\ntwiceler\r\ntwisted\r\nucsd\r\nudmsearch\r\nurl check\r\nupdated\r\nvagabondo\r\nvalkyrie\r\nverticrawl\r\nvictoria\r\nvision-search\r\nvolcano\r\nvoyager/\r\nvoyager-hc\r\nw3c_validator\r\nw3m2\r\nw3mir\r\nwalker\r\nwallpaper\r\nwanderer\r\nwauuu\r\nwavefire\r\nweb core\r\nweb hopper\r\nweb wombat\r\nwebbandit\r\nwebcatcher\r\nwebcopy\r\nwebfoot\r\nweblayers\r\nweblinker\r\nweblog monitor\r\nwebmirror\r\nwebmonkey\r\nwebquest\r\nwebreaper\r\nwebsitepulse\r\nwebsnarf\r\nwebstolperer\r\nwebvac\r\nwebwalk\r\nwebwatch\r\nwebwombat\r\nwebzinger\r\nwhizbang\r\nwhowhere\r\nwild ferret\r\nworldlight\r\nwwwc\r\nwwwster\r\nxenu\r\nxget\r\nxift\r\nxirq\r\nyandex\r\nyanga\r\nyeti\r\nyodao\r\nzao\r\nzippp\r\nzyborg', 0),
(62574, 0, 'config', 'config_seo_remarketing', '', 0),
(62575, 0, 'config', 'config_google_conversion', '', 0),
(62546, 0, 'config', 'config_mail_alert', '', 0),
(62545, 0, 'config', 'config_mail_smtp_timeout', '15', 0),
(62544, 0, 'config', 'config_mail_smtp_port', '465', 0),
(62543, 0, 'config', 'config_mail_smtp_password', '', 0),
(62542, 0, 'config', 'config_mail_smtp_username', '', 0),
(62541, 0, 'config', 'config_mail_smtp_hostname', '', 0),
(62539, 0, 'config', 'config_mail_protocol', 'smtp', 0),
(62540, 0, 'config', 'config_mail_parameter', '', 0),
(62538, 0, 'config', 'config_image_search_height', '47', 0),
(62537, 0, 'config', 'config_image_search_width', '47', 0),
(62536, 0, 'config', 'config_image_product_height', '240', 0),
(62535, 0, 'config', 'config_image_product_width', '320', 0),
(62533, 0, 'config', 'config_image_thumb_width', '600', 0),
(62534, 0, 'config', 'config_image_thumb_height', '600', 0),
(62532, 0, 'config', 'config_image_logo_height', '25', 0),
(62531, 0, 'config', 'config_image_logo_width', '250', 0),
(62530, 0, 'config', 'config_image_tab_category_height', '263', 0),
(62529, 0, 'config', 'config_image_tab_category_width', '263', 0),
(62528, 0, 'config', 'config_image_category_height', '332', 0),
(62526, 0, 'config', 'config_icon', 'catalog/the_sun.jpg', 0),
(62527, 0, 'config', 'config_image_category_width', '286', 0),
(62525, 0, 'config', 'config_logo_white', 'catalog/logo-white.png', 0),
(62523, 0, 'config', 'config_order_mail', '1', 0),
(62524, 0, 'config', 'config_logo', 'catalog/logo.png', 0),
(62521, 0, 'config', 'config_processing_status', 'a:1:{i:0;s:1:"2";}', 1),
(62522, 0, 'config', 'config_complete_status', 'a:1:{i:0;s:1:"4";}', 1),
(62520, 0, 'config', 'config_payment_status_id', '2', 0),
(62519, 0, 'config', 'config_order_status_id', '1', 0),
(62518, 0, 'config', 'config_tax_customer', 'shipping', 0),
(62517, 0, 'config', 'config_tax_default', 'shipping', 0),
(62516, 0, 'config', 'config_tax', '0', 0),
(62515, 0, 'config', 'config_limit_admin', '20', 0),
(62514, 0, 'config', 'config_product_search_limit', '5', 0),
(62513, 0, 'config', 'config_product_limit', '6', 0),
(62512, 0, 'config', 'config_product_count', '1', 0),
(62511, 0, 'config', 'config_currency', 'грн', 0),
(62510, 0, 'config', 'config_admin_language', 'ru', 0),
(62509, 0, 'config', 'config_language', 'ru', 0),
(62508, 0, 'config', 'config_zone_id', '', 0),
(62507, 0, 'config', 'config_country_id', '220', 0),
(62506, 0, 'config', 'config_layout_id', '6', 0),
(62505, 0, 'config', 'config_template', 'default', 0),
(62504, 0, 'config', 'config_open', '8.30- 17.30%выходной: суббота, воскресенье', 0),
(62503, 0, 'config', 'config_telephone', '+38(066) 886 92 56,+38(099) 299 67 69', 0),
(62502, 0, 'config', 'config_email', 'smartroom6@gmail.com', 0),
(62501, 0, 'config', 'config_address', 'Киев', 0),
(62500, 0, 'config', 'config_name', 'smart-room', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `stock_status`
--

CREATE TABLE `stock_status` (
  `stock_status_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ssl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tax_class`
--

CREATE TABLE `tax_class` (
  `tax_class_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tax_rate`
--

CREATE TABLE `tax_rate` (
  `tax_rate_id` int(11) NOT NULL,
  `geo_zone_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `rate` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `type` char(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tax_rate_to_customer_group`
--

CREATE TABLE `tax_rate_to_customer_group` (
  `tax_rate_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tax_rule`
--

CREATE TABLE `tax_rule` (
  `tax_rule_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `based` varchar(10) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `upload`
--

CREATE TABLE `upload` (
  `upload_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `url_alias`
--

CREATE TABLE `url_alias` (
  `url_alias_id` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `url_alias`
--

INSERT INTO `url_alias` (`url_alias_id`, `query`, `keyword`) VALUES
(7, 'category_id=7', 'televizori'),
(8, 'category_id=8', 'holodilniki'),
(9, 'category_id=10', 'proektori'),
(10, 'category_id=11', 'fotoapparati'),
(11, 'information_id=18', 'onas'),
(12, 'information_id=19', 'dostavka'),
(13, 'product_id=1', 'sony'),
(14, 'product_id=2', 'sony_1'),
(19, 'product_id=3', 'samsung'),
(20, 'product_id=102', 'holodilnikhitachi'),
(21, 'product_id=103', 'holodilnikhitachi_1'),
(22, 'product_id=104', 'holodilnikhitachi_1'),
(23, 'product_id=105', 'holodilnikhitachi_1'),
(24, 'product_id=106', 'holodilnikhitachi_1'),
(25, 'product_id=107', 'holodilnikhitachi_1'),
(26, 'product_id=108', 'holodilnikhitachi_1'),
(27, 'product_id=109', 'holodilnikhitachi_1'),
(28, 'product_id=110', 'holodilnikhitachi_1'),
(29, 'product_id=111', 'holodilnikhitachi_1');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `image` varchar(255) NOT NULL,
  `code` varchar(40) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `user_group_id`, `username`, `password`, `salt`, `firstname`, `lastname`, `email`, `image`, `code`, `ip`, `status`, `date_added`) VALUES
(2, 1, 'smartroom', '68004731aee236ead25c707446d9a7a8aa538125', '9ce3b88cc', 'Smart', 'Room', '', 'catalog/proj.jpg', '', '127.0.0.1', 1, '2015-12-17 13:01:56'),
(4, 1, 'admin', 'e1e3e8f5bff765eabc6c45048de30d05dc440ea4', 'dcc33bb44', 'John', 'Doe', '', '', '', '', 1, '2016-08-12 11:07:43');

-- --------------------------------------------------------

--
-- Структура таблицы `user_group`
--

CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `name`, `permission`) VALUES
(1, 'Administrator', 'a:2:{s:6:"access";a:124:{i:0;s:17:"catalog/attribute";i:1;s:23:"catalog/attribute_group";i:2;s:16:"catalog/category";i:3;s:16:"catalog/download";i:4;s:19:"catalog/information";i:5;s:12:"catalog/look";i:6;s:20:"catalog/manufacturer";i:7;s:14:"catalog/option";i:8;s:15:"catalog/product";i:9;s:25:"catalog/product_parameter";i:10;s:17:"catalog/recurring";i:11;s:14:"catalog/review";i:12;s:18:"common/column_left";i:13;s:18:"common/filemanager";i:14;s:11:"common/menu";i:15;s:14:"common/profile";i:16;s:12:"common/stats";i:17;s:13:"design/banner";i:18;s:13:"design/layout";i:19;s:14:"extension/feed";i:20;s:15:"extension/fraud";i:21;s:19:"extension/installer";i:22;s:22:"extension/modification";i:23;s:16:"extension/module";i:24;s:17:"extension/openbay";i:25;s:17:"extension/payment";i:26;s:18:"extension/shipping";i:27;s:15:"extension/total";i:28;s:16:"feed/google_base";i:29;s:19:"feed/google_sitemap";i:30;s:18:"fraud/fraudlabspro";i:31;s:13:"fraud/maxmind";i:32;s:20:"localisation/country";i:33;s:21:"localisation/currency";i:34;s:21:"localisation/geo_zone";i:35;s:21:"localisation/language";i:36;s:25:"localisation/length_class";i:37;s:21:"localisation/location";i:38;s:25:"localisation/order_status";i:39;s:26:"localisation/return_action";i:40;s:26:"localisation/return_reason";i:41;s:26:"localisation/return_status";i:42;s:25:"localisation/stock_status";i:43;s:22:"localisation/tax_class";i:44;s:21:"localisation/tax_rate";i:45;s:25:"localisation/weight_class";i:46;s:17:"localisation/zone";i:47;s:19:"marketing/affiliate";i:48;s:17:"marketing/contact";i:49;s:16:"marketing/coupon";i:50;s:19:"marketing/marketing";i:51;s:14:"module/account";i:52;s:13:"module/banner";i:53;s:17:"module/bestseller";i:54;s:15:"module/carousel";i:55;s:15:"module/category";i:56;s:15:"module/featured";i:57;s:13:"module/filter";i:58;s:22:"module/google_hangouts";i:59;s:11:"module/html";i:60;s:18:"module/information";i:61;s:13:"module/latest";i:62;s:17:"module/novaposhta";i:63;s:16:"module/pp_button";i:64;s:15:"module/pp_login";i:65;s:16:"module/slideshow";i:66;s:14:"module/special";i:67;s:12:"module/store";i:68;s:21:"payment/bank_transfer";i:69;s:14:"payment/cheque";i:70;s:11:"payment/cod";i:71;s:21:"payment/free_checkout";i:72;s:14:"payment/liqpay";i:73;s:18:"payment/pp_express";i:74;s:14:"payment/pp_pro";i:75;s:19:"payment/pp_standard";i:76;s:24:"report/customer_activity";i:77;s:22:"report/customer_credit";i:78;s:21:"report/customer_login";i:79;s:22:"report/customer_online";i:80;s:21:"report/customer_order";i:81;s:22:"report/customer_reward";i:82;s:16:"report/marketing";i:83;s:24:"report/product_purchased";i:84;s:21:"report/product_viewed";i:85;s:18:"report/sale_coupon";i:86;s:17:"report/sale_order";i:87;s:18:"report/sale_return";i:88;s:20:"report/sale_shipping";i:89;s:15:"report/sale_tax";i:90;s:17:"sale/custom_field";i:91;s:13:"sale/customer";i:92;s:20:"sale/customer_ban_ip";i:93;s:19:"sale/customer_group";i:94;s:10:"sale/order";i:95;s:14:"sale/recurring";i:96;s:11:"sale/return";i:97;s:12:"sale/voucher";i:98;s:18:"sale/voucher_theme";i:99;s:15:"setting/setting";i:100;s:13:"setting/store";i:101;s:17:"shipping/citylink";i:102;s:13:"shipping/flat";i:103;s:13:"shipping/free";i:104;s:13:"shipping/item";i:105;s:15:"shipping/pickup";i:106;s:15:"shipping/weight";i:107;s:11:"tool/backup";i:108;s:14:"tool/error_log";i:109;s:16:"tool/import_tool";i:110;s:11:"tool/upload";i:111;s:12:"total/coupon";i:112;s:12:"total/credit";i:113;s:14:"total/handling";i:114;s:19:"total/low_order_fee";i:115;s:12:"total/reward";i:116;s:14:"total/shipping";i:117;s:15:"total/sub_total";i:118;s:9:"total/tax";i:119;s:11:"total/total";i:120;s:13:"total/voucher";i:121;s:8:"user/api";i:122;s:9:"user/user";i:123;s:20:"user/user_permission";}s:6:"modify";a:124:{i:0;s:17:"catalog/attribute";i:1;s:23:"catalog/attribute_group";i:2;s:16:"catalog/category";i:3;s:16:"catalog/download";i:4;s:19:"catalog/information";i:5;s:12:"catalog/look";i:6;s:20:"catalog/manufacturer";i:7;s:14:"catalog/option";i:8;s:15:"catalog/product";i:9;s:25:"catalog/product_parameter";i:10;s:17:"catalog/recurring";i:11;s:14:"catalog/review";i:12;s:18:"common/column_left";i:13;s:18:"common/filemanager";i:14;s:11:"common/menu";i:15;s:14:"common/profile";i:16;s:12:"common/stats";i:17;s:13:"design/banner";i:18;s:13:"design/layout";i:19;s:14:"extension/feed";i:20;s:15:"extension/fraud";i:21;s:19:"extension/installer";i:22;s:22:"extension/modification";i:23;s:16:"extension/module";i:24;s:17:"extension/openbay";i:25;s:17:"extension/payment";i:26;s:18:"extension/shipping";i:27;s:15:"extension/total";i:28;s:16:"feed/google_base";i:29;s:19:"feed/google_sitemap";i:30;s:18:"fraud/fraudlabspro";i:31;s:13:"fraud/maxmind";i:32;s:20:"localisation/country";i:33;s:21:"localisation/currency";i:34;s:21:"localisation/geo_zone";i:35;s:21:"localisation/language";i:36;s:25:"localisation/length_class";i:37;s:21:"localisation/location";i:38;s:25:"localisation/order_status";i:39;s:26:"localisation/return_action";i:40;s:26:"localisation/return_reason";i:41;s:26:"localisation/return_status";i:42;s:25:"localisation/stock_status";i:43;s:22:"localisation/tax_class";i:44;s:21:"localisation/tax_rate";i:45;s:25:"localisation/weight_class";i:46;s:17:"localisation/zone";i:47;s:19:"marketing/affiliate";i:48;s:17:"marketing/contact";i:49;s:16:"marketing/coupon";i:50;s:19:"marketing/marketing";i:51;s:14:"module/account";i:52;s:13:"module/banner";i:53;s:17:"module/bestseller";i:54;s:15:"module/carousel";i:55;s:15:"module/category";i:56;s:15:"module/featured";i:57;s:13:"module/filter";i:58;s:22:"module/google_hangouts";i:59;s:11:"module/html";i:60;s:18:"module/information";i:61;s:13:"module/latest";i:62;s:17:"module/novaposhta";i:63;s:16:"module/pp_button";i:64;s:15:"module/pp_login";i:65;s:16:"module/slideshow";i:66;s:14:"module/special";i:67;s:12:"module/store";i:68;s:21:"payment/bank_transfer";i:69;s:14:"payment/cheque";i:70;s:11:"payment/cod";i:71;s:21:"payment/free_checkout";i:72;s:14:"payment/liqpay";i:73;s:18:"payment/pp_express";i:74;s:14:"payment/pp_pro";i:75;s:19:"payment/pp_standard";i:76;s:24:"report/customer_activity";i:77;s:22:"report/customer_credit";i:78;s:21:"report/customer_login";i:79;s:22:"report/customer_online";i:80;s:21:"report/customer_order";i:81;s:22:"report/customer_reward";i:82;s:16:"report/marketing";i:83;s:24:"report/product_purchased";i:84;s:21:"report/product_viewed";i:85;s:18:"report/sale_coupon";i:86;s:17:"report/sale_order";i:87;s:18:"report/sale_return";i:88;s:20:"report/sale_shipping";i:89;s:15:"report/sale_tax";i:90;s:17:"sale/custom_field";i:91;s:13:"sale/customer";i:92;s:20:"sale/customer_ban_ip";i:93;s:19:"sale/customer_group";i:94;s:10:"sale/order";i:95;s:14:"sale/recurring";i:96;s:11:"sale/return";i:97;s:12:"sale/voucher";i:98;s:18:"sale/voucher_theme";i:99;s:15:"setting/setting";i:100;s:13:"setting/store";i:101;s:17:"shipping/citylink";i:102;s:13:"shipping/flat";i:103;s:13:"shipping/free";i:104;s:13:"shipping/item";i:105;s:15:"shipping/pickup";i:106;s:15:"shipping/weight";i:107;s:11:"tool/backup";i:108;s:14:"tool/error_log";i:109;s:16:"tool/import_tool";i:110;s:11:"tool/upload";i:111;s:12:"total/coupon";i:112;s:12:"total/credit";i:113;s:14:"total/handling";i:114;s:19:"total/low_order_fee";i:115;s:12:"total/reward";i:116;s:14:"total/shipping";i:117;s:15:"total/sub_total";i:118;s:9:"total/tax";i:119;s:11:"total/total";i:120;s:13:"total/voucher";i:121;s:8:"user/api";i:122;s:9:"user/user";i:123;s:20:"user/user_permission";}}'),
(10, 'Demonstration', '');

-- --------------------------------------------------------

--
-- Структура таблицы `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `from_name` varchar(64) NOT NULL,
  `from_email` varchar(96) NOT NULL,
  `to_name` varchar(64) NOT NULL,
  `to_email` varchar(96) NOT NULL,
  `voucher_theme_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `voucher_history`
--

CREATE TABLE `voucher_history` (
  `voucher_history_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `voucher_theme`
--

CREATE TABLE `voucher_theme` (
  `voucher_theme_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `voucher_theme_description`
--

CREATE TABLE `voucher_theme_description` (
  `voucher_theme_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `zone`
--

CREATE TABLE `zone` (
  `zone_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `zone`
--

INSERT INTO `zone` (`zone_id`, `country_id`, `name`, `code`, `status`) VALUES
(1, 20, 'Брест', 'BR', 1),
(2, 20, 'Гомель', 'HO', 1),
(3, 20, 'Минск', 'HM', 1),
(4, 20, 'Гродно', 'HR', 1),
(5, 20, 'Могилев', 'MA', 1),
(6, 20, 'Минская область', 'MI', 1),
(7, 20, 'Витебск', 'VI', 1),
(8, 80, 'Abkhazia', 'AB', 1),
(9, 80, 'Ajaria', 'AJ', 1),
(10, 80, 'Tbilisi', 'TB', 1),
(11, 80, 'Guria', 'GU', 1),
(12, 80, 'Imereti', 'IM', 1),
(13, 80, 'Kakheti', 'KA', 1),
(14, 80, 'Kvemo Kartli', 'KK', 1),
(15, 80, 'Mtskheta-Mtianeti', 'MM', 1),
(16, 80, 'Racha Lechkhumi and Kvemo Svanet', 'RL', 1),
(17, 80, 'Samegrelo-Zemo Svaneti', 'SZ', 1),
(18, 80, 'Samtskhe-Javakheti', 'SJ', 1),
(19, 80, 'Shida Kartli', 'SK', 1),
(20, 109, 'Алматинская область', 'AL', 1),
(21, 109, 'Алматы - город республ-го значения', 'AC', 1),
(22, 109, 'Акмолинская область', 'AM', 1),
(23, 109, 'Актюбинская область', 'AQ', 1),
(24, 109, 'Астана - город республ-го значения', 'AS', 1),
(25, 109, 'Атырауская область', 'AT', 1),
(26, 109, 'Западно-Казахстанская область', 'BA', 1),
(27, 109, 'Байконур - город республ-го значения', 'BY', 1),
(28, 109, 'Мангистауская область', 'MA', 1),
(29, 109, 'Южно-Казахстанская область', 'ON', 1),
(30, 109, 'Павлодарская область', 'PA', 1),
(31, 109, 'Карагандинская область', 'QA', 1),
(32, 109, 'Костанайская область', 'QO', 1),
(33, 109, 'Кызылординская область', 'QY', 1),
(34, 109, 'Восточно-Казахстанская область', 'SH', 1),
(35, 109, 'Северо-Казахстанская область', 'SO', 1),
(36, 109, 'Жамбылская область', 'ZH', 1),
(37, 115, 'Bishkek', 'GB', 1),
(38, 115, 'Batken', 'B', 1),
(39, 115, 'Chu', 'C', 1),
(40, 115, 'Jalal-Abad', 'J', 1),
(41, 115, 'Naryn', 'N', 1),
(42, 115, 'Osh', 'O', 1),
(43, 115, 'Talas', 'T', 1),
(44, 115, 'Ysyk-Kol', 'Y', 1),
(45, 176, 'Республика Хакасия', 'KK', 1),
(46, 176, 'Московская область', 'MOS', 1),
(47, 176, 'Чукотский АО', 'CHU', 1),
(48, 176, 'Архангельская область', 'ARK', 1),
(49, 176, 'Астраханская область', 'AST', 1),
(50, 176, 'Алтайский край', 'ALT', 1),
(51, 176, 'Белгородская область', 'BEL', 1),
(52, 176, 'Еврейская АО', 'YEV', 1),
(53, 176, 'Амурская область', 'AMU', 1),
(54, 176, 'Брянская область', 'BRY', 1),
(55, 176, 'Чувашская Республика', 'CU', 1),
(56, 176, 'Челябинская область', 'CHE', 1),
(57, 176, 'Карачаево-Черкеcсия', 'KC', 1),
(58, 176, 'Забайкальский край', 'ZAB', 1),
(59, 176, 'Ленинградская область', 'LEN', 1),
(60, 176, 'Республика Калмыкия', 'KL', 1),
(61, 176, 'Сахалинская область', 'SAK', 1),
(62, 176, 'Республика Алтай', 'AL', 1),
(63, 176, 'Чеченская Республика', 'CE', 1),
(64, 176, 'Иркутская область', 'IRK', 1),
(65, 176, 'Ивановская область', 'IVA', 1),
(66, 176, 'Удмуртская Республика', 'UD', 1),
(67, 176, 'Калининградская область', 'KGD', 1),
(68, 176, 'Калужская область', 'KLU', 1),
(69, 176, 'Республика Татарстан', 'TA', 1),
(70, 176, 'Кемеровская область', 'KEM', 1),
(71, 176, 'Хабаровский край', 'KHA', 1),
(72, 176, 'Ханты-Мансийский АО - Югра', 'KHM', 1),
(73, 176, 'Костромская область', 'KOS', 1),
(74, 176, 'Краснодарский край', 'KDA', 1),
(75, 176, 'Красноярский край', 'KYA', 1),
(76, 176, 'Курганская область', 'KGN', 1),
(77, 176, 'Курская область', 'KRS', 1),
(78, 176, 'Республика Тыва', 'TY', 1),
(79, 176, 'Липецкая область', 'LIP', 1),
(80, 176, 'Магаданская область', 'MAG', 1),
(81, 176, 'Республика Дагестан', 'DA', 1),
(82, 176, 'Республика Адыгея', 'AD', 1),
(83, 176, 'Москва', 'MOW', 1),
(84, 176, 'Мурманская область', 'MUR', 1),
(85, 176, 'Республика Кабардино-Балкария', 'KB', 1),
(86, 176, 'Ненецкий АО', 'NEN', 1),
(87, 176, 'Республика Ингушетия', 'IN', 1),
(88, 176, 'Нижегородская область', 'NIZ', 1),
(89, 176, 'Новгородская область', 'NGR', 1),
(90, 176, 'Новосибирская область', 'NVS', 1),
(91, 176, 'Омская область', 'OMS', 1),
(92, 176, 'Орловская область', 'ORL', 1),
(93, 176, 'Оренбургская область', 'ORE', 1),
(94, 176, 'Пензенская область', 'PNZ', 1),
(95, 176, 'Пермский край', 'PER', 1),
(96, 176, 'Камчатский край', 'KAM', 1),
(97, 176, 'Республика Карелия', 'KR', 1),
(98, 176, 'Псковская область', 'PSK', 1),
(99, 176, 'Ростовская область', 'ROS', 1),
(100, 176, 'Рязанская область', 'RYA', 1),
(101, 176, 'Ямало-Ненецкий АО', 'YAN', 1),
(102, 176, 'Самарская область', 'SAM', 1),
(103, 176, 'Республика Мордовия', 'MO', 1),
(104, 176, 'Саратовская область', 'SAR', 1),
(105, 176, 'Смоленская область', 'SMO', 1),
(106, 176, 'Санкт-Петербург', 'SPE', 1),
(107, 176, 'Ставропольский край', 'STA', 1),
(108, 176, 'Республика Коми', 'KO', 1),
(109, 176, 'Тамбовская область', 'TAM', 1),
(110, 176, 'Томская область', 'TOM', 1),
(111, 176, 'Тульская область', 'TUL', 1),
(112, 176, 'Тверская область', 'TVE', 1),
(113, 176, 'Тюменская область', 'TYU', 1),
(114, 176, 'Республика Башкортостан', 'BA', 1),
(115, 176, 'Ульяновская область', 'ULY', 1),
(116, 176, 'Республика Бурятия', 'BU', 1),
(117, 176, 'Республика Северная Осетия', 'SE', 1),
(118, 176, 'Владимирская область', 'VLA', 1),
(119, 176, 'Приморский край', 'PRI', 1),
(120, 176, 'Волгоградская область', 'VGG', 1),
(121, 176, 'Вологодская область', 'VLG', 1),
(122, 176, 'Воронежская область', 'VOR', 1),
(123, 176, 'Кировская область', 'KIR', 1),
(124, 176, 'Республика Саха', 'SA', 1),
(125, 176, 'Ярославская область', 'YAR', 1),
(126, 176, 'Свердловская область', 'SVE', 1),
(127, 176, 'Республика Марий Эл', 'ME', 1),
(128, 176, 'Республика Крым', 'CR', 1),
(129, 220, 'Черкассы', 'CK', 1),
(130, 220, 'Чернигов', 'CH', 1),
(131, 220, 'Черновцы', 'CV', 1),
(132, 220, 'Днепропетровск', 'DN', 1),
(133, 220, 'Донецк', 'DO', 1),
(134, 220, 'Ивано-Франковск', 'IV', 1),
(135, 220, 'Харьков', 'KH', 1),
(136, 220, 'Хмельницкий', 'KM', 1),
(137, 220, 'Кировоград', 'KR', 1),
(138, 220, 'Киевская область', 'KV', 1),
(139, 220, 'Киев', 'KY', 1),
(140, 220, 'Луганск', 'LU', 1),
(141, 220, 'Львов', 'LV', 1),
(142, 220, 'Николаев', 'MY', 1),
(143, 220, 'Одесса', 'OD', 1),
(144, 220, 'Полтава', 'PO', 1),
(145, 220, 'Ровно', 'RI', 1),
(146, 176, 'Севастополь', 'SE', 1),
(147, 220, 'Сумы', 'SU', 1),
(148, 220, 'Тернополь', 'TE', 1),
(149, 220, 'Винница', 'VI', 1),
(150, 220, 'Луцк', 'VO', 1),
(151, 220, 'Ужгород', 'ZK', 1),
(152, 220, 'Запорожье', 'ZA', 1),
(153, 220, 'Житомир', 'ZH', 1),
(154, 220, 'Херсон', 'KE', 1),
(155, 226, 'Andijon', 'AN', 1),
(156, 226, 'Buxoro', 'BU', 1),
(157, 226, 'Farg''ona', 'FA', 1),
(158, 226, 'Jizzax', 'JI', 1),
(159, 226, 'Namangan', 'NG', 1),
(160, 226, 'Navoiy', 'NW', 1),
(161, 226, 'Qashqadaryo', 'QA', 1),
(162, 226, 'Qoraqalpog''iston Republikasi', 'QR', 1),
(163, 226, 'Samarqand', 'SA', 1),
(164, 226, 'Sirdaryo', 'SI', 1),
(165, 226, 'Surxondaryo', 'SU', 1),
(166, 226, 'Toshkent City', 'TK', 1),
(167, 226, 'Toshkent Region', 'TO', 1),
(168, 226, 'Xorazm', 'XO', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `zone_to_geo_zone`
--

CREATE TABLE `zone_to_geo_zone` (
  `zone_to_geo_zone_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `geo_zone_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `zone_to_geo_zone`
--

INSERT INTO `zone_to_geo_zone` (`zone_to_geo_zone_id`, `country_id`, `zone_id`, `geo_zone_id`, `date_added`, `date_modified`) VALUES
(1, 222, 0, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 176, 0, 3, '2014-09-09 11:48:13', '0000-00-00 00:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Индексы таблицы `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`api_id`);

--
-- Индексы таблицы `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Индексы таблицы `banner_image`
--
ALTER TABLE `banner_image`
  ADD PRIMARY KEY (`banner_image_id`);

--
-- Индексы таблицы `banner_image_description`
--
ALTER TABLE `banner_image_description`
  ADD PRIMARY KEY (`banner_image_id`,`language_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `fk_category_category1_idx` (`parent_id`);

--
-- Индексы таблицы `category_description`
--
ALTER TABLE `category_description`
  ADD PRIMARY KEY (`category_id`,`language_id`),
  ADD KEY `name` (`name`),
  ADD KEY `fk_category_description_category1_idx` (`category_id`),
  ADD KEY `fk_category_description_language1_idx` (`language_id`);

--
-- Индексы таблицы `category_path`
--
ALTER TABLE `category_path`
  ADD PRIMARY KEY (`category_id`,`path_id`);

--
-- Индексы таблицы `category_to_layout`
--
ALTER TABLE `category_to_layout`
  ADD PRIMARY KEY (`category_id`,`store_id`);

--
-- Индексы таблицы `category_to_store`
--
ALTER TABLE `category_to_store`
  ADD PRIMARY KEY (`category_id`,`store_id`);

--
-- Индексы таблицы `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Индексы таблицы `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Индексы таблицы `coupon_category`
--
ALTER TABLE `coupon_category`
  ADD PRIMARY KEY (`coupon_id`,`category_id`);

--
-- Индексы таблицы `coupon_history`
--
ALTER TABLE `coupon_history`
  ADD PRIMARY KEY (`coupon_history_id`);

--
-- Индексы таблицы `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD PRIMARY KEY (`coupon_product_id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Индексы таблицы `customer_activity`
--
ALTER TABLE `customer_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Индексы таблицы `customer_ban_ip`
--
ALTER TABLE `customer_ban_ip`
  ADD PRIMARY KEY (`customer_ban_ip_id`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`customer_group_id`);

--
-- Индексы таблицы `customer_group_description`
--
ALTER TABLE `customer_group_description`
  ADD PRIMARY KEY (`customer_group_id`,`language_id`);

--
-- Индексы таблицы `customer_history`
--
ALTER TABLE `customer_history`
  ADD PRIMARY KEY (`customer_history_id`);

--
-- Индексы таблицы `customer_ip`
--
ALTER TABLE `customer_ip`
  ADD PRIMARY KEY (`customer_ip_id`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`customer_login_id`),
  ADD KEY `email` (`email`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `customer_online`
--
ALTER TABLE `customer_online`
  ADD PRIMARY KEY (`ip`);

--
-- Индексы таблицы `customer_reward`
--
ALTER TABLE `customer_reward`
  ADD PRIMARY KEY (`customer_reward_id`);

--
-- Индексы таблицы `customer_social`
--
ALTER TABLE `customer_social`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer_transaction`
--
ALTER TABLE `customer_transaction`
  ADD PRIMARY KEY (`customer_transaction_id`);

--
-- Индексы таблицы `custom_field`
--
ALTER TABLE `custom_field`
  ADD PRIMARY KEY (`custom_field_id`);

--
-- Индексы таблицы `custom_field_customer_group`
--
ALTER TABLE `custom_field_customer_group`
  ADD PRIMARY KEY (`custom_field_id`,`customer_group_id`);

--
-- Индексы таблицы `custom_field_description`
--
ALTER TABLE `custom_field_description`
  ADD PRIMARY KEY (`custom_field_id`,`language_id`);

--
-- Индексы таблицы `custom_field_value`
--
ALTER TABLE `custom_field_value`
  ADD PRIMARY KEY (`custom_field_value_id`);

--
-- Индексы таблицы `custom_field_value_description`
--
ALTER TABLE `custom_field_value_description`
  ADD PRIMARY KEY (`custom_field_value_id`,`language_id`);

--
-- Индексы таблицы `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`download_id`);

--
-- Индексы таблицы `download_description`
--
ALTER TABLE `download_description`
  ADD PRIMARY KEY (`download_id`,`language_id`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Индексы таблицы `extension`
--
ALTER TABLE `extension`
  ADD PRIMARY KEY (`extension_id`);

--
-- Индексы таблицы `geo_zone`
--
ALTER TABLE `geo_zone`
  ADD PRIMARY KEY (`geo_zone_id`);

--
-- Индексы таблицы `import_log`
--
ALTER TABLE `import_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`information_id`);

--
-- Индексы таблицы `information_description`
--
ALTER TABLE `information_description`
  ADD PRIMARY KEY (`information_id`,`language_id`),
  ADD KEY `fk_information_description_information1_idx` (`information_id`),
  ADD KEY `fk_information_description_language1_idx` (`language_id`);

--
-- Индексы таблицы `information_to_layout`
--
ALTER TABLE `information_to_layout`
  ADD PRIMARY KEY (`information_id`,`store_id`);

--
-- Индексы таблицы `information_to_product`
--
ALTER TABLE `information_to_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `information_to_store`
--
ALTER TABLE `information_to_store`
  ADD PRIMARY KEY (`information_id`,`store_id`);

--
-- Индексы таблицы `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`layout_id`);

--
-- Индексы таблицы `layout_module`
--
ALTER TABLE `layout_module`
  ADD PRIMARY KEY (`layout_module_id`);

--
-- Индексы таблицы `layout_route`
--
ALTER TABLE `layout_route`
  ADD PRIMARY KEY (`layout_route_id`);

--
-- Индексы таблицы `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`marketing_id`);

--
-- Индексы таблицы `modification`
--
ALTER TABLE `modification`
  ADD PRIMARY KEY (`modification_id`);

--
-- Индексы таблицы `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`,`language_id`);

--
-- Индексы таблицы `order_voucher`
--
ALTER TABLE `order_voucher`
  ADD PRIMARY KEY (`order_voucher_id`);

--
-- Индексы таблицы `param`
--
ALTER TABLE `param`
  ADD PRIMARY KEY (`param_id`),
  ADD UNIQUE KEY `param_id` (`param_id`);

--
-- Индексы таблицы `param_filters`
--
ALTER TABLE `param_filters`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `param_to_category`
--
ALTER TABLE `param_to_category`
  ADD PRIMARY KEY (`id`,`category_id`,`param_id`),
  ADD KEY `fk_param_to_category_category1_idx` (`category_id`),
  ADD KEY `fk_param_to_category_param1_idx` (`param_id`);

--
-- Индексы таблицы `param_value`
--
ALTER TABLE `param_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `param_value_to_product`
--
ALTER TABLE `param_value_to_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `product_description`
--
ALTER TABLE `product_description`
  ADD PRIMARY KEY (`product_id`,`language_id`),
  ADD KEY `name` (`name`),
  ADD KEY `fk_product_description_language1_idx` (`language_id`),
  ADD KEY `fk_product_description_product1_idx` (`product_id`);

--
-- Индексы таблицы `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `product_special`
--
ALTER TABLE `product_special`
  ADD PRIMARY KEY (`product_special_id`,`product_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_product_special_product1_idx` (`product_id`);

--
-- Индексы таблицы `product_to_category`
--
ALTER TABLE `product_to_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `product_to_layout`
--
ALTER TABLE `product_to_layout`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `product_to_store`
--
ALTER TABLE `product_to_store`
  ADD PRIMARY KEY (`product_id`,`store_id`);

--
-- Индексы таблицы `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`return_id`);

--
-- Индексы таблицы `return_action`
--
ALTER TABLE `return_action`
  ADD PRIMARY KEY (`return_action_id`,`language_id`);

--
-- Индексы таблицы `return_history`
--
ALTER TABLE `return_history`
  ADD PRIMARY KEY (`return_history_id`);

--
-- Индексы таблицы `return_reason`
--
ALTER TABLE `return_reason`
  ADD PRIMARY KEY (`return_reason_id`,`language_id`);

--
-- Индексы таблицы `return_status`
--
ALTER TABLE `return_status`
  ADD PRIMARY KEY (`return_status_id`,`language_id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`,`product_id`,`customer_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_review_product1_idx` (`product_id`),
  ADD KEY `fk_review_customer1_idx` (`customer_id`);

--
-- Индексы таблицы `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Индексы таблицы `stock_status`
--
ALTER TABLE `stock_status`
  ADD PRIMARY KEY (`stock_status_id`,`language_id`);

--
-- Индексы таблицы `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Индексы таблицы `tax_class`
--
ALTER TABLE `tax_class`
  ADD PRIMARY KEY (`tax_class_id`);

--
-- Индексы таблицы `tax_rate`
--
ALTER TABLE `tax_rate`
  ADD PRIMARY KEY (`tax_rate_id`);

--
-- Индексы таблицы `tax_rate_to_customer_group`
--
ALTER TABLE `tax_rate_to_customer_group`
  ADD PRIMARY KEY (`tax_rate_id`,`customer_group_id`);

--
-- Индексы таблицы `tax_rule`
--
ALTER TABLE `tax_rule`
  ADD PRIMARY KEY (`tax_rule_id`);

--
-- Индексы таблицы `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`upload_id`);

--
-- Индексы таблицы `url_alias`
--
ALTER TABLE `url_alias`
  ADD PRIMARY KEY (`url_alias_id`),
  ADD KEY `query` (`query`),
  ADD KEY `keyword` (`keyword`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`,`user_group_id`),
  ADD KEY `fk_user_user_group1_idx` (`user_group_id`);

--
-- Индексы таблицы `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- Индексы таблицы `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- Индексы таблицы `voucher_history`
--
ALTER TABLE `voucher_history`
  ADD PRIMARY KEY (`voucher_history_id`);

--
-- Индексы таблицы `voucher_theme`
--
ALTER TABLE `voucher_theme`
  ADD PRIMARY KEY (`voucher_theme_id`);

--
-- Индексы таблицы `voucher_theme_description`
--
ALTER TABLE `voucher_theme_description`
  ADD PRIMARY KEY (`voucher_theme_id`,`language_id`);

--
-- Индексы таблицы `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- Индексы таблицы `zone_to_geo_zone`
--
ALTER TABLE `zone_to_geo_zone`
  ADD PRIMARY KEY (`zone_to_geo_zone_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `api`
--
ALTER TABLE `api`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `banner_image`
--
ALTER TABLE `banner_image`
  MODIFY `banner_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
--
-- AUTO_INCREMENT для таблицы `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `coupon_history`
--
ALTER TABLE `coupon_history`
  MODIFY `coupon_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `coupon_product`
--
ALTER TABLE `coupon_product`
  MODIFY `coupon_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_activity`
--
ALTER TABLE `customer_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_ban_ip`
--
ALTER TABLE `customer_ban_ip`
  MODIFY `customer_ban_ip_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `customer_group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_history`
--
ALTER TABLE `customer_history`
  MODIFY `customer_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_ip`
--
ALTER TABLE `customer_ip`
  MODIFY `customer_ip_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `customer_login_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_reward`
--
ALTER TABLE `customer_reward`
  MODIFY `customer_reward_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_social`
--
ALTER TABLE `customer_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer_transaction`
--
ALTER TABLE `customer_transaction`
  MODIFY `customer_transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `custom_field`
--
ALTER TABLE `custom_field`
  MODIFY `custom_field_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `custom_field_value`
--
ALTER TABLE `custom_field_value`
  MODIFY `custom_field_value_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `download`
--
ALTER TABLE `download`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `extension`
--
ALTER TABLE `extension`
  MODIFY `extension_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `geo_zone`
--
ALTER TABLE `geo_zone`
  MODIFY `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `import_log`
--
ALTER TABLE `import_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `information`
--
ALTER TABLE `information`
  MODIFY `information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `information_to_product`
--
ALTER TABLE `information_to_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `layout`
--
ALTER TABLE `layout`
  MODIFY `layout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `layout_module`
--
ALTER TABLE `layout_module`
  MODIFY `layout_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `layout_route`
--
ALTER TABLE `layout_route`
  MODIFY `layout_route_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `marketing`
--
ALTER TABLE `marketing`
  MODIFY `marketing_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `modification`
--
ALTER TABLE `modification`
  MODIFY `modification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `order_voucher`
--
ALTER TABLE `order_voucher`
  MODIFY `order_voucher_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `param_filters`
--
ALTER TABLE `param_filters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT для таблицы `param_to_category`
--
ALTER TABLE `param_to_category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `param_value`
--
ALTER TABLE `param_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT для таблицы `param_value_to_product`
--
ALTER TABLE `param_value_to_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT для таблицы `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `product_special`
--
ALTER TABLE `product_special`
  MODIFY `product_special_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `return`
--
ALTER TABLE `return`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `return_action`
--
ALTER TABLE `return_action`
  MODIFY `return_action_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `return_history`
--
ALTER TABLE `return_history`
  MODIFY `return_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `return_reason`
--
ALTER TABLE `return_reason`
  MODIFY `return_reason_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `return_status`
--
ALTER TABLE `return_status`
  MODIFY `return_status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62594;
--
-- AUTO_INCREMENT для таблицы `stock_status`
--
ALTER TABLE `stock_status`
  MODIFY `stock_status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tax_class`
--
ALTER TABLE `tax_class`
  MODIFY `tax_class_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tax_rate`
--
ALTER TABLE `tax_rate`
  MODIFY `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tax_rule`
--
ALTER TABLE `tax_rule`
  MODIFY `tax_rule_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `upload`
--
ALTER TABLE `upload`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `url_alias`
--
ALTER TABLE `url_alias`
  MODIFY `url_alias_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `user_group`
--
ALTER TABLE `user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `voucher_history`
--
ALTER TABLE `voucher_history`
  MODIFY `voucher_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `voucher_theme`
--
ALTER TABLE `voucher_theme`
  MODIFY `voucher_theme_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `zone`
--
ALTER TABLE `zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT для таблицы `zone_to_geo_zone`
--
ALTER TABLE `zone_to_geo_zone`
  MODIFY `zone_to_geo_zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `information_description`
--
ALTER TABLE `information_description`
  ADD CONSTRAINT `fk_information_description_information1` FOREIGN KEY (`information_id`) REFERENCES `information` (`information_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_information_description_language1` FOREIGN KEY (`language_id`) REFERENCES `language` (`language_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_user_group1` FOREIGN KEY (`user_group_id`) REFERENCES `user_group` (`user_group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

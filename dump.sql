-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `affiliate_url`;
CREATE TABLE `affiliate_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `affiliate_url_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `affiliate_url` (`id`, `partner_id`, `hash`, `product_id`) VALUES
(2,	1,	'sdWcve58w',	1),
(3,	2,	'aaAOk9',	2);

DROP TABLE IF EXISTS `affiliate_url_log`;
CREATE TABLE `affiliate_url_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `affiliate_url_id` int(11) NOT NULL,
  `click_price` decimal(8,2) NOT NULL,
  `http_referer` varchar(255) DEFAULT NULL,
  `client_ip` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliate_url_id` (`affiliate_url_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `affiliate_url_log_ibfk_1` FOREIGN KEY (`affiliate_url_id`) REFERENCES `affiliate_url` (`id`),
  CONSTRAINT `affiliate_url_log_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `affiliate_url_log` (`id`, `datetime`, `affiliate_url_id`, `click_price`, `http_referer`, `client_ip`, `product_id`) VALUES
(1,	'2021-01-19 15:43:32',	2,	2.20,	NULL,	'127.0.0.1',	1),
(2,	'2021-01-19 15:45:08',	3,	3.00,	NULL,	'127.0.0.1',	2);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(2083) NOT NULL,
  `bid_price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product` (`id`, `url`, `bid_price`) VALUES
(1,	'https://www.alza.cz/samsung-galaxy-s21-5g?dq=6276498',	2.20),
(2,	'https://www.mall.cz/kuchynske-panve/tefal-panev-na-palacinky-25-cm-resist-d5161053?tab=parameters',	3.00);

-- 2021-01-19 14:45:51

CREATE DATABASE api_db;

USE api_db;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(32) NOT NULL,
  `params` text NOT NULL,
  `messages` text NOT NULL,
  `ip` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(1, 'login', '698d51a19d8a121ce581499d7b701668', 'login@gmail.com'),
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', 'alex@gmail.com');

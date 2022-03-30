
DROP TABLE IF EXISTS `trade`;
CREATE TABLE `trade` (
  `id` decimal(25,0) PRIMARY KEY,
  `type` varchar(20),
  `date` datetime NOT NULL,
  `amount` decimal(25,2) NOT NULL,
  `user` varchar(20),
  `concept` varchar(100)
);
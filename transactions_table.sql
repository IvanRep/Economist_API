
DROP TABLE IF EXISTS `Transacciones`;
CREATE TABLE `Transacciones` (
  `Id` decimal(25,0) PRIMARY KEY,
  `Tipo` varchar(20),
  `Fecha` datetime NOT NULL,
  `Importe` decimal(25,2) NOT NULL,
  `Usuario` varchar(20),
  `Concepto` varchar(100)
);
CREATE TABLE IF NOT EXISTS `llx_consultas` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `Ref` varchar(255) NOT NULL,
  `date_consultation` datetime DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `fk_user_pacientes` int(11) NOT NULL,
  `fk_user_creation` int(11) NOT NULL,
  `date_validation` datetime DEFAULT NULL,
  `fk_user_validation` int(11) DEFAULT NULL,
  `date_clos` datetime DEFAULT NULL,
  `fk_user_close` int(255) DEFAULT NULL,
  `Type_consultation` int(255) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `temperature` float DEFAULT NULL,
  `fk_user_med` varchar(255) DEFAULT NULL,
  `reason` int(255) DEFAULT NULL,
  `reason_detail` text,
  `diagnostics` int(255) DEFAULT NULL,
  `diagnostics_detail` text,
  `treatments` text,
  `comments` text,
  `fk_evento` int(11) DEFAULT NULL,
  `statut` int(11) NOT NULL,
  `entity` int(11) DEFAULT '1',
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.14-MariaDB : Database - responsipwb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`nama`,`username`,`password`) values 
(1,'Admin','admin','admin');

/*Table structure for table `data_pulsa` */

DROP TABLE IF EXISTS `data_pulsa`;

CREATE TABLE `data_pulsa` (
  `id_pulsa` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pulsa`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `data_pulsa` */

insert  into `data_pulsa`(`id_pulsa`,`provider`,`nominal`,`harga`,`id_admin`) values 
(3,'Telkomsel',5000,8000,1),
(4,'Telkomsel',10000,13000,1),
(5,'Telkomsel',25000,28000,1),
(6,'Telkomsel',50000,53000,1),
(8,'Telkomsel',100000,102000,1),
(15,'Three',5000,7000,1),
(18,'Three',10000,12000,1),
(20,'Three',50000,52000,1),
(21,'Three',100000,102500,1),
(23,'Indosat',5000,7000,1),
(25,'Indosat',10000,12500,1);

/*Table structure for table `detail_transaksi` */

DROP TABLE IF EXISTS `detail_transaksi`;

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `metode_bayar` varchar(255) DEFAULT NULL,
  `bayar` int(255) DEFAULT NULL,
  `sisa_bayar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `detail_transaksi_fk0` (`id_transaksi`),
  CONSTRAINT `detail_transaksi_fk0` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_transaksi` */

insert  into `detail_transaksi`(`id_detail`,`id_transaksi`,`tanggal`,`metode_bayar`,`bayar`,`sisa_bayar`) values 
(12,4,'2021-05-05','kartu Debit',8000,0),
(13,17,'2021-05-10','Tunai',102000,0),
(14,14,'2021-05-09','Voucher',28000,0),
(22,19,'2021-05-17','Tunai',50000,37500),
(35,24,'2021-05-23','Tunai',8000,0),
(36,38,'2021-05-23','Tunai',8000,0),
(38,46,'2021-05-23','kredit',102500,0),
(43,47,'2021-05-23','tunai',53000,1000);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`nama_pelanggan`,`username`,`password`,`no_hp`,`kota`) values 
(1,'Budi','budi','budi','081234567890','palangkaraya'),
(3,'Bambang',NULL,NULL,'089889988998','Muara Teweh'),
(4,'Maura',NULL,NULL,'087890988778','Palangkaraya'),
(5,'Petricia',NULL,NULL,'081332566556','Palangkaraya'),
(7,'Grace',NULL,NULL,'081122334455','Pulang Pisau'),
(12,'Maya',NULL,NULL,'089800001111','Kapuas'),
(13,'Chyntia',NULL,NULL,'081199880077','Murung Raya'),
(14,'Rachelv',NULL,NULL,'08888889999','Banjarmasin'),
(15,'Risa',NULL,NULL,'083322116789','Pulang Pisau'),
(17,'acil','acil','acil','081234567890','Palangkaraya');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pulsa` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jenis_pulsa` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `transaksi_fk0` (`id_pulsa`),
  KEY `transaksi_fk1` (`id_pelanggan`),
  CONSTRAINT `transaksi_fk0` FOREIGN KEY (`id_pulsa`) REFERENCES `data_pulsa` (`id_pulsa`),
  CONSTRAINT `transaksi_fk1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`id_pulsa`,`id_pelanggan`,`jenis_pulsa`) values 
(4,3,3,'Kuota'),
(14,5,1,'Regular'),
(17,8,7,'Kuota'),
(19,25,13,'Regular'),
(20,20,14,'Kuota'),
(21,20,12,'Kuota'),
(22,6,5,'Regular'),
(24,3,1,'Kuota'),
(38,3,17,'Kuota'),
(46,21,17,'Kuota'),
(47,20,17,'Kuota'),
(48,8,17,'Kuota');

/* Trigger structure for table `transaksi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_transaksi` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_transaksi` BEFORE DELETE ON `transaksi` FOR EACH ROW BEGIN
	DELETE detail_transaksi 
	FROM detail_transaksi 
	INNER JOIN transaksi 
	ON detail_transaksi.id_transaksi=transaksi.id_transaksi 
	WHERE transaksi.id_transaksi = old.id_transaksi;
    END */$$


DELIMITER ;

/* Function  structure for function  `LaporanTotal` */

/*!50003 DROP FUNCTION IF EXISTS `LaporanTotal` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `LaporanTotal`(metod_bayar VARCHAR(255)) RETURNS varchar(255) CHARSET utf8mb4
BEGIN
	DECLARE total VARCHAR(255);
	SELECT
	    SUM(dt.total_bayar)
	FROM
	    detail_transaksi AS dt
	WHERE
	    dt.metode_bayar = metod_bayar INTO total;
	RETURN total;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `manage_detailtransaksi` */

/*!50003 DROP PROCEDURE IF EXISTS  `manage_detailtransaksi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `manage_detailtransaksi`(IN `iddetail` INT(11), IN `idtransaksi` INT(11), IN `tanggal` date, IN `metodebayar` VARCHAR(225), IN `bayardet` INT(11), IN `StatementType` INT)
BEGIN
	
	IF StatementType = 1 THEN
		INSERT INTO detail_transaksi  
                        (id_transaksi, tanggal, metode_bayar, bayar, sisa_bayar)
		VALUES     (idtransaksi, tanggal, metodebayar, bayardet, (bayardet-(SELECT dp.harga FROM transaksi t JOIN data_pulsa dp ON dp.id_pulsa = t.id_pulsa WHERE t.id_transaksi = idtransaksi)));
	ELSEIF StatementType = 2 THEN
		UPDATE detail_transaksi  
		SET    id_transaksi = idtransaksi,  
                   tanggal = tanggal,
                   metode_bayar = metodebayar,
                   bayar = bayardet,
                   sisa_bayar = (bayardet-(SELECT dp.harga FROM transaksi t JOIN data_pulsa dp ON dp.id_pulsa = t.id_pulsa WHERE t.id_transaksi = idtransaksi))	
		WHERE  id_detail = iddetail;
	ELSEIF StatementType = 3 THEN
		DELETE FROM detail_transaksi  
		WHERE  id_detail = iddetail;
	END IF;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `manage_pelanggan` */

/*!50003 DROP PROCEDURE IF EXISTS  `manage_pelanggan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `manage_pelanggan`(IN `idpelanggan` INT(11), IN `namapelanggan` VARCHAR(255), IN `nohp` VARCHAR(255), in kota varchar(255), IN `StatementType` INT)
BEGIN
	
	IF StatementType = 1 THEN
		INSERT INTO pelanggan  
                        (nama_pelanggan, no_hp, kota)
		VALUES     (namapelanggan,nohp, kota);
	ELSEIF StatementType = 2 THEN
		UPDATE pelanggan  
		SET    nama_pelanggan = namapelanggan,  
                   no_hp = nohp,
                   kota = kota
		WHERE  id_pelanggan = idpelanggan;
	ELSEIF StatementType = 3 THEN
		DELETE FROM pelanggan  
		WHERE  id_pelanggan = idpelanggan;
	END IF;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `manage_pulsa` */

/*!50003 DROP PROCEDURE IF EXISTS  `manage_pulsa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `manage_pulsa`(IN `idpulsa` INT(11), IN `provider` VARCHAR(255), IN `nominal` int(11), IN harga int(11), IN `StatementType` INT)
BEGIN
	
	IF StatementType = 1 THEN
		INSERT INTO data_pulsa  
                        (provider, nominal, harga)
		VALUES     (provider,nominal, harga);
	ELSEIF StatementType = 2 THEN
		UPDATE data_pulsa  
		SET    provider = provider,  
                   nominal = nominal,
                   harga = harga
		WHERE  id_pulsa = idpulsa;
	ELSEIF StatementType = 3 THEN
		DELETE FROM data_pulsa  
		WHERE  id_pulsa = idpulsa;
	END IF;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `manage_transaksi` */

/*!50003 DROP PROCEDURE IF EXISTS  `manage_transaksi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `manage_transaksi`(IN `idtransaksi` INT(11), IN `idpulsa` int(11), IN `idpelanggan` INT(11), IN jenispulsa varchar(225), IN `StatementType` INT)
BEGIN
	
	IF StatementType = 1 THEN
		INSERT INTO transaksi  
                        (id_pulsa, id_pelanggan, Jenis_pulsa)
		VALUES     (idpulsa,idpelanggan, jenispulsa);
	ELSEIF StatementType = 2 THEN
		UPDATE transaksi  
		SET    id_pulsa = idpulsa,  
                   id_pelanggan = idpelanggan,
                   Jenis_pulsa = jenispulsa
		WHERE  id_transaksi = idtransaksi;
	ELSEIF StatementType = 3 THEN
		DELETE FROM transaksi  
		WHERE  id_transaksi = idtransaksi;
	END IF;
	END */$$
DELIMITER ;

/*Table structure for table `belum_terproses` */

DROP TABLE IF EXISTS `belum_terproses`;

/*!50001 DROP VIEW IF EXISTS `belum_terproses` */;
/*!50001 DROP TABLE IF EXISTS `belum_terproses` */;

/*!50001 CREATE TABLE  `belum_terproses`(
 `id_transaksi` int(11) ,
 `nama_pelanggan` varchar(255) 
)*/;

/*View structure for view belum_terproses */

/*!50001 DROP TABLE IF EXISTS `belum_terproses` */;
/*!50001 DROP VIEW IF EXISTS `belum_terproses` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `belum_terproses` AS select `t`.`id_transaksi` AS `id_transaksi`,`p`.`nama_pelanggan` AS `nama_pelanggan` from (`transaksi` `t` join `pelanggan` `p` on(`t`.`id_pelanggan` = `p`.`id_pelanggan` and !(`t`.`id_transaksi` in (select `t`.`id_transaksi` from ((`detail_transaksi` `dp` join `transaksi` `t` on(`dp`.`id_transaksi` = `t`.`id_transaksi`)) join `pelanggan` `p` on(`t`.`id_pelanggan` = `p`.`id_pelanggan`)))))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

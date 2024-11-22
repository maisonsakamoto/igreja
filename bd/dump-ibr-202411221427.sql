-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: ibr
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `membresia`
--

DROP TABLE IF EXISTS `membresia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membresia` (
  `id_membresia` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `nascimento_cidade` varchar(30) DEFAULT NULL,
  `nascimento_estado` varchar(2) DEFAULT NULL,
  `estado_civil` varchar(1) DEFAULT NULL COMMENT '1  solteiro  -  2 casado  -  3 viuvo  -  divorciado  -  outro',
  `conjuge` varchar(50) DEFAULT NULL,
  `casamento` date DEFAULT NULL,
  `nome_pai` varchar(50) DEFAULT NULL,
  `nome_mae` varchar(50) DEFAULT NULL,
  `grau_instrucao` varchar(1) DEFAULT NULL,
  `endereco_rua` varchar(50) DEFAULT NULL,
  `endereco_numero` int(11) DEFAULT NULL,
  `endereco_bairo` varchar(50) DEFAULT NULL,
  `endereco_cep` varchar(10) DEFAULT NULL,
  `endereco_complemento` varchar(50) DEFAULT NULL,
  `endereco_cidade` varchar(30) DEFAULT NULL,
  `endereco_estado` varchar(2) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `rede_social` varchar(50) DEFAULT NULL,
  `trabalho_local` varchar(50) DEFAULT NULL,
  `trabalho_ramo` varchar(30) DEFAULT NULL,
  `batismo` varchar(1) DEFAULT NULL,
  `batismo_igreja` varchar(50) DEFAULT NULL,
  `batismo_data` date DEFAULT NULL,
  `batismo_pastor` varchar(50) DEFAULT NULL,
  `batismo_cidade` varchar(30) DEFAULT NULL,
  `batismo_estado` varchar(2) DEFAULT NULL,
  `uso_ibr_membresia` varchar(1) DEFAULT NULL,
  `uso_ibr_data` date DEFAULT NULL,
  `uso_ibr_ata` varchar(11) DEFAULT NULL,
  `uso_ibr_pastor` varchar(50) DEFAULT NULL,
  `uso_ibr_igreja` varchar(50) DEFAULT NULL,
  `uso_ibr_desligamento` date DEFAULT NULL,
  `uso_ibr_desliga_ata` varchar(11) DEFAULT NULL,
  `uso_ibr_desliga_motivo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_membresia`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membresia`
--

LOCK TABLES `membresia` WRITE;
/*!40000 ALTER TABLE `membresia` DISABLE KEYS */;
INSERT INTO `membresia` VALUES (1,'CELSO MOSSANE','1958-08-30','APUCARANA','PR','3','JARLENE MOSSANE','1978-01-07','FABIANO','ANITA','1','endereco rua',0,'bairro','cep','complemento','cidade','es','(45)3522-1216','(45)98806-0000','email','rede social','trabalho','trabalho ramo','S','Ceifa','1995-12-15','BATISMO PASTOR','BATISMO CIDADE','RR','1','2024-07-12','uso_ibr_ata','uso_ibr_pastor','uso_ibr_igreja',NULL,NULL,NULL),(2,'teste',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'AAAAAA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'BBBB',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'CCCCC 5',NULL,'','','','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','',NULL,'','','',NULL,NULL,NULL),(33,'dsfsfdsdd  33',NULL,'','','','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','',NULL,'','','',NULL,NULL,NULL),(34,'fdfdfdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,'ghghghghg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,'HJHJHJ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,'IOIOIOIOI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,'JKJKJKJKJ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,'KLKLKLKL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,'LMLMLMLM',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,'MNMNMNMN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,'NBNBNBNBBN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,'OPOPOPOP',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,'PWPWPWPW',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,'TRTRTRTR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(46,'LALALALALA  LALALALA   LALALALALAL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(94,'KSKDSKDS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(95,'KDFKSDKSKSKDS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(96,'OPEKIRTOTORTR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(97,'HSBDHSBDHSD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(98,'IEJIEJRIEJR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(99,'KIOSJDFSSFNJD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(100,'DSDSDSD  SDSDSDS  SDSDSD SDSDS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(101,'BARTHOLO TRANSPORTES RODOVIARIOS LTDA',NULL,'','','','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','',NULL,'','','',NULL,NULL,NULL),(102,'Z10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(103,'Z11Z',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(104,'Z12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(105,'Z13Z',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(108,'AA NOVO MEMBRO 14 08 2024   15:51',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-28','108','desliga'),(109,'aa NOVO   109','1958-08-30','','','','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','',NULL,'','','','2024-08-28','109','desliga'),(110,'AAA   110','2024-08-14','FOZ DO IGUAÇU','','','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','',NULL,'','','','2024-08-28','110','vamos'),(111,'AAA   111','2024-08-14','FOZ DO IGUAÇU','PR','2','CONJUGE',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','',NULL,'','','','2024-08-28','111','desliga membro 111'),(112,'AAA   111','2024-08-14','CIDADE','PR','2','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','',NULL,'','','','2024-08-28','112','desligamento 112'),(113,'aaa  113','2024-08-14','CIDADEW','PR','3','CONJUGE',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','',NULL,'','','','2024-08-28','113/24','desligamento 113'),(114,'aaa  114','2024-08-14','cidade nascimento','pr','4','nome conjuge',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-13','123','teste'),(115,'aaa  115','2024-08-14','CIDADE','PR','4','CONJUGE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(149,'149    65665',NULL,'','','','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','1','2024-08-19',NULL,NULL,NULL,'2024-08-28','149','desliga'),(150,'150    2222',NULL,'','','','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','1',NULL,'','','','2024-08-28','150','DESLIGA'),(151,'151 ',NULL,'','','','',NULL,'','','','',0,'','','','','','','','','','','','','',NULL,'','','','3','2024-08-19','ata','pastor','igreja','2024-08-28','151','DESLIGA'),(152,'CELSO MOSSANE ','1958-08-30','APUCARANA ','PR','3','JARLENE MOSSANE','1978-01-07','FAIANO MOSSANE','ANITA H MOSSANE','2','AV FELIPE WANDSCHEER',4430,'JARDIM SAO ROQUE','85.853-703','CONDOMINIO ECO BELLA VISTA','FOZ DO IGUAÇU','PR','(45) 3522-1216','(45) 98806-0000','cmossane@gmail.com','celso.mossane','BTR TRANSPORTES','TRANSPORTES RODOVIARIOS','1','CEIFA','2000-01-07','EUGENIO','FOZ DO IGUAÇU','PR','2','2000-01-07','030/2000','JOSIAS DAMAS','IBR CENTRO',NULL,NULL,NULL),(153,'PRISCILA NASCIMENTO MOSSANE','1982-10-31','FOZ DO IGUAÇU','PR','1','',NULL,'CELSO MOSSANE','JARLENE MOSSANE','3','AV FELIPE WANDSCHEER',4430,'SAO ROQUE','85.853-703','COND ECO BELLA VISTA','FOZ DO IGUAÇU','PR','(45) 3522-1216','(45) 98806-0002','pmossane@gmail.com','priscila.mossane','BTR ','TRANSPORTES','1','CEIFA','2000-01-01','EUGENIO','FOZ DO IGUAÇU','PR','2','2000-02-02','ata 030/200','JOSIAS DAMAS','IBR CENTRO',NULL,NULL,NULL);
/*!40000 ALTER TABLE `membresia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membros_filhos`
--

DROP TABLE IF EXISTS `membros_filhos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membros_filhos` (
  `id_filho` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `id_membro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_filho`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membros_filhos`
--

LOCK TABLES `membros_filhos` WRITE;
/*!40000 ALTER TABLE `membros_filhos` DISABLE KEYS */;
INSERT INTO `membros_filhos` VALUES (1,'FILHO CELSO','2024-01-01',1),(7,'FILHO BARTHOLO','2024-01-01',101),(10,'FILHO 3 CCCC 5','2024-01-01',5),(16,'CELSO FILHOP 6','2024-01-01',1),(17,'CELSO FILHO 7','2024-01-01',1);
/*!40000 ALTER TABLE `membros_filhos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano_contas_conta`
--

DROP TABLE IF EXISTS `plano_contas_conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plano_contas_conta` (
  `id_contas` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` int(11) DEFAULT NULL,
  `conta_nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_contas`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano_contas_conta`
--

LOCK TABLES `plano_contas_conta` WRITE;
/*!40000 ALTER TABLE `plano_contas_conta` DISABLE KEYS */;
INSERT INTO `plano_contas_conta` VALUES (1,1,'CONTA TES'),(2,2,'CONTRA TESTE 2'),(3,2,NULL),(4,2,'fdgffgffg'),(5,2,'KDFJNGKDNJMKDFFD'),(6,2,'TYTRYTRTERERERE'),(7,2,'FGHFGFGFGFGFG  777'),(8,2,'HGJHKJKJKKJJ  88'),(9,2,'yujtiukjilkhjl,jhlk,mm,  CONTA 9'),(10,2,'FGFGFGFG 10'),(11,2,'fgfgfgfgfgg'),(12,2,'GRUPOTESTE2ID1SDSDSDSDSDSDSDSD'),(13,2,'sdsdsdsdlsldsdsds'),(14,2,'GRUPO TESTE 2   ID 2   SDSDSDS'),(15,1,'GRUPO TESTE   ID 1'),(16,1,'GRUPO TESTE  ID 1 07/05  14:21'),(17,1,'GRUPO TES 1   ID1  07/05  14:24'),(18,1,'GRUPO TESTE  ID1  07/05  14:28'),(19,1,'GRUPO TESTE  07/05  14:41'),(20,2,'GRUPO TESTE 2 07/05 14:52'),(21,2,'07/05  14:54'),(22,1,'07/05  16:14'),(23,2,'07/05  16:16'),(24,1,'07/05  17:17'),(25,2,'07/05  15:19'),(26,2,'07/05   16:20'),(27,2,'sdsdsdsd'),(28,2,'fgfgfgfgfgfg'),(29,2,'sldmksldkslkd,sdsd'),(30,2,'orejikperotgoesjjedfgksdfgfdgfdf'),(31,2,'hhghghghghgh'),(32,2,'32     32323232323'),(33,1,'33   3332323232323º'),(34,2,'34   6565656565'),(35,6,'nova conta  14/05  10:42'),(36,11,'NOVA CONTA 14/05  10:49'),(37,8,'NOVA CONTA 14/05 10:52'),(38,10,'14/05 10:52');
/*!40000 ALTER TABLE `plano_contas_conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano_contas_grupo`
--

DROP TABLE IF EXISTS `plano_contas_grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plano_contas_grupo` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano_contas_grupo`
--

LOCK TABLES `plano_contas_grupo` WRITE;
/*!40000 ALTER TABLE `plano_contas_grupo` DISABLE KEYS */;
INSERT INTO `plano_contas_grupo` VALUES (1,'GRUPO 1'),(2,'GRUPO TESTE 2 2 2 2'),(3,'GRUPO 3'),(4,'NOVO GRUPO  16:25'),(5,'NOVO GRUPO 16:28'),(6,'NOVO GRUPO 16:33'),(7,'NOVO GRUPO 16:38'),(8,'NOVO GRUPO 16:50'),(9,'14/05  10:40'),(10,'ALTERANDO ID 10'),(11,'NOVO GRUPO 14/05  10:47'),(12,'NOVO GRUPO 14/05  10:55'),(13,'ALTERANDO ID 13'),(14,'NOVO GRUPO 21/05  15:41'),(15,'NOVO GRUPO 14/05 10:58'),(16,'NOVO GRUPO 14/05  11:00'),(17,'NOVO GRUPO 14/05  13:42'),(18,'NOVO GRUPO 14/05  13:45'),(19,'ALTERANDO ID 19 TESTE'),(20,'ALTERANDO ID 20'),(21,'ALTERANDO ID 21'),(22,'ALTERANDO ID 22'),(23,'NOVO GRUPO 14/05  11:00   IDE 16'),(24,'NOVO GRUPO 14/05  16:17  '),(25,'HDBHFBDGHFDHFDFD  14/05  25'),(26,''),(27,''),(28,''),(29,'');
/*!40000 ALTER TABLE `plano_contas_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano_contas_lancamento`
--

DROP TABLE IF EXISTS `plano_contas_lancamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plano_contas_lancamento` (
  `lanc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK da tabela',
  `lanc_dt_emissao` date NOT NULL COMMENT 'Data da emissao do lancamento',
  `lanc_descricao` varchar(255) NOT NULL COMMENT 'Descricao do lancamento',
  `lanc_valor` decimal(10,2) NOT NULL,
  `lanc_conta` int(11) NOT NULL COMMENT 'FK da tab_plano_conta',
  `lanc_tipo` varchar(1) DEFAULT NULL COMMENT 'R - Receita\r\nD - Despesa',
  PRIMARY KEY (`lanc_id`),
  KEY `plano_contas_lancamento_plano_contas_conta_FK` (`lanc_conta`),
  CONSTRAINT `plano_contas_lancamento_plano_contas_conta_FK` FOREIGN KEY (`lanc_conta`) REFERENCES `plano_contas_conta` (`id_contas`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano_contas_lancamento`
--

LOCK TABLES `plano_contas_lancamento` WRITE;
/*!40000 ALTER TABLE `plano_contas_lancamento` DISABLE KEYS */;
INSERT INTO `plano_contas_lancamento` VALUES (6,'2024-09-17','SABE DEUS',30.00,34,'R'),(7,'2024-09-17','TESTE',50.00,25,'D');
/*!40000 ALTER TABLE `plano_contas_lancamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ibr'
--

--
-- Dumping routines for database 'ibr'
--
/*!50003 DROP PROCEDURE IF EXISTS `proc_criar_tab_log` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `proc_criar_tab_log`(IN tabela_nome VARCHAR(100))
BEGIN
     /*
     * Maison K. Sakamoto - 17/05/2024 - Procedure para criar triggers e tabela de logs
     * @tabela_nome - nome do tabela que será copiada para o database de log
     * O que isso tudo faz?
     *    Ao receber o nome da tabela a rotina cria uma tabela no schema+'_log' 
     *    Ex: se rodar em schema 'local' irá criar a tabela em 'local_log'
     *    E se rodar em 'dbpy' irá criar a tabela em 'dbpy_log'
     * Após criar a tabela de log ele faz as triggers de AFTER INSERT para eventos de INSERT, UPDATE e DELETE
     */    
	
    -- recebe o parametro da procedure
    SET @tabela_nome = tabela_nome;            
    -- Define o schema de origem
    SET @origem_schema = DATABASE();
    -- Define o schema de destino
    SET @destino_schema = CONCAT(@origem_schema, '_log');    
    -- Nome da tabela de log
    SET @log_table_name = CONCAT(@destino_schema, '.log_', @tabela_nome);   
    -- contar os registros para ver se já existe a tabela no 
    SET @contador = 0; 
   
   -- carrega a variavel @contador
   SELECT COUNT(*) INTO @contador FROM information_schema.tables WHERE table_schema = @destino_schema AND table_name = @log_table_name;
   
   -- Criação da tabela de log
    SET @create_table_query = CONCAT('CREATE TABLE IF NOT EXISTS ', @log_table_name, ' (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(45),
        data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
        host VARCHAR(45),
        operacao VARCHAR(2),
        INDEX idx_data_hora (data_hora)
    )');     
   -- Executa a consulta de criação da tabela de log    
    EXECUTE IMMEDIATE @create_table_query;
   
    
    -- Variavel auxiliar para adicionar as colunas da tabela original na tabela de log
    SET @col_nome_e_tipo = '';
   
    -- Concatena resultados e insere na variavel auxiliar 
    SELECT GROUP_CONCAT(CONCAT('ADD COLUMN ', COLUMN_NAME, ' ', COLUMN_TYPE)) INTO @col_nome_e_tipo FROM information_schema.columns WHERE table_schema = @origem_schema AND table_name = @tabela_nome;
    set @smt_query = concat('ALTER TABLE ', @log_table_name, ' ', @col_nome_e_tipo);
    -- Executa a consulta de adição de colunas
    EXECUTE IMMEDIATE @smt_query;

 
   -- Variavel auxiliar para adicionar as colunas da table que vem do parametro
   SET @col_nome = '';
   SELECT GROUP_CONCAT(CONCAT(COLUMN_NAME,' ')) INTO @col_nome FROM information_schema.columns WHERE table_schema = @origem_schema AND table_name = @tabela_nome;
  
   -- Variavel auxiliar para adicionar o novo valor na tabela de log
   set @col_new_value = '';
   SELECT GROUP_CONCAT(CONCAT(' NEW.',COLUMN_NAME)) INTO @col_new_value FROM information_schema.columns WHERE table_schema = @origem_schema AND table_name = @tabela_nome;
   
   -- Variavel auxiliar para adiciar o valor antigo da tabela na tabela de log
   set @col_old_value = '';
   SELECT GROUP_CONCAT(CONCAT(' OLD.',COLUMN_NAME)) INTO @col_old_value FROM information_schema.columns WHERE table_schema = @origem_schema AND table_name = @tabela_nome;
  
  
    -- Criação dos triggers
    SET @insert_trigger_query = CONCAT(
	    'DELIMITER $$ \n',
	    'use ',@origem_schema,' $$ \n',
	    'CREATE TRIGGER tg_', @tabela_nome, '_after_i AFTER INSERT ON ', @origem_schema, '.', @tabela_nome, ' FOR EACH ROW
	        BEGIN
	            INSERT INTO ', @log_table_name, ' (user_name, data_hora, host, operacao, ',@col_nome,' )
	            VALUES (substring_index(user(),\'@\',1), NOW(), @@hostname, "I", ', @col_new_value,');
	        END$$ \n',            
	        
	
	    -- SET @update_trigger_query = CONCAT(
	    'CREATE TRIGGER tg_', @tabela_nome, '_after_u AFTER UPDATE ON ', @origem_schema, '.', @tabela_nome, ' FOR EACH ROW
	        BEGIN
	            INSERT INTO ', @log_table_name, ' (user_name, data_hora, host, operacao, ',@col_nome,' )
	            VALUES (substring_index(user(),\'@\',1), NOW(), @@hostname, "U", ', @col_new_value,');
	        END$$ \n',            
	
	    -- SET @delete_trigger_query = CONCAT(
	    'CREATE TRIGGER tg_', @tabela_nome, '_after_d AFTER DELETE ON ', @origem_schema, '.', @tabela_nome, ' FOR EACH ROW
	        BEGIN
	            INSERT INTO ', @log_table_name, ' (user_name, data_hora, host, operacao, ',@col_nome,' )
	            VALUES (substring_index(user(),\'@\',1), NOW() , @@hostname, "D", ', @col_old_value,');
	        END$$ \n',
        'DELIMITER ;'
    );   
       
    -- Exibe o código das triggers
    SELECT @insert_trigger_query AS 'Trigger AFTER INSERT'; -- , @update_trigger_query AS 'Trigger AFTER UPDATE', @delete_trigger_query AS 'Trigger AFTER DELETE';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-22 14:27:03

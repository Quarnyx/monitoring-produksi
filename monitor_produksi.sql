/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : 127.0.0.1:3306
 Source Schema         : monitor_produksi

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 23/04/2026 15:58:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for detail_produksi_defect
-- ----------------------------
DROP TABLE IF EXISTS `detail_produksi_defect`;
CREATE TABLE `detail_produksi_defect`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `hasil_produksi_id` int NULL DEFAULT NULL,
  `kategori_defect_id` int NULL DEFAULT NULL,
  `jumlah` int NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `produk_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kategori_defect_id`(`kategori_defect_id` ASC) USING BTREE,
  INDEX `hasil_produksi_id`(`hasil_produksi_id` ASC) USING BTREE,
  INDEX `id_produk`(`produk_id` ASC) USING BTREE,
  CONSTRAINT `detail_produksi_defect_ibfk_2` FOREIGN KEY (`kategori_defect_id`) REFERENCES `kategori_defect` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_produksi_defect_ibfk_3` FOREIGN KEY (`hasil_produksi_id`) REFERENCES `hasil_produksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_produksi_defect_ibfk_4` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_produksi_defect
-- ----------------------------
INSERT INTO `detail_produksi_defect` VALUES (3, 103, 1, 1, 'oio', 1);

-- ----------------------------
-- Table structure for hasil_produksi
-- ----------------------------
DROP TABLE IF EXISTS `hasil_produksi`;
CREATE TABLE `hasil_produksi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_produksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah_bagus` int NULL DEFAULT NULL,
  `jumlah_reject` int NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tanggal` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 203 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hasil_produksi
-- ----------------------------
INSERT INTO `hasil_produksi` VALUES (103, 'CE-AA-4585-V', 22, 28, 'In a Telnet session, all communications, including username and password, are transmitted           ', '2026-04-02');
INSERT INTO `hasil_produksi` VALUES (104, 'EA-DD-1466-W', 26, 91, 'Export Wizard allows you to export data from tables, collections, views, or query                   ', '2026-04-30');
INSERT INTO `hasil_produksi` VALUES (105, 'EF-DB-9625-N', 80, 100, 'Champions keep playing until they get it right. Navicat Data Modeler is a powerful                  ', '2026-04-25');
INSERT INTO `hasil_produksi` VALUES (106, 'BD-DD-4601-I', 10, 81, 'Typically, it is employed as an encrypted version of Telnet. Export Wizard allows                   ', '2026-04-18');
INSERT INTO `hasil_produksi` VALUES (107, 'EC-EB-0005-C', 77, 23, 'The repository database can be an existing MySQL, MariaDB, PostgreSQL, SQL Server,                  ', '2026-04-09');
INSERT INTO `hasil_produksi` VALUES (108, 'AA-CD-0003-X', 99, 42, 'Navicat Monitor requires a repository to store alerts and metrics for historical analysis.', '2026-04-07');
INSERT INTO `hasil_produksi` VALUES (109, 'DA-FE-5661-S', 26, 29, 'The repository database can be an existing MySQL, MariaDB, PostgreSQL, SQL Server,                  ', '2026-04-05');
INSERT INTO `hasil_produksi` VALUES (110, 'CE-BC-1645-K', 27, 46, 'Navicat is a multi-connections Database Administration tool allowing you to connect                 ', '2026-04-17');
INSERT INTO `hasil_produksi` VALUES (111, 'DB-EF-0030-Q', 42, 75, 'The On Startup feature allows you to control what tabs appear when you launch Navicat.', '2026-04-27');
INSERT INTO `hasil_produksi` VALUES (112, 'DA-AF-7628-K', 82, 8, 'Navicat authorizes you to make connection to remote servers running on different                    ', '2026-04-23');
INSERT INTO `hasil_produksi` VALUES (113, 'CE-EA-9949-Y', 70, 10, 'Always keep your eyes open. Keep watching. Because whatever you see can inspire you.                ', '2026-04-05');
INSERT INTO `hasil_produksi` VALUES (114, 'AC-BF-0915-L', 57, 51, 'Navicat allows you to transfer data from one database and/or schema to another with                 ', '2026-04-03');
INSERT INTO `hasil_produksi` VALUES (115, 'DB-DE-0140-W', 96, 47, 'A man’s best friends are his ten fingers. Secure SHell (SSH) is a program to log                  ', '2026-04-12');
INSERT INTO `hasil_produksi` VALUES (116, 'CD-BF-4579-S', 38, 78, 'You cannot save people, you can just love them. The Navigation pane employs tree                    ', '2026-04-09');
INSERT INTO `hasil_produksi` VALUES (117, 'CB-ED-6247-E', 66, 0, 'I may not have gone where I intended to go, but I think I have ended up where I needed to be.       ', '2026-04-09');
INSERT INTO `hasil_produksi` VALUES (118, 'BE-DE-8773-Z', 72, 65, 'The Navigation pane employs tree structure which allows you to take action upon the                 ', '2026-04-23');
INSERT INTO `hasil_produksi` VALUES (119, 'BC-EF-5490-G', 40, 2, 'The past has no power over the present moment. You can select any connections, objects              ', '2026-04-12');
INSERT INTO `hasil_produksi` VALUES (120, 'BE-AF-3251-P', 85, 55, 'Navicat Monitor can be installed on any local computer or virtual machine and does                  ', '2026-04-02');
INSERT INTO `hasil_produksi` VALUES (121, 'DB-FB-0605-X', 52, 56, 'Creativity is intelligence having fun. I may not have gone where I intended to go,                  ', '2026-04-26');
INSERT INTO `hasil_produksi` VALUES (122, 'DC-AD-0337-O', 59, 19, 'Export Wizard allows you to export data from tables, collections, views, or query                   ', '2026-04-21');
INSERT INTO `hasil_produksi` VALUES (123, 'BE-AF-6754-N', 99, 35, 'Navicat Monitor can be installed on any local computer or virtual machine and does                  ', '2026-04-16');
INSERT INTO `hasil_produksi` VALUES (124, 'DF-EA-1196-I', 82, 64, 'The On Startup feature allows you to control what tabs appear when you launch Navicat.', '2026-04-03');
INSERT INTO `hasil_produksi` VALUES (125, 'BB-EE-0341-V', 43, 12, 'I will greet this day with love in my heart. Navicat allows you to transfer data                    ', '2026-04-09');
INSERT INTO `hasil_produksi` VALUES (126, 'FF-AD-7464-R', 41, 43, 'Instead of wondering when your next vacation is, maybe you should set up a life you                 ', '2026-04-12');
INSERT INTO `hasil_produksi` VALUES (127, 'BA-FE-3829-J', 96, 15, 'Anyone who has ever made anything of importance was disciplined. In a Telnet session,               ', '2026-04-24');
INSERT INTO `hasil_produksi` VALUES (128, 'EB-CC-1128-X', 10, 94, 'In a Telnet session, all communications, including username and password, are transmitted           ', '2026-04-07');
INSERT INTO `hasil_produksi` VALUES (129, 'DA-CA-8933-U', 76, 24, 'Genius is an infinite capacity for taking pains. Navicat allows you to transfer data                ', '2026-04-20');
INSERT INTO `hasil_produksi` VALUES (130, 'CD-AA-5107-E', 6, 68, 'You will succeed because most people are lazy. The repository database can be an                    ', '2026-04-10');
INSERT INTO `hasil_produksi` VALUES (131, 'FB-DF-2133-H', 62, 73, 'Success consists of going from failure to failure without loss of enthusiasm.                       ', '2026-04-03');
INSERT INTO `hasil_produksi` VALUES (132, 'CA-ED-6601-C', 80, 70, 'Difficult circumstances serve as a textbook of life for people. If you wait, all                    ', '2026-04-22');
INSERT INTO `hasil_produksi` VALUES (133, 'AE-EE-8291-O', 27, 70, 'You must be the change you wish to see in the world.', '2026-04-16');
INSERT INTO `hasil_produksi` VALUES (134, 'CA-CF-5425-E', 78, 71, 'The Main Window consists of several toolbars and panes for you to work on connections,              ', '2026-04-13');
INSERT INTO `hasil_produksi` VALUES (135, 'AB-EB-1145-W', 14, 81, 'Navicat Data Modeler is a powerful and cost-effective database design tool which                    ', '2026-04-14');
INSERT INTO `hasil_produksi` VALUES (136, 'CD-FE-5399-Y', 60, 68, 'All journeys have secret destinations of which the traveler is unaware.                             ', '2026-04-29');
INSERT INTO `hasil_produksi` VALUES (137, 'EA-EB-9391-V', 60, 70, 'SSH serves to prevent such vulnerabilities and allows you to access a remote server\'s               ', '2026-04-26');
INSERT INTO `hasil_produksi` VALUES (138, 'CC-EF-0104-M', 53, 7, 'The Main Window consists of several toolbars and panes for you to work on connections,              ', '2026-04-18');
INSERT INTO `hasil_produksi` VALUES (139, 'EA-AA-5601-K', 91, 58, 'To clear or reload various internal caches, flush tables, or acquire locks, control-click           ', '2026-04-06');
INSERT INTO `hasil_produksi` VALUES (140, 'DB-BA-5092-Z', 56, 60, 'In the middle of winter I at last discovered that there was in me an invincible summer.', '2026-04-19');
INSERT INTO `hasil_produksi` VALUES (141, 'AC-DF-1605-Q', 38, 98, 'Always keep your eyes open. Keep watching. Because whatever you see can inspire you.                ', '2026-04-20');
INSERT INTO `hasil_produksi` VALUES (142, 'DA-CA-8401-L', 86, 94, 'To clear or reload various internal caches, flush tables, or acquire locks, control-click           ', '2026-04-23');
INSERT INTO `hasil_produksi` VALUES (143, 'EA-DD-2803-I', 71, 98, 'Navicat 15 has added support for the system-wide dark mode. Creativity is intelligence having fun.', '2026-04-17');
INSERT INTO `hasil_produksi` VALUES (144, 'DD-FB-1519-I', 96, 17, 'HTTP Tunneling is a method for connecting to a server that uses the same protocol                   ', '2026-04-12');
INSERT INTO `hasil_produksi` VALUES (145, 'BE-FE-3903-T', 92, 87, 'To successfully establish a new connection to local/remote server - no matter via                   ', '2026-04-05');
INSERT INTO `hasil_produksi` VALUES (146, 'AD-CE-9881-L', 39, 92, 'SSH serves to prevent such vulnerabilities and allows you to access a remote server\'s               ', '2026-04-10');
INSERT INTO `hasil_produksi` VALUES (147, 'FB-AC-2752-O', 15, 78, 'Remember that failure is an event, not a person. Such sessions are also susceptible                 ', '2026-04-01');
INSERT INTO `hasil_produksi` VALUES (148, 'DF-FB-2926-I', 83, 93, 'If your Internet Service Provider (ISP) does not provide direct access to its server,               ', '2026-04-19');
INSERT INTO `hasil_produksi` VALUES (149, 'EB-FE-4895-A', 19, 59, 'A comfort zone is a beautiful place, but nothing ever grows there. A man’s best                   ', '2026-04-29');
INSERT INTO `hasil_produksi` VALUES (150, 'EC-FC-6793-G', 12, 75, 'Secure Sockets Layer(SSL) is a protocol for transmitting private documents via the Internet.', '2026-04-07');
INSERT INTO `hasil_produksi` VALUES (151, 'CB-BA-6868-K', 90, 28, 'In the middle of winter I at last discovered that there was in me an invincible summer.', '2026-04-01');
INSERT INTO `hasil_produksi` VALUES (152, 'AC-AE-1843-C', 71, 18, 'Export Wizard allows you to export data from tables, collections, views, or query                   ', '2026-04-04');
INSERT INTO `hasil_produksi` VALUES (153, 'CC-ED-3965-A', 39, 61, 'After comparing data, the window shows the number of records that will be inserted,                 ', '2026-04-16');
INSERT INTO `hasil_produksi` VALUES (154, 'EC-FF-0868-C', 56, 51, 'The Navigation pane employs tree structure which allows you to take action upon the                 ', '2026-04-06');
INSERT INTO `hasil_produksi` VALUES (155, 'DE-CB-7826-R', 3, 18, 'You will succeed because most people are lazy. What you get by achieving your goals                 ', '2026-04-17');
INSERT INTO `hasil_produksi` VALUES (156, 'AE-CF-0021-P', 73, 78, 'In the Objects tab, you can use the List List, Detail Detail and ER Diagram ER Diagram              ', '2026-04-15');
INSERT INTO `hasil_produksi` VALUES (157, 'CD-DA-3043-Y', 56, 95, 'To connect to a database or schema, simply double-click it in the pane.', '2026-04-14');
INSERT INTO `hasil_produksi` VALUES (158, 'CB-DC-5619-G', 84, 89, 'A query is used to extract data from the database in a readable format according                    ', '2026-04-08');
INSERT INTO `hasil_produksi` VALUES (159, 'FC-BA-2304-Z', 11, 36, 'In other words, Navicat provides the ability for data in different databases and/or                 ', '2026-04-25');
INSERT INTO `hasil_produksi` VALUES (160, 'AC-AA-1547-A', 79, 74, 'I may not have gone where I intended to go, but I think I have ended up where I needed to be.', '2026-04-07');
INSERT INTO `hasil_produksi` VALUES (161, 'BB-BB-4849-M', 78, 71, 'Navicat Data Modeler enables you to build high-quality conceptual, logical and physical             ', '2026-04-27');
INSERT INTO `hasil_produksi` VALUES (162, 'FA-EA-4669-K', 68, 84, 'All journeys have secret destinations of which the traveler is unaware.', '2026-04-30');
INSERT INTO `hasil_produksi` VALUES (163, 'CE-BA-2288-W', 37, 66, 'A comfort zone is a beautiful place, but nothing ever grows there. Navicat Cloud                    ', '2026-04-24');
INSERT INTO `hasil_produksi` VALUES (164, 'AD-EC-5649-M', 10, 8, 'Remember that failure is an event, not a person. The repository database can be an                  ', '2026-04-19');
INSERT INTO `hasil_produksi` VALUES (165, 'DB-EC-4389-K', 29, 44, 'Navicat Monitor can be installed on any local computer or virtual machine and does                  ', '2026-04-27');
INSERT INTO `hasil_produksi` VALUES (166, 'AB-EF-4058-M', 80, 79, 'It wasn’t raining when Noah built the ark. It provides strong authentication and                  ', '2026-04-01');
INSERT INTO `hasil_produksi` VALUES (167, 'FB-BD-8554-G', 78, 56, 'Champions keep playing until they get it right. What you get by achieving your goals                ', '2026-04-17');
INSERT INTO `hasil_produksi` VALUES (168, 'FC-FB-5105-T', 61, 9, 'Navicat Monitor requires a repository to store alerts and metrics for historical analysis.          ', '2026-04-07');
INSERT INTO `hasil_produksi` VALUES (169, 'FC-FB-2472-Y', 98, 12, 'To connect to a database or schema, simply double-click it in the pane.                             ', '2026-04-14');
INSERT INTO `hasil_produksi` VALUES (170, 'BE-EF-4297-X', 31, 96, 'To connect to a database or schema, simply double-click it in the pane.', '2026-04-30');
INSERT INTO `hasil_produksi` VALUES (171, 'DF-EB-6654-S', 80, 19, 'It can also manage cloud databases such as Amazon Redshift, Amazon RDS, Alibaba Cloud.              ', '2026-04-21');
INSERT INTO `hasil_produksi` VALUES (172, 'DE-BE-6959-B', 32, 14, 'To open a query using an external editor, control-click it and select Open with External            ', '2026-04-17');
INSERT INTO `hasil_produksi` VALUES (173, 'CE-AA-2969-G', 96, 15, 'You can select any connections, objects or projects, and then select the corresponding              ', '2026-04-10');
INSERT INTO `hasil_produksi` VALUES (174, 'EA-BE-6185-Q', 66, 95, 'HTTP Tunneling is a method for connecting to a server that uses the same protocol                   ', '2026-04-18');
INSERT INTO `hasil_produksi` VALUES (175, 'DD-EF-8925-Q', 31, 87, 'The first step is as good as half over. The Navigation pane employs tree structure                  ', '2026-04-07');
INSERT INTO `hasil_produksi` VALUES (176, 'DE-BF-2444-H', 96, 97, 'Navicat allows you to transfer data from one database and/or schema to another with                 ', '2026-04-26');
INSERT INTO `hasil_produksi` VALUES (177, 'DD-FE-0795-K', 16, 83, 'Such sessions are also susceptible to session hijacking, where a malicious user takes               ', '2026-04-01');
INSERT INTO `hasil_produksi` VALUES (178, 'CB-EC-5906-G', 76, 13, 'If opportunity doesn’t knock, build a door. In the Objects tab, you can use the                   ', '2026-04-06');
INSERT INTO `hasil_produksi` VALUES (179, 'CA-CB-9979-Z', 9, 65, 'If your Internet Service Provider (ISP) does not provide direct access to its server,               ', '2026-04-22');
INSERT INTO `hasil_produksi` VALUES (180, 'EF-EB-7085-F', 87, 62, 'Always keep your eyes open. Keep watching. Because whatever you see can inspire you.', '2026-04-15');
INSERT INTO `hasil_produksi` VALUES (181, 'DD-FC-4199-R', 53, 61, 'SSH serves to prevent such vulnerabilities and allows you to access a remote server\'s               ', '2026-04-05');
INSERT INTO `hasil_produksi` VALUES (182, 'BA-CB-9495-H', 86, 6, 'I may not have gone where I intended to go, but I think I have ended up where I needed to be.', '2026-04-09');
INSERT INTO `hasil_produksi` VALUES (183, 'BC-DA-8039-N', 0, 85, 'Navicat Monitor requires a repository to store alerts and metrics for historical analysis.', '2026-04-22');
INSERT INTO `hasil_produksi` VALUES (184, 'EA-CE-3968-B', 38, 28, 'Export Wizard allows you to export data from tables, collections, views, or query                   ', '2026-04-17');
INSERT INTO `hasil_produksi` VALUES (185, 'FE-DB-5191-A', 32, 22, 'Navicat Cloud provides a cloud service for synchronizing connections, queries, model                ', '2026-04-29');
INSERT INTO `hasil_produksi` VALUES (186, 'ED-CB-0135-I', 42, 38, 'The Synchronize to Database function will give you a full picture of all database differences.      ', '2026-04-28');
INSERT INTO `hasil_produksi` VALUES (187, 'EE-EB-8498-U', 80, 65, 'To open a query using an external editor, control-click it and select Open with External            ', '2026-04-26');
INSERT INTO `hasil_produksi` VALUES (188, 'DA-ED-4063-Y', 94, 37, 'Navicat Data Modeler enables you to build high-quality conceptual, logical and physical             ', '2026-04-18');
INSERT INTO `hasil_produksi` VALUES (189, 'BB-FB-3295-P', 30, 47, 'Navicat Cloud could not connect and access your databases. By which it means, it                    ', '2026-04-24');
INSERT INTO `hasil_produksi` VALUES (190, 'DC-DA-3566-M', 66, 54, 'If the plan doesn’t work, change the plan, but never the goal. Actually it is just                ', '2026-04-05');
INSERT INTO `hasil_produksi` VALUES (191, 'EC-BE-3139-B', 19, 29, 'Navicat Data Modeler is a powerful and cost-effective database design tool which                    ', '2026-04-24');
INSERT INTO `hasil_produksi` VALUES (192, 'AA-FA-0280-V', 68, 10, 'All journeys have secret destinations of which the traveler is unaware.                             ', '2026-04-24');
INSERT INTO `hasil_produksi` VALUES (193, 'FD-CD-2937-Q', 1, 98, 'The Information Pane shows the detailed object information, project activities, the                 ', '2026-04-23');
INSERT INTO `hasil_produksi` VALUES (194, 'AC-CC-8702-D', 46, 55, 'The reason why a great man is great is that he resolves to be a great man.', '2026-04-28');
INSERT INTO `hasil_produksi` VALUES (195, 'CB-BF-9792-C', 36, 7, 'Navicat 15 has added support for the system-wide dark mode. To connect to a database                ', '2026-04-19');
INSERT INTO `hasil_produksi` VALUES (196, 'FD-FF-9746-T', 12, 25, 'In other words, Navicat provides the ability for data in different databases and/or                 ', '2026-04-20');
INSERT INTO `hasil_produksi` VALUES (197, 'DA-FF-6238-W', 65, 47, 'SQL Editor allows you to create and edit SQL text, prepare and execute selected queries.', '2026-04-16');
INSERT INTO `hasil_produksi` VALUES (198, 'ED-BD-3195-F', 21, 4, 'In the Objects tab, you can use the List List, Detail Detail and ER Diagram ER Diagram              ', '2026-04-25');
INSERT INTO `hasil_produksi` VALUES (199, 'DA-FC-8468-M', 33, 72, 'Import Wizard allows you to import data to tables/collections from CSV, TXT, XML, DBF and more.', '2026-04-04');
INSERT INTO `hasil_produksi` VALUES (200, 'CA-BC-1773-R', 1, 19, 'In the Objects tab, you can use the List List, Detail Detail and ER Diagram ER Diagram              ', '2026-04-02');
INSERT INTO `hasil_produksi` VALUES (201, 'DC-CA-4007-X', 20, 5, 'It wasn’t raining when Noah built the ark. Navicat provides a wide range advanced                 ', '2026-04-06');
INSERT INTO `hasil_produksi` VALUES (202, 'CA-FD-0111-A', 44, 81, 'Navicat Cloud provides a cloud service for synchronizing connections, queries, model                ', '2026-04-09');

-- ----------------------------
-- Table structure for kategori_defect
-- ----------------------------
DROP TABLE IF EXISTS `kategori_defect`;
CREATE TABLE `kategori_defect`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori_defect` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori_defect
-- ----------------------------
INSERT INTO `kategori_defect` VALUES (1, 'Rusak');
INSERT INTO `kategori_defect` VALUES (2, 'Jahitan Kasar');

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID pengguna',
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('admin','qc') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_nama_pengguna`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (8, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin');
INSERT INTO `pengguna` VALUES (11, 'Karyawan A', 'karyawan', '07142c5501c3ea09303d899012e2b47d', 'qc');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `variasi_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (1, 'No Drop Tinting', 'PRDK-002', 'asdasd');
INSERT INTO `produk` VALUES (2, 'No Drop Tinting', 'PRDK-002', 'asdasd');

SET FOREIGN_KEY_CHECKS = 1;

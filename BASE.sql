-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla sistemaasistenciasdb.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistenciasdb.alumnos: ~25 rows (aproximadamente)
INSERT INTO `alumnos` (`id`, `dni`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
	(105, '42850626', 'Lucas Gabriel', 'Barreiro', '2000-11-10'),
	(106, '45847922', 'Franco', 'Cabrera', '2000-12-12'),
	(107, '43149316', 'Franco Agustín', 'Chappe', '2000-12-12'),
	(108, '43632750', 'Roman', 'Coletti', '2000-12-12'),
	(109, '40790201', 'Esteban', 'Copello', '2000-12-12'),
	(110, '40790545', 'Daian Exequiel', 'Fernández ', '2000-12-12'),
	(111, '44980999', 'Nicolás Osvaldo ', 'Fernández ', '2000-12-12'),
	(112, '44623314', 'Facundo Gerónimo ', 'Figun', '2000-12-12'),
	(113, '45389325', 'Lucas Jeremias', 'Fiorotto', '2000-12-12'),
	(114, '45048325', 'Felipe', 'Franco', '2000-12-12'),
	(115, '43631803', 'Bruno', 'Godoy', '2000-12-12'),
	(116, '42069298', 'Marcos Damián ', 'Godoy', '2000-12-12'),
	(117, '45385675', 'Teo', 'Hildt', '2000-12-12'),
	(118, '41872676', 'Facundo Ariel', 'Janusa', '2000-12-12'),
	(119, '45387761', 'Santiago Nicolás ', 'Martinez Bender', '2000-12-12'),
	(120, '45741185', 'Pablo Federico', 'Martinez', '2000-12-12'),
	(121, '44981059', 'Federico José ', 'Martinolich', '2000-11-10'),
	(122, '42070085', 'María Pía', 'Melgarejo', '2000-12-12'),
	(123, '43631710', 'Thiago Jeremías ', 'Meseguer', '2000-12-12'),
	(124, '44644523', 'Ignacio Agustín ', 'Piter', '2000-12-12'),
	(125, '44282007', 'Kevin Gustavo', 'Quiroga', '2000-12-12'),
	(128, '40018598', 'Kevin Gustavo', 'Quiroga', '2000-12-12'),
	(129, '38570361', 'Marcos ', 'Reynoso', '2000-12-12'),
	(130, '39255959', 'Franco Antonio', 'Robles', '2000-12-12'),
	(131, '43414566', 'Maximiliano', 'Weyler', '2000-12-12'),
	(181, '45048950', 'Facundo Martin', 'Jara', '2003-06-14'),
	(182, '12345678', 'Prueba ', 'Dia Cumpleaños', '2000-11-14');

-- Volcando estructura para tabla sistemaasistenciasdb.asistencias
CREATE TABLE IF NOT EXISTS `asistencias` (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `dni_alumno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_materia` int NOT NULL,
  `fecha` date NOT NULL,
  `tipo_asistencia` tinyint NOT NULL,
  PRIMARY KEY (`id_asistencia`) USING BTREE,
  KEY `dni_alumno` (`dni_alumno`) USING BTREE,
  KEY `id_materia` (`id_materia`) USING BTREE,
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`dni_alumno`) REFERENCES `alumnos` (`dni`),
  CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistenciasdb.asistencias: ~0 rows (aproximadamente)
INSERT INTO `asistencias` (`id_asistencia`, `dni_alumno`, `id_materia`, `fecha`, `tipo_asistencia`) VALUES
	(102, '42850626', 1, '2023-11-13', 1),
	(103, '42850626', 1, '2023-11-01', 1),
	(104, '45847922', 1, '2023-11-10', 1);

-- Volcando estructura para tabla sistemaasistenciasdb.materias
CREATE TABLE IF NOT EXISTS `materias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_profesor` int DEFAULT NULL,
  `materia` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_profesor` (`id_profesor`),
  CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistenciasdb.materias: ~1 rows (aproximadamente)
INSERT INTO `materias` (`id`, `id_profesor`, `materia`) VALUES
	(1, 10, 'Programacion');

-- Volcando estructura para tabla sistemaasistenciasdb.profesores
CREATE TABLE IF NOT EXISTS `profesores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistenciasdb.profesores: ~2 rows (aproximadamente)
INSERT INTO `profesores` (`id`, `dni`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
	(10, '38976287', 'Javier', 'Parra', '2000-12-12');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

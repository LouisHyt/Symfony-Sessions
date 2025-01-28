-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table symfony_sessions.category : ~6 rows (environ)
INSERT INTO `category` (`id`, `label`) VALUES
	(6, 'Administration Système'),
	(2, 'Bureautique'),
	(4, 'DataScience'),
	(3, 'Design'),
	(1, 'DevWeb'),
	(5, 'Marketing');

-- Listage des données de la table symfony_sessions.doctrine_migration_versions : ~1 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20250123123026', '2025-01-27 07:29:14', 607);

-- Listage des données de la table symfony_sessions.intern : ~23 rows (environ)
INSERT INTO `intern` (`id`, `email`, `first_name`, `last_name`, `birth_date`, `genre`, `city`, `phone`) VALUES
	(1, 'jean.dupont@example.com', 'Jean', 'Dupont', '1990-01-15', 'M', 'Paris', '0123456789'),
	(2, 'marie.martin@example.com', 'Marie', 'Martin', '1985-03-22', 'F', 'Lyon', '0987654321'),
	(3, 'lucas.bernard@example.com', 'Lucas', 'Bernard', '1992-07-11', 'M', 'Marseille', '0147258369'),
	(4, 'alice.durand@example.com', 'Alice', 'Durand', '1988-11-05', 'F', 'Toulouse', '0159348273'),
	(5, 'paul.ribeiro@example.com', 'Paul', 'Ribeiro', '1994-02-28', 'M', 'Nice', '0165638291'),
	(6, 'claire.lopez@example.com', 'Claire', 'Lopez', '1996-09-12', 'F', 'Bordeaux', '0172746584'),
	(7, 'thomas.roux@example.com', 'Thomas', 'Roux', '1987-06-30', 'M', 'Lille', '0186837482'),
	(9, 'nicolas.gauthier@example.com', 'Nicolas', 'Gauthier', '1991-10-17', 'M', 'Strasbourg', '0126895730'),
	(10, 'julie.david@example.com', 'Julie', 'David', '1995-12-02', 'F', 'Rennes', '0161492835'),
	(11, 'antoine.meyer@example.com', 'Antoine', 'Meyer', '1990-04-06', 'M', 'Lyon', '0173657284'),
	(12, 'margaux.leroy@example.com', 'Margaux', 'Leroy', '1989-01-19', 'F', 'Paris', '0192873645'),
	(13, 'henri.duc@example.com', 'Henri', 'Duc', '1992-12-14', 'M', 'Marseille', '0123782946'),
	(14, 'celine.perez@example.com', 'Celine', 'Perez', '1993-05-07', 'F', 'Nice', '0174523987'),
	(15, 'yannick.leclerc@example.com', 'Yannick', 'Leclerc', '1988-08-23', 'M', 'Bordeaux', '0198765432'),
	(16, 'marion.ferreira@example.com', 'Marion', 'Ferreira', '1994-11-11', 'F', 'Toulouse', '0168392745'),
	(17, 'laurent.dubois@example.com', 'Laurent', 'Dubois', '1991-02-09', 'M', 'Nantes', '0147568392'),
	(18, 'elisabeth.garnier@example.com', 'Elisabeth', 'Garnier', '1990-07-30', 'F', 'Strasbourg', '0182746359'),
	(19, 'luc.astruc@example.com', 'Luc', 'Astruc', '1995-09-18', 'M', 'Lille', '0169273841'),
	(20, 'caroline.tanguy@example.com', 'Caroline', 'Tanguy', '1992-04-24', 'F', 'Paris', '0172859473'),
	(21, 'jajaja@gmail.com', 'jajaju', 'bababa', '1994-01-04', 'M', 'Belfort', '07 18 49 75 16'),
	(22, 'Emmanuel@casino.com', 'Emmanuel', 'Geldreich', '1967-12-04', 'M', 'Roubaix', '0708451975'),
	(23, 'Theoarbo@ankama.fr', 'Théo', 'Arbogast', '1987-12-12', 'M', 'Le Havre', '0748759658'),
	(24, 'Asma@skyrock.fr', 'Asma', 'Asma', '2008-12-04', 'F', 'Sochaux', '0417857459');

-- Listage des données de la table symfony_sessions.intern_session : ~10 rows (environ)
INSERT INTO `intern_session` (`intern_id`, `session_id`) VALUES
	(1, 3),
	(1, 10),
	(2, 3),
	(3, 8),
	(5, 6),
	(6, 7),
	(7, 8),
	(10, 4),
	(12, 5),
	(19, 3);

-- Listage des données de la table symfony_sessions.messenger_messages : ~0 rows (environ)

-- Listage des données de la table symfony_sessions.module : ~19 rows (environ)
INSERT INTO `module` (`id`, `category_id`, `name`) VALUES
	(1, 1, 'Javascript'),
	(2, 1, 'PHP'),
	(3, 1, 'HTML/CSS'),
	(4, 1, 'React'),
	(5, 2, 'Word'),
	(6, 2, 'Excel'),
	(7, 2, 'PowerPoint'),
	(8, 3, 'Photoshop'),
	(9, 3, 'Illustrator'),
	(10, 3, 'UX/UI Design'),
	(11, 4, 'Python'),
	(12, 4, 'R'),
	(13, 4, 'Machine Learning'),
	(14, 5, 'SEO'),
	(15, 5, 'PPC'),
	(16, 5, 'Content Marketing'),
	(17, 6, 'Linux Administration'),
	(18, 6, 'Windows Server Administration'),
	(19, 6, 'Cloud Computing');

-- Listage des données de la table symfony_sessions.program : ~12 rows (environ)
INSERT INTO `program` (`id`, `session_id`, `module_id`, `total_days`) VALUES
	(29, 3, 10, 10),
	(30, 4, 3, 30),
	(31, 4, 2, 30),
	(32, 4, 4, 30),
	(33, 5, 11, 16),
	(34, 5, 13, 16),
	(35, 6, 14, 16),
	(36, 6, 15, 16),
	(37, 7, 19, 31),
	(38, 8, 14, 15),
	(39, 9, 16, 30),
	(40, 10, 17, 15);

-- Listage des données de la table symfony_sessions.session : ~10 rows (environ)
INSERT INTO `session` (`id`, `trainer_id`, `training_id`, `name`, `places`, `begin_date`, `end_date`) VALUES
	(3, NULL, NULL, 'Formation JavaScript - 2023', 20, '2023-06-01', '2023-06-30'),
	(4, NULL, NULL, 'Formation Python Avancé - 2023', 15, '2023-08-01', '2023-08-15'),
	(5, NULL, NULL, 'Atelier Design UX/UI - 2023', 12, '2025-01-20', '2025-09-12'),
	(6, NULL, NULL, 'Formation DevWeb - 2024', 25, '2024-01-01', '2024-03-31'),
	(7, NULL, NULL, 'Atelier Data Science - 2024', 18, '2024-01-15', '2024-02-15'),
	(8, NULL, NULL, 'Séminaire Marketing Digital - 2024', 30, '2024-01-20', '2024-02-20'),
	(9, NULL, NULL, 'Formation Cloud Computing - 2025', 15, '2025-01-04', '2025-05-31'),
	(10, NULL, NULL, 'Atelier SEO - 2025', 20, '2025-06-01', '2025-06-15'),
	(11, NULL, NULL, 'Formation Marketing - 2025', 22, '2025-07-01', '2025-07-30'),
	(12, NULL, NULL, 'Séminaire Administration Système - 2025', 10, '2025-08-01', '2025-08-15');

-- Listage des données de la table symfony_sessions.trainer : ~0 rows (environ)

-- Listage des données de la table symfony_sessions.training : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `topic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (13,4,'Programming','Getting Started with PHP','PHP is one of the most widely used server-side scripting languages. It powers millions of websites worldwide and is especially popular for building dynamic applications. Learning PHP is a great foundation for anyone who wants to dive into backend web development.',NULL,'2025-09-07 08:15:00','2025-09-11 10:40:32'),(14,5,'Health','The Science of Productive Sleep','Good sleep is not only about duration but also about quality. Studies show that consistent sleeping patterns can significantly improve memory, focus, and overall health. A productive sleep cycle ensures higher performance during the day.',NULL,'2025-09-08 20:40:00','2025-09-11 10:40:32'),(15,6,'Education','Why Pursue a Master’s Degree?','A Master’s degree can open doors to new opportunities, both academically and professionally. It allows you to specialize in a field, conduct research, and gain a competitive advantage in the job market.',NULL,'2025-09-09 12:05:00','2025-09-11 10:40:32'),(16,7,'Technology','The Future of Full Stack Web Development','Full Stack Developers are in high demand, as companies look for versatile engineers who can work on both frontend and backend. The future will rely heavily on modern JavaScript frameworks, cloud integration, and AI-assisted coding.',NULL,'2025-09-10 07:20:00','2025-09-11 10:40:32'),(17,8,'Lifestyle','The Hidden Dangers of Fast Food','Fast food consumption has dramatically increased worldwide. While it is convenient, regular fast food intake is linked to obesity, heart disease, and poor nutrition. Awareness of these dangers is crucial for healthier lifestyles.',NULL,'2025-09-10 18:45:00','2025-09-11 10:40:32'),(18,9,'Economy','Economic Challenges in Today’s Turkey','Turkey is facing economic challenges such as high inflation, unemployment, and currency fluctuations. These issues directly impact the cost of living and create difficulties for families and young professionals.',NULL,'2025-09-11 06:30:00','2025-09-11 10:40:32');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,4,'Collaboration Opportunity','Hello, I have been following your blog for a while and I am very impressed with the quality of your content. \r\n I would like to discuss a possible collaboration where my company TechNova Solutions provides guest articles \r\n about new trends in AI and cloud infrastructure. Let me know if this interests you.','2025-09-09 12:22:00'),(2,5,'Educational Use Permission','Merhaba, sitenizdeki yazıları öğrencilerime ders materyali olarak göstermek istiyorum. \r\n Özellikle yazılım ve teknoloji üzerine yazdığınız içerikler bizim için çok faydalı. \r\n Eğer mümkünse bazı makalelerinizi eğitim amaçlı kullanabilir miyim? Kaynak olarak da blogunuzu göstereceğim.','2025-09-08 17:45:00'),(3,6,'Job Posting Inquiry','Good afternoon, I came across your blog through LinkedIn and found the articles on full-stack web development \r\n very insightful. Our company is currently hiring developers and we would like to advertise our job postings \r\n on your platform. Could you share the pricing and process details?','2025-09-10 09:05:00'),(4,7,'Sponsored Post Request','Hi there, I just read your blog post about the importance of productive sleep and it resonated with me deeply. \r\n I work for a health-tech company and we are launching a product related to sleep tracking. \r\n Would you be open to a sponsored post or a product review on your blog?','2025-09-11 07:15:00');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(3,'author'),(2,'customer');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'ULKU','ukilic1@stu.vistula.edu.pl','$2y$10$TtZ0fuLuLTQyGtiImDjFGuyBWYu.asBRwOhLusGq04lSCFMXBolji',2,'2025-09-11 08:33:05'),(3,'Elif Ulku','ulkuklc03@gmail.com','$2y$10$udAtuD8GjJj9mdR6hhmIR.OJHNzEIoAIVgHRus83V2VXT5.8uHs7a',1,'2025-09-11 08:39:37'),(4,'Alice Johnson','alice@gmail.com','$2y$10$JbU2g.L0rCpg.luP4Sz2RO0XakT7cnYOq0.8Zx6a0k1WvpgQwTuN.',3,'2025-09-11 10:37:01'),(5,'Michael Brown','michael@gmail.com','$2y$10$JbU2g.L0rCpg.luP4Sz2RO0XakT7cnYOq0.8Zx6a0k1WvpgQwTuN.',3,'2025-09-11 10:37:01'),(6,'Sophia Davis','sophia@gmail.com','$2y$10$JbU2g.L0rCpg.luP4Sz2RO0XakT7cnYOq0.8Zx6a0k1WvpgQwTuN.',3,'2025-09-11 10:37:01'),(7,'James Wilson','james@gmail.com','$2y$10$JbU2g.L0rCpg.luP4Sz2RO0XakT7cnYOq0.8Zx6a0k1WvpgQwTuN.',3,'2025-09-11 10:37:01'),(8,'Emma Martinez','emma@gmail.com','$2y$10$JbU2g.L0rCpg.luP4Sz2RO0XakT7cnYOq0.8Zx6a0k1WvpgQwTuN.',3,'2025-09-11 10:37:01'),(9,'David Anderson','david@gmail.com','$2y$10$JbU2g.L0rCpg.luP4Sz2RO0XakT7cnYOq0.8Zx6a0k1WvpgQwTuN.',3,'2025-09-11 10:37:01'),(10,'Olivia Thomas','olivia@gmail.com','$2y$10$JbU2g.L0rCpg.luP4Sz2RO0XakT7cnYOq0.8Zx6a0k1WvpgQwTuN.',3,'2025-09-11 10:37:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-27  2:16:24

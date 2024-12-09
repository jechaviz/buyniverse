-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2024 at 05:50 PM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u698055122_xUZNx`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employer_id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `street` varchar(191) DEFAULT NULL,
  `externalNumber` varchar(191) DEFAULT NULL,
  `internalNumber` varchar(191) DEFAULT NULL,
  `neighborhood` varchar(191) DEFAULT NULL,
  `locality` varchar(191) DEFAULT NULL,
  `reference` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `zipCode` varchar(191) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `website` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `employer_id`, `name`, `type`, `street`, `externalNumber`, `internalNumber`, `neighborhood`, `locality`, `reference`, `city`, `state`, `country`, `zipCode`, `latitude`, `longitude`, `website`, `created_at`, `updated_at`) VALUES
(1, 1, 'tester', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 'lucas', 'mexico', NULL, NULL, NULL, NULL, NULL, '2022-10-31 21:10:06', '2022-10-31 21:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `answer` varchar(191) NOT NULL,
  `value` int(11) NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `value`, `question_id`, `created_at`, `updated_at`) VALUES
(1, '1-2 years', 2, 1, '2021-02-26 07:01:55', '2021-02-26 07:01:55'),
(2, '2.5 years to 5 years', 5, 1, '2021-02-26 07:02:07', '2021-02-26 07:02:07'),
(3, '5.5 years to 10 years', 7, 1, '2021-02-26 07:02:20', '2021-02-26 07:02:20'),
(4, '10+ years', 10, 1, '2021-02-26 07:02:32', '2021-02-26 07:02:32'),
(5, 'Respuesta 1', 2, 2, '2022-01-11 01:39:16', '2022-01-11 01:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `approvers`
--

CREATE TABLE `approvers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(191) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lname` varchar(191) NOT NULL,
  `status` int(11) DEFAULT 0,
  `notes` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `approvers`
--

INSERT INTO `approvers` (`id`, `name`, `email`, `role`, `permission`, `job_id`, `created_at`, `updated_at`, `lname`, `status`, `notes`) VALUES
(20, 'Sadique', 'sadiqueali786@gmail.com', 'CEO', 1, 207, '2022-09-09 14:04:58', '2022-09-12 15:26:39', 'Ali', 0, NULL),
(21, 'Jorge', 'jorge.becerril@yopmail.com', 'Aprobador.', 1, 208, '2023-01-26 21:38:26', '2023-01-26 21:48:01', 'Becerril', 1, NULL),
(22, 'Juan', 'juan.glz@yopmail.com', 'Lider', 1, 209, '2023-02-02 20:42:37', '2023-02-02 20:42:37', 'Gonzalez', 0, NULL),
(23, 'Leo', 'leo@yopmail.com', 'CEO', 2, 210, '2023-02-18 14:22:13', '2023-02-18 14:27:27', 'Tolsoy', 1, NULL),
(24, 'test', 'test.aprover@yopmail.com', 'Aprover', 1, 211, '2023-02-27 22:43:14', '2023-02-27 22:43:14', 'aprover', 0, NULL),
(26, 'Sadique', 'sadiquea@yopmail.com', 'tester', 2, 212, '2023-03-11 13:02:34', '2023-03-11 13:02:34', 'Ali', 0, NULL),
(28, 'Sadique', 'sadiquea@yopmail.com', 'tester', 3, 213, '2023-03-13 12:55:47', '2023-03-13 13:29:41', 'A', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `banner` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `banner`, `description`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Who Else Wants To Be Successful With Business', 'who-else-wants-to-be-successful-with-business', 'img-01.jpg', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem perspiciatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsa quae ab illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione voluptatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon numquam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat tatem dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>\r\n                    <blockquote class=\"wt-blockquotevone\"><span><i class=\"lnr lnr-bookmark\"></i></span> <q>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce.&rdquo;</q></blockquote>\r\n                    <p>ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur. Excepteur sint occaecat cupidatat ainon proident sunt in culpa qui officia deserunt mollit anim id est laborum ut perspiciatis unde.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-articlessingleone\"><img class=\"test\" src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-02.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</span></figcaption>\r\n                    </figure>\r\n                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>\r\n                    <ul>\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>Qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-alignleft\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-03.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde</span></figcaption>\r\n                    </figure>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque lum, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dictation explicabo. nemo enim ipsam voluptatem quia voluptas orem ipsum quia dolor sit.</p>\r\n                    <ul class=\"wt-blogliststyle\">\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eiuste modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n                    <p class=\"wt-clear\">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-alignright\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-04.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde</span></figcaption>\r\n                    </figure>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <ul class=\"wt-blogliststyle\">\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia nonae numquam eius modi tempora incidunt labore.</p>\r\n                    <p class=\"wt-clear\">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasite architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <div class=\"wt-video\">\r\n                    <figure><a href=\"https://www.youtube.com/watch?v=J37W6DjqT3Q\" rel=\"prettyPhoto[video]\" data-rel=\"prettyPhoto[video]\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/video-img.jpg\" alt=\"image description\" /></a></figure>\r\n                    </div>\r\n                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <ul>\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.</p>', '2021-02-25 05:48:21', '2021-02-25 05:48:21', 1),
(2, '20 Top Tips For Business', '20-top-tips-for-business', 'img-02.jpg', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem perspiciatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsa quae ab illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione voluptatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon numquam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat tatem dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>\r\n                    <blockquote class=\"wt-blockquotevone\"><span><i class=\"lnr lnr-bookmark\"></i></span> <q>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce.&rdquo;</q></blockquote>\r\n                    <p>ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur. Excepteur sint occaecat cupidatat ainon proident sunt in culpa qui officia deserunt mollit anim id est laborum ut perspiciatis unde.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-articlessingleone\"><img class=\"test\" src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-02.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</span></figcaption>\r\n                    </figure>\r\n                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>\r\n                    <ul>\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>Qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-alignleft\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-03.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde</span></figcaption>\r\n                    </figure>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque lum, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dictation explicabo. nemo enim ipsam voluptatem quia voluptas orem ipsum quia dolor sit.</p>\r\n                    <ul class=\"wt-blogliststyle\">\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eiuste modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n                    <p class=\"wt-clear\">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-alignright\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-04.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde</span></figcaption>\r\n                    </figure>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <ul class=\"wt-blogliststyle\">\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia nonae numquam eius modi tempora incidunt labore.</p>\r\n                    <p class=\"wt-clear\">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasite architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <div class=\"wt-video\">\r\n                    <figure><a href=\"https://www.youtube.com/watch?v=J37W6DjqT3Q\" rel=\"prettyPhoto[video]\" data-rel=\"prettyPhoto[video]\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/video-img.jpg\" alt=\"image description\" /></a></figure>\r\n                    </div>\r\n                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <ul>\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.</p>', '2021-02-25 05:48:21', '2021-02-25 05:48:21', 1),
(3, 'Clear And Unbiased Facts About Business (Without All The Hype)', 'clear-and-unbiased-facts-about-business-without-all-the-hype', 'img-04.jpg', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem perspiciatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsa quae ab illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione voluptatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon numquam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat tatem dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>\r\n                    <blockquote class=\"wt-blockquotevone\"><span><i class=\"lnr lnr-bookmark\"></i></span> <q>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce.&rdquo;</q></blockquote>\r\n                    <p>ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur. Excepteur sint occaecat cupidatat ainon proident sunt in culpa qui officia deserunt mollit anim id est laborum ut perspiciatis unde.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-articlessingleone\"><img class=\"test\" src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-02.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</span></figcaption>\r\n                    </figure>\r\n                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>\r\n                    <ul>\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>Qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-alignleft\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-03.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde</span></figcaption>\r\n                    </figure>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque lum, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dictation explicabo. nemo enim ipsam voluptatem quia voluptas orem ipsum quia dolor sit.</p>\r\n                    <ul class=\"wt-blogliststyle\">\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eiuste modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n                    <p class=\"wt-clear\">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <figure class=\"wt-blogdetailimgvtwo wt-alignright\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/img-04.jpg\" alt=\"image description\" />\r\n                    <figcaption><span>As per current survey perspiciatis unde</span></figcaption>\r\n                    </figure>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <ul class=\"wt-blogliststyle\">\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia nonae numquam eius modi tempora incidunt labore.</p>\r\n                    <p class=\"wt-clear\">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasite architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <div class=\"wt-video\">\r\n                    <figure><a href=\"https://www.youtube.com/watch?v=J37W6DjqT3Q\" rel=\"prettyPhoto[video]\" data-rel=\"prettyPhoto[video]\"><img src=\"http://www.amentotech.com/projects/worketic/images/article/articlessingle/video-img.jpg\" alt=\"image description\" /></a></figure>\r\n                    </div>\r\n                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</p>\r\n                    <ul>\r\n                    <li><span>Nemo enim ipsam voluptatem quia</span></li>\r\n                    <li><span>Adipisci velit, sed quia non numquam eius modi tempora</span></li>\r\n                    <li><span>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</span></li>\r\n                    <li><span>qui dolorem ipsum quia dolor sit amet</span></li>\r\n                    </ul>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.</p>', '2021-02-25 05:48:21', '2021-02-25 05:48:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE `article_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `abstract` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `title`, `slug`, `abstract`, `image`, `created_at`, `updated_at`) VALUES
(1, 'PSD Web Template', 'psd-web-template', NULL, NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 'Digital Marketing', 'digital-marketing', NULL, NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 'PHP Development', 'php-development', NULL, NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `article_category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `article_category_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 3),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `color` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`id`, `title`, `slug`, `image`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Gold', 'gold', 'featured.png', '#f1c40f', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 'Silver', 'silver', 'featured.png', '#e67e22', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 'Bronze', 'Bronze', 'featured.png', '#2ecc71', '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `catables`
--

CREATE TABLE `catables` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `catable_id` int(11) NOT NULL,
  `catable_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catables`
--

INSERT INTO `catables` (`id`, `category_id`, `catable_id`, `catable_type`, `created_at`, `updated_at`) VALUES
(181, 2, 200, 'App\\Job', NULL, NULL),
(182, 3, 200, 'App\\Job', NULL, NULL),
(183, 6, 200, 'App\\Job', NULL, NULL),
(184, 1, 201, 'App\\Job', NULL, NULL),
(185, 2, 201, 'App\\Job', NULL, NULL),
(186, 1, 202, 'App\\Job', NULL, NULL),
(187, 2, 202, 'App\\Job', NULL, NULL),
(188, 0, 202, 'App\\Job', NULL, NULL),
(189, 1, 203, 'App\\Job', NULL, NULL),
(190, 2, 203, 'App\\Job', NULL, NULL),
(191, 7, 203, 'App\\Job', NULL, NULL),
(192, 8, 203, 'App\\Job', NULL, NULL),
(193, 0, 203, 'App\\Job', NULL, NULL),
(194, 2, 204, 'App\\Job', NULL, NULL),
(195, 6, 204, 'App\\Job', NULL, NULL),
(196, 3, 204, 'App\\Job', NULL, NULL),
(197, 2, 205, 'App\\Job', NULL, NULL),
(198, 1, 206, 'App\\Job', NULL, NULL),
(199, 1, 207, 'App\\Job', NULL, NULL),
(200, 2, 207, 'App\\Job', NULL, NULL),
(201, 1, 208, 'App\\Job', NULL, NULL),
(203, 7, 209, 'App\\Job', NULL, NULL),
(204, 1, 210, 'App\\Job', NULL, NULL),
(205, 3, 210, 'App\\Job', NULL, NULL),
(206, 5, 210, 'App\\Job', NULL, NULL),
(207, 6, 211, 'App\\Job', NULL, NULL),
(208, 4, 211, 'App\\Job', NULL, NULL),
(209, 3, 212, 'App\\Job', NULL, NULL),
(210, 1, 212, 'App\\Job', NULL, NULL),
(211, 6, 212, 'App\\Job', NULL, NULL),
(212, 2, 213, 'App\\Job', NULL, NULL),
(213, 1, 213, 'App\\Job', NULL, NULL),
(214, 6, 213, 'App\\Job', NULL, NULL),
(215, 1, 4, 'App\\User', NULL, NULL),
(217, 7, 4, 'App\\User', NULL, NULL),
(218, 6, 203, 'App\\Job', NULL, NULL),
(219, 14, 214, 'App\\Job', NULL, NULL),
(220, 14, 215, 'App\\Job', NULL, NULL),
(221, 14, 21, 'App\\User', NULL, NULL),
(222, 2, 21, 'App\\User', NULL, NULL),
(223, 6, 21, 'App\\User', NULL, NULL),
(225, 2, 22, 'App\\User', NULL, NULL),
(227, 15, 213, 'App\\Job', NULL, NULL),
(228, 15, 217, 'App\\Job', NULL, NULL),
(230, 14, 216, 'App\\Job', NULL, NULL),
(231, 15, 216, 'App\\Job', NULL, NULL),
(232, 15, 4, 'App\\User', NULL, NULL),
(233, 15, 218, 'App\\Job', NULL, NULL),
(234, 1, 218, 'App\\Job', NULL, NULL),
(235, 3, 218, 'App\\Job', NULL, NULL),
(236, 15, 22, 'App\\User', NULL, NULL),
(237, 1, 22, 'App\\User', NULL, NULL),
(238, 15, 23, 'App\\User', NULL, NULL),
(239, 3, 23, 'App\\User', NULL, NULL),
(240, 3, 216, 'App\\Job', NULL, NULL),
(241, 3, 219, 'App\\Job', NULL, NULL),
(242, 15, 219, 'App\\Job', NULL, NULL),
(243, 7, 220, 'App\\Job', NULL, NULL),
(244, 7, 23, 'App\\User', NULL, NULL),
(245, 15, 21, 'App\\User', NULL, NULL),
(246, 7, 21, 'App\\User', NULL, NULL),
(247, 1, 21, 'App\\User', NULL, NULL),
(248, 1, 24, 'App\\User', NULL, NULL),
(249, 7, 24, 'App\\User', NULL, NULL),
(251, 15, 220, 'App\\Job', NULL, NULL),
(252, 3, 220, 'App\\Job', NULL, NULL),
(253, 15, 221, 'App\\Job', NULL, NULL),
(254, 3, 221, 'App\\Job', NULL, NULL),
(255, 1, 221, 'App\\Job', NULL, NULL),
(256, 15, 222, 'App\\Job', NULL, NULL),
(257, 7, 222, 'App\\Job', NULL, NULL),
(258, 1, 222, 'App\\Job', NULL, NULL),
(259, 3, 222, 'App\\Job', NULL, NULL),
(260, 15, 223, 'App\\Job', NULL, NULL),
(261, 3, 224, 'App\\Job', NULL, NULL),
(262, 2, 224, 'App\\Job', NULL, NULL),
(264, 7, 225, 'App\\Job', NULL, NULL),
(265, 1, 225, 'App\\Job', NULL, NULL),
(267, 3, 225, 'App\\Job', NULL, NULL),
(269, 1, 228, 'App\\Job', NULL, NULL),
(270, 3, 228, 'App\\Job', NULL, NULL),
(271, 1, 229, 'App\\Job', NULL, NULL),
(272, 3, 229, 'App\\Job', NULL, NULL),
(276, 7, 226, 'App\\Job', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `abstract` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `approved_by` int(11) DEFAULT NULL,
  `status` enum('appear_globally','appear_user','rejected') NOT NULL DEFAULT 'appear_user',
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `abstract`, `image`, `created_at`, `updated_at`, `user_id`, `admin`, `approved_by`, `status`, `parent_id`) VALUES
(1, 'Web Design', 'web-design', 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.', '1.png', '2021-02-25 05:48:21', '2022-08-05 13:28:29', 1, 1, NULL, 'appear_globally', 0),
(2, 'WordPress', 'wordpress', 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.', '2.png', '2021-02-25 05:48:21', '2022-08-05 13:29:04', 1, 1, NULL, 'appear_globally', 0),
(3, 'PHP', 'php', 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.', '3.png', '2021-02-25 05:48:21', '2022-08-05 13:29:33', 1, 1, NULL, 'appear_globally', 0),
(4, 'Javascript', 'javascript', 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.', '4.png', '2021-02-25 05:48:21', '2022-08-05 13:30:01', 1, 1, NULL, 'appear_globally', 0),
(5, 'HTML CSS', 'html-css', 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.', '5.png', '2021-02-25 05:48:21', '2022-08-05 13:30:38', 1, 1, NULL, 'appear_globally', 0),
(6, 'Laravel/CI', 'laravelci', 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.', '6.png', '2021-02-25 05:48:21', '2022-08-05 13:31:22', 1, 1, NULL, 'appear_globally', 0),
(7, 'Vuejs', 'vuejs', 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.', '7.png', '2021-02-25 05:48:21', '2022-08-05 13:32:08', 1, 1, NULL, 'appear_globally', 0),
(8, 'Angularjs', 'angularjs', 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.', '8.png', '2021-02-25 05:48:21', '2022-08-05 13:32:29', 1, 1, NULL, 'appear_globally', 0),
(15, 'Laravel', 'laravel', 'This is the laravel test', NULL, '2023-06-05 09:07:05', '2024-06-10 11:01:04', 4, 1, 1, 'appear_globally', 6);

-- --------------------------------------------------------

--
-- Table structure for table `cat_skills`
--

CREATE TABLE `cat_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cat_skills`
--

INSERT INTO `cat_skills` (`id`, `cat_id`, `skill_id`, `created_at`, `updated_at`) VALUES
(1, 7, 19, '2024-02-28 05:55:50', '2024-03-23 07:45:35'),
(2, 2, 20, '2024-02-28 07:12:01', '2024-02-29 06:18:47'),
(3, 3, 1, '2024-03-21 06:11:49', '2024-03-21 06:11:49'),
(4, 4, 2, '2024-03-21 06:12:09', '2024-03-21 06:12:09'),
(5, 5, 4, '2024-03-21 06:12:22', '2024-03-21 06:12:22'),
(6, 8, 5, '2024-03-21 06:12:40', '2024-03-21 06:12:40'),
(7, 5, 6, '2024-03-21 06:12:56', '2024-03-21 06:12:56'),
(8, 3, 7, '2024-03-21 06:13:10', '2024-03-21 06:13:10'),
(9, 6, 8, '2024-03-21 06:13:21', '2024-03-21 06:13:21'),
(10, 8, 9, '2024-03-21 06:13:32', '2024-03-21 06:13:32'),
(11, 15, 10, '2024-03-21 06:13:47', '2024-03-21 06:13:47'),
(12, 8, 11, '2024-03-21 06:13:58', '2024-03-21 06:13:58'),
(13, 3, 12, '2024-03-21 06:14:15', '2024-03-21 06:14:15'),
(14, 2, 13, '2024-03-21 06:14:49', '2024-03-21 06:14:49'),
(15, 1, 14, '2024-03-21 06:15:03', '2024-03-21 06:15:03'),
(16, 2, 15, '2024-03-21 06:15:14', '2024-03-21 06:15:14'),
(17, 7, 16, '2024-03-21 06:15:22', '2024-03-21 06:15:22'),
(18, 3, 17, '2024-03-21 06:15:35', '2024-03-21 06:15:35'),
(19, 8, 18, '2024-03-21 06:15:53', '2024-03-21 06:15:53'),
(20, 6, 21, '2024-06-03 01:09:38', '2024-06-03 01:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE `chatrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contest_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `contest_id`, `status`, `created_at`, `updated_at`) VALUES
(4, 16, 1, '2022-11-23 12:50:47', '2022-11-23 12:50:47'),
(5, 18, 1, '2022-12-07 23:33:10', '2022-12-07 23:33:10'),
(6, 20, 1, '2023-09-04 12:52:10', '2023-09-04 12:52:10'),
(7, 21, 1, '2023-09-18 12:46:44', '2023-09-18 12:46:44'),
(8, 22, 1, '2023-10-04 12:26:26', '2023-10-04 12:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chatroom_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `readby` varchar(191) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `chatroom_id`, `user_id`, `readby`, `message`, `created_at`, `updated_at`) VALUES
(11, 3, 4, NULL, 'this is the test', '2022-03-22 20:50:17', '2022-03-22 20:50:17'),
(12, 3, 21, NULL, 'this is another test', '2022-03-22 21:02:39', '2022-03-22 21:02:39'),
(13, 3, 21, NULL, 'test', '2022-03-23 17:56:22', '2022-03-23 17:56:22'),
(14, 3, 4, NULL, 'hello', '2022-03-23 17:56:39', '2022-03-23 17:56:39'),
(15, 3, 4, NULL, 'hello', '2022-03-23 17:56:39', '2022-03-23 17:56:39'),
(16, 3, 4, NULL, 'send', '2022-03-23 17:59:44', '2022-03-23 17:59:44'),
(17, 3, 4, NULL, 'This is the test\n\nThis is the testvThis is the test\nThis is the test', '2022-03-23 18:00:13', '2022-03-23 18:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `child_location`
--

CREATE TABLE `child_location` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `child_pages`
--

CREATE TABLE `child_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_pages`
--

INSERT INTO `child_pages` (`id`, `parent_id`, `child_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 1, 2, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(5, 1, 7, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(6, 1, 8, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(7, 1, 9, '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employer_id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `position` varchar(191) DEFAULT NULL,
  `department` varchar(191) DEFAULT NULL,
  `skype` varchar(191) DEFAULT NULL,
  `facebook` varchar(191) DEFAULT NULL,
  `twitter` varchar(191) DEFAULT NULL,
  `personalWebSite` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contest_bids`
--

CREATE TABLE `contest_bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contest_bids`
--

INSERT INTO `contest_bids` (`id`, `contest_id`, `user_id`, `bid`, `status`, `created_at`, `updated_at`) VALUES
(30, 16, 21, 2000, 1, '2022-11-23 13:06:41', '2022-11-23 13:06:41'),
(31, 16, 22, 2200, 1, '2022-11-23 13:06:46', '2022-11-23 13:06:46'),
(32, 16, 23, 2300, 1, '2022-11-23 13:06:59', '2022-11-23 13:06:59'),
(33, 18, 21, 2000, 1, '2022-12-07 23:33:30', '2022-12-07 23:33:30'),
(34, 18, 22, 2200, 1, '2022-12-07 23:33:36', '2022-12-07 23:33:36'),
(35, 18, 23, 2300, 1, '2022-12-07 23:33:42', '2022-12-07 23:33:42'),
(36, 18, 24, 2000, 1, '2022-12-07 23:33:50', '2022-12-07 23:33:50'),
(37, 20, 21, 13000, 1, '2023-09-04 12:52:18', '2023-09-04 12:52:18'),
(38, 20, 22, 14000, 1, '2023-09-04 12:52:23', '2023-09-04 12:52:23'),
(39, 21, 21, 1400, 1, '2023-09-18 12:47:46', '2023-09-18 12:47:46'),
(40, 21, 23, 1499, 1, '2023-09-18 12:47:56', '2023-09-18 12:47:56'),
(41, 21, 22, 1399, 1, '2023-09-18 12:48:01', '2023-09-18 12:48:01'),
(42, 21, 22, 1359, 0, '2023-09-18 12:50:23', '2023-09-18 12:50:23'),
(43, 21, 21, 1300, 0, '2023-09-18 12:53:09', '2023-09-18 12:53:09'),
(44, 22, 22, 1500, 1, '2023-10-04 12:26:31', '2023-10-04 12:26:31'),
(45, 22, 22, 1499, 0, '2023-10-04 12:28:19', '2023-10-04 12:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numeric_code` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `symbol` varchar(191) NOT NULL,
  `fraction_name` varchar(191) NOT NULL,
  `decimals` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `numeric_code`, `code`, `name`, `symbol`, `fraction_name`, `decimals`, `created_at`, `updated_at`) VALUES
(1, '840', 'USD', 'United States dollar', '$', 'Cent[D]', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(2, '784', 'AED', 'United Arab Emirates dirham', 'د.إ', 'Fils', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(3, '971', 'AFN', 'Afghan afghani', '؋', 'Pul', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(4, '8', 'ALL', 'Albanian lek', 'L', 'Qintar', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(5, '51', 'AMD', 'Armenian dram', 'դր.', 'Luma', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(6, '532', 'ANG', 'Netherlands Antillean guilder', 'ƒ', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(7, '973', 'AOA', 'Angolan kwanza', 'Kz', 'Cêntimo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(8, '32', 'ARS', 'Argentine peso', '$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(9, '36', 'AUD', 'Australian dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(10, '533', 'AWG', 'Aruban florin', 'ƒ', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(11, '944', 'AZN', 'Azerbaijani manat', 'AZN', 'Qəpik', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(12, '977', 'BAM', 'Bosnia and Herzegovina convertible mark', 'КМ', 'Fening', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(13, '52', 'BBD', 'Barbadian dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(14, '50', 'BDT', 'Bangladeshi taka', '৳', 'Paisa', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(15, '975', 'BGN', 'Bulgarian lev', 'лв', 'Stotinka', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(16, '48', 'BHD', 'Bahraini dinar', 'ب.د', 'Fils', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(17, '108', 'BIF', 'Burundian franc', 'Fr', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(18, '60', 'BMD', 'Bermudian dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(19, '96', 'BND', 'Brunei dollar', '$', 'Sen', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(20, '68', 'BOB', 'Bolivian boliviano', 'Bs.', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(21, '986', 'BRL', 'Brazilian real', 'R$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(22, '44', 'BSD', 'Bahamian dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(23, '64', 'BTN', 'Bhutanese ngultrum', 'BTN', 'Chertrum', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(24, '72', 'BWP', 'Botswana pula', 'P', 'Thebe', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(25, '974', 'BYR', 'Belarusian ruble', 'Br', 'Kapyeyka', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(26, '84', 'BZD', 'Belize dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(27, '124', 'CAD', 'Canadian dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(28, '976', 'CDF', 'Congolese franc', 'Fr', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(29, '756', 'CHF', 'Swiss franc', 'Fr', 'Rappen[I]', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(30, '152', 'CLP', 'Chilean peso', '$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(31, '156', 'CNY', 'Chinese yuan', '元', 'Fen[E]', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(32, '170', 'COP', 'Colombian peso', '$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(33, '188', 'CRC', 'Costa Rican colón', '₡', 'Céntimo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(34, '931', 'CUC', 'Cuban convertible peso', '$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(35, '192', 'CUP', 'Cuban peso', '$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(36, '132', 'CVE', 'Cape Verdean escudo', 'Esc', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(37, '203', 'CZK', 'Czech koruna', 'Kc', 'Haléř', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(38, '262', 'DJF', 'Djiboutian franc', 'Fr', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(39, '208', 'DKK', 'Danish krone', 'kr', 'Øre', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(40, '214', 'DOP', 'Dominican peso', '$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(41, '12', 'DZD', 'Algerian dinar', 'د.ج', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(42, '233', 'EEK', 'Estonian kroon', 'KR', 'Sent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(43, '818', 'EGP', 'Egyptian pound', '£', 'Piastre[F]', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(44, '232', 'ERN', 'Eritrean nakfa', 'Nfk', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(45, '230', 'ETB', 'Ethiopian birr', 'ETB', 'Santim', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(46, '978', 'EUR', 'Euro', '€', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(47, '242', 'FJD', 'Fijian dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(48, '238', 'FKP', 'Falkland Islands pound', '£', 'Penny', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(49, '826', 'GBP', 'British pound[C]', '£', 'Penny', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(50, '981', 'GEL', 'Georgian lari', 'ლ', 'Tetri', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(51, '936', 'GHS', 'Ghanaian cedi', '₵', 'Pesewa', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(52, '292', 'GIP', 'Gibraltar pound', '£', 'Penny', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(53, '270', 'GMD', 'Gambian dalasi', 'D', 'Butut', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(54, '324', 'GNF', 'Guinean franc', 'Fr', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(55, '320', 'GTQ', 'Guatemalan quetzal', 'Q', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(56, '328', 'GYD', 'Guyanese dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(57, '344', 'HKD', 'Hong Kong dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(58, '340', 'HNL', 'Honduran lempira', 'L', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(59, '191', 'HRK', 'Croatian kuna', 'kn', 'Lipa', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(60, '332', 'HTG', 'Haitian gourde', 'G', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(61, '348', 'HUF', 'Hungarian forint', 'Ft', 'Fillér', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(62, '360', 'IDR', 'Indonesian rupiah', 'Rp', 'Sen', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(63, '376', 'ILS', 'Israeli new sheqel', '₪', 'Agora', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(64, '356', 'INR', 'Indian rupee', '₹', 'Paisa', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(65, '368', 'IQD', 'Iraqi dinar', 'ع.د', 'Fils', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(66, '364', 'IRR', 'Iranian rial', '', 'Dinar', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(67, '352', 'ISK', 'Icelandic króna', 'kr', 'Eyrir', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(68, '388', 'JMD', 'Jamaican dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(69, '400', 'JOD', 'Jordanian dinar', 'د.ا', 'Piastre[H]', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(70, '392', 'JPY', 'Japanese yen', '¥', 'Sen[G]', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(71, '404', 'KES', 'Kenyan shilling', 'Sh', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(72, '417', 'KGS', 'Kyrgyzstani som', 'KGS', 'Tyiyn', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(73, '116', 'KHR', 'Cambodian riel', '៛', 'Sen', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(74, '174', 'KMF', 'Comorian franc', 'Fr', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(75, '408', 'KPW', 'North Korean won', '', 'Chŏn', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(76, '410', 'KRW', 'South Korean won', '', 'Jeon', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(77, '414', 'KWD', 'Kuwaiti dinar', 'د.ك', 'Fils', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(78, '136', 'KYD', 'Cayman Islands dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(79, '398', 'KZT', 'Kazakhstani tenge', '〒', 'Tiyn', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(80, '418', 'LAK', 'Lao kip', '', 'Att', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(81, '422', 'LBP', 'Lebanese pound', 'ل.ل', 'Piastre', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(82, '144', 'LKR', 'Sri Lankan rupee', 'Rs', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(83, '430', 'LRD', 'Liberian dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(84, '426', 'LSL', 'Lesotho loti', 'L', 'Sente', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(85, '440', 'LTL', 'Lithuanian litas', 'Lt', 'Centas', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(86, '428', 'LVL', 'Latvian lats', 'Ls', 'Santims', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(87, '434', 'LYD', 'Libyan dinar', 'ل.د', 'Dirham', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(88, '504', 'MAD', 'Moroccan dirham', 'Dh', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(89, '498', 'MDL', 'Moldovan leu', 'L', 'Ban', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(90, '969', 'MGA', 'Malagasy ariary', 'MGA', 'Iraimbilanja', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(91, '807', 'MKD', 'Macedonian denar', 'ден', 'Deni', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(92, '104', 'MMK', 'Myanma kyat', 'K', 'Pya', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(93, '496', 'MNT', 'Mongolian tögrög', '', 'Möngö', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(94, '446', 'MOP', 'Macanese pataca', 'P', 'Avo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(95, '478', 'MRO', 'Mauritanian ouguiya', 'UM', 'Khoums', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(96, '480', 'MUR', 'Mauritian rupee', '', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(97, '462', 'MVR', 'Maldivian rufiyaa', 'ރ.', 'Laari', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(98, '454', 'MWK', 'Malawian kwacha', 'MK', 'Tambala', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(99, '484', 'MXN', 'Mexican peso', '$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(100, '458', 'MYR', 'Malaysian ringgit', 'RM', 'Sen', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(101, '943', 'MZN', 'Mozambican metical', 'MTn', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(102, '516', 'NAD', 'Namibian dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(103, '566', 'NGN', 'Nigerian naira', '₦', 'Kobo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(104, '558', 'NIO', 'Nicaraguan córdoba', 'C$', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(105, '578', 'NOK', 'Norwegian krone', 'kr', 'Øre', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(106, '524', 'NPR', 'Nepalese rupee', '', 'Paisa', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(107, '554', 'NZD', 'New Zealand dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(108, '512', 'OMR', 'Omani rial', 'ر.ع.', 'Baisa', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(109, '590', 'PAB', 'Panamanian balboa', 'B/.', 'Centésimo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(110, '604', 'PEN', 'Peruvian nuevo sol', 'S/.', 'Céntimo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(111, '598', 'PGK', 'Papua New Guinean kina', 'K', 'Toea', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(112, '608', 'PHP', 'Philippine peso', '₱', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(113, '586', 'PKR', 'Pakistani rupee', 'PKR', 'Paisa', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(114, '985', 'PLN', 'Polish złoty', 'zł', 'Grosz', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(115, '600', 'PYG', 'Paraguayan guaraní', '', 'Céntimo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(116, '634', 'QAR', 'Qatari riyal', 'ر.ق', 'Dirham', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(117, '946', 'RON', 'Romanian leu', 'L', 'Ban', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(118, '941', 'RSD', 'Serbian dinar', 'дин.', 'Para', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(119, '643', 'RUB', 'Russian ruble', 'руб.', 'Kopek', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(120, '646', 'RWF', 'Rwandan franc', 'Fr', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(121, '682', 'SAR', 'Saudi riyal', 'ر.س', 'Hallallah', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(122, '90', 'SBD', 'Solomon Islands dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(123, '690', 'SCR', 'Seychellois rupee', '', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(124, '938', 'SDG', 'Sudanese pound', 'ج.س', 'Piastre', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(125, '752', 'SEK', 'Swedish krona', 'kr', 'Öre', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(126, '702', 'SGD', 'Singapore dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(127, '654', 'SHP', 'Saint Helena pound', '£', 'Penny', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(128, '694', 'SLL', 'Sierra Leonean leone', 'Le', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(129, '706', 'SOS', 'Somali shilling', 'Sh', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(130, '968', 'SRD', 'Surinamese dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(131, '678', 'STD', 'São Tomé and Príncipe dobra', 'Db', 'Cêntimo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(132, '222', 'SVC', 'Salvadoran colón', '', 'Centavo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(133, '760', 'SYP', 'Syrian pound', '£', 'Piastre', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(134, '748', 'SZL', 'Swazi lilangeni', 'L', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(135, '764', 'THB', 'Thai baht', '฿', 'Satang', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(136, '972', 'TJS', 'Tajikistani somoni', 'ЅМ', 'Diram', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(137, '0', 'TMM', 'Turkmenistani manat', 'm', 'Tennesi', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(138, '788', 'TND', 'Tunisian dinar', 'د.ت', 'Millime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(139, '776', 'TOP', 'Tongan paʻanga', 'T$', 'Seniti[J]', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(140, '949', 'TRY', 'Turkish lira', 'TL', 'Kuruş', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(141, '780', 'TTD', 'Trinidad and Tobago dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(142, '901', 'TWD', 'New Taiwan dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(143, '834', 'TZS', 'Tanzanian shilling', 'Sh', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(144, '980', 'UAH', 'Ukrainian hryvnia', '', 'Kopiyka', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(145, '800', 'UGX', 'Ugandan shilling', 'Sh', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(146, '858', 'UYU', 'Uruguayan peso', '$', 'Centésimo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(147, '860', 'UZS', 'Uzbekistani som', 'UZS', 'Tiyin', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(148, '937', 'VEF', 'Venezuelan bolívar', 'Bs F', 'Céntimo', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(149, '704', 'VND', 'Vietnamese dong', '₫', 'Hào[K]', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(150, '548', 'VUV', 'Vanuatu vatu', 'Vt', 'None', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(151, '882', 'WST', 'Samoan tala', 'T', 'Sene', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(152, '950', 'XAF', 'Central African CFA franc', 'Fr', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(153, '951', 'XCD', 'East Caribbean dollar', '$', 'Cent', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(154, '952', 'XOF', 'West African CFA franc', 'Fr', 'Centime', '', '2022-08-10 13:55:00', '2022-08-10 13:55:00'),
(155, '953', 'XPF', 'CFP franc', 'Fr', 'Centime', '', '2022-08-10 13:55:01', '2022-08-10 13:55:01'),
(156, '886', 'YER', 'Yemeni rial', '', 'Fils', '', '2022-08-10 13:55:01', '2022-08-10 13:55:01'),
(157, '710', 'ZAR', 'South African rand', 'R', 'Cent', '', '2022-08-10 13:55:01', '2022-08-10 13:55:01'),
(158, '894', 'ZMK', 'Zambian kwacha', 'ZK', 'Ngwee', '', '2022-08-10 13:55:01', '2022-08-10 13:55:01'),
(159, '0', 'ZWR', 'Zimbabwean dollar', '$', 'Cent', '', '2022-08-10 13:55:01', '2022-08-10 13:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_times`
--

CREATE TABLE `delivery_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_times`
--

INSERT INTO `delivery_times` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, '1 Day', '1-day', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, '2 Days', '2-days', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, '3 Days', '3-days', '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Accounting and Finance', 'accounting-and-finance', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 'Customer Service or Operations', 'customer-service-or-operations', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 'Engineering or Product Management', 'engineering-or-product-management', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(4, 'Human Resource Management', 'human-resource-management', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(5, 'Marketing', 'marketing', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(6, 'Production', 'production', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(7, 'Purchasing', 'purchasing', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(8, 'Research And Development', 'research-and-development', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(9, 'Sales', 'sales', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `disputes`
--

CREATE TABLE `disputes` (
  `id` int(10) UNSIGNED NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(191) DEFAULT NULL,
  `email_type_id` int(11) DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `admin_email`, `email_type_id`, `title`, `subject`, `content`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Registration', 'New User Registered', '<p>Hi <strong>%name%!</strong> Thanks for registering at Worketic. You can now login to manage your account using the following credentials:<br /> <strong>Username:</strong> %name%<br /> <strong>Password:</strong> %password%<br /> <strong>Email:</strong> %email%<br /> %signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(2, NULL, 2, 'Verification Code', 'Verification Code Received', '<p>Hi <strong>%name%!</strong> Thanks for registering at Worketic.<br /> Here is your verification code to complete registration process<br /> <strong>Name :</strong> %name%<br /> <strong>Email :</strong> %email%<br /> <strong>Verification Code:</strong> %verification_code%<br /> %signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(3, NULL, 3, 'Lost Password', 'Forgot Password', '<p>Hi <strong>%name%!</strong> <strong>Lost Password reset</strong></p>\r\n                    <p>Someone requested to reset the password of following account:<br /> <strong>Email Address:</strong> %account_email%<br /> If this was a mistake, just ignore this email and nothing will happen.<br /> To reset your password, click reset link below:<br /> <a href=\"%link%\"><strong>Reset</strong></a></p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(4, NULL, 4, 'Account Verification', 'Account Verification', '<p>Hi <strong>%name%</strong>! <strong>Verify Your Account</strong></p>\r\n                    <p>You account has created with below given email address:</p>\r\n                    <p><strong>Email Address:</strong> %account_email%</p>\r\n                    <p>If this was a mistake, just ignore this email and nothing will happen.</p>\r\n                    <p>To verifiy your account, click below link:</p>\r\n                    <p><strong><a href=\"%link%\">Verify</a> </strong></p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(5, NULL, 5, 'Invitation', 'Invitation', '<p>Hi,</p>\r\n                    <p><strong>%username%</strong> has invited you to signup at <strong>%link%</strong>.</p>\r\n                    <p>You have invitation message given below</p>\r\n                    <p><strong>%message% </strong></p>\r\n                    <p><strong>%signature%</strong></p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(6, NULL, 6, 'Contact Form Received', 'Contact Form Received', '<p>Hi,</p>\r\n                    <p>A person has contacted you,</p>\r\n                    <p>Description of message is given below.</p>\r\n                    <p><strong>Subject :</strong> %subject%</p>\r\n                    <p><strong>Name :</strong> %name%</p>\r\n                    <p><strong>Email :</strong> %email%</p>\r\n                    <p><strong>Phone Number :</strong> %phone%</p>\r\n                    <p><strong>Message :</strong> %message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(7, 'info@yourdomain.com', 7, 'Admin Email Content - Registration', 'New Registration!', '<p>Hey!</p>\r\n                    <p>A new user <strong>\"%username%\"</strong> with email address <strong>\"%email%\"</strong> has registered on your website.<br /> Please login to check user detail.<br /> You can check user detail at: <strong>%link% </strong></p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(8, 'info@yourdomain.com', 8, 'Admin Email Content - Account Delete', 'Account Delete', '<p>Hi, An existing user has deleted account due to following</p>\r\n                    <p><strong>Reason:</strong> %reason%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(9, 'info@yourdomain.com', 9, 'Admin Email Content - Report Employer', 'Employer Reported', '<p>Hello,</p>\r\n                    <p>An employer <strong><a href=\"%link%\"> %reported_employer% </a></strong> has been reported by <strong><a href=\"%report_by_link%\">%reported_by% </a></strong></p>\r\n                    <p>Message is given below.</p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(10, 'info@yourdomain.com', 10, 'Admin Email Content - Report Project', 'Project Reported', '<p>Hello,</p>\r\n                    <p>A project <strong><a href=\"%link\">%reported_project%</a></strong> has been reported by <strong><a href=\"%report_by_link%\">%reported_by% </a></strong></p>\r\n                    <p>Message is given below.</p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(11, 'info@yourdomain.com', 11, 'Admin Email Content - Report Provider', 'A Provider has been reported!', '<p>Hello,</p>\r\n                    <p>A Provider <a href=\"%link%\"><strong>%reported_provider%</strong></a> has been reported by<strong> <a href=\"%report_by_link%\">%reported_by% </a></strong>&nbsp;</p>\r\n                    <p>Message is given below.</p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(12, 'info@yourdomain.com', 12, 'Admin Email Content - Job Posted', 'New Job Posted', '<p>Hello,</p>\r\n                    <p>A new job is posted by <strong><a href=\"%employer_link%\">%employer_name%</a></strong>.</p>\r\n                    <p>Click to view the job link.</p>\r\n                    <p><a href=\"%job_link%\" target=\"_blank\" rel=\"noopener\"><strong>%job_title%</strong></a></p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(13, 'info@yourdomain.com', 13, 'Admin Email Content - Job Completed', 'Job Completed', '<p>Hello,</p>\r\n                    <p>The <a href=\"%provider_link%\"><strong>%provider_name%</strong></a> has completed the following project (<strong><a href=\"%project_link%\">%project_title%</a></strong>).</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(14, NULL, 14, 'Employer Email Content - Proposal Received', 'Proposal Received', '<p>Hello <strong>%employer_name%</strong>,</p>\r\n                    <p><strong> <a href=\"%provider_link%\">%provider_name%</a></strong> has sent a new proposal on the following project <a href=\"%project_link%\"><strong>%project_title%</strong></a>. Project Information is given below.</p>\r\n                    <p><strong>Proposal Amount :</strong> %proposal_amount%</p>\r\n                    <p><strong>Project Duration :</strong> %proposal_duration%</p>\r\n                    <p><strong>Message:</strong></p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(15, NULL, 15, 'Employer Email Content - New Job Posted', 'New Job Posted', '<p>Hello,</p>\r\n                    <p>A new job is posted by you <strong><a href=\"%employer_link%\">%employer_name%</a></strong>.</p>\r\n                    <p>Click to view the job link. <strong><a href=\"%job_link%\" target=\"_blank\" rel=\"noopener\">%job_title%</a></strong>&nbsp;</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(16, NULL, 16, 'Employer Email Content - Proposal Message', 'Proposal Message', '<p>Hello <strong><a href=\"%employer_link%\">%employer_name%</a></strong>,</p>\r\n                    <p>The <a href=\"%provider_link%\"><strong>%provider_name%</strong></a> have submitted the proposal message on this job <strong><a href=\"%project_link%\">%project_title%</a></strong>.</p>\r\n                    <p>Login to view your proposal message.</p>\r\n                    <p><strong>Message: </strong></p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(17, NULL, 17, 'Employer Email Content - Package Purchased', 'Package Purchased', '<p>Hello <a href=\"%employer_link%\"><strong>%employer_name%</strong></a>,</p>\r\n                    <p>You have subscribed to the following</p>\r\n                    <p><strong>%package_name%</strong> package at cost of <strong>%package_price%</strong> which will be expired on <strong>%package_expiry%</strong>.</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(18, NULL, 18, 'Provider Email Content - New Proposal Submitted', 'New Proposal Submitted', '<p>Hello <strong><a href=\"%provider_link%\">%provider_name%</a></strong>,</p>\r\n                    <p>You have submitted the proposal against this job <strong><a href=\"%project_link%\">%project_title%</a></strong>. With the following details.</p>\r\n                    <p><strong>Project Proposal Amount :</strong> %proposal_amount%</p>\r\n                    <p><strong>Project Duration :</strong> %proposal_duration%</p>\r\n                    <p><strong>Message:</strong> %message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(19, NULL, 19, 'Provider Email Content - Hire Provider', 'Congratulation You are hired!', '<p>Hello <strong><a href=\"%provider_link%\">%provider_name%</a></strong>,</p>\r\n                    <p>The <strong><a href=\"%employer_link%\">%employer_name%</a></strong> hired you for the following job <strong><a href=\"%project_link%\">%project_title%</a></strong>.</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(20, NULL, 20, 'Provider Email Content - Send Offer', 'Offer Received', '<p>Hi <strong><a href=\"%provider_link%\">%provider_name%</a></strong>,</p>\r\n                    <p>The <a href=\"%employer_link%\"><strong>%employer_name%</strong></a> would like to invite you to consider working on the following project&nbsp;&nbsp;</p>\r\n                    <p><strong>Project Name :</strong> <strong><a href=\"%project_link%\">%project_title%</a> </strong></p>\r\n                    <p><strong>Message:</strong></p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(21, NULL, 21, 'Provider Email Content - Cancel Job', 'Job Cancelled', '<p>Hello <strong><a href=\"%provider_link%\">%provider_name%</a></strong>,</p>\r\n                    <p>Unfortunately <strong><a href=\"%employer_link%\">%employer_name%</a></strong> cancelled the <strong><a href=\"%project_link%\">%project_title%</a></strong> due to following reasons.</p>\r\n                    <p>Job Cancel Reasons Below.</p>\r\n                    <p><strong>Message:</strong></p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(22, NULL, 22, 'Provider Email Content - Proposal Message', 'Proposal Message', '<p>Hello <strong><a href=\"%employer_link%\">%employer_name%</a></strong>,</p>\r\n                    <p>The <strong><a href=\"%provider_link%\">%provider_name%</a></strong>&nbsp;has submitted the proposal message on this job <strong><a href=\"%project_link%\">%project_title%</a></strong>.</p>\r\n                    <p>Login to view your proposal message.</p>\r\n                    <p><strong>Message:</strong></p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(23, NULL, 23, 'Provider Email Content - Package Subscribed', 'Package Purchased', '<p>Hello <strong><a href=\"%provider_link%\">%provider_name%</a></strong>,</p>\r\n                    <p>You have subscribed to the following <strong>%package_name%</strong> package at cost of <strong>%package_price%</strong> which will be expired on <strong>%package_expiry%</strong>.</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(24, NULL, 24, 'Provider Email Content - Job Completed', 'Job Completed', '<p>Hello <strong><a href=\"%provider_link%\">%provider_name%</a></strong>,</p>\r\n                    <p>The <strong><a href=\"%employer_link%\">%employer_name%</a></strong>&nbsp;has confirmed that the following project (<a href=\"%project_link%\">\"<strong>%project_title%</strong>\"</a>) is completed.</p>\r\n                    <p>You have received the following ratings from employer.</p>\r\n                    <p><strong>Message: </strong></p>\r\n                    <p>%message%</p>\r\n                    <p><strong>Ratings:</strong> %rating%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(25, 'info@yourdomain.com', 25, 'Admin Email Content - Dispute Raised', 'A dispute has been rasied', '<p>Hello,</p>\r\n                    <p>A dispute has been raised by Provider <strong><a href=\"%provider_link%\"> %provider_name% </a></strong> against <a href=\"%project_link%\">\"<strong>%project_title%</strong>\"</a>&nbsp;.</p>\r\n                    <p><strong>Reason:</strong> \"%reason%\"</p>\r\n                    <p>Message is given below.</p>\r\n                    <p>%message%</p>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(26, NULL, 26, 'Password Reset', 'Password Reset', '<p>Hello <strong>%name%</strong>,</p>\r\n                    <p>You password has been reset successfully.</p>\r\n                    <p>You can login to your account with new credentials</p>\r\n                    <p><strong>Email: </strong>%email%</p>\r\n                    <p><strong>Password: </strong>%password%</p><br>\r\n                    <p>%signature%</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47'),
(27, 'info@yourdomain.com', 27, 'Admin Email Content - Job Cancelled', 'Job Cancelled', '  <p>Hello,</p>\r\n                                    <p>An Employer <a href=\"%employer_link%\">%employer_name%</a> has cancelled his ongoing project <a href=\"%project_link%\">%project_title%</a> assigned to <a href=\"%provider_link%\"> %provider_name% </a></p>\r\n                                    <p>Job Cancel Reason is given below.</p>\r\n                                    <p>%message%</p>\r\n                                    <p>%signature%,</p>', '2024-02-08 11:42:47', '2024-02-08 11:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `email_types`
--

CREATE TABLE `email_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `email_type` enum('new_user','verification_code','lost_password','account_verification','invitation','contact_form_received','admin_email_registration','admin_email_delete_account','admin_email_report_employer','admin_email_report_project','admin_email_report_provider','admin_email_new_job_posted','admin_email_job_completed','employer_email_proposal_received','employer_email_new_job_posted','employer_email_proposal_message','employer_email_package_subscribed','provider_email_new_proposal_submitted','provider_email_hire_provider','provider_email_send_offer','provider_email_cancel_job','provider_email_proposal_message','provider_email_package_subscribed','provider_email_job_completed','admin_email_dispute_raised','reset_password_email','admin_email_cancel_job') NOT NULL,
  `variables` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_types`
--

INSERT INTO `email_types` (`id`, `role_id`, `email_type`, `variables`, `created_at`, `updated_at`) VALUES
(1, NULL, 'new_user', 'a:6:{i:0;a:2:{s:3:\"key\";s:4:\"name\";s:5:\"value\";s:6:\"%name%\";}i:1;a:2:{s:3:\"key\";s:5:\"email\";s:5:\"value\";s:7:\"%email%\";}i:2;a:2:{s:3:\"key\";s:8:\"username\";s:5:\"value\";s:10:\"%username%\";}i:3;a:2:{s:3:\"key\";s:8:\"password\";s:5:\"value\";s:10:\"%password%\";}i:4;a:2:{s:3:\"key\";s:17:\"verification_code\";s:5:\"value\";s:19:\"%verification_code%\";}i:5;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(2, NULL, 'verification_code', 'a:4:{i:0;a:2:{s:3:\"key\";s:4:\"name\";s:5:\"value\";s:6:\"%name%\";}i:1;a:2:{s:3:\"key\";s:5:\"email\";s:5:\"value\";s:7:\"%email%\";}i:2;a:2:{s:3:\"key\";s:17:\"verification_code\";s:5:\"value\";s:19:\"%verification_code%\";}i:3;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(3, NULL, 'lost_password', 'a:3:{i:0;a:2:{s:3:\"key\";s:4:\"name\";s:5:\"value\";s:6:\"%name%\";}i:1;a:2:{s:3:\"key\";s:4:\"link\";s:5:\"value\";s:6:\"%link%\";}i:2;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(4, NULL, 'account_verification', 'a:3:{i:0;a:2:{s:3:\"key\";s:4:\"name\";s:5:\"value\";s:6:\"%name%\";}i:1;a:2:{s:3:\"key\";s:4:\"link\";s:5:\"value\";s:6:\"%link%\";}i:2;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(5, NULL, 'invitation', 'a:4:{i:0;a:2:{s:3:\"key\";s:8:\"username\";s:5:\"value\";s:10:\"%username%\";}i:1;a:2:{s:3:\"key\";s:4:\"link\";s:5:\"value\";s:6:\"%link%\";}i:2;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:3;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(6, NULL, 'contact_form_received', 'a:6:{i:0;a:2:{s:3:\"key\";s:7:\"subject\";s:5:\"value\";s:9:\"%subject%\";}i:1;a:2:{s:3:\"key\";s:4:\"name\";s:5:\"value\";s:6:\"%name%\";}i:2;a:2:{s:3:\"key\";s:5:\"email\";s:5:\"value\";s:7:\"%email%\";}i:3;a:2:{s:3:\"key\";s:5:\"phone\";s:5:\"value\";s:7:\"%phone%\";}i:4;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:5;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(7, 1, 'admin_email_registration', 'a:4:{i:0;a:2:{s:3:\"key\";s:8:\"username\";s:5:\"value\";s:10:\"%username%\";}i:1;a:2:{s:3:\"key\";s:4:\"link\";s:5:\"value\";s:6:\"%link%\";}i:2;a:2:{s:3:\"key\";s:5:\"email\";s:5:\"value\";s:7:\"%email%\";}i:3;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(8, 1, 'admin_email_delete_account', 'a:5:{i:0;a:2:{s:3:\"key\";s:6:\"reason\";s:5:\"value\";s:8:\"%reason%\";}i:1;a:2:{s:3:\"key\";s:8:\"username\";s:5:\"value\";s:10:\"%username%\";}i:2;a:2:{s:3:\"key\";s:5:\"email\";s:5:\"value\";s:7:\"%email%\";}i:3;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:4;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(9, 1, 'admin_email_report_employer', 'a:6:{i:0;a:2:{s:3:\"key\";s:17:\"reported_employer\";s:5:\"value\";s:19:\"%reported_employer%\";}i:1;a:2:{s:3:\"key\";s:17:\"reported_employer\";s:5:\"value\";s:19:\"%reported_employer%\";}i:2;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:3;a:2:{s:3:\"key\";s:9:\"user_link\";s:5:\"value\";s:11:\"%user_link%\";}i:4;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:5;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(10, 1, 'admin_email_report_project', 'a:6:{i:0;a:2:{s:3:\"key\";s:16:\"reported_project\";s:5:\"value\";s:18:\"%reported_project%\";}i:1;a:2:{s:3:\"key\";s:11:\"reported_by\";s:5:\"value\";s:13:\"%reported_by%\";}i:2;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:3;a:2:{s:3:\"key\";s:9:\"user_link\";s:5:\"value\";s:11:\"%user_link%\";}i:4;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:5;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(11, 1, 'admin_email_report_provider', 'a:6:{i:0;a:2:{s:3:\"key\";s:19:\"reported_provider\";s:5:\"value\";s:21:\"%reported_provider%\";}i:1;a:2:{s:3:\"key\";s:11:\"reported_by\";s:5:\"value\";s:13:\"%reported_by%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:3;a:2:{s:3:\"key\";s:9:\"user_link\";s:5:\"value\";s:11:\"%user_link%\";}i:4;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:5;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(12, 1, 'admin_email_new_job_posted', 'a:5:{i:0;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:1;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:2;a:2:{s:3:\"key\";s:9:\"job_title\";s:5:\"value\";s:11:\"%job_title%\";}i:3;a:2:{s:3:\"key\";s:8:\"job_link\";s:5:\"value\";s:10:\"%job_link%\";}i:4;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(13, 1, 'admin_email_job_completed', 'a:5:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:3;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:4;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(14, 2, 'employer_email_proposal_received', 'a:9:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:3;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:4;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:5;a:2:{s:3:\"key\";s:15:\"proposal_amount\";s:5:\"value\";s:17:\"%proposal_amount%\";}i:6;a:2:{s:3:\"key\";s:17:\"proposal_duration\";s:5:\"value\";s:19:\"%proposal_duration%\";}i:7;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:8;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(15, 2, 'employer_email_new_job_posted', 'a:5:{i:0;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:1;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:2;a:2:{s:3:\"key\";s:9:\"job_title\";s:5:\"value\";s:11:\"%job_title%\";}i:3;a:2:{s:3:\"key\";s:8:\"job_link\";s:5:\"value\";s:10:\"%job_link%\";}i:4;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(16, 2, 'employer_email_proposal_message', 'a:8:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:3;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:4;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:5;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:6;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:7;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(17, 2, 'employer_email_package_subscribed', 'a:6:{i:0;a:2:{s:3:\"key\";s:12:\"package_name\";s:5:\"value\";s:14:\"%package_name%\";}i:1;a:2:{s:3:\"key\";s:13:\"package_price\";s:5:\"value\";s:15:\"%package_price%\";}i:2;a:2:{s:3:\"key\";s:14:\"package_expiry\";s:5:\"value\";s:16:\"%package_expiry%\";}i:3;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:4;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:5;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(18, 3, 'provider_email_new_proposal_submitted', 'a:8:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:3;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:4;a:2:{s:3:\"key\";s:15:\"proposal_amount\";s:5:\"value\";s:17:\"%proposal_amount%\";}i:5;a:2:{s:3:\"key\";s:17:\"proposal_duration\";s:5:\"value\";s:19:\"%proposal_duration%\";}i:6;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:7;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(19, 3, 'provider_email_hire_provider', 'a:7:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:3;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:4;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:5;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:6;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(20, 3, 'provider_email_send_offer', 'a:8:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:3;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:4;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:5;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:6;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:7;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(21, 3, 'provider_email_cancel_job', 'a:8:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:3;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:4;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:5;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:6;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:7;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(22, 3, 'provider_email_proposal_message', 'a:8:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:3;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:4;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:5;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:6;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:7;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(23, 3, 'provider_email_package_subscribed', 'a:6:{i:0;a:2:{s:3:\"key\";s:12:\"package_name\";s:5:\"value\";s:14:\"%package_name%\";}i:1;a:2:{s:3:\"key\";s:13:\"package_price\";s:5:\"value\";s:15:\"%package_price%\";}i:2;a:2:{s:3:\"key\";s:14:\"package_expiry\";s:5:\"value\";s:16:\"%package_expiry%\";}i:3;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:4;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:5;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(24, 3, 'provider_email_job_completed', 'a:9:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:2;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:3;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:4;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:5;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:6;a:2:{s:3:\"key\";s:7:\"ratings\";s:5:\"value\";s:9:\"%ratings%\";}i:7;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:8;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(25, 1, 'admin_email_dispute_raised', 'a:7:{i:0;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:1;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:2;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:3;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:4;a:2:{s:3:\"key\";s:6:\"reason\";s:5:\"value\";s:8:\"%reason%\";}i:5;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:6;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(26, NULL, 'reset_password_email', 'a:3:{i:0;a:2:{s:3:\"key\";s:4:\"name\";s:5:\"value\";s:6:\"%name%\";}i:1;a:2:{s:3:\"key\";s:5:\"email\";s:5:\"value\";s:7:\"%email%\";}i:2;a:2:{s:3:\"key\";s:8:\"password\";s:5:\"value\";s:10:\"%password%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16'),
(27, NULL, 'admin_email_cancel_job', 'a:8:{i:0;a:2:{s:3:\"key\";s:13:\"employer_link\";s:5:\"value\";s:15:\"%employer_link%\";}i:1;a:2:{s:3:\"key\";s:13:\"employer_name\";s:5:\"value\";s:15:\"%employer_name%\";}i:2;a:2:{s:3:\"key\";s:12:\"project_link\";s:5:\"value\";s:14:\"%project_link%\";}i:3;a:2:{s:3:\"key\";s:13:\"project_title\";s:5:\"value\";s:15:\"%project_title%\";}i:4;a:2:{s:3:\"key\";s:15:\"provider_link\";s:5:\"value\";s:17:\"%provider_link%\";}i:5;a:2:{s:3:\"key\";s:15:\"provider_name\";s:5:\"value\";s:17:\"%provider_name%\";}i:6;a:2:{s:3:\"key\";s:7:\"message\";s:5:\"value\";s:9:\"%message%\";}i:7;a:2:{s:3:\"key\";s:9:\"signature\";s:5:\"value\";s:11:\"%signature%\";}}', '2024-02-13 08:12:16', '2024-02-13 08:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `taxId` varchar(191) DEFAULT NULL,
  `taxPayerType` varchar(191) DEFAULT NULL,
  `privateKey` varchar(191) DEFAULT NULL,
  `publicKey` varchar(191) DEFAULT NULL,
  `privateKeyPassword` varchar(191) DEFAULT NULL,
  `licence` varchar(191) DEFAULT NULL,
  `mode` enum('no taxer person','taxer person','taxer company') NOT NULL DEFAULT 'no taxer person',
  `profile_id` varchar(191) DEFAULT NULL,
  `files` varchar(191) DEFAULT NULL,
  `frontLetter` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `user_id`, `name`, `taxId`, `taxPayerType`, `privateKey`, `publicKey`, `privateKeyPassword`, `licence`, `mode`, `profile_id`, `files`, `frontLetter`, `created_at`, `updated_at`) VALUES
(1, 4, 'test', '4256897589', 'one', 'tester', NULL, NULL, NULL, 'no taxer person', NULL, NULL, NULL, '2022-10-31 08:31:27', '2022-10-31 08:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `english_levels`
--

CREATE TABLE `english_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `english_level` enum('basic','conversational','fluent','native','professional') NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `follower` int(11) DEFAULT NULL,
  `following` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fteams`
--

CREATE TABLE `fteams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fteams`
--

INSERT INTO `fteams` (`id`, `name`, `email`, `role`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 'Tester1', 'tester1@yopmail.com', 'Tester', 21, '2023-11-05 06:52:11', '2023-11-05 06:53:35'),
(8, 'Tester', 'tester@yopmail.com', 'Tester', 21, '2023-11-05 06:53:02', '2023-11-05 06:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `price` double NOT NULL,
  `payer_name` varchar(191) NOT NULL,
  `payer_email` varchar(191) NOT NULL,
  `seller_email` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `payer_status` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) NOT NULL,
  `sales_tax` double NOT NULL,
  `invoice_id` varchar(191) NOT NULL,
  `customer_id` varchar(191) DEFAULT NULL,
  `shipping_amount` double DEFAULT NULL,
  `handling_amount` double DEFAULT NULL,
  `insurance_amount` double DEFAULT NULL,
  `paypal_fee` double NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `type` enum('trial','package','project','quiz') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `transection_doc` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `title`, `price`, `payer_name`, `payer_email`, `seller_email`, `currency_code`, `payer_status`, `transaction_id`, `sales_tax`, `invoice_id`, `customer_id`, `shipping_amount`, `handling_amount`, `insurance_amount`, `paypal_fee`, `payment_mode`, `paid`, `type`, `created_at`, `updated_at`, `detail`, `transection_doc`) VALUES
(39, 'Bank Transfer', 90, 'Cooper White', 'white.employer@yopmail.com', '', 'USD', NULL, '', 0, '', NULL, 0, 0, 0, 0, 'bacs', 1, 'package', '2022-08-05 21:28:37', '2022-08-05 21:29:44', 'I need testing to be done', NULL),
(40, 'Bank Transfer', 60, 'Kai Clarke', 'kai.clarke@yopmail.com', '', 'USD', NULL, '', 0, '', NULL, 0, 0, 0, 0, 'bacs', 1, 'package', '2022-08-10 15:17:12', '2022-08-10 15:18:42', 'This is package for the provider', NULL),
(41, 'Bank Transfer', 3000, 'Cooper White', 'white.employer@yopmail.com', '', 'USD', NULL, '', 0, '', NULL, 0, 0, 0, 0, 'bacs', 1, 'project', '2022-08-13 12:54:39', '2022-08-13 13:04:56', 'Tsshis is the test', NULL),
(42, 'Bank Transfer', 120, 'Georgia Baker', 'gbaker@yopmail.com', '', 'USD', NULL, '', 0, '', NULL, 0, 0, 0, 0, 'bacs', 1, 'package', '2022-11-15 11:40:14', '2022-11-15 11:40:43', 'This is the tester', NULL),
(43, 'Bank Transfer', 120, 'Ralph Davis', 'ralph.davis@yopmail.com', '', 'USD', NULL, '', 0, '', NULL, 0, 0, 0, 0, 'bacs', 1, 'package', '2022-11-15 11:44:09', '2022-11-15 11:44:30', 'This is another test', NULL),
(44, 'Bank Transfer', 120, 'Alexa Xavier', 'alexa.xavier@yopmail.com', '', 'USD', NULL, '', 0, '', NULL, 0, 0, 0, 0, 'bacs', 1, 'package', '2022-11-15 11:56:35', '2022-11-15 11:56:59', 'This is the  test', NULL),
(45, 'Bank Transfer', 120, 'Elon Watcher', 'elon@yopmail.com', '', 'USD', NULL, '', 0, '', NULL, 0, 0, 0, 0, 'bacs', 1, 'package', '2022-11-15 12:01:10', '2022-11-15 12:01:36', 'this is the test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `subscriber` int(11) NOT NULL,
  `item_name` varchar(191) NOT NULL,
  `item_price` double NOT NULL,
  `item_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `invoice_id`, `product_id`, `subscriber`, `item_name`, `item_price`, `item_qty`, `created_at`, `updated_at`, `type`) VALUES
(74, 39, 6, 4, 'Paltinum', 90, 1, '2022-08-05 21:29:44', '2022-08-05 21:29:44', 'package'),
(75, 40, 3, 21, 'Basic', 60, 1, '2022-08-10 15:18:42', '2022-08-10 15:18:42', 'package'),
(76, 41, 39, 4, 'PHP Codeigniter Expert', 3000, 1, '2022-08-13 13:05:01', '2022-08-13 13:05:01', 'project'),
(77, 42, 5, 22, 'Pro Members', 120, 1, '2022-11-15 11:40:43', '2022-11-15 11:40:43', 'package'),
(78, 43, 5, 23, 'Pro Members', 120, 1, '2022-11-15 11:44:30', '2022-11-15 11:44:30', 'package'),
(79, 44, 5, 24, 'Pro Members', 120, 1, '2022-11-15 11:56:59', '2022-11-15 11:56:59', 'package'),
(80, 45, 5, 58, 'Pro Members', 120, 1, '2022-11-15 12:01:36', '2022-11-15 12:01:36', 'package');

-- --------------------------------------------------------

--
-- Table structure for table `i_p_n_statuses`
--

CREATE TABLE `i_p_n_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `payload` text NOT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `duration` varchar(191) DEFAULT NULL,
  `project_level` enum('basic','medium','expensive') NOT NULL,
  `provider_type` varchar(255) NOT NULL,
  `english_level` enum('basic','conversational','fluent','native','professional') NOT NULL,
  `project_type` enum('hourly','fixed') NOT NULL DEFAULT 'fixed',
  `price` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `address` varchar(191) NOT NULL,
  `longitude` varchar(191) NOT NULL,
  `latitude` varchar(191) NOT NULL,
  `is_featured` text DEFAULT NULL,
  `show_attachments` text DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `code` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expiry_date` varchar(191) DEFAULT NULL,
  `quiz` enum('yes','no') DEFAULT 'no',
  `delivery_type` enum('time','date') NOT NULL DEFAULT 'date',
  `month` int(10) UNSIGNED DEFAULT NULL,
  `week` int(10) UNSIGNED DEFAULT NULL,
  `day` int(10) UNSIGNED DEFAULT NULL,
  `hour` int(10) UNSIGNED DEFAULT NULL,
  `payment` enum('fixed','perhour') NOT NULL DEFAULT 'fixed',
  `status` enum('draft','approval','rejected','posted','hired','completed','cancelled') NOT NULL DEFAULT 'draft',
  `currency` varchar(191) DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'private'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `title`, `slug`, `duration`, `project_level`, `provider_type`, `english_level`, `project_type`, `price`, `description`, `location_id`, `address`, `longitude`, `latitude`, `is_featured`, `show_attachments`, `attachments`, `code`, `created_at`, `updated_at`, `expiry_date`, `quiz`, `delivery_type`, `month`, `week`, `day`, `hour`, `payment`, `status`, `currency`, `type`) VALUES
(200, 4, 'Laravel developer', 'laravel-developer', 'monthly', 'basic', '', '', 'fixed', 12354, '<ul>\n<li>Full Stack Development</li>\n<li>Laravel language</li>\n<li>Solr expert&nbsp;</li>\n<li>Required to deliver the development tasks&nbsp;</li>\n<li>Know how to deal AWS</li>\n</ul>\n<p>could Startup project Pre-seed stage Size of the team now is 5 Requirement - More than 30 hrs/week Hourly - Duration 6+ months - Expert Level - Hourly price $10&ndash;$30</p>', NULL, '', '', '', NULL, NULL, NULL, 'J7RRHTRU', '2022-08-05 21:23:26', '2022-08-05 21:29:57', '2022-08-31 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'AUD', 'public'),
(201, 4, 'Laravel Developer for existing software', 'laravel-developer-for-existing-software', 'monthly', 'medium', '', '', 'fixed', 500, '<p>I am looking for a laravel developer who can correct some errors on existing ssoftware and also can add some modules in the software. The modules which needs to be developed are<br />-Student&nbsp;&nbsp;module -<br />Student can view - Personal details, payment schedule, fee receipts , courses<br />Print - Contract, transcript,fee receipts, certificate<br />-Instructor module&nbsp;&nbsp;will be choosing campus and then subject then lands on dashboard. User management module based access<br />View student, edit student , add student based on campus and subject, mark attendance of student<br />View schedule , attendance , add schedule , Road test<br /><br />Only comment if you have understood the functionality and can properly work on this. I need this on urgent basis may be with in a week or so.<br />Thanks</p>', NULL, '', '', '', NULL, NULL, NULL, 'K1E3Z9XO', '2022-08-07 19:37:09', '2022-08-07 19:40:21', '2022-09-30 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'USD', 'public'),
(202, 4, 'Elementor eCommerce website', 'elementor-ecommerce-website', 'monthly', 'medium', '', '', 'fixed', 2354, '<p>Hey, please read this carefully before sending a message (irrelevant messages will be removed automatically)<br /><br />---------------------------<br />Hey, I want to create WordPress website using Elementor pro and woocommerce.<br />The website is a business that provides a monthly subscription to its users.<br />The services are suggestions of our team (sports analysts ) to sports gamblers that use platforms such as bet365 and other sports betting platforms.<br /><br />For example, there is a soccer match that you can gamble on him using BET365. We provide suggestions for this game of what we recommend you to gamble in this match<br /><br />--------------<br />I need someone to develop for me a website that includes a home page,<br />Pricing page - will include the pricing of our plans.<br />User page - where the user that already paid for the service could see the recommendations that we uploaded.<br />Blog page with 4 articles<br />Hits page - shows (as images) what games we succeed to win<br />Contact page<br /><br />Also, there should be login/register panel<br /><br />Note: I have already a domain and hosting. I\'ll upload the context by myself<br />We can by pre made template (themeforest) and edit it if that\'s ok<br /><br />reference site: shorturl.at/acgjZ<br /><br />Please send me the price and the working time for this please</p>', NULL, '', '', '', NULL, NULL, NULL, 'B79UDKVY', '2022-08-07 19:45:33', '2022-08-07 19:47:54', '2022-10-06 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'USD', 'public'),
(203, 4, 'FrontEnd Vue/NuxJS Tailwind CSS engineer developer', 'frontend-vuenuxjs-tailwind-css-engineer-developer', 'monthly', 'medium', '', '', 'fixed', 2357, '<p>Responsibilities<br /><br />Become a Zider Tech member and join this amazing company that is on top of the e-commerce game! Join a company that is not only growing but having fun while doing it. We are a human centric organization with huge growth plans and with a purpose to help more and more people with little or no digital experience to start their online business (e-commerce), move their offline to online or grow their offline businesses even more by having an online presence.<br /><br />As a Senior FrontEnd Developer you should be passionate for delivering high quality products with great design and usability. You will definitely be a team player, think outside of the box, have high experience and knowledge in the technology we use (and why not others too!) and be a good communication. We are a product oriented organization with a strong passion for Engineering and innovation.<br /><br />What You\'ll Bring<br />Hard Skills<br />● A background studies in Computer Science or similar<br />● At least 6 years of hands-on experience in Vue.js, Javascript, HTML &amp; CSS<br />● A strong hands-on experience in model-view-controller architectures<br />● Having a design background is a big plus<br />● Hands-on experience in connecting with UX/UI and standards in UI/UX, Example: Materials design, Bootstrap, Flat Remix, or other<br />● Experience using MySQL<br />● Experience in consuming REST APIs<br />● Knowing or having worked in the e-commerce, retail digital space is a big plus<br />● Having worked with JIRA and Notion is a plus<br />● Knowledge or having work in an Agile environment with SCRUM or Kanban practices is a plus<br /><br /><br />Soft Skills<br />● Great communication skills<br />● Team player<br />● Attention to detail<br />● Excellent debugging and problem-solving skills<br />● Excellent communication skills, both written and verbal.<br />● Smart working habits!<br />● Ability to at point work under pressure (doesn&rsquo;t happen often but sometimes we have deadlines!)<br />● Seek the highest quality and aim to build a &ldquo;bugs-free software even though we understand and know there is no such thing in real life<br />● Have a clean coding standards to avoid creating waste<br /><br />Some of your responsibilities<br />● Work closely with Product owners and other team members to drive the delivery of projects, new features and support on the L2 for incident management.<br />● Guide other more junior in knowledge team members to ensure they become better and more efficient themselves in the art of coding.<br />● Work on your time management skills to ensure that we can estimate tasks and work effort for the work being required by each product line<br />● Support and actively contribute to the collaborative development workflows (source control, branches, PRs) and continuous deployment practices<br />● Be part of the daily standups that are done with product<br />● Help with peer source code review<br />● Be part of the retrospective sessions to ensure that we not only do continuous integration and continuous deployment but also continuous improvements on the way we work as a team!<br />● Be part of this amazing Ziders team!<br />What do we offer<br />● Great environment and people to work with<br />● Thursday&rsquo;s 4pm fun hour! - topics in which teams discuss different topics or we have special guests providing a topic of conversation<br />● Flexible working hours<br />● Hybrid, physical or remote - you choose! (for people not in Riyadh, Saudi Arabia, full remote!!)<br />● Competitive salary package<br />● Technology equipment according to the needs of the role (fancy!)<br />● Regular training (train the trainers or actual training provided by organizations)<br />● Our current technology stack is composed of: PHP, Pyton, .NET, Django, JavaScript, Vuejs, Typescript, Bootstrap, JAVA, jQuery, MySQL, Redis, ELK, NodeJS, Django, among others.</p>', NULL, '', '', '', NULL, NULL, NULL, 'CJX3H34C', '2022-08-07 19:50:09', '2022-12-07 23:26:13', '2022-12-25 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'EUR', 'public'),
(204, 4, 'PHP Codeigniter Expert', 'php-codeigniter-expert', 'three_month', 'basic', '', '', 'fixed', 3546, '<p>Hi,<br /><br />Looking for a PHP Codeigniter Expert for regular daily jobs<br /><br />My requirements are for a developer that has a super good experience with all the list of modules that I list in the txt file and described my current running site.<br /><br /><br />Any developer that considers working on my site will need to e sure he agrees:<br />=========================================================<br />1. Job needs to be done using AnyDeks only.<br />2. Starting job time is 09:00 AM /&nbsp;&nbsp;GMT+3<br />3. Hourly rate is 5$ - 8$<br /><br />Only if you read the text file and you have an experience with all modules you read that are running on my current site, so you can ping me a message.<br /><br />Thank you</p>', NULL, '', '', '', NULL, NULL, NULL, '5AVCBFOD', '2022-08-07 19:55:18', '2022-08-13 13:04:56', '2022-10-14 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'hired', 'EUR', 'public'),
(205, 21, 'Provider Project', 'provider-project', 'monthly', 'basic', '', '', 'fixed', 2500, '<p>This is the tester project</p>', NULL, '', '', '', NULL, NULL, NULL, '1W5DRHI1', '2022-08-28 11:59:16', '2022-08-28 12:00:22', '2022-10-30 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'draft', 'EUR', 'public'),
(206, 21, 'Tester', 'tester', 'monthly', 'basic', '', '', 'fixed', 24500, '<p>Thgis is freelancer\'s project to be done by employer as provider</p>', NULL, '', '', '', NULL, NULL, NULL, 'SICYW249', '2022-09-05 14:19:40', '2022-09-05 14:21:13', '2022-11-10 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'EUR', 'public'),
(207, 4, 'Tester', 'tester-1', 'weekly', 'basic', '', '', 'fixed', 1200, '<p>This is the test</p>', NULL, '', '', '', NULL, NULL, NULL, 'S2OAE3ZA', '2022-09-09 14:03:28', '2022-09-12 15:26:39', '2022-11-24 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'approval', 'USD', 'public'),
(208, 4, 'Adquisición de Firewall CheckPoint 6400', 'adquisicion-de-firewall-checkpoint-6400', 'three_month', 'expensive', '', '', 'fixed', 2800000, '<p>Infraestructura de firewall con redundancia y doble fuente de poder para red interna de Grupo Vizi&oacute;n.&nbsp;</p>\n<p>&nbsp;</p>', NULL, '', '', '', NULL, NULL, NULL, 'ROLUPIR1', '2023-01-26 21:31:01', '2023-01-26 21:40:37', '2023-02-05 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'approval', 'MXN', 'public'),
(209, 4, 'Adquisición de Proxy Web Titan', 'adquisicion-de-proxy-web-titan', 'six_month', 'expensive', '', '', 'fixed', 5000000, '<p>Adquisici&oacute;n de Proxy Web Titan para 1500 equipos conectados a un switch autorizador central</p>', NULL, '', '', '', NULL, NULL, NULL, 'J9ZK7IPF', '2023-02-02 20:39:13', '2023-02-02 20:40:33', NULL, 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'draft', 'MXN', 'public'),
(210, 4, 'Content Writing', 'content-writing', 'monthly', 'medium', '', '', 'fixed', 4200, '<p>This project involves evaluating one of our websites under development and writing the Key Messages. The attached document provides the items that need to be developed. Once the Key Messages are completed we will be looking for a Video Explainer (VE) to develop a video for the website.</p>\n<p>&nbsp;</p>\n<p>This is the first if 3 projects which will require these services.</p>\n<p>&nbsp;</p>\n<p>To be considered bidders must have marketing writing samples that they developed the Key Marketing Messages.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p class=\"PageProjectViewLogout-detail-paragraph\">We are including a document to clarify the content. Please acknowledge you have:<br />1. Reviewed the website<br />2. Reviewed the attachments<br />3. Proposal will include all components in the Marketing Message requirement.<br /><br />Only Freelancers who acknowledge can be considered.<br /><br />Thank you.</p>', NULL, '', '', '', NULL, NULL, NULL, 'JBP6FO8Y', '2023-02-18 14:18:06', '2023-02-20 14:20:03', '2023-02-28 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'USD', 'public'),
(211, 4, 'Test 1', 'test-1', 'more_than_six', 'expensive', '', '', 'fixed', 43434, '<p>Descripci&oacute;n</p>', NULL, '', '', '', NULL, NULL, NULL, '2JI4VJ7Y', '2023-02-27 22:40:45', '2023-02-27 22:43:52', '2023-03-06 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'approval', 'MXN', 'public'),
(212, 4, 'Algorithm Analysis', 'algorithm-analysis', 'monthly', 'medium', '', '', 'fixed', 45000, '<p><a href=\"https://www.freelancer.com/hire/algorithm-analysis\">Algorithm Analysis</a>&nbsp;is an exciting field of research in software engineering that requires a deep understanding of mathematical research to solve complex issues. An Algorithms Analyst is a specialist who uses techniques such as divide and conquer, recursive search techniques, problem reduction, and dynamic programming to create sophisticated data structures and efficient algorithms used in software development.</p>\n<p>When a client needs the services of an Algorithm Analyst, they wish to solve hard computing problems that require operational research methodologies. This can include scheduling algorithms, searching and sorting trees, pattern recognition problems, routing and packing problems, combinatorial optimization problems, graph coloring theories, etc. If successful in finding the best solutions for solutions for these tasks, an Algorithm Analyst has the potential to save a company time and money with their advanced analysis techniques.</p>\n<p>Here&rsquo;s some projects that our expert Algorithms Analysts made real:</p>\n<ul>\n<li>Optimising online marketing strategies</li>\n<li>Developing programs using linked lists and graphs</li>\n<li>Creating custom lexical analysis solutions</li>\n<li>Writing codes to make cryptocurrencies trading strategies automated</li>\n<li>Implementing dictionary using multiple data structures</li>\n<li>Intensifying speed of data copying and pasting processes</li>\n<li>Crafting solutions to the shortest route problem in Python</li>\n<li>Using dynamic programming to solve complex problems</li>\n</ul>\n<p>If your company faces challenging tasks such as these why not post your own project on Freelancer.com so our qualified Algorithm Analysts can use their expertise to make your dreams a reality. With our sophisticated methods at an affordable cost we want you to succeed.</p>', NULL, '', '', '', NULL, NULL, NULL, '9JHE0W8W', '2023-03-11 12:49:56', '2023-03-11 12:51:55', '2023-03-30 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'approval', 'USD', 'public'),
(213, 4, 'Senior Developer: Laravel, Vue JS, PHP, Microservices, PostGre, MySQL, Kafka, Redis Cache, Hosting VPS', 'senior-developer-laravel-vue-js-php-microservices-postgre-mysql-kafka-redis-cache-hosting-vps', 'monthly', 'medium', '', '', 'fixed', 2400, '<p>Must have: Laravel, PHP, Microservices, Postgres, MySQL, Kafka, Redis Cache, VPS Hosting, and Load Balancing.</p>\n<p>Front end: Vue JS, other front-end technologies.</p>\n<p>&nbsp;</p>\n<p>May conduct coding test. This is fulltime.</p>\n<p>&nbsp;</p>\n<p>Must be able to work complete and update work quickly on a daily basis for testing.</p>', NULL, '', '', '', NULL, NULL, NULL, 'KE0RAF17', '2023-03-11 13:11:58', '2023-03-23 12:05:52', '2023-03-30 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'EUR', 'private'),
(214, 4, 'HardWare Provisioning', 'hardware-provisioning', 'monthly', 'basic', '', '', 'fixed', 1000000, '<p>I need 50 servers for the store</p>', NULL, '', '', '', NULL, NULL, NULL, '2ZPVDF4E', '2023-05-09 15:14:20', '2023-05-09 15:17:01', '2023-05-19 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'MXN', 'private'),
(215, 4, 'Buy Tools for shop', 'buy-tools-for-shop', 'monthly', 'medium', '', '', 'fixed', 10000, '<p>This is the test buy project. This is the test buy project. This is the test buy projectThis is the test buy projectThis is the test buy projectThis is the test buy projectThis is the test buy project</p>', NULL, '', '', '', NULL, NULL, NULL, '2HJCRZNK', '2023-05-24 12:44:05', '2023-05-24 12:47:13', '2023-06-23 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'MXN', 'public'),
(216, 4, 'Laravel Project', 'laravel-project', 'monthly', 'medium', '', '', 'fixed', 2000, '<div class=\"elementor-element elementor-element-6b25c2e0 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor\" data-id=\"6b25c2e0\" data-element_type=\"widget\" data-widget_type=\"text-editor.default\">\n<div class=\"elementor-widget-container\">Once you&rsquo;ve determined the skills required for the role, you can write a job description to advertise your position to job seekers. Here&rsquo;s what to include in a Laravel Developer job description:</div>\n</div>\n<section class=\"elementor-section elementor-inner-section elementor-element elementor-element-324fcff5 elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-id=\"324fcff5\" data-element_type=\"section\">\n<div class=\"elementor-container elementor-column-gap-default\">\n<div class=\"elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-dc81647\" data-id=\"dc81647\" data-element_type=\"column\">\n<div class=\"elementor-widget-wrap elementor-element-populated\">\n<div class=\"elementor-element elementor-element-12842eb5 elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-heading\" data-id=\"12842eb5\" data-element_type=\"widget\" data-widget_type=\"heading.default\">\n<div class=\"elementor-widget-container\">\n<p class=\"elementor-heading-title elementor-size-default\">Summary:</p>\n</div>\n</div>\n<div class=\"elementor-element elementor-element-76726294 elementor-align-left elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list\" data-id=\"76726294\" data-element_type=\"widget\" data-widget_type=\"icon-list.default\">\n<div class=\"elementor-widget-container\">\n<ul class=\"elementor-icon-list-items\">\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">Why is the role being filled?</span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">How does this role fit into the organization and the team?  </span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">What makes your company unique? </span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">What would it be like to work for your company?</span></li>\n</ul>\n</div>\n</div>\n<div class=\"elementor-element elementor-element-72421858 elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-heading\" data-id=\"72421858\" data-element_type=\"widget\" data-widget_type=\"heading.default\">\n<div class=\"elementor-widget-container\">\n<p class=\"elementor-heading-title elementor-size-default\">Requirements:</p>\n</div>\n</div>\n<div class=\"elementor-element elementor-element-739385cd elementor-align-left elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list\" data-id=\"739385cd\" data-element_type=\"widget\" data-widget_type=\"icon-list.default\">\n<div class=\"elementor-widget-container\">\n<ul class=\"elementor-icon-list-items\">\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">What technical skills are needed for this role?</span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">Which soft skills are applicable for this role?  </span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">What are the nice-to-have experiences of your ideal candidate?</span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">Include availability preferences in this section</span></li>\n</ul>\n</div>\n</div>\n</div>\n</div>\n</div>\n</section>', NULL, '', '', '', NULL, NULL, NULL, '8HK96VXC', '2023-06-05 09:08:31', '2023-06-05 13:57:30', '2023-06-30 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'USD', 'private'),
(217, 4, 'Laravel Job', 'laravel-job', 'monthly', 'basic', '', '', 'fixed', 1000, '<div class=\"elementor-element elementor-element-6b25c2e0 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor\" data-id=\"6b25c2e0\" data-element_type=\"widget\" data-widget_type=\"text-editor.default\">\n<div class=\"elementor-widget-container\">Once you&rsquo;ve determined the skills required for the role, you can write a job description to advertise your position to job seekers. Here&rsquo;s what to include in a Laravel Developer job description:</div>\n</div>\n<section class=\"elementor-section elementor-inner-section elementor-element elementor-element-324fcff5 elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-id=\"324fcff5\" data-element_type=\"section\">\n<div class=\"elementor-container elementor-column-gap-default\">\n<div class=\"elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-dc81647\" data-id=\"dc81647\" data-element_type=\"column\">\n<div class=\"elementor-widget-wrap elementor-element-populated\">\n<div class=\"elementor-element elementor-element-12842eb5 elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-heading\" data-id=\"12842eb5\" data-element_type=\"widget\" data-widget_type=\"heading.default\">\n<div class=\"elementor-widget-container\">\n<p class=\"elementor-heading-title elementor-size-default\">Summary:</p>\n</div>\n</div>\n<div class=\"elementor-element elementor-element-76726294 elementor-align-left elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list\" data-id=\"76726294\" data-element_type=\"widget\" data-widget_type=\"icon-list.default\">\n<div class=\"elementor-widget-container\">\n<ul class=\"elementor-icon-list-items\">\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">Why is the role being filled?</span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">How does this role fit into the organization and the team?  </span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">What makes your company unique? </span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">What would it be like to work for your company?</span></li>\n</ul>\n</div>\n</div>\n<div class=\"elementor-element elementor-element-72421858 elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-heading\" data-id=\"72421858\" data-element_type=\"widget\" data-widget_type=\"heading.default\">\n<div class=\"elementor-widget-container\">\n<p class=\"elementor-heading-title elementor-size-default\">Requirements:</p>\n</div>\n</div>\n<div class=\"elementor-element elementor-element-739385cd elementor-align-left elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list\" data-id=\"739385cd\" data-element_type=\"widget\" data-widget_type=\"icon-list.default\">\n<div class=\"elementor-widget-container\">\n<ul class=\"elementor-icon-list-items\">\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">What technical skills are needed for this role?</span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">Which soft skills are applicable for this role?  </span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">What are the nice-to-have experiences of your ideal candidate?</span></li>\n<li class=\"elementor-icon-list-item\"><span class=\"elementor-icon-list-text\">Include availability preferences in this section</span></li>\n</ul>\n</div>\n</div>\n</div>\n</div>\n</div>\n</section>', NULL, '', '', '', NULL, NULL, NULL, '93DYJEDE', '2023-06-05 09:24:58', '2023-06-05 09:25:42', '2023-06-30 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'EUR', 'private'),
(218, 4, 'Software Engineer, Web', 'software-engineer-web', 'monthly', 'medium', '', '', 'fixed', 1000, '<p style=\"font-weight: 400;\"><strong>ABOUT THIS POSITION</strong><strong><br /><br /></strong></p>\n<p style=\"font-weight: 400;\"><span style=\"font-weight: 400;\">Digital Extremes is seeking a</span><strong> mid to senior Software Engineer</strong><span style=\"font-weight: 400;\"> to join our Web Team. Do you have a passion for creating innovative and engaging web products? Do you day-dream about exciting ways to extend gaming experiences and communities to the web? Do you love building and extending websites and interactive experiences? Then this may be the job for you!</span><span style=\"font-weight: 400;\"><br /><br /></span></p>\n<p style=\"font-weight: 400;\"><strong>RESPONSIBILITIES</strong><strong><br /><br /></strong></p>\n<ul style=\"font-weight: 400;\">\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Build innovative web and online products to extend our game experiences and communities.</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Follow the team lead&rsquo;s architectural guidance and write quality code.</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Writes clean, performant code in one or more relevant languages (PHP, JavaScript, HTML/CSS, SQL).</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Comfortable with interacting with APIs, web client concepts like CORS, accessibility, cookies, local storage.</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Understands common design patterns, refactoring.</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Participate in team-wide code reviews.</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Collaborate with product managers and designers to deliver world-class, player-first web experiences.</span><span style=\"font-weight: 400;\"><br /><br /></span></li>\n</ul>\n<p style=\"font-weight: 400;\"><strong>REQUIREMENTS</strong><strong><br /><br /></strong></p>\n<ul style=\"font-weight: 400;\">\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">2 to 5 years of relevant experience</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">A team player with excellent communication and documentation skills and experience</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Comfortable with front-end and back-end web technologies, CMS, working with API layers, and open source technologies (Laravel, NodeJS, Apache, Redis, MySQL, MongoDB, etc.)</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Ability to adapt visual designs and layouts into web UIs using frameworks and CSS (React, Vue, Bootstrap)</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Fluency in one or more web programming languages (PHP, Javascript, Python, etc.)</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Can optimize page and image load time/bandwidth, adapt pages to multiple devices (desktop, mobile)</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Familiarity with source control tools and management (Git or similar)</span><span style=\"font-weight: 400;\"><br /><br /></span></li>\n</ul>\n<p style=\"font-weight: 400;\"><strong>PREFERRED EXTRAS</strong><strong><br /><br /></strong></p>\n<ul style=\"font-weight: 400;\">\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Bachelor&rsquo;s degree or higher in Software Engineering, Computer Science, or a related field</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Familiarity with graphic design and prototyping tools (such as Photoshop, Figma)</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Experience with web projects that complement or extend Software as a Service or Games as a Service products - e-commerce, community, publishing, etc.</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Previous experience in an agile environment with CI/CD</span><span style=\"font-weight: 400;\"><br /><br /></span></li>\n</ul>\n<p style=\"font-weight: 400;\"><strong>ABOUT DIGITAL EXTREMES</strong></p>\n<p style=\"font-weight: 400;\">&nbsp;</p>\n<p style=\"font-weight: 400;\"><span style=\"font-weight: 400;\">Founded in 1993 by James Schmalz, Digital Extremes ranks as one of the world\'s top independent video game development studios. Originating with the co-creation of Epic Games\' multi-million unit selling Unreal&reg; franchise including Unreal and Unreal Tournament, Digital Extremes went on to develop Dark Sector&reg;, BioShock&reg; for the PlayStation&reg;3, the BioShock 2 multiplayer campaign, and The Darkness&reg; II. The studio has reached its greatest critical and commercial success with the free-to-play action game, Warframe&reg;, boasting a global community of 50 million registered players on PC, PS4&trade;, Xbox One and Nintendo Switch&trade;.</span></p>\n<p style=\"font-weight: 400;\"><strong>&nbsp;</strong></p>\n<p style=\"font-weight: 400;\"><span style=\"font-weight: 400;\">For more information about Digital Extremes, visit </span><a href=\"http://www.digitalextremes.com/\"><span style=\"font-weight: 400;\">www.digitalextremes.com</span></a><span style=\"font-weight: 400;\">. To sign up for Warframe, visit</span><a href=\"http://www.warframe.com/\"> <span style=\"font-weight: 400;\">www.warframe.com</span></a><span style=\"font-weight: 400;\">.</span></p>\n<p style=\"font-weight: 400;\"><strong>&nbsp;</strong></p>\n<p style=\"font-weight: 400;\"><strong>WHY WORK AT DIGITAL EXTREMES</strong></p>\n<p style=\"font-weight: 400;\"><strong>&nbsp;</strong></p>\n<p style=\"font-weight: 400;\"><span style=\"font-weight: 400;\">Our culture is centered on providing great opportunities to our employees so that everyone feels they are making a meaningful impact. Developing new and existing talent is our long-term focus. We are honored that our work environment has been consistently recognized as one of \"Canada\'s Top 100 Employers\". We summon you to join our elite team!</span></p>\n<p style=\"font-weight: 400;\"><strong>&nbsp;</strong></p>\n<p style=\"font-weight: 400;\"><span style=\"font-weight: 400;\">The rewards of a career with Digital Extremes include:</span></p>\n<ul style=\"font-weight: 400;\">\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Competitive salary with bonus opportunities</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Excellent benefits and paid time off</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Matching RRSP plan</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Employee Assistance Program (EAP)</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Virtual access to Dialogue, our mental wellness and healthcare services app</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Professional development and career support</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Work-life balance fitness subsidies</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Be part of \"Giving Back\" through a multitude of fundraising venues at DE</span></li>\n<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\">Virtual events such as team building exercises, Games night, Live band performances, Adult and separate children\'s holiday and summer parties for global teams!</span></li>\n</ul>\n<p style=\"font-weight: 400;\"><strong>JOIN US</strong></p>\n<p style=\"font-weight: 400;\">&nbsp;</p>\n<p style=\"font-weight: 400;\"><span style=\"font-weight: 400;\">Digital Extremes is an equal opportunity employer committed to diversity and inclusion. We welcome and encourage applications from people with disabilities. Accommodations are available upon request for candidates taking part in all aspects of the recruitment process. We thank you for your interest, however, only those candidates selected for the next steps in the hiring process will be contacted.</span></p>', NULL, '', '', '', NULL, NULL, NULL, 'KXYE3RKG', '2023-06-05 14:01:07', '2023-06-05 14:02:15', '2023-06-30 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'USD', 'private'),
(219, 4, 'Website for insurance broker services', 'website-for-insurance-broker-services', 'monthly', 'medium', '', '', 'fixed', 1500, '<p class=\"PageProjectViewLogout-detail-paragraph\">Job Description:</p>\n<p>I currently have a Wordpress site that can be edited, or it can be built from scratch in order to be as successful as possible. The new site should be Search Engine Optimized (SEO) and work with traffic pushed from Instagram and Facebook initially as well as from other social media platforms in the future. I plan on using this site to attract and engage prospects and move them to clients. There will be a 3rd party site linked to the new site that will allow visitors to receive life insurance quotes from the top 6 life insurance carriers. The current site is [login to view URL] and all the products and services listed on the site will be available to visitors through consultation. Again, this site has to extremely viable from an analytics standpoint. Please visit the site to get a feel for the products. If the current site is redesigned, I need the theme changed (colors, pics, content, etc.) and the site must meet the robust SEO requirements noted above. thank you!</p>', NULL, '', '', '', NULL, NULL, NULL, 'NNQTLW1B', '2023-06-20 15:07:31', '2023-06-20 15:08:43', '2023-07-15 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'MXN', 'private'),
(220, 4, 'Senior Frontend Developer', 'senior-frontend-developer', 'monthly', 'medium', '', '', 'fixed', 15000, '<p>Are you a talented Frontend Engineer passionate about creating stunning, user-friendly interfaces? Are you ready to use your expertise in VueJS 3 and RESTful, API-driven web applications to revolutionize how quick-service and fast-casual restaurants operate? At Parse Pay, we have an exciting opportunity for a skilled professional like you.</p>\n<p>As a rapidly growing company, we\'re in search of a dynamic individual who is ready to grow with us, continuously sharpen their skills, and work collaboratively with a team of experts in the field. Our POS software is constantly evolving, and we\'re spearheading the development of innovative features to address industry demands while offering our customers the most intuitive and powerful solution for their businesses.</p>\n<h3><strong>Who we are:</strong></h3>\n<p>Parse Pay is more than just a POS company. We are an all-in-one, cloud-based platform committed to revolutionizing quick-service and fast-casual restaurants. By merging the most essential front-of-house, back-of-house, and customer engagement solutions into one user-friendly platform, we empower restaurateurs to streamline operations, simplify payments, increase sales, and deliver unforgettable guest experiences.</p>\n<p>We firmly believe that the POS system is the beating heart of every small business, and we play an essential role in their success. By providing our customers with a simple and intuitive interface filled with innovative features and robust functionality, we allow businesses to focus on what truly matters: their customers.</p>\n<p>If you\'re ready to be at the forefront of POS innovation, join us on this exciting journey. We\'re eagerly awaiting your application!</p>\n<h3>Responsibilities</h3>\n<ul>\n<li>\n<p>Lead the development of next-generation responsive web applications</p>\n</li>\n<li>\n<p>Develop clean, reusable code while building web applications with JavaScript, Vue.js, HTML, CSS, and others</p>\n</li>\n<li>\n<p>Implement responsive layouts for multiple responsive sizes</p>\n</li>\n<li>\n<p>Work cross-functionally with various Development, QA, and Integration teams</p>\n</li>\n<li>\n<p>Design, develop, test, and productize front-end components and services deployed on our continuous delivery platform</p>\n</li>\n</ul>\n<h3>About You</h3>\n<ul>\n<li>\n<p>Experience developing with modern, client-side Javascript (ES6 preferred)</p>\n</li>\n<li>\n<p>Strong knowledge of Vue.js (3), Vuex &amp; Pinta, and Vue Router.</p>\n</li>\n<li>\n<p>Proficiency in HTML and CSS/SASS, implementing responsive web design, and building complex layouts</p>\n</li>\n<li>\n<p>Strong knowledge of Web development patterns/tools/idioms and APIs</p>\n</li>\n<li>\n<p>Excellent written and verbal communication skills</p>\n</li>\n<li>\n<p>Strong capability of meeting project milestones and comfortable with agile development</p>\n</li>\n</ul>', NULL, '', '', '', NULL, NULL, NULL, 'QK1UU4WK', '2023-07-14 13:22:01', '2023-07-14 13:23:19', '2023-07-31 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'MXN', 'private'),
(221, 4, 'Test', 'test', 'three_month', 'medium', '', '', 'fixed', 1500, '<p>This is the test</p>', NULL, '', '', '', NULL, NULL, NULL, '52TL3C6U', '2023-07-21 09:16:07', '2023-07-21 09:17:47', '2023-07-27 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'USD', 'private'),
(222, 4, 'Web & App developer needed for the project x1', 'web-app-developer-needed-for-the-project', 'weekly', 'basic', '', '', 'fixed', 1500, '<p>Related stock market Project ready to go Job scope ready Small project Please make sure if u hv knowledge about stock market We need grab stock api Backend, Ui Design, Website, Android, iOS Flutter, laravel .. dfdsaf</p>', NULL, '', '', '', NULL, NULL, NULL, '5VI91N5U', '2023-09-12 10:15:20', '2023-11-02 11:42:09', '2023-09-14 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'USD', 'private'),
(223, 4, 'Mi Proyecto', 'mi-proyecto', 'three_month', 'medium', '', '', 'fixed', 4567890, '<p>Descripci&oacute;n</p>', NULL, '', '', '', NULL, NULL, NULL, '1OM5MBUW', '2023-11-01 13:19:14', '2023-11-01 13:21:35', '2023-11-23 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'MXN', 'private'),
(224, 4, 'Need a top level seller to create and build a unique Amazon affiliate site', 'need-a-top-level-seller-to-create-and-build-a-unique-amazon-affiliate-site', 'three_month', 'medium', '', '', 'fixed', 1235, '<p>Need a top level freelancer to build a unique Amazon 1-product affiliate site. Will use the niche Samsung galaxy flip 5 phone. Want something different from all the other look alike Amazon affiliate sites. Get back to me ASAP plan to start immediate. Freelancer has to show me a mock-up first before we start.</p>', NULL, '', '', '', NULL, NULL, NULL, 'RXHX7AQQ', '2023-11-02 11:48:09', '2023-11-02 11:52:00', '2023-11-15 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'MXN', 'private'),
(225, 4, 'PRueba', 'prueba', 'more_than_six', 'medium', '', '', 'fixed', 123456789, '<p>Descripci&oacute;n del proyecto</p>', NULL, '', '', '', NULL, NULL, NULL, 'E8SWZCMQ', '2023-11-05 00:04:54', '2024-02-13 20:05:43', '2023-11-23 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'EUR', 'public'),
(226, 4, 'Python developer', 'python-developer', 'monthly', 'medium', '', '', 'fixed', 5600, '<p>This is a test</p>', NULL, '', '', '', NULL, NULL, NULL, 'LE5Y1XKC', '2024-03-23 17:05:32', '2024-03-23 17:06:22', NULL, 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'draft', 'USD', 'private'),
(227, 4, 'Py one developer', 'py-one-developer', '', '', '', '', 'fixed', NULL, '<p>Thi si sa test</p>', NULL, '', '', '', NULL, NULL, NULL, 'HHT88RLN', '2024-03-23 17:08:59', '2024-03-23 17:09:07', NULL, 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'draft', NULL, 'private'),
(228, 4, 'Test Developer', 'test-developer', 'monthly', 'medium', '', '', 'fixed', 586954, '<p>This is a test</p>', NULL, '', '', '', NULL, NULL, NULL, 'AQIFELF0', '2024-03-23 17:25:54', '2024-03-23 17:26:24', NULL, 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'draft', 'USD', 'private'),
(229, 4, 'Test One developer', 'test-one-developer', 'weekly', 'expensive', '', '', 'fixed', 1522, '<p>This is a test</p>', NULL, '', '', '', NULL, NULL, NULL, '732AR3R8', '2024-03-23 17:31:03', '2024-03-23 17:32:03', '2024-03-30 00:00:00', 'no', 'date', NULL, NULL, NULL, NULL, 'fixed', 'posted', 'EUR', 'private');

-- --------------------------------------------------------

--
-- Table structure for table `job_chats`
--

CREATE TABLE `job_chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_chats`
--

INSERT INTO `job_chats` (`id`, `job_id`, `chat_id`, `created_at`, `updated_at`) VALUES
(3, 204, 1, '2022-08-11 14:49:15', '2022-08-11 14:49:15'),
(4, 219, 57, '2023-06-20 15:17:06', '2023-06-20 15:17:06'),
(5, 219, 8, '2023-06-23 10:24:03', '2023-06-23 10:24:03'),
(6, 222, 1, '2023-11-01 13:27:52', '2023-11-01 13:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `job_files`
--

CREATE TABLE `job_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `size` varchar(191) NOT NULL,
  `use` enum('normal','contract') NOT NULL DEFAULT 'normal',
  `status` enum('new','signed','unsigned','modified','accepted','waiting') NOT NULL DEFAULT 'new',
  `user_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_id` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_files`
--

INSERT INTO `job_files` (`id`, `name`, `size`, `use`, `status`, `user_id`, `job_id`, `created_at`, `updated_at`, `file_id`) VALUES
(15, '2 - CSS3.docx', '20.62 KB', 'normal', 'new', 4, 219, '2023-06-21 02:08:12', '2023-06-21 02:08:12', '2 - CSS3_219_1687331292.docx'),
(16, '1 - OOP.docx', '103.89 KB', 'normal', 'new', 4, 219, '2023-06-21 02:08:22', '2023-06-21 02:08:22', '1 - OOP_219_1687331302.docx'),
(17, '3 - HTML5.docx', '19.89 KB', 'contract', 'new', 4, 219, '2023-06-21 02:08:37', '2023-06-21 02:08:37', '3 - HTML5_219_1687331317.docx'),
(18, 'organize.png', '5.97 KB', 'normal', 'new', 4, 203, '2023-06-23 10:33:44', '2023-06-23 10:33:44', 'organize_203_1687534424.png'),
(19, 'One test.pdf', '142.79 KB', 'normal', 'new', 4, 220, '2023-07-14 13:26:17', '2023-07-14 13:26:17', 'One test_220_1689359177.pdf'),
(20, 'One test.pdf', '142.79 KB', 'contract', 'new', 4, 220, '2023-07-14 13:27:58', '2023-07-14 13:27:58', 'One test_220_1689359278.pdf'),
(22, 'REFERRAL POLICY.pdf', '842.47 KB', 'normal', 'new', 4, 225, '2023-11-05 00:09:33', '2023-11-05 00:09:33', 'REFERRAL POLICY_225_1699164573.pdf'),
(23, 'test.html', '3.21 KB', 'contract', 'new', 4, 229, '2024-07-08 11:44:19', '2024-07-08 11:44:19', 'test_229_1720460659.html');

-- --------------------------------------------------------

--
-- Table structure for table `job_invites`
--

CREATE TABLE `job_invites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_invites`
--

INSERT INTO `job_invites` (`id`, `job_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 203, 21, '2022-11-05 08:53:46', '2022-11-05 08:53:46'),
(2, 203, 24, '2022-11-05 09:04:31', '2022-11-05 09:04:31'),
(3, 203, 22, '2022-11-05 11:26:25', '2022-11-05 11:26:25'),
(4, 210, 21, '2023-02-18 14:32:04', '2023-02-18 14:32:04'),
(5, 210, 24, '2023-02-18 14:34:44', '2023-02-18 14:34:44'),
(6, 213, 21, '2023-03-13 13:36:49', '2023-03-13 13:36:49'),
(7, 213, 24, '2023-03-13 13:37:01', '2023-03-13 13:37:01'),
(8, 213, 23, '2023-03-13 13:37:08', '2023-03-13 13:37:08'),
(9, 213, 22, '2023-03-23 12:06:57', '2023-03-23 12:06:57'),
(10, 214, 21, '2023-05-09 15:17:48', '2023-05-09 15:17:48'),
(11, 214, 24, '2023-05-09 15:17:58', '2023-05-09 15:17:58'),
(12, 215, 21, '2023-05-24 12:54:58', '2023-05-24 12:54:58'),
(13, 215, 22, '2023-05-24 12:55:04', '2023-05-24 12:55:04'),
(14, 218, 23, '2023-06-05 14:06:35', '2023-06-05 14:06:35'),
(15, 218, 22, '2023-06-05 14:06:43', '2023-06-05 14:06:43'),
(16, 217, 23, '2023-06-19 16:51:03', '2023-06-19 16:51:03'),
(17, 217, 22, '2023-06-19 16:54:21', '2023-06-19 16:54:21'),
(18, 216, 23, '2023-06-20 13:06:20', '2023-06-20 13:06:20'),
(19, 216, 22, '2023-06-20 13:10:13', '2023-06-20 13:10:13'),
(20, 219, 23, '2023-06-20 15:10:03', '2023-06-20 15:10:03'),
(21, 219, 22, '2023-06-20 15:10:10', '2023-06-20 15:10:10'),
(22, 221, 21, '2023-07-21 10:24:51', '2023-07-21 10:24:51'),
(23, 221, 22, '2023-07-21 10:24:57', '2023-07-21 10:24:57'),
(24, 220, 21, '2023-08-02 21:48:31', '2023-08-02 21:48:31'),
(25, 222, 21, '2023-09-12 10:18:03', '2023-09-12 10:18:03'),
(26, 222, 24, '2023-09-12 10:18:10', '2023-09-12 10:18:10'),
(27, 222, 23, '2023-09-18 12:38:23', '2023-09-18 12:38:23'),
(28, 222, 22, '2023-09-18 12:38:55', '2023-09-18 12:38:55'),
(29, 221, 24, '2023-10-04 12:26:01', '2023-10-04 12:26:01'),
(30, 223, 21, '2023-11-01 13:24:12', '2023-11-01 13:24:12'),
(31, 223, 23, '2023-11-01 13:24:23', '2023-11-01 13:24:23'),
(32, 225, 21, '2023-11-05 00:10:19', '2023-11-05 00:10:19'),
(33, 225, 24, '2023-11-05 00:10:24', '2023-11-05 00:10:24'),
(34, 225, 23, '2024-02-13 20:06:07', '2024-02-13 20:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `job_notes`
--

CREATE TABLE `job_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `star` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `color` varchar(191) NOT NULL DEFAULT '#b5f0de',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_notes`
--

INSERT INTO `job_notes` (`id`, `title`, `description`, `star`, `color`, `created_at`, `updated_at`, `user_id`, `job_id`) VALUES
(11, 'No olvidar añadir al equipo a Juan Perez del lado del proveedor', 'Por fa!', 0, 'note-bg-green', '2023-11-01 20:09:11', '2023-11-01 20:09:11', 4, 222);

-- --------------------------------------------------------

--
-- Table structure for table `job_quizzes`
--

CREATE TABLE `job_quizzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_skill`
--

CREATE TABLE `job_skill` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_skill`
--

INSERT INTO `job_skill` (`id`, `job_id`, `skill_id`, `created_at`, `updated_at`) VALUES
(306, 225, 19, NULL, NULL),
(307, 225, 16, NULL, NULL),
(308, 225, 12, NULL, NULL),
(309, 225, 7, NULL, NULL),
(310, 229, 1, NULL, NULL),
(311, 229, 12, NULL, NULL),
(313, 226, 16, NULL, NULL),
(314, 204, 13, NULL, NULL),
(315, 204, 1, NULL, NULL),
(316, 204, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_tickets`
--

CREATE TABLE `job_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `sent_to` int(10) UNSIGNED NOT NULL,
  `from` int(10) UNSIGNED NOT NULL,
  `priority` enum('normal','medium','high','critical') NOT NULL DEFAULT 'normal',
  `status` enum('open','waiting','hold','close') NOT NULL DEFAULT 'open',
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_id` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `langables`
--

CREATE TABLE `langables` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `langable_id` int(11) NOT NULL,
  `langable_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `langables`
--

INSERT INTO `langables` (`id`, `language_id`, `langable_id`, `langable_type`, `created_at`, `updated_at`) VALUES
(5, 5, 4, 'App\\User', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(6, 6, 4, 'App\\User', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(25, 23, 21, 'App\\User', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(26, 24, 22, 'App\\User', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(27, 23, 23, 'App\\User', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(28, 24, 24, 'App\\User', '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Abkhazian', 'ab', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 'Afar', 'aa', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 'Arabic', 'arabic', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(4, 'Afrikaans', 'af', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(5, 'Akan', 'ak', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(6, 'Bambara', 'bm', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(7, 'Bengali', 'bn', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(8, 'Bulgarian', 'bg', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(9, 'Chamorro', 'ch', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(10, 'Chinese', 'zh', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(11, 'Danish', 'da', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(12, 'Dzongkha', 'dz', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(13, 'English', 'en', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(14, 'Esperanto', 'eo', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(15, 'Faroese', 'fo', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(16, 'Fulah', 'ff', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(17, 'Galician', 'gl', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(18, 'Hausa', 'ha', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(19, 'Hindi', 'hi', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(20, 'Irish', 'ga', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(21, 'Indonesian', 'id', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(22, 'Japanese', 'ja', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(23, 'Kannada', 'kn', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(24, 'Kanuri', 'kr', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(25, 'Spanish', 'spanish', 'es', '2022-01-10 23:47:51', '2022-01-10 23:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `live_contests`
--

CREATE TABLE `live_contests` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `show_participant` enum('yes','no') NOT NULL DEFAULT 'no',
  `show_participant_to_provider` varchar(255) NOT NULL DEFAULT 'no',
  `show_participant_offer_to_provider` varchar(255) NOT NULL DEFAULT 'no',
  `automatic_offer` enum('yes','no') NOT NULL DEFAULT 'no',
  `automatic_offer_choice` enum('percentage','amount') DEFAULT NULL,
  `automatic_offer_value` int(10) UNSIGNED DEFAULT NULL,
  `awarded_allowed` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time_limit` int(10) UNSIGNED NOT NULL,
  `status` enum('open','close') NOT NULL DEFAULT 'open',
  `flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `live_contests`
--

INSERT INTO `live_contests` (`id`, `job_id`, `start_date`, `end_date`, `show_participant`, `show_participant_to_provider`, `show_participant_offer_to_provider`, `automatic_offer`, `automatic_offer_choice`, `automatic_offer_value`, `awarded_allowed`, `created_at`, `updated_at`, `time_limit`, `status`, `flag`) VALUES
(18, 203, '2022-12-08 10:58:00', '2022-12-10 11:58:00', 'yes', 'no', 'yes', 'no', NULL, NULL, 1, '2022-12-07 23:29:04', '2022-12-13 14:35:34', 10, 'close', 0),
(19, 202, '2022-12-15 02:59:00', '2022-12-15 03:59:00', 'yes', 'yes', 'yes', 'no', NULL, NULL, 1, '2022-12-13 15:28:57', '2022-12-13 15:28:57', 10, 'open', 0),
(20, 220, '2023-09-06 23:18:00', '2023-09-07 12:18:00', 'yes', 'no', 'no', 'yes', 'percentage', 10, 2, '2023-09-04 12:51:51', '2024-03-19 05:05:06', 10, 'close', 0),
(21, 222, '2023-09-18 11:17:00', '2023-09-18 12:17:00', 'yes', 'no', 'no', 'yes', 'percentage', 10, 1, '2023-09-18 12:46:29', '2023-10-04 12:23:13', 5, 'close', 0),
(22, 221, '2023-10-04 10:53:00', '2023-10-04 11:53:00', 'yes', 'no', 'no', 'yes', NULL, 10, 2, '2023-10-04 12:25:02', '2023-10-04 12:34:21', 5, 'close', 0);

-- --------------------------------------------------------

--
-- Table structure for table `live_contest_participants`
--

CREATE TABLE `live_contest_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `live_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `live_contest_participants`
--

INSERT INTO `live_contest_participants` (`id`, `live_id`, `user_id`, `created_at`, `updated_at`, `status`) VALUES
(25, 18, 21, '2022-12-07 23:33:30', '2022-12-07 23:33:30', 'no'),
(26, 18, 22, '2022-12-07 23:33:36', '2022-12-07 23:33:36', 'no'),
(27, 18, 23, '2022-12-07 23:33:42', '2022-12-07 23:33:42', 'no'),
(28, 18, 24, '2022-12-07 23:33:50', '2022-12-07 23:33:50', 'no'),
(29, 20, 21, '2023-09-04 12:52:18', '2023-09-04 12:52:18', 'no'),
(30, 20, 22, '2023-09-04 12:52:23', '2023-09-04 12:52:23', 'no'),
(31, 21, 21, '2023-09-18 12:47:46', '2023-09-18 12:53:20', 'no'),
(32, 21, 23, '2023-09-18 12:47:56', '2023-09-18 12:50:23', 'yes'),
(33, 21, 22, '2023-09-18 12:48:01', '2023-09-18 12:53:14', 'no'),
(34, 22, 22, '2023-10-04 12:26:31', '2023-10-04 12:28:21', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `flag` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `title`, `slug`, `parent`, `flag`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Canada', 'canada', 0, 'can.png', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 'England', 'england', 0, 'eng.png', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(4, 'India', 'india', 0, 'in.png', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(5, 'Turkey', 'turkey', 0, 'tu.png', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(6, 'United Emirates', 'united-emirates', 0, 'ue.png', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(7, 'United Kingdom', 'united-kingdom', 0, 'uk.png', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(8, 'United States', 'united-states', 0, 'us.png', NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL,
  `marks` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `report` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `receiver_id`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 21, 'Donec placerat, massa eu tincidunt volutpat.', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 21, 4, 'Donec placerat, massa eu tincidunt volutpat, lectus nibh commodo nisl, quis fermentum neque quam et erat. In vel dictum dui. In hac habitasse platea dictumst. Suspendisse vel libero libero.', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 4, 21, 'Donec placerat, massa eu tincidunt volutpat, lectus nibh commodo nisl, quis fermentum neque quam et erat. In vel dictum dui. In hac habitasse platea dictumst. Suspendisse vel libero libero.Donec placerat, massa eu tincidunt volutpat, lectus nibh commodo nisl, quis fermentum neque quam et erat. In vel dictum dui. In hac habitasse platea dictumst. Suspendisse vel libero libero.', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(4, 4, 21, 'You are hired for Need helping hand in PHP project Project', 1, '2021-04-01 07:50:54', '2021-04-01 07:50:54'),
(8, 4, 23, 'You are hired for Need helping hand in PHP project x Project', 1, '2021-07-25 14:05:33', '2021-07-25 14:05:33'),
(23, 4, 21, 'Cooper White purchased your service I Will Develop Ios And Android Mobile App Using React Native', 1, '2021-11-19 15:13:23', '2021-11-19 15:13:23'),
(24, 4, 21, 'Cooper White purchased your service I Will Provide Pro SEO Report, Competitor Website Audit And Analysis', 1, '2021-11-21 14:54:12', '2021-11-21 14:54:12'),
(56, 4, 21, 'You are hired for PHP Codeigniter Expert Project', 1, '2022-08-13 13:04:56', '2022-08-13 13:04:56'),
(57, 4, 22, 'Hi', 1, '2023-06-20 15:17:06', '2023-06-20 15:17:06'),
(58, 4, 22, 'hello', 1, '2023-07-03 11:40:40', '2023-07-03 11:40:40'),
(59, 4, 22, 'test', 1, '2023-07-03 11:49:33', '2023-07-03 11:49:33'),
(60, 4, 22, 'tester', 1, '2023-07-03 12:05:56', '2023-07-03 12:05:56'),
(61, 4, 22, 'tester', 1, '2023-07-03 12:06:23', '2023-07-03 12:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE `metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(191) NOT NULL,
  `meta_value` text DEFAULT NULL,
  `metable_type` varchar(191) NOT NULL,
  `metable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metas`
--

INSERT INTO `metas` (`id`, `meta_key`, `meta_value`, `metable_type`, `metable_id`, `created_at`, `updated_at`) VALUES
(56, 'content0', 'a:4:{s:11:\"description\";s:1475:\"<div class=\'wt-greetingcontent\'>\r\n        <div class=\'wt-sectionhead\'>\r\n        <div class=\'wt-sectiontitle\'>\r\n        <h2>Greetings &amp; Welcome</h2>\r\n        <span>Start Today For a Great Future</span></div>\r\n        <div class=\'wt-description\'>\r\n        <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce anim id est laborumed.</p>\r\n        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa officia deserunt mollit anim id est laborumed perspiciatis unde omnis isteatus error aluptatem accusantium doloremque laudantium.</p>\r\n        </div>\r\n        </div>\r\n        <div id=\'wt-statistics\' class=\'wt-statistics\'>\r\n        <div class=\'wt-statisticcontent wt-countercolor1\'>\r\n        <h3 data-from=\'0\' data-to=\'1500\' data-speed=\'8000\' data-refresh-interval=\'50\'>1,500</h3>\r\n        <em>k</em>\r\n        <h4>Active Projects</h4>\r\n        </div>\r\n        <div class=\'wt-statisticcontent wt-countercolor2\'>\r\n        <h3 data-from=\'0\' data-to=\'99\' data-speed=\'8000\' data-refresh-interval=\'5.9\'>99</h3>\r\n        <em>%</em>\r\n        <h4>Great Feedback</h4>\r\n        </div>\r\n        <div class=\'wt-statisticcontent wt-countercolor3\'>\r\n        <h3 data-from=\'0\' data-to=\'5000\' data-speed=\'8000\' data-refresh-interval=\'100\'>5,000</h3>\r\n        <em>k</em>\r\n        <h4>Active Providers</h4>\r\n        </div>\r\n        </div>\r\n        </div>\";s:12:\"sectionColor\";s:7:\"#f7f7f7\";s:2:\"id\";i:4;s:11:\"parentIndex\";i:0;}', 'App\\Page', 2, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(57, 'title', '1', 'App\\Page', 2, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(58, 'cat1', 'a:6:{s:5:\"title\";s:18:\"Explore Categories\";s:8:\"subtitle\";s:26:\"Professional by categories\";s:11:\"description\";s:135:\"<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget leo rutrum, ullamcorper dolor eu, faucibus massa.</span></p>\";s:2:\"id\";i:2;s:11:\"parentIndex\";i:1;s:12:\"sectionColor\";s:7:\"#ffffff\";}', 'App\\Page', 5, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(59, 'welcome_sections3', 'a:11:{s:18:\"welcome_background\";s:32:\"1579153406-1557484284-banner.jpg\";s:11:\"first_title\";s:16:\"Start As Company\";s:9:\"first_url\";s:1:\"#\";s:16:\"first_url_button\";s:8:\"JOIN NOW\";s:17:\"first_description\";s:172:\"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum.\";s:12:\"second_title\";s:19:\"Start As Provider\";s:10:\"second_url\";s:1:\"#\";s:17:\"second_url_button\";s:8:\"JOIN NOW\";s:18:\"second_description\";s:172:\"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum.\";s:2:\"id\";i:4;s:11:\"parentIndex\";i:3;}', 'App\\Page', 5, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(60, 'sliders0', 'a:17:{s:5:\"style\";s:6:\"style1\";s:12:\"slider_image\";a:1:{i:0;s:14:\"banner-img.jpg\";}s:18:\"inner_banner_image\";s:26:\"1579153511-img-01inner.png\";s:16:\"floating_image01\";s:21:\"1579153511-img-02.png\";s:16:\"floating_image02\";s:21:\"1579153511-img-03.png\";s:5:\"title\";s:23:\"Hire expert providers\";s:8:\"subtitle\";s:19:\"for any job, Online\";s:11:\"description\";s:108:\"<p>Consectetur adipisicing elit sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim.</p>\";s:10:\"video_link\";s:43:\"https://www.youtube.com/watch?v=J37W6DjqT3Q\";s:11:\"video_title\";s:17:\"See For Yourself!\";s:17:\"video_description\";s:43:\"How it works & experience the ultimate joy.\";s:2:\"id\";i:1;s:11:\"parentIndex\";i:0;s:10:\"titleColor\";s:7:\"#ffffff\";s:13:\"subtitleColor\";s:7:\"#ffffff\";s:12:\"taglineColor\";s:7:\"#ffffff\";s:12:\"sectionColor\";s:7:\"#d1d1d1\";}', 'App\\Page', 5, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(61, 'app_section4', 'a:13:{s:5:\"title\";s:20:\"Limitless Experience\";s:8:\"subtitle\";s:30:\"Roam Around With Your Business\";s:11:\"description\";s:460:\"<p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum dolore eu fugiat nulla pariatur lokaim urianewce.</p>\r\n    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget leo rutrum, ullamcorper dolor eu, faucibus massa. Etiam placerat mattis pellentesque. Mauris eu mollis arcu. Nullam tincidunt auctor mattis. Donec pretium porta est ut ullamcorper.&nbsp;</p>\";s:11:\"andriod_url\";s:1:\"#\";s:7:\"ios_url\";s:1:\"#\";s:5:\"style\";s:6:\"style1\";s:16:\"background_image\";s:0:\"\";s:9:\"app_image\";s:47:\"1579153406-1558518016-1557484284-mobile-img.png\";s:2:\"id\";i:5;s:11:\"parentIndex\";i:4;s:12:\"sectionColor\";s:7:\"#ffffff\";s:9:\"ios_image\";s:21:\"1590762784-img-02.png\";s:13:\"android_image\";s:21:\"1590762784-img-01.png\";}', 'App\\Page', 5, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(62, 'title', '0', 'App\\Page', 5, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(63, 'providers3', 'a:6:{s:5:\"title\";s:13:\"Top Providers\";s:8:\"subtitle\";s:24:\"Start With Great Peoples\";s:11:\"description\";s:135:\"<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget leo rutrum, ullamcorper dolor eu, faucibus massa.</span></p>\";s:2:\"id\";i:4;s:11:\"parentIndex\";i:3;s:12:\"sectionColor\";s:7:\"#ffffff\";}', 'App\\Page', 6, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(64, 'services1', 'a:6:{s:5:\"title\";s:20:\"Explore Top Services\";s:8:\"subtitle\";s:27:\"Picked Top Serviced For You\";s:11:\"description\";s:259:\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget leo rutrum, ullamcorper dolor eu, faucibus massa. Etiam placerat mattis pellentesque. Mauris eu mollis arcu. Nullam tincidunt auctor mattis. Donec pretium porta est ut ullamcorper.&nbsp;</p>\";s:2:\"id\";i:6;s:11:\"parentIndex\";i:1;s:12:\"sectionColor\";s:7:\"#ffffff\";}', 'App\\Page', 6, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(65, 'work_tabs2', 'a:15:{s:16:\"background_image\";s:21:\"1579165004-img-05.jpg\";s:14:\"first_tab_icon\";s:21:\"1579165004-img-01.png\";s:15:\"second_tab_icon\";s:21:\"1579165004-img-02.png\";s:14:\"third_tab_icon\";s:21:\"1579165004-img-03.png\";s:5:\"title\";s:12:\"How It Works\";s:8:\"subtitle\";s:15:\"We Made It Easy\";s:11:\"description\";s:163:\"<p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>\";s:15:\"first_tab_title\";s:12:\"Professional\";s:18:\"first_tab_subtitle\";s:18:\"Search Best Online\";s:16:\"second_tab_title\";s:11:\"Appointment\";s:19:\"second_tab_subtitle\";s:11:\"Get Instant\";s:15:\"third_tab_title\";s:8:\"Feedback\";s:18:\"third_tab_subtitle\";s:10:\"Leave Your\";s:2:\"id\";i:3;s:11:\"parentIndex\";i:2;}', 'App\\Page', 6, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(66, 'sliders0', 'a:14:{s:5:\"style\";s:6:\"style2\";s:12:\"slider_image\";a:4:{i:0;s:21:\"1579164321-img-01.jpg\";i:1;s:21:\"1579164321-img-02.jpg\";i:2;s:21:\"1579164321-img-03.jpg\";i:3;s:21:\"1579164321-img-04.jpg\";}s:5:\"title\";s:23:\"Hire expert providers\";s:8:\"subtitle\";s:19:\"for any job, Online\";s:11:\"description\";s:160:\"<p>Consectetur adipisicing elition sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim adion minim veniam quistan neostrud exercitation.</p>\";s:10:\"video_link\";s:28:\"https://youtu.be/B-ph2g5o2K4\";s:11:\"video_title\";s:17:\"See For Yourself!\";s:17:\"video_description\";s:43:\"How it works & experience the ultimate joy.\";s:2:\"id\";i:1;s:11:\"parentIndex\";i:0;s:10:\"titleColor\";s:7:\"#ffffff\";s:13:\"subtitleColor\";s:7:\"#ffffff\";s:12:\"taglineColor\";s:7:\"#ffffff\";s:12:\"sectionColor\";s:7:\"#afafaf\";}', 'App\\Page', 6, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(67, 'app_section4', 'a:13:{s:5:\"title\";s:19:\"Introducing All New\";s:8:\"subtitle\";s:21:\"Our Native Mobile App\";s:11:\"description\";s:163:\"<p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>\";s:11:\"andriod_url\";s:1:\"#\";s:7:\"ios_url\";s:1:\"#\";s:5:\"style\";s:6:\"style2\";s:16:\"background_image\";s:21:\"1579165080-img-06.jpg\";s:9:\"app_image\";s:21:\"1579165080-img-05.png\";s:2:\"id\";i:5;s:11:\"parentIndex\";i:4;s:12:\"sectionColor\";s:7:\"#ffffff\";s:9:\"ios_image\";s:21:\"1590762784-img-02.png\";s:13:\"android_image\";s:21:\"1590762784-img-01.png\";}', 'App\\Page', 6, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(68, 'articles5', 'a:6:{s:5:\"title\";s:15:\"Latest Articles\";s:8:\"subtitle\";s:26:\"Stay Updated With Our News\";s:11:\"description\";s:164:\" <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>\";s:2:\"id\";i:10;s:11:\"parentIndex\";i:5;s:12:\"sectionColor\";s:7:\"#ffffff\";}', 'App\\Page', 6, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(69, 'title', '0', 'App\\Page', 6, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(70, 'providers3', 'a:6:{s:5:\"title\";s:13:\"Top Providers\";s:8:\"subtitle\";s:24:\"Start With Great Peoples\";s:11:\"description\";s:135:\"<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget leo rutrum, ullamcorper dolor eu, faucibus massa.</span></p>\";s:2:\"id\";i:4;s:11:\"parentIndex\";i:2;s:12:\"sectionColor\";s:7:\"#ffffff\";}', 'App\\Page', 7, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(71, 'services1', 'a:6:{s:5:\"title\";s:20:\"Explore Top Services\";s:8:\"subtitle\";s:27:\"Picked Top Serviced For You\";s:11:\"description\";s:259:\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget leo rutrum, ullamcorper dolor eu, faucibus massa. Etiam placerat mattis pellentesque. Mauris eu mollis arcu. Nullam tincidunt auctor mattis. Donec pretium porta est ut ullamcorper.&nbsp;</p>\";s:2:\"id\";i:5;s:11:\"parentIndex\";i:1;s:12:\"sectionColor\";s:7:\"#f7f7f7\";}', 'App\\Page', 7, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(72, 'work_videos2', 'a:8:{s:5:\"title\";s:13:\" How It Works\";s:8:\"subtitle\";s:15:\"We Made It Easy\";s:11:\"description\";s:163:\"<p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>\";s:2:\"id\";i:3;s:11:\"parentIndex\";i:3;s:5:\"video\";s:28:\"https://youtu.be/B-ph2g5o2K4\";s:12:\"video_poster\";s:21:\"1579689887-img-01.png\";s:12:\"sectionColor\";s:7:\"#f7f7f7\";}', 'App\\Page', 7, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(73, 'sliders0', 'a:16:{s:5:\"style\";s:6:\"style3\";s:12:\"slider_image\";a:2:{i:0;s:21:\"1579166079-img-04.jpg\";i:1;s:21:\"1579166079-img-05.jpg\";}s:5:\"title\";s:23:\"Buy expert’s Services\";s:8:\"subtitle\";s:19:\"for any job, Online\";s:11:\"description\";s:160:\"<p>Consectetur adipisicing elition sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim adion minim veniam quistan neostrud exercitation.</p>\";s:10:\"video_link\";s:28:\"https://youtu.be/B-ph2g5o2K4\";s:11:\"video_title\";s:17:\"See For Yourself!\";s:17:\"video_description\";s:43:\"How it works & experience the ultimate joy.\";s:2:\"id\";i:1;s:11:\"parentIndex\";i:0;s:10:\"titleColor\";s:7:\"#005178\";s:13:\"subtitleColor\";s:7:\"#323232\";s:12:\"taglineColor\";s:7:\"#000000\";s:12:\"sectionColor\";s:7:\"#ffffff\";s:16:\"floating_image01\";s:32:\"1590064417-1579166079-img-05.png\";s:16:\"floating_image02\";s:21:\"1590064417-img-06.png\";}', 'App\\Page', 7, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(74, 'app_section4', 'a:13:{s:5:\"title\";s:19:\"Introducing All New\";s:8:\"subtitle\";s:21:\"Our Native Mobile App\";s:11:\"description\";s:163:\"<p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>\";s:11:\"andriod_url\";s:1:\"#\";s:7:\"ios_url\";s:1:\"#\";s:5:\"style\";s:6:\"style2\";s:16:\"background_image\";s:21:\"1579591173-img-06.jpg\";s:9:\"app_image\";s:32:\"1579520549-1579165080-img-05.png\";s:2:\"id\";i:7;s:11:\"parentIndex\";i:4;s:12:\"sectionColor\";s:7:\"#ffffff\";s:9:\"ios_image\";s:21:\"1590762784-img-02.png\";s:13:\"android_image\";s:21:\"1590762784-img-01.png\";}', 'App\\Page', 7, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(75, 'articles5', 'a:6:{s:5:\"title\";s:15:\"Latest Articles\";s:8:\"subtitle\";s:26:\"Stay Updated With Our News\";s:11:\"description\";s:164:\" <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>\";s:2:\"id\";i:6;s:11:\"parentIndex\";i:5;s:12:\"sectionColor\";s:7:\"#ffffff\";}', 'App\\Page', 7, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(76, 'title', '0', 'App\\Page', 7, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(77, 'app_section3', 'a:21:{s:5:\"title\";s:8:\"Download\";s:8:\"titleTwo\";s:18:\"Mobile Application\";s:8:\"subtitle\";s:22:\"Double Your Experience\";s:11:\"description\";s:698:\"<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore ete dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><ul class=\"wt-mobapp-listing\"><li><span>Duis aute irure dolor in reprehenderit</span></li><li><span>Voluptate velit esse cillum dolore</span></li><li><span>Fugiat nulla pariatur. Excepteur sint occaecat</span></li><li><span>Cupidatat non proident sunt in culpa</span></li><li><span>Qui officia deserunt mollit anim</span></li></ul><div class=\"wt-description\"><p>Laborum ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p></div>\";s:11:\"andriod_url\";s:1:\"#\";s:7:\"ios_url\";s:1:\"#\";s:16:\"background_image\";s:21:\"1588069315-img-05.png\";s:9:\"app_image\";s:21:\"1588069315-mobile.png\";s:5:\"style\";s:6:\"style3\";s:12:\"sectionColor\";s:7:\"#ffffff\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#f62b84\";s:13:\"subtitleColor\";s:7:\"#3d4461\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:2:\"80\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:4;s:11:\"parentIndex\";i:3;s:9:\"ios_image\";s:21:\"1590763420-img-02.png\";s:13:\"android_image\";s:21:\"1590763420-img-01.png\";}', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(78, 'categoriesSecondVersion1', 'a:16:{s:5:\"title\";s:8:\"Trending\";s:8:\"subtitle\";s:14:\"Top Categories\";s:11:\"description\";s:75:\"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina\";s:12:\"sectionColor\";s:7:\"#ffffff\";s:13:\"backgroundImg\";s:21:\"1588069315-img-04.png\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"subtitleColor\";s:7:\"#f62b84\";s:13:\"showAllBtnUrl\";s:1:\"#\";s:12:\"lastTabTitle\";s:18:\"Explore Categories\";s:11:\"lastTabDesc\";s:59:\"Consectetur adipisicing elit deius temor incididunt utnenbo\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:2:\"80\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:2;s:11:\"parentIndex\";i:1;}', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(79, 'providersSecondVersion4', 'a:13:{s:5:\"title\";s:3:\"Top\";s:8:\"titleTwo\";s:11:\"Providers\";s:11:\"description\";s:83:\"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita\";s:13:\"backgroundImg\";s:21:\"1588069315-img-03.png\";s:12:\"sectionColor\";s:7:\"#f5f7fa\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#f62b84\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:2:\"80\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";s:3:\"108\";s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:5;s:11:\"parentIndex\";i:4;}', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(80, 'jobs2', 'a:13:{s:5:\"title\";s:6:\"Latest\";s:8:\"titleTwo\";s:12:\"Jobs Opening\";s:11:\"description\";s:83:\"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita\";s:13:\"backgroundImg\";s:21:\"1588069316-img-02.png\";s:12:\"sectionColor\";s:7:\"#f5f7fa\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#f62b84\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:2:\"80\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";s:3:\"108\";s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:3;s:11:\"parentIndex\";i:2;}', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(81, 'packages5', 'a:13:{s:5:\"title\";s:3:\"Top\";s:8:\"titleTwo\";s:8:\"Packages\";s:11:\"description\";s:83:\"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita\";s:12:\"sectionColor\";s:7:\"#ffffff\";s:13:\"backgroundImg\";s:21:\"1588652284-img-04.png\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#f62b84\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:3:\"100\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";s:1:\"0\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:6;s:11:\"parentIndex\";i:5;}', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(82, 'bannerFirstVersion0', 'a:17:{s:5:\"title\";s:23:\"Most Powerful Directory\";s:8:\"subtitle\";s:31:\"Available for Service Providers\";s:10:\"videoTitle\";s:17:\"See For Yourself!\";s:9:\"videoDesc\";s:43:\"How it works & experience the ultimate joy.\";s:8:\"videoUrl\";s:1:\"#\";s:13:\"backgroundImg\";s:21:\"1588069316-img-01.jpg\";s:8:\"frontImg\";s:32:\"1588069316-1587028317-img-01.png\";s:14:\"showSearchForm\";b:1;s:12:\"sectionColor\";s:7:\"#ffffff\";s:10:\"titleColor\";s:7:\"#ffffff\";s:13:\"subtitleColor\";s:7:\"#ffffff\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"96\";s:5:\"right\";i:0;s:6:\"bottom\";s:2:\"96\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:1;s:11:\"parentIndex\";i:0;}', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(83, 'header', 'style4', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(84, 'footer', 'style2', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(85, 'title', '0', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(86, 'app_section3', 'a:21:{s:5:\"title\";s:8:\"Download\";s:8:\"titleTwo\";s:18:\"Mobile Application\";s:8:\"subtitle\";s:22:\"Double Your Experience\";s:11:\"description\";s:664:\"<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore ete dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><ul class=\"wt-mobapp-listing\"><li><span>Duis aute irure dolor in reprehenderit</span></li><li><span>Voluptate velit esse cillum dolore</span></li><li><span>Fugiat nulla pariatur. Excepteur sint occaecat</span></li><li><span>Cupidatat non proident sunt in culpa</span></li><li><span>Qui officia deserunt mollit anim</span></li></ul><p>Laborum ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>\";s:11:\"andriod_url\";s:1:\"#\";s:7:\"ios_url\";s:1:\"#\";s:16:\"background_image\";s:21:\"1588246876-img-05.png\";s:9:\"app_image\";s:21:\"1588246876-mobile.png\";s:5:\"style\";s:6:\"style3\";s:12:\"sectionColor\";s:7:\"#ffffff\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#f62b84\";s:13:\"subtitleColor\";s:7:\"#3d4461\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:2:\"80\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:4;s:11:\"parentIndex\";i:3;s:9:\"ios_image\";s:21:\"1590763876-img-02.png\";s:13:\"android_image\";s:21:\"1590763876-img-01.png\";}', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(87, 'providersSecondVersion4', 'a:13:{s:5:\"title\";s:3:\"Top\";s:8:\"titleTwo\";s:11:\"Providers\";s:11:\"description\";s:90:\"<p>Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita</p>\";s:13:\"backgroundImg\";s:21:\"1588246876-img-03.png\";s:12:\"sectionColor\";s:7:\"#f5f7fa\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#9013fe\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:2:\"80\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";s:3:\"108\";s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:5;s:11:\"parentIndex\";i:4;}', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(88, 'jobs2', 'a:13:{s:5:\"title\";s:6:\"Latest\";s:8:\"titleTwo\";s:12:\"Jobs Opening\";s:11:\"description\";s:83:\"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita\";s:13:\"backgroundImg\";s:21:\"1588246877-img-02.png\";s:12:\"sectionColor\";s:7:\"#f5f7fa\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#9013f3\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:2:\"80\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";s:3:\"108\";s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:3;s:11:\"parentIndex\";i:2;}', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(89, 'packages5', 'a:13:{s:5:\"title\";s:3:\"Top\";s:8:\"titleTwo\";s:8:\"Packages\";s:11:\"description\";s:83:\"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita\";s:12:\"sectionColor\";s:7:\"#ffffff\";s:13:\"backgroundImg\";s:21:\"1588246877-img-04.png\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#9013fe\";s:7:\"padding\";a:5:{s:3:\"top\";s:2:\"80\";s:5:\"right\";i:0;s:6:\"bottom\";s:3:\"100\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:6;s:11:\"parentIndex\";i:5;}', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(90, 'sliders0', 'a:24:{s:5:\"style\";s:6:\"style4\";s:12:\"slider_image\";a:4:{i:0;s:21:\"1588246877-img-01.jpg\";i:1;s:21:\"1588246878-img-02.jpg\";i:2;s:21:\"1588246878-img-03.jpg\";i:3;s:21:\"1588246878-img-04.jpg\";}s:5:\"title\";s:15:\"Title Your Need\";s:8:\"subtitle\";s:16:\"We Have Everyone\";s:7:\"tagline\";s:25:\"Looking For Professional?\";s:11:\"description\";s:208:\"<p>Consectetur adipisicing elition sedames dotem iusmod temporei incuntes utnalo labore etdolore maina aliqua enim adion minim veniam quis nsitrud exercitation ullamco laboris nisiutaliquip ex ea commodo.</p>\";s:10:\"video_link\";N;s:11:\"video_title\";N;s:17:\"video_description\";s:0:\"\";s:12:\"taglineColor\";s:7:\"#ffffff\";s:10:\"titleColor\";s:7:\"#ffffff\";s:13:\"subtitleColor\";s:7:\"#ffffff\";s:12:\"sectionColor\";s:7:\"#ffffff\";s:7:\"padding\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:1;s:11:\"parentIndex\";i:0;s:18:\"enable_search_form\";b:1;s:17:\"search_form_title\";s:25:\"That Help You To Go Ahead\";s:20:\"search_form_subtitle\";s:22:\"Best Service Providers\";s:17:\"price_range_title\";s:12:\"Price Range:\";s:15:\"listing_tagline\";s:33:\"more than 2500 listings available\";}', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(91, 'categoriesThirdVersion1', 'a:16:{s:5:\"title\";s:9:\"Versatile\";s:8:\"titleTwo\";s:10:\"Categories\";s:8:\"subtitle\";s:16:\"Explore with our\";s:11:\"description\";s:200:\"<p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum dolore eunfugiat nulla pariatur lokaim urianewce sint.</p>\";s:12:\"sectionColor\";s:7:\"#ffffff\";s:13:\"backgroundImg\";s:21:\"1588246878-img-01.png\";s:10:\"titleColor\";s:7:\"#3d4461\";s:13:\"titleTwoColor\";s:7:\"#9013fe\";s:13:\"subtitleColor\";s:7:\"#3d4461\";s:13:\"showAllBtnUrl\";s:1:\"#\";s:7:\"padding\";a:5:{s:3:\"top\";s:3:\"160\";s:5:\"right\";i:0;s:6:\"bottom\";s:3:\"160\";s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:6:\"margin\";a:5:{s:3:\"top\";i:0;s:5:\"right\";i:0;s:6:\"bottom\";i:0;s:4:\"left\";i:0;s:4:\"unit\";s:2:\"px\";}s:9:\"sectionId\";N;s:12:\"sectionClass\";N;s:2:\"id\";i:2;s:11:\"parentIndex\";i:1;}', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(92, 'header', 'style5', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(93, 'footer', 'style3', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(94, 'title', '0', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(95, 'header_styling', 'a:4:{s:4:\"logo\";N;s:9:\"menuColor\";s:7:\"#ffffff\";s:14:\"menuHoverColor\";s:7:\"#fbde44\";s:5:\"color\";s:7:\"#ffffff\";}', 'App\\Page', 9, '2024-02-08 11:49:36', '2024-02-08 11:49:36'),
(96, 'header_styling', 'a:4:{s:4:\"logo\";N;s:9:\"menuColor\";s:7:\"#ffffff\";s:14:\"menuHoverColor\";s:7:\"#fbde44\";s:5:\"color\";s:7:\"#ffffff\";}', 'App\\Page', 8, '2024-02-08 11:49:36', '2024-02-08 11:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_21_082930_create_site_managements_table', 1),
(4, '2019_01_21_083223_create_categories_table', 1),
(5, '2019_01_21_083659_create_pages_table', 1),
(6, '2019_01_21_084005_child_pages', 1),
(7, '2019_01_21_084332_create_locations_table', 1),
(8, '2019_01_21_084630_create_skills_table', 1),
(9, '2019_01_21_084946_private_messages', 1),
(10, '2019_01_21_085428_private_messages_to', 1),
(11, '2019_01_21_103956_create_languages_table', 1),
(12, '2019_01_21_104105_create_jobs_table', 1),
(13, '2019_01_21_105235_create_proposals_table', 1),
(14, '2019_01_21_105802_proposal_documents', 1),
(15, '2019_01_23_063619_create_child_location_table', 1),
(16, '2019_01_23_064221_create_permission_tables', 1),
(17, '2019_01_25_070119_profile', 1),
(18, '2019_01_25_074332_departments', 1),
(19, '2019_01_29_113201_create_skill_user_table', 1),
(20, '2019_01_29_130030_create_catables_table', 1),
(21, '2019_02_01_140348_create_langables_table', 1),
(22, '2019_02_12_082928_create_job_skill_table', 1),
(23, '2019_02_16_103711_create_reports_table', 1),
(24, '2019_02_26_122204_followers', 1),
(25, '2019_02_28_115604_create_email_types_table', 1),
(26, '2019_02_28_115655_create_email_templates_table', 1),
(27, '2019_03_01_071107_create_review-options_table', 1),
(28, '2019_03_01_124110_create_reviews_table', 1),
(29, '2019_03_04_070237_create_packages_table', 1),
(30, '2019_03_04_085836_create_invoices_table', 1),
(31, '2019_03_04_112418_create_orders_table', 1),
(32, '2019_03_04_112537_create_items_table', 1),
(33, '2019_03_04_112635_create_i_p_n_statuses_table', 1),
(34, '2019_03_15_103524_create_messages_table', 1),
(35, '2019_03_19_125626_create_offers_table', 1),
(36, '2019_03_19_125645_create_disputes_table', 1),
(37, '2019_04_06_122330_create_badges_table', 1),
(38, '2019_04_10_131904_create_payouts_table', 1),
(39, '2019_06_17_080227_create_delivery_time_table', 1),
(40, '2019_06_17_080252_create_response_time_table', 1),
(41, '2019_06_17_084715_create_services_table', 1),
(42, '2019_06_18_113753_create_service_user_table', 1),
(43, '2019_06_25_121752_update_profile', 1),
(44, '2019_06_25_135732_update_private_messages', 1),
(45, '2019_06_26_070540_delete_profile_rating', 1),
(46, '2019_07_01_123323_update_reviews', 1),
(47, '2019_07_02_124918_update_payouts', 1),
(48, '2019_07_03_130706_update_packages', 1),
(49, '2019_07_31_080556_update_profile_payout', 1),
(50, '2019_08_01_095648_add_to_payout_type', 1),
(51, '2019_08_05_083823_add_is_active_to_users', 1),
(52, '2019_10_18_133239_add_paid_to_proposals', 1),
(53, '2019_10_18_133520_add_paid_to_service_user', 1),
(54, '2019_10_28_123201_add_videos_to_profiles_table', 1),
(55, '2019_10_31_083735_add_paid_progress_to_proposals', 1),
(56, '2019_10_31_085942_add_paid_progress_to_service_user', 1),
(57, '2019_10_31_104244_add_projects_ids_to_payouts', 1),
(58, '2019_12_17_080700_add_expiry_to_jobs_table', 1),
(59, '2019_12_18_150007_add_bank_column_to_invoices_table', 1),
(60, '2019_12_20_105734_add_type_to_orders_table', 1),
(61, '2019_12_20_142840_add_type_to_items_table', 1),
(62, '2019_12_24_140115_create_metas_table', 1),
(63, '2019_12_24_142522_add_sections_to_pages_table', 1),
(64, '2020_01_20_055407_create_article_categories_table', 1),
(65, '2020_01_20_061623_create_articles_table', 1),
(66, '2020_01_20_062131_create_article_category_table', 1),
(67, '2020_04_14_140545_add_image_to_packages_table', 1),
(68, '2020_12_23_194412_create_tasks_table', 2),
(69, '2020_12_27_230945_update_tasks_table', 2),
(70, '2021_01_06_192740_create_checklists_table', 2),
(71, '2021_01_06_194343_create_attachments_table', 2),
(72, '2021_01_06_195318_create_task_users_table', 2),
(73, '2021_01_06_195653_update_tasks_table_with_new_update', 2),
(74, '2021_01_15_100551_recreate_checklists_table', 2),
(75, '2021_01_17_131621_create_comments_table', 2),
(76, '2021_01_21_063538_create_quizzes_table', 2),
(77, '2021_01_24_101610_create_questions_table', 2),
(78, '2021_01_24_102424_create_answers_table', 2),
(79, '2021_01_24_102957_update_questions_table', 2),
(80, '2021_01_24_185617_rename_column_in_answers_table', 2),
(81, '2021_01_24_215251_create_marks_table', 2),
(82, '2021_01_27_065045_add_quiz_to_jobs_table', 2),
(83, '2021_01_27_070208_create_job_quizzes_table', 2),
(84, '2021_02_05_215920_create_live_contests_table', 2),
(85, '2021_02_05_222629_create_live_contest_participants_table', 2),
(86, '2021_02_10_211059_update_time_linit_in_live_contests_table', 2),
(87, '2021_02_14_191403_update_contests_table', 2),
(88, '2021_02_20_200955_add_flag_to_the_contests_table', 2),
(89, '2021_04_11_183243_create_job_files_table', 3),
(90, '2021_04_11_213815_create_job_notes_table', 4),
(91, '2021_04_11_214457_create_note_users_table', 5),
(92, '2021_04_11_214718_add_job_id_to_job_notes_table', 6),
(93, '2021_04_16_112342_add_job_id_to_job_notes_table1', 7),
(94, '2021_04_17_195945_create_job_tickets_table', 8),
(95, '2021_04_25_192231_add_file_link_in_job_files_table', 9),
(96, '2021_05_16_120705_make_job_duration_nallable', 10),
(97, '2021_05_16_121230_add_devilery_type_to_jobs_table', 11),
(98, '2021_05_16_194045_make_price_nullable_in_jobs_table', 12),
(99, '2021_05_16_195508_add_payments_in_jobs_table', 13),
(100, '2021_06_06_193824_create_reply_tickets_table', 14),
(101, '2021_06_18_163906_add_files_to_job_tickets_table', 15),
(102, '2021_08_31_133937_create_teams_table', 16),
(103, '2021_09_04_075541_create_english_levels_table', 17),
(104, '2021_09_04_075800_create_freelancer_types_table', 17),
(105, '2021_09_11_192154_add_original_to_proposals_table', 18),
(107, '2021_09_19_163625_create_contest_bids_table', 19),
(108, '2021_10_06_173002_create_sub_skills_table', 20),
(109, '2021_10_06_174403_create_sub_catetories_table', 20),
(110, '2021_10_08_200003_create_sub_job_skills_table', 21),
(111, '2021_10_08_200135_create_sub_job_cats_table', 21),
(112, '2021_12_03_212832_create_fteams_table', 22),
(113, '2021_12_09_075916_add_nickname_to_users_table', 23),
(114, '2021_12_09_080159_update_nickname_to_users_table', 24),
(115, '2021_12_14_180419_create_approvers_table', 25),
(116, '2021_12_17_191147_update_approvers_and_teams_table', 26),
(117, '2021_12_21_201043_droporupdate_jobs_table', 26),
(118, '2021_12_21_201748_add_status_to_the_jobs_table', 27),
(119, '2021_12_23_061147_create_freelancerinvites_table', 28),
(120, '2021_12_23_192054_add_email_text_to_freelancerinvites_table', 29),
(121, '2021_12_24_065438_add_ststus_to_approvers_table', 30),
(122, '2022_05_26_203218_create_job_chats_table', 31),
(123, '2022_06_24_212111_add_draft_to_enum_in_jobs_table', 32),
(124, '2022_07_20_185042_add_user_role_to_users_table', 33),
(125, '2022_08_01_201809_add_currency_to_jobs_table', 34),
(126, '2022_08_10_190016_create_currencies_table', 35),
(127, '2022_09_11_183428_add_rejected_status_to_jobs_table', 36),
(129, '2022_10_09_160052_create_employers_table', 37),
(130, '2022_10_10_151753_create_addresses_table', 38),
(131, '2022_10_10_152421_create_contacts_table', 39),
(132, '2022_11_04_150548_create_job_invites_table', 40),
(133, '2023_03_09_135515_add_notes_to_the_approvers_table', 41),
(134, '2023_03_20_133925_add_project_type_to_the_jobs_table', 42),
(135, '2023_04_13_131915_add_status_to_the_category', 43),
(136, '2023_06_01_145627_add_parent_id_to_categories_table', 44),
(137, '2023_08_08_124746_create_proposal_files_table', 45),
(138, '2023_10_10_084301_add_added_by_to_teams_table', 46),
(139, '2023_11_05_123236_add_assign_to_tasks', 47),
(140, '2024_01_25_115220_update_table_names', 48),
(141, '2024_01_28_065120_update_freelancer_invites_table', 49),
(142, '2024_01_28_102941_update_live_contests_table', 50),
(143, '2024_01_31_113759_update_offers_and_propasals_table', 51),
(144, '2024_02_11_063326_update_profile_table_with_saved_provider', 52),
(145, '2024_02_27_205314_create_cat_skills_table', 53),
(146, '2024_02_28_124352_add_status_and_approved_by_to_skills_table', 54);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 4),
(2, 'App\\User', 32),
(2, 'App\\User', 33),
(2, 'App\\User', 35),
(2, 'App\\User', 40),
(2, 'App\\User', 41),
(2, 'App\\User', 43),
(2, 'App\\User', 45),
(2, 'App\\User', 46),
(2, 'App\\User', 47),
(2, 'App\\User', 48),
(2, 'App\\User', 49),
(2, 'App\\User', 51),
(2, 'App\\User', 52),
(2, 'App\\User', 53),
(2, 'App\\User', 54),
(2, 'App\\User', 55),
(2, 'App\\User', 56),
(2, 'App\\User', 57),
(2, 'App\\User', 59),
(2, 'App\\User', 72),
(2, 'App\\User', 75),
(2, 'App\\User', 76),
(2, 'App\\User', 77),
(2, 'App\\User', 78),
(3, 'App\\User', 21),
(3, 'App\\User', 22),
(3, 'App\\User', 23),
(3, 'App\\User', 24),
(3, 'App\\User', 27),
(3, 'App\\User', 30),
(3, 'App\\User', 31),
(3, 'App\\User', 36),
(3, 'App\\User', 37),
(3, 'App\\User', 38),
(3, 'App\\User', 39),
(3, 'App\\User', 42),
(3, 'App\\User', 44),
(3, 'App\\User', 50),
(3, 'App\\User', 58),
(3, 'App\\User', 69),
(3, 'App\\User', 70),
(3, 'App\\User', 71),
(3, 'App\\User', 73),
(3, 'App\\User', 74),
(3, 'App\\User', 79),
(3, 'App\\User', 80),
(3, 'App\\User', 81);

-- --------------------------------------------------------

--
-- Table structure for table `note_users`
--

CREATE TABLE `note_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `note_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `invoice_id`, `status`, `created_at`, `updated_at`, `type`) VALUES
(2, 4, 8, 10, 'completed', '2021-05-16 05:07:58', '2021-05-16 05:08:57', 'package'),
(5, 21, 3, 12, 'completed', '2021-07-29 12:25:20', '2021-07-29 12:26:56', 'package'),
(6, 4, 21, 13, 'completed', '2021-11-19 14:59:14', '2021-11-19 15:13:23', 'service'),
(7, 4, 22, 14, 'completed', '2021-11-21 14:52:18', '2021-11-21 14:54:12', 'service'),
(8, 4, 23, 15, 'completed', '2021-11-21 15:02:13', '2021-11-21 15:03:06', 'service'),
(11, 4, 24, 18, 'completed', '2021-11-26 15:29:45', '2021-11-26 15:30:51', 'service'),
(12, 4, 8, 19, 'completed', '2021-12-25 14:33:03', '2021-12-25 14:33:40', 'package'),
(13, 21, 5, 20, 'completed', '2021-12-26 01:14:12', '2021-12-26 01:15:05', 'package'),
(14, 4, 19, 21, 'completed', '2021-12-26 01:19:43', '2021-12-26 01:20:24', 'job'),
(15, 32, 8, 22, 'completed', '2021-12-26 01:37:32', '2021-12-26 01:42:49', 'package'),
(16, 22, 4, 23, 'completed', '2021-12-26 14:07:11', '2021-12-26 14:07:51', 'package'),
(17, 23, 5, 24, 'completed', '2021-12-26 14:13:25', '2021-12-26 14:13:59', 'package'),
(18, 4, 31, 25, 'completed', '2021-12-26 14:27:03', '2021-12-26 14:28:15', 'job'),
(19, 4, 4, 26, 'completed', '2022-01-20 17:13:03', '2022-01-20 17:14:34', 'quiz'),
(20, 47, 6, NULL, 'pending', '2022-01-27 17:09:00', '2022-01-27 17:09:00', 'package'),
(21, 47, 6, 27, 'completed', '2022-01-27 17:12:41', '2022-01-27 17:26:26', 'package'),
(22, 24, 3, NULL, 'pending', '2022-02-09 17:16:07', '2022-02-09 17:16:07', 'package'),
(23, 24, 3, 28, 'completed', '2022-02-09 17:16:08', '2022-02-09 17:17:05', 'package'),
(24, 51, 6, 29, 'completed', '2022-05-30 14:57:19', '2022-05-30 14:58:06', 'package'),
(25, 4, 9, NULL, 'pending', '2022-05-31 15:15:22', '2022-05-31 15:15:22', 'package'),
(26, 21, 6, 38, 'completed', '2022-07-20 13:14:27', '2022-07-20 13:15:53', 'package'),
(27, 4, 6, 39, 'completed', '2022-08-05 21:28:18', '2022-08-05 21:29:44', 'package'),
(28, 21, 3, 40, 'completed', '2022-08-10 15:16:44', '2022-08-10 15:18:42', 'package'),
(29, 4, 39, 41, 'completed', '2022-08-13 12:35:43', '2022-08-13 13:04:56', 'job'),
(30, 22, 5, 42, 'completed', '2022-11-15 11:40:01', '2022-11-15 11:40:43', 'package'),
(31, 23, 5, 43, 'completed', '2022-11-15 11:43:58', '2022-11-15 11:52:14', 'package'),
(32, 24, 5, 44, 'completed', '2022-11-15 11:56:22', '2022-11-15 11:56:59', 'package'),
(33, 58, 5, 45, 'completed', '2022-11-15 12:01:00', '2022-11-15 12:01:36', 'package'),
(34, 4, 46, NULL, 'pending', '2023-06-21 02:10:49', '2023-06-21 02:10:49', 'job'),
(35, 4, 6, NULL, 'pending', '2023-11-01 20:23:36', '2023-11-01 20:23:36', 'package'),
(36, 4, 52, NULL, 'pending', '2024-03-16 07:37:21', '2024-03-16 07:37:21', 'job'),
(37, 4, 52, NULL, 'pending', '2024-03-16 07:45:28', '2024-03-16 07:45:28', 'job');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `subtitle` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `role_id` int(11) NOT NULL,
  `trial` tinyint(4) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `options` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `subtitle`, `slug`, `cost`, `role_id`, `trial`, `badge_id`, `options`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Trial Employer', '30 Days Trial', 'trial-employer', 0.00, 2, 1, 0, 'a:5:{s:4:\"jobs\";s:1:\"5\";s:13:\"featured_jobs\";s:1:\"5\";s:8:\"duration\";s:2:\"10\";s:13:\"banner_option\";s:4:\"true\";s:12:\"private_chat\";s:4:\"true\";}', '2021-02-25 05:48:21', '2022-05-30 14:35:06', NULL),
(2, 'Trial Freelancer', '30 Days Trial', 'trial-freelancer', 0.00, 3, 1, 0, 'a:7:{s:14:\"no_of_connects\";s:2:\"50\";s:12:\"no_of_skills\";s:1:\"5\";s:14:\"no_of_services\";s:1:\"5\";s:23:\"no_of_featured_services\";s:1:\"5\";s:8:\"duration\";s:2:\"10\";s:13:\"banner_option\";s:4:\"true\";s:12:\"private_chat\";s:4:\"true\";}', '2021-02-25 05:48:21', '2022-06-07 15:23:17', '1654635197-8750-fav.png'),
(3, 'Basic', 'Extended Plan For Managerial', 'basic', 60.00, 3, 0, 1, 'a:8:{s:14:\"no_of_connects\";s:2:\"60\";s:12:\"no_of_skills\";s:2:\"15\";s:14:\"no_of_services\";s:1:\"8\";s:23:\"no_of_featured_services\";s:1:\"5\";s:8:\"duration\";s:2:\"10\";s:5:\"badge\";s:1:\"1\";s:13:\"banner_option\";s:4:\"true\";s:12:\"private_chat\";s:4:\"true\";}', '2021-02-25 05:48:21', '2021-02-25 05:48:21', '1588830253-img-01.jpg'),
(4, 'Plus Members', 'Starter Plan For Newbie', 'plus-member', 90.00, 3, 0, 2, 'a:8:{s:14:\"no_of_connects\";s:2:\"90\";s:12:\"no_of_skills\";s:2:\"20\";s:14:\"no_of_services\";s:2:\"10\";s:23:\"no_of_featured_services\";s:1:\"8\";s:8:\"duration\";s:2:\"10\";s:5:\"badge\";s:1:\"2\";s:13:\"banner_option\";s:4:\"true\";s:12:\"private_chat\";s:4:\"true\";}', '2021-02-25 05:48:21', '2021-02-25 05:48:21', '1588830373-img-02.jpg'),
(5, 'Pro Members', 'Popular Plan For Professionals', 'pro-members', 120.00, 3, 0, 3, 'a:8:{s:14:\"no_of_connects\";s:3:\"120\";s:12:\"no_of_skills\";s:2:\"30\";s:14:\"no_of_services\";s:2:\"20\";s:23:\"no_of_featured_services\";s:2:\"10\";s:8:\"duration\";s:2:\"10\";s:5:\"badge\";s:1:\"3\";s:13:\"banner_option\";s:4:\"true\";s:12:\"private_chat\";s:4:\"true\";}', '2021-02-25 05:48:21', '2021-02-25 05:48:21', '1588830460-img-03.jpg'),
(6, 'Paltinum', 'For Employers', 'paltinum', 90.00, 2, 0, 0, 'a:5:{s:4:\"jobs\";s:2:\"15\";s:13:\"featured_jobs\";s:1:\"5\";s:8:\"duration\";s:2:\"10\";s:13:\"banner_option\";s:4:\"true\";s:12:\"private_chat\";s:4:\"true\";}', '2021-02-25 05:48:21', '2021-02-25 05:48:21', '1588830571-img-03.jpg'),
(7, 'Silver', 'Package for Employers', 'silver', 120.00, 2, 0, 0, 'a:5:{s:4:\"jobs\";s:1:\"5\";s:13:\"featured_jobs\";s:1:\"3\";s:8:\"duration\";s:2:\"30\";s:13:\"banner_option\";s:4:\"true\";s:12:\"private_chat\";s:4:\"true\";}', '2021-02-25 05:48:21', '2021-02-25 05:48:21', '1588830532-img-01.jpg'),
(8, 'Gold', 'Package for Employers', 'gold', 180.00, 2, 0, 0, 'a:5:{s:4:\"jobs\";s:3:\"100\";s:13:\"featured_jobs\";s:1:\"5\";s:8:\"duration\";s:3:\"360\";s:13:\"banner_option\";s:4:\"true\";s:12:\"private_chat\";s:4:\"true\";}', '2021-02-25 05:48:21', '2021-08-02 16:06:38', '1588830552-img-02.jpg'),
(9, 'Default', 'Default Package for Employer', 'default', 0.00, 2, 0, 0, 'a:5:{s:4:\"jobs\";s:2:\"10\";s:13:\"featured_jobs\";s:1:\"5\";s:8:\"duration\";s:2:\"10\";s:13:\"banner_option\";s:5:\"false\";s:12:\"private_chat\";s:5:\"false\";}', '2022-05-31 15:04:10', '2022-05-31 15:04:10', NULL),
(10, 'Default', 'Default Package for Providers', 'default-1', 0.00, 3, 0, 3, 'a:8:{s:14:\"no_of_connects\";s:2:\"10\";s:14:\"no_of_services\";s:1:\"2\";s:23:\"no_of_featured_services\";s:1:\"2\";s:12:\"no_of_skills\";s:1:\"3\";s:8:\"duration\";s:2:\"10\";s:5:\"badge\";s:1:\"3\";s:13:\"banner_option\";s:5:\"false\";s:12:\"private_chat\";s:5:\"false\";}', '2022-05-31 15:05:38', '2022-05-31 15:05:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `body` longtext NOT NULL,
  `relation_type` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sections` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `body`, `relation_type`, `created_at`, `updated_at`, `sections`) VALUES
(2, 'About Us', 'about-us', 'null', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'a:1:{i:0;O:8:\"stdClass\":5:{s:4:\"name\";s:19:\"Description Section\";s:7:\"section\";s:15:\"content_section\";s:5:\"value\";s:7:\"content\";s:4:\"icon\";s:10:\"img-09.png\";s:2:\"id\";i:4;}}'),
(3, 'How It Works', 'how-it-works', '<div class=\"wt-contentwrappers\">\n                    <div class=\"container\">\n                    <div class=\"row\">\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-12 float-left\">\n                    <div class=\"wt-howitwork-hold wt-bgwhite wt-haslayout\">\n                    <ul class=\"wt-navarticletab wt-navarticletabvtwo nav navbar-nav\">\n                    <li class=\"nav-item\"><a id=\"all-tab\" class=\"active\" href=\"#forhiring\" data-toggle=\"tab\">For Hiring</a></li>\n                    <li class=\"nav-item\"><a id=\"business-tab\" href=\"#forfreelancing\" data-toggle=\"tab\">For Freelancing</a></li>\n                    <li class=\"nav-item\"><a id=\"trading-tab\" href=\"#faq\" data-toggle=\"tab\">FAQ</a></li>\n                    </ul>\n                    <div class=\"tab-content wt-haslayout\">\n                    <div id=\"forhiring\" class=\"wt-contentarticle tab-pane active fade show\">\n                    <div class=\"row\">\n                    <div class=\"wt-starthiringhold wt-innerspace wt-haslayout\">\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-7 float-left\">\n                    <div class=\"wt-starthiringcontent\">\n                    <div class=\"wt-sectionhead\">\n                    <div class=\"wt-sectiontitle\">\n                    <h2>How To Start Hiring</h2>\n                    Start Today For a Great Future</div>\n                    <div class=\"wt-description\">\n                    <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce animid <a>Learn more</a></p>\n                    </div>\n                    </div>\n                    <ul class=\"wt-accordionhold accordion\">\n                    <li>\n                    <div id=\"headingOne\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapseOne\">Adipisicing elit, sed do eiusmod tempor incididunt?</div>\n                    <div id=\"collapseOne\" class=\"wt-accordiondetails collapse show\" aria-labelledby=\"headingOne\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eta dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingtwo\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsetwo\">Dolore magna aliqua enim ad minim veniam?</div>\n                    <div id=\"collapsetwo\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingtwo\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingthreea\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsethree\">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo?</div>\n                    <div id=\"collapsethree\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingthreea\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    </ul>\n                    </div>\n                    </div>\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-5 float-right\">\n                    <div class=\"wt-howtoworkimg\">\n                    <figure><img src=\"/public/images/how/img-01.jpg\" alt=\"img description\" width=\"415\" height=\"386\" /></figure>\n                    </div>\n                    </div>\n                    </div>\n                    <div class=\"wt-starthiringhold wt-innerspace wt-haslayout\">\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-7 float-right\">\n                    <div class=\"wt-starthiringcontent\">\n                    <div class=\"wt-sectionhead\">\n                    <div class=\"wt-sectiontitle\">\n                    <h2>Getting Into Business</h2>\n                    Focus on Your Work &amp; Team</div>\n                    <div class=\"wt-description\">\n                    <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce animid learn <a>more</a></p>\n                    </div>\n                    </div>\n                    <ul class=\"wt-accordionhold accordion\">\n                    <li>\n                    <div id=\"headingtwo2\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsetwo2\">Nostrud exercitation ullamco laboris nisi ut aliquip?</div>\n                    <div id=\"collapsetwo2\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingtwo2\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingtwo4\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsetwo4\">Commodo consequat aute irure dolor in reprehenderit in voluptate velit?</div>\n                    <div id=\"collapsetwo4\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingtwo4\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingthree2\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsethree2\">Cillum dolore eu fugiat nulla pariatur?</div>\n                    <div id=\"collapsethree2\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingthree2\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    </ul>\n                    </div>\n                    </div>\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-5 float-left\">\n                    <div class=\"wt-howtoworkimg\">\n                    <figure><img src=\"/public/images/how/img-02.jpg\" alt=\"img description\" /></figure>\n                    </div>\n                    </div>\n                    </div>\n                    <div class=\"wt-starthiringhold wt-innerspace wt-haslayout\">\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-7 float-left\">\n                    <div class=\"wt-starthiringcontent\">\n                    <div class=\"wt-sectionhead\">\n                    <div class=\"wt-sectiontitle\">\n                    <h2>Making Serious Profit</h2>\n                    Manage Your Profitable Account</div>\n                    <div class=\"wt-description\">\n                    <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce animid learn <a>more</a></p>\n                    </div>\n                    </div>\n                    <ul class=\"wt-accordionhold accordion\">\n                    <li>\n                    <div id=\"headingOne3\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapseOne3\">Excepteur sint occaecat cupidatat non proident?</div>\n                    <div id=\"collapseOne3\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingOne3\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingtwo3\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsetwo3\">Sunt in culpa qui officia deserunt mollit anim id est laborum?</div>\n                    <div id=\"collapsetwo3\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingtwo3\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingthree3\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsethree3\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem?</div>\n                    <div id=\"collapsethree3\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingthree3\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    </ul>\n                    </div>\n                    </div>\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-5 float-right\">\n                    <div class=\"wt-howtoworkimg\">\n                    <figure><img src=\"/public/images/how/img-03.jpg\" alt=\"img description\" width=\"415\" height=\"386\" /></figure>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    <div id=\"forfreelancing\" class=\"wt-contentarticle tab-pane fade\">\n                    <div class=\"row\">\n                    <div class=\"wt-starthiringhold wt-innerspace wt-haslayout\">\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-7 float-right\">\n                    <div class=\"wt-starthiringcontent\">\n                    <div class=\"wt-sectionhead\">\n                    <div class=\"wt-sectiontitle\">\n                    <h2>How To Start Hiring</h2>\n                    Start Today For a Great Future</div>\n                    <div class=\"wt-description\">\n                    <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce animid learn <a>more</a></p>\n                    </div>\n                    </div>\n                    <ul class=\"wt-accordionhold accordion\">\n                    <li>\n                    <div id=\"headingOneq\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapseOneq\">Adipisicing elit, sed do eiusmod tempor incididunt?</div>\n                    <div id=\"collapseOneq\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingOneq\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingtwoq\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsetwoq\">Dolore magna aliqua enim ad minim veniam?</div>\n                    <div id=\"collapsetwoq\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingtwoq\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingthreeq\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsethreeq\">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo?</div>\n                    <div id=\"collapsethreeq\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingthreeq\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    </ul>\n                    </div>\n                    </div>\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-5 float-left\">\n                    <div class=\"wt-howtoworkimg\">\n                    <figure><img src=\"/public/images/how/img-01.jpg\" alt=\"img description\" width=\"415\" height=\"386\" /></figure>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    <div id=\"faq\" class=\"wt-contentarticle tab-pane fade\">\n                    <div class=\"row\">\n                    <div class=\"wt-starthiringhold wt-innerspace wt-haslayout\">\n                    <div class=\"col-12 col-sm-12 col-md-12 col-lg-7 float-left\">\n                    <div class=\"wt-starthiringcontent\">\n                    <div class=\"wt-sectionhead\">\n                    <div class=\"wt-sectiontitle\">\n                    <h2>How To Start Hiring</h2>\n                    Start Today For a Great Future</div>\n                    <div class=\"wt-description\">\n                    <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua eniina ilukita ylokem lokateise ination voluptate velite esse cillum dolore eu fugnulla pariatur lokaim urianewce animid learn <a>more</a></p>\n                    </div>\n                    </div>\n                    <ul class=\"wt-accordionhold accordion\">\n                    <li>\n                    <div id=\"headingOnea\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapseOnea\">Nostrud exercitation ullamco laboris nisi ut aliquip?</div>\n                    <div id=\"collapseOnea\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingOne\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingtwoa\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsetwoa\">Commodo consequat aute irure dolor in reprehenderit in voluptate velit?</div>\n                    <div id=\"collapsetwoa\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingtwoa\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    <li>\n                    <div id=\"headingthree\" class=\"wt-accordiontitle collapsed\" data-toggle=\"collapse\" data-target=\"#collapsethreea\">Cillum dolore eu fugiat nulla pariatur?</div>\n                    <div id=\"collapsethreea\" class=\"wt-accordiondetails collapse\" aria-labelledby=\"headingthree\">\n                    <div class=\"wt-title\">\n                    <h3>Digital Marketing</h3>\n                    </div>\n                    <div class=\"wt-description\">\n                    <p>Consectetur adipisicing elit sed aeiusmisuod tempor incididunt labore dolore ma alaeiqua enim ade minim veniam quis nostr xecitation ullamcoaris nisi ut aliquipa extaea coedmmmodo equate irure dolawor in reprehenderit.</p>\n                    </div>\n                    <div class=\"wt-likeunlike\">Did you find this useful?</div>\n                    </div>\n                    </li>\n                    </ul>\n                    </div>\n                    </div>\n                    <div class=\"col-12 col-sm-12 col-md-4 col-lg-5 float-right\">\n                    <div class=\"wt-howtoworkimg\">\n                    <figure><img src=\"/public/images/how/img-01.jpg\" alt=\"img description\" width=\"415\" height=\"386\" /></figure>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>\n                    </div>', 0, '2021-02-25 05:48:21', '2021-02-25 05:48:21', NULL),
(4, 'Privacy Policy', 'privacy-policy', '<div id=\"wt-twocolumns\" class=\"wt-twocolumns wt-haslayout\">\r\n                    <div class=\"col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left\">\r\n                    <aside id=\"wt-sidebar\" class=\"wt-sidebar\">\r\n                    <div class=\"wt-widget wt-effectiveholder\">\r\n                    <div class=\"wt-widgettitle\">\r\n                    <h2>Effective T&amp;C</h2>\r\n                    </div>\r\n                    <div class=\"wt-widgetcontent\">\r\n                    <ul class=\"wt-effectivecontent\">\r\n                    <li><a>Adipisicing elit sed do eiusmod</a></li>\r\n                    <li><a>Tempor incididunt</a></li>\r\n                    <li><a>How To Submit Claim Report</a></li>\r\n                    <li><a>Ut enim ad minim veniam</a></li>\r\n                    <li><a>Quis nostrud exercitation</a></li>\r\n                    <li><a>Ullamco laboris nisiut</a></li>\r\n                    <li><a>Aliquip ex ea commodo</a></li>\r\n                    <li><a>Consequat duis aute</a></li>\r\n                    <li><a>Irure dolorin</a></li>\r\n                    <li><a>Reprehenderit</a></li>\r\n                    <li><a>Voluptate velit esse cillum</a></li>\r\n                    </ul>\r\n                    </div>\r\n                    </div>\r\n                    </aside>\r\n                    </div>\r\n                    <div class=\"col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left\">\r\n                    <div class=\"wt-submitreportholder wt-bgwhite\">\r\n                    <div class=\"wt-titlebar\">\r\n                    <h2>How To Submit Claim Report</h2>\r\n                    </div>\r\n                    <div class=\"wt-reportdescription\">\r\n                    <div class=\"wt-description\">\r\n                    <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud <a href=\"javascrip:void(0);\"> exercitation ullamco laboris</a> nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut <a href=\"javascrip:void(0);\"> perspiciatis unde</a> omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur, adipisci velit, sed quia magnam aliquam quaerat voluptatem.</p>\r\n                    </div>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Step #01</h3>\r\n                    </div>\r\n                    <div class=\"wt-description\">\r\n                    <p>Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n                    <p>Voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n                    <p>Odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur, adipisci velit, sed quia magnam aliquam quaerat voluptatem.</p>\r\n                    </div>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Step #02</h3>\r\n                    </div>\r\n                    <div class=\"wt-description\">\r\n                    <p>Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n                    <p>Consequuntur magni dolores eios qui ratione voluptatem sequi nesciunt. Nequerro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur, adipisci velit, sed quia magnam aliquam quaerat voluptatem.</p>\r\n                    </div>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Step #03</h3>\r\n                    </div>\r\n                    <div class=\"wt-description\">\r\n                    <p>Dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur adipisci velit.</p>\r\n                    </div>\r\n                    </div>\r\n                    </div>\r\n                    </div>\r\n                    </div>', 0, '2021-02-25 05:48:21', '2021-02-25 05:48:21', NULL),
(5, 'Home v1', 'home-v1', 'null', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'a:4:{i:0;O:8:\"stdClass\":5:{s:4:\"name\";s:14:\"Slider Section\";s:7:\"section\";s:6:\"slider\";s:5:\"value\";s:7:\"sliders\";s:4:\"icon\";s:10:\"img-01.png\";s:2:\"id\";i:1;}i:1;O:8:\"stdClass\":5:{s:4:\"name\";s:16:\"Category Section\";s:7:\"section\";s:8:\"category\";s:5:\"value\";s:3:\"cat\";s:4:\"icon\";s:10:\"img-02.png\";s:2:\"id\";i:2;}i:2;O:8:\"stdClass\":5:{s:4:\"name\";s:15:\"Welcome Section\";s:7:\"section\";s:15:\"welcome_section\";s:5:\"value\";s:16:\"welcome_sections\";s:4:\"icon\";s:10:\"img-03.png\";s:2:\"id\";i:4;}i:3;O:8:\"stdClass\":5:{s:4:\"name\";s:11:\"APP Section\";s:7:\"section\";s:11:\"app_section\";s:5:\"value\";s:11:\"app_section\";s:4:\"icon\";s:10:\"img-04.png\";s:2:\"id\";i:5;}}'),
(6, 'Home V2', 'home-v2', 'null', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'a:6:{i:0;O:8:\"stdClass\":5:{s:4:\"name\";s:14:\"Slider Section\";s:7:\"section\";s:6:\"slider\";s:5:\"value\";s:7:\"sliders\";s:4:\"icon\";s:10:\"img-01.png\";s:2:\"id\";i:1;}i:1;O:8:\"stdClass\":5:{s:4:\"name\";s:15:\"Service Section\";s:7:\"section\";s:15:\"service_section\";s:5:\"value\";s:8:\"services\";s:4:\"icon\";s:10:\"img-05.png\";s:2:\"id\";i:6;}i:2;O:8:\"stdClass\":5:{s:4:\"name\";s:23:\"How it work tab section\";s:7:\"section\";s:16:\"work_tab_section\";s:5:\"value\";s:9:\"work_tabs\";s:4:\"icon\";s:10:\"img-07.png\";s:2:\"id\";i:3;}i:3;O:8:\"stdClass\":5:{s:4:\"name\";s:18:\"Freelancer section\";s:7:\"section\";s:18:\"freelancer_section\";s:5:\"value\";s:11:\"freelancers\";s:4:\"icon\";s:10:\"img-08.png\";s:2:\"id\";i:4;}i:4;O:8:\"stdClass\":5:{s:4:\"name\";s:11:\"APP Section\";s:7:\"section\";s:11:\"app_section\";s:5:\"value\";s:11:\"app_section\";s:4:\"icon\";s:10:\"img-04.png\";s:2:\"id\";i:5;}i:5;O:8:\"stdClass\":5:{s:4:\"name\";s:15:\"Article Section\";s:7:\"section\";s:15:\"article_section\";s:5:\"value\";s:8:\"articles\";s:4:\"icon\";s:10:\"img-10.png\";s:2:\"id\";i:10;}}'),
(7, 'Home v3', 'home-v3', 'null', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'a:6:{i:0;O:8:\"stdClass\":5:{s:4:\"name\";s:14:\"Slider Section\";s:7:\"section\";s:6:\"slider\";s:5:\"value\";s:7:\"sliders\";s:4:\"icon\";s:10:\"img-01.png\";s:2:\"id\";i:1;}i:1;O:8:\"stdClass\":5:{s:4:\"name\";s:15:\"Service Section\";s:7:\"section\";s:15:\"service_section\";s:5:\"value\";s:8:\"services\";s:4:\"icon\";s:10:\"img-05.png\";s:2:\"id\";i:5;}i:2;O:8:\"stdClass\":5:{s:4:\"name\";s:18:\"Freelancer section\";s:7:\"section\";s:18:\"freelancer_section\";s:5:\"value\";s:11:\"freelancers\";s:4:\"icon\";s:10:\"img-08.png\";s:2:\"id\";i:4;}i:3;O:8:\"stdClass\":5:{s:4:\"name\";s:25:\"How it work video section\";s:7:\"section\";s:18:\"work_video_section\";s:5:\"value\";s:11:\"work_videos\";s:4:\"icon\";s:10:\"img-06.png\";s:2:\"id\";i:3;}i:4;O:8:\"stdClass\":5:{s:4:\"name\";s:11:\"APP Section\";s:7:\"section\";s:11:\"app_section\";s:5:\"value\";s:11:\"app_section\";s:4:\"icon\";s:10:\"img-04.png\";s:2:\"id\";i:7;}i:5;O:8:\"stdClass\":5:{s:4:\"name\";s:15:\"Article Section\";s:7:\"section\";s:15:\"article_section\";s:5:\"value\";s:8:\"articles\";s:4:\"icon\";s:10:\"img-09.png\";s:2:\"id\";i:6;}}'),
(8, 'Home V4', 'home-v4', 'null', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'a:6:{i:0;O:8:\"stdClass\":5:{s:4:\"name\";s:17:\"Banner Section V1\";s:7:\"section\";s:8:\"bannerV1\";s:5:\"value\";s:18:\"bannerFirstVersion\";s:4:\"icon\";s:10:\"img-12.png\";s:2:\"id\";i:1;}i:1;O:8:\"stdClass\":5:{s:4:\"name\";s:19:\"Category Section V2\";s:7:\"section\";s:10:\"categoryV2\";s:5:\"value\";s:23:\"categoriesSecondVersion\";s:4:\"icon\";s:10:\"img-07.png\";s:2:\"id\";i:2;}i:2;O:8:\"stdClass\":5:{s:4:\"name\";s:12:\"Jobs Section\";s:7:\"section\";s:12:\"jobs_section\";s:5:\"value\";s:4:\"jobs\";s:4:\"icon\";s:10:\"img-11.png\";s:2:\"id\";i:3;}i:3;O:8:\"stdClass\":5:{s:4:\"name\";s:11:\"APP Section\";s:7:\"section\";s:11:\"app_section\";s:5:\"value\";s:11:\"app_section\";s:4:\"icon\";s:10:\"img-04.png\";s:2:\"id\";i:4;}i:4;O:8:\"stdClass\":5:{s:4:\"name\";s:21:\"Freelancer Section V2\";s:7:\"section\";s:21:\"freelancer_section_v2\";s:5:\"value\";s:24:\"freelancersSecondVersion\";s:4:\"icon\";s:10:\"img-08.png\";s:2:\"id\";i:5;}i:5;O:8:\"stdClass\":5:{s:4:\"name\";s:15:\"Package Section\";s:7:\"section\";s:15:\"package_section\";s:5:\"value\";s:8:\"packages\";s:4:\"icon\";s:10:\"img-09.png\";s:2:\"id\";i:6;}}'),
(9, 'Home V5', 'home-v5', 'null', 1, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'a:6:{i:0;O:8:\"stdClass\":5:{s:4:\"name\";s:14:\"Slider Section\";s:7:\"section\";s:6:\"slider\";s:5:\"value\";s:7:\"sliders\";s:4:\"icon\";s:10:\"img-01.png\";s:2:\"id\";i:1;}i:1;O:8:\"stdClass\":5:{s:4:\"name\";s:19:\"Category Section V3\";s:7:\"section\";s:10:\"categoryV3\";s:5:\"value\";s:22:\"categoriesThirdVersion\";s:4:\"icon\";s:10:\"img-12.png\";s:2:\"id\";i:2;}i:2;O:8:\"stdClass\":5:{s:4:\"name\";s:12:\"Jobs Section\";s:7:\"section\";s:12:\"jobs_section\";s:5:\"value\";s:4:\"jobs\";s:4:\"icon\";s:10:\"img-11.png\";s:2:\"id\";i:3;}i:3;O:8:\"stdClass\":5:{s:4:\"name\";s:11:\"APP Section\";s:7:\"section\";s:11:\"app_section\";s:5:\"value\";s:11:\"app_section\";s:4:\"icon\";s:10:\"img-04.png\";s:2:\"id\";i:4;}i:4;O:8:\"stdClass\":5:{s:4:\"name\";s:21:\"Freelancer Section V2\";s:7:\"section\";s:21:\"freelancer_section_v2\";s:5:\"value\";s:24:\"freelancersSecondVersion\";s:4:\"icon\";s:10:\"img-08.png\";s:2:\"id\";i:5;}i:5;O:8:\"stdClass\":5:{s:4:\"name\";s:15:\"Package Section\";s:7:\"section\";s:15:\"package_section\";s:5:\"value\";s:8:\"packages\";s:4:\"icon\";s:10:\"img-09.png\";s:2:\"id\";i:6;}}');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` varchar(191) NOT NULL,
  `payment_method` varchar(191) NOT NULL,
  `currency` varchar(191) NOT NULL,
  `paypal_id` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `type` enum('job','service') NOT NULL DEFAULT 'job',
  `bank_details` text DEFAULT NULL,
  `projects_ids` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE `private_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `attachments` text DEFAULT NULL,
  `notify` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_type` enum('job','service') NOT NULL DEFAULT 'job'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `private_messages`
--

INSERT INTO `private_messages` (`id`, `author_id`, `proposal_id`, `content`, `attachments`, `notify`, `created_at`, `updated_at`, `project_type`) VALUES
(1, 4, 1, '<p><span style=\"font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in risus id mauris convallis sollicitudin. Etiam porta, massa finibus bibendum fermentum, velit diam hendrerit libero, eu consectetur sapien velit ac nibh. Ut in volutpat nisi, et suscipit libero.</span></p>', NULL, 0, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'job'),
(2, 21, 1, 'Donec placerat, massa eu tincidunt volutpat.', 'a:1:{i:0;s:52:\"1555913392-How-to-run-mysql-command-in-database.docx\";}', 0, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'job'),
(3, 4, 1, 'Donec placerat, massa eu tincidunt volutpat.', NULL, 0, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'job'),
(4, 21, 1, 'Donec placerat, massa eu tincidunt volutpat.', 'a:1:{i:0;s:52:\"1555913456-How-to-run-mysql-command-in-database.docx\";}', 0, '2021-02-25 05:48:21', '2021-02-25 05:48:21', 'job');

-- --------------------------------------------------------

--
-- Table structure for table `private_messages_to`
--

CREATE TABLE `private_messages_to` (
  `id` int(10) UNSIGNED NOT NULL,
  `private_message_id` int(11) DEFAULT NULL,
  `recipent_id` int(11) NOT NULL,
  `message_read` tinyint(4) NOT NULL,
  `read_date` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `private_messages_to`
--

INSERT INTO `private_messages_to` (`id`, `private_message_id`, `recipent_id`, `message_read`, `read_date`, `created_at`, `updated_at`) VALUES
(1, 1, 21, 0, NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 2, 4, 0, NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 3, 21, 0, NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(4, 4, 4, 0, NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `no_of_employees` int(11) DEFAULT NULL,
  `provider_type` varchar(191) DEFAULT NULL,
  `english_level` enum('basic','conversational','fluent','native','professional') DEFAULT NULL,
  `hourly_rate` int(11) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `awards` text DEFAULT NULL,
  `projects` text DEFAULT NULL,
  `saved_provider` text DEFAULT NULL,
  `offers` text DEFAULT NULL,
  `saved_jobs` text DEFAULT NULL,
  `saved_employers` text DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `avater` varchar(191) DEFAULT NULL,
  `banner` varchar(191) DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `tagline` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `delete_reason` varchar(191) DEFAULT NULL,
  `delete_description` varchar(191) DEFAULT NULL,
  `payout_id` varchar(191) DEFAULT NULL,
  `profile_searchable` text DEFAULT NULL,
  `profile_blocked` text DEFAULT NULL,
  `weekly_alerts` text DEFAULT NULL,
  `message_alerts` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `saved_services` text DEFAULT NULL,
  `ratings` text DEFAULT NULL,
  `payout_settings` text DEFAULT NULL,
  `videos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `department_id`, `no_of_employees`, `provider_type`, `english_level`, `hourly_rate`, `experience`, `education`, `awards`, `projects`, `saved_provider`, `offers`, `saved_jobs`, `saved_employers`, `address`, `longitude`, `latitude`, `avater`, `banner`, `gender`, `tagline`, `description`, `delete_reason`, `delete_description`, `payout_id`, `profile_searchable`, `profile_blocked`, `weekly_alerts`, `message_alerts`, `created_at`, `updated_at`, `saved_services`, `ratings`, `payout_settings`, `videos`) VALUES
(1, 1, NULL, NULL, 'Basic', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '5340-Screenshot_2.png', '1652732104-9402-OhL7btd-wallpaper-of-universe.jpg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-25 05:48:21', '2022-07-07 14:10:23', NULL, NULL, NULL, NULL),
(4, 4, 3, 100, 'Basic', 'native', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '132.609851360321', '-21.2475322804021', '4019-American-actor-John-Krasinski-2020.webp', 'b.jpg', '', 'HR HCL Technology', 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\r\nLaborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-25 05:48:21', '2022-06-24 13:40:39', NULL, NULL, NULL, NULL),
(21, 21, NULL, NULL, 'Basic', 'professional', 12, 'a:2:{i:0;a:5:{s:9:\"job_title\";s:21:\"SEO Expert Consultant\";s:10:\"start_date\";s:10:\"2019-04-18\";s:8:\"end_date\";s:10:\"2019-04-20\";s:13:\"company_title\";s:10:\"Amentotech\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}i:1;a:5:{s:9:\"job_title\";s:13:\"Start & Sound\";s:10:\"start_date\";s:10:\"2019-04-26\";s:8:\"end_date\";s:10:\"2019-04-28\";s:13:\"company_title\";s:10:\"Amentotech\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}}', 'a:1:{i:0;a:5:{s:12:\"degree_title\";s:22:\"Information Technology\";s:10:\"start_date\";s:10:\"2019-04-09\";s:8:\"end_date\";s:10:\"2019-04-17\";s:15:\"institute_title\";s:35:\"Amento Tech Institute of Technology\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}}', 'a:4:{i:0;a:3:{s:11:\"award_title\";s:10:\"Best Theme\";s:10:\"award_date\";s:8:\"12-12-31\";s:18:\"award_hidden_image\";s:22:\"15543822240-img-03.jpg\";}i:1;a:3:{s:11:\"award_title\";s:23:\"Monster Developer Award\";s:10:\"award_date\";s:8:\"12-01-14\";s:18:\"award_hidden_image\";s:22:\"15544736871-img-09.jpg\";}i:2;a:3:{s:11:\"award_title\";s:23:\"Best Communication 2015\";s:10:\"award_date\";s:8:\"19-02-01\";s:18:\"award_hidden_image\";s:22:\"15544736872-img-10.jpg\";}i:3;a:3:{s:11:\"award_title\";s:23:\"Best Logo Design Winner\";s:10:\"award_date\";s:8:\"20-10-09\";s:18:\"award_hidden_image\";s:22:\"15544736873-img-12.jpg\";}}', 'a:6:{i:0;a:3:{s:13:\"project_title\";s:8:\"Worketic\";s:11:\"project_url\";s:39:\"http://amentotech.com/projects/worketic\";s:20:\"project_hidden_image\";s:26:\"15543822240-banner-img.jpg\";}i:1;a:3:{s:13:\"project_title\";s:9:\"Videohive\";s:11:\"project_url\";s:17:\"www.videohive.net\";s:20:\"project_hidden_image\";s:10:\"img-01.jpg\";}i:2;a:3:{s:13:\"project_title\";s:10:\"Codecanyon\";s:11:\"project_url\";s:18:\"www.codecanyon.net\";s:20:\"project_hidden_image\";s:10:\"img-03.jpg\";}i:3;a:3:{s:13:\"project_title\";s:12:\"Graphicriver\";s:11:\"project_url\";s:20:\"www.graphicriver.net\";s:20:\"project_hidden_image\";s:10:\"img-04.jpg\";}i:4;a:3:{s:13:\"project_title\";s:9:\"Photodune\";s:11:\"project_url\";s:17:\"www.photodune.net\";s:20:\"project_hidden_image\";s:10:\"img-05.jpg\";}i:5;a:3:{s:13:\"project_title\";s:11:\"Audiojungle\";s:11:\"project_url\";s:19:\"www.audiojungle.net\";s:20:\"project_hidden_image\";s:10:\"img-06.jpg\";}}', NULL, NULL, NULL, NULL, 'Jed Tyre & Exhaust Centre Friars Burn/High St Jedburgh TD8 6AG UK', '-2.55555510520935', '55.4785859361283', 'a.jpg', 'b.jpg', 'male', 'PHP developer   HCL', 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\r\nLaborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-25 05:48:21', '2021-12-09 12:30:21', NULL, 'a:1:{i:0;d:5;}', NULL, 'a:1:{i:0;a:1:{s:3:\"url\";N;}}'),
(22, 22, NULL, NULL, 'Basic', 'fluent', 0, 'a:2:{i:0;a:5:{s:9:\"job_title\";s:21:\"SEO Expert Consultant\";s:10:\"start_date\";s:10:\"2019-04-18\";s:8:\"end_date\";s:10:\"2019-04-20\";s:13:\"company_title\";s:10:\"Amentotech\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}i:1;a:5:{s:9:\"job_title\";s:13:\"Start & Sound\";s:10:\"start_date\";s:10:\"2019-04-26\";s:8:\"end_date\";s:10:\"2019-04-28\";s:13:\"company_title\";s:10:\"Amentotech\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}}', 'a:1:{i:0;a:5:{s:12:\"degree_title\";s:22:\"Information Technology\";s:10:\"start_date\";s:10:\"2019-04-09\";s:8:\"end_date\";s:10:\"2019-04-17\";s:15:\"institute_title\";s:35:\"Amento Tech Institute of Technology\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}}', 'a:4:{i:0;a:3:{s:11:\"award_title\";s:10:\"Best Theme\";s:10:\"award_date\";s:8:\"12-12-31\";s:18:\"award_hidden_image\";s:22:\"15543822240-img-03.jpg\";}i:1;a:3:{s:11:\"award_title\";s:23:\"Monster Developer Award\";s:10:\"award_date\";s:8:\"12-01-14\";s:18:\"award_hidden_image\";s:22:\"15544736871-img-09.jpg\";}i:2;a:3:{s:11:\"award_title\";s:23:\"Best Communication 2015\";s:10:\"award_date\";s:8:\"19-02-01\";s:18:\"award_hidden_image\";s:22:\"15544736872-img-10.jpg\";}i:3;a:3:{s:11:\"award_title\";s:23:\"Best Logo Design Winner\";s:10:\"award_date\";s:8:\"20-10-09\";s:18:\"award_hidden_image\";s:22:\"15544736873-img-12.jpg\";}}', 'a:6:{i:0;a:3:{s:13:\"project_title\";s:8:\"Worketic\";s:11:\"project_url\";s:39:\"http://amentotech.com/projects/worketic\";s:20:\"project_hidden_image\";s:26:\"15543822240-banner-img.jpg\";}i:1;a:3:{s:13:\"project_title\";s:9:\"Videohive\";s:11:\"project_url\";s:17:\"www.videohive.net\";s:20:\"project_hidden_image\";s:10:\"img-01.jpg\";}i:2;a:3:{s:13:\"project_title\";s:10:\"Codecanyon\";s:11:\"project_url\";s:18:\"www.codecanyon.net\";s:20:\"project_hidden_image\";s:10:\"img-03.jpg\";}i:3;a:3:{s:13:\"project_title\";s:12:\"Graphicriver\";s:11:\"project_url\";s:20:\"www.graphicriver.net\";s:20:\"project_hidden_image\";s:10:\"img-04.jpg\";}i:4;a:3:{s:13:\"project_title\";s:9:\"Photodune\";s:11:\"project_url\";s:17:\"www.photodune.net\";s:20:\"project_hidden_image\";s:10:\"img-05.jpg\";}i:5;a:3:{s:13:\"project_title\";s:11:\"Audiojungle\";s:11:\"project_url\";s:19:\"www.audiojungle.net\";s:20:\"project_hidden_image\";s:10:\"img-06.jpg\";}}', NULL, NULL, NULL, NULL, '', '-2.71619260311126', '55.4753116211057', 'a.jpg', 'b.jpg', 'male', 'Data Analyst at ABCL', 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\r\nLaborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-25 05:48:21', '2023-07-21 10:26:56', NULL, NULL, NULL, 'a:1:{i:0;a:1:{s:3:\"url\";N;}}'),
(23, 23, NULL, NULL, 'Basic', 'native', 47, 'a:2:{i:0;a:5:{s:9:\"job_title\";s:21:\"SEO Expert Consultant\";s:10:\"start_date\";s:10:\"2019-04-18\";s:8:\"end_date\";s:10:\"2019-04-20\";s:13:\"company_title\";s:10:\"Amentotech\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}i:1;a:5:{s:9:\"job_title\";s:13:\"Start & Sound\";s:10:\"start_date\";s:10:\"2019-04-26\";s:8:\"end_date\";s:10:\"2019-04-28\";s:13:\"company_title\";s:10:\"Amentotech\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}}', 'a:1:{i:0;a:5:{s:12:\"degree_title\";s:22:\"Information Technology\";s:10:\"start_date\";s:10:\"2019-04-09\";s:8:\"end_date\";s:10:\"2019-04-17\";s:15:\"institute_title\";s:35:\"Amento Tech Institute of Technology\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}}', 'a:4:{i:0;a:3:{s:11:\"award_title\";s:10:\"Best Theme\";s:10:\"award_date\";s:8:\"12-12-31\";s:18:\"award_hidden_image\";s:22:\"15543822240-img-03.jpg\";}i:1;a:3:{s:11:\"award_title\";s:23:\"Monster Developer Award\";s:10:\"award_date\";s:8:\"12-01-14\";s:18:\"award_hidden_image\";s:22:\"15544736871-img-09.jpg\";}i:2;a:3:{s:11:\"award_title\";s:23:\"Best Communication 2015\";s:10:\"award_date\";s:8:\"19-02-01\";s:18:\"award_hidden_image\";s:22:\"15544736872-img-10.jpg\";}i:3;a:3:{s:11:\"award_title\";s:23:\"Best Logo Design Winner\";s:10:\"award_date\";s:8:\"20-10-09\";s:18:\"award_hidden_image\";s:22:\"15544736873-img-12.jpg\";}}', 'a:6:{i:0;a:3:{s:13:\"project_title\";s:8:\"Worketic\";s:11:\"project_url\";s:39:\"http://amentotech.com/projects/worketic\";s:20:\"project_hidden_image\";s:26:\"15543822240-banner-img.jpg\";}i:1;a:3:{s:13:\"project_title\";s:9:\"Videohive\";s:11:\"project_url\";s:17:\"www.videohive.net\";s:20:\"project_hidden_image\";s:10:\"img-01.jpg\";}i:2;a:3:{s:13:\"project_title\";s:10:\"Codecanyon\";s:11:\"project_url\";s:18:\"www.codecanyon.net\";s:20:\"project_hidden_image\";s:10:\"img-03.jpg\";}i:3;a:3:{s:13:\"project_title\";s:12:\"Graphicriver\";s:11:\"project_url\";s:20:\"www.graphicriver.net\";s:20:\"project_hidden_image\";s:10:\"img-04.jpg\";}i:4;a:3:{s:13:\"project_title\";s:9:\"Photodune\";s:11:\"project_url\";s:17:\"www.photodune.net\";s:20:\"project_hidden_image\";s:10:\"img-05.jpg\";}i:5;a:3:{s:13:\"project_title\";s:11:\"Audiojungle\";s:11:\"project_url\";s:19:\"www.audiojungle.net\";s:20:\"project_hidden_image\";s:10:\"img-06.jpg\";}}', NULL, NULL, NULL, NULL, '', '-98.95441532135', '40.4909568065246', 'a.jpg', 'b.jpg', 'female', 'ASP Webmaster at CBSC', 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\r\nLaborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-25 05:48:21', '2023-07-14 13:29:11', NULL, NULL, NULL, 'a:1:{i:0;a:1:{s:3:\"url\";N;}}'),
(24, 24, NULL, NULL, 'independent', 'basic', 25, 'a:2:{i:0;a:5:{s:9:\"job_title\";s:21:\"SEO Expert Consultant\";s:10:\"start_date\";s:10:\"2019-04-18\";s:8:\"end_date\";s:10:\"2019-04-20\";s:13:\"company_title\";s:10:\"Amentotech\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}i:1;a:5:{s:9:\"job_title\";s:13:\"Start & Sound\";s:10:\"start_date\";s:10:\"2019-04-26\";s:8:\"end_date\";s:10:\"2019-04-28\";s:13:\"company_title\";s:10:\"Amentotech\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}}', 'a:1:{i:0;a:5:{s:12:\"degree_title\";s:22:\"Information Technology\";s:10:\"start_date\";s:10:\"2019-04-09\";s:8:\"end_date\";s:10:\"2019-04-17\";s:15:\"institute_title\";s:35:\"Amento Tech Institute of Technology\";s:11:\"description\";s:461:\"Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\";}}', 'a:4:{i:0;a:3:{s:11:\"award_title\";s:10:\"Best Theme\";s:10:\"award_date\";s:8:\"12-12-31\";s:18:\"award_hidden_image\";s:22:\"15543822240-img-03.jpg\";}i:1;a:3:{s:11:\"award_title\";s:23:\"Monster Developer Award\";s:10:\"award_date\";s:8:\"12-01-14\";s:18:\"award_hidden_image\";s:22:\"15544736871-img-09.jpg\";}i:2;a:3:{s:11:\"award_title\";s:23:\"Best Communication 2015\";s:10:\"award_date\";s:8:\"19-02-01\";s:18:\"award_hidden_image\";s:22:\"15544736872-img-10.jpg\";}i:3;a:3:{s:11:\"award_title\";s:23:\"Best Logo Design Winner\";s:10:\"award_date\";s:8:\"20-10-09\";s:18:\"award_hidden_image\";s:22:\"15544736873-img-12.jpg\";}}', 'a:6:{i:0;a:3:{s:13:\"project_title\";s:8:\"Worketic\";s:11:\"project_url\";s:39:\"http://amentotech.com/projects/worketic\";s:20:\"project_hidden_image\";s:26:\"15543822240-banner-img.jpg\";}i:1;a:3:{s:13:\"project_title\";s:9:\"Videohive\";s:11:\"project_url\";s:17:\"www.videohive.net\";s:20:\"project_hidden_image\";s:10:\"img-01.jpg\";}i:2;a:3:{s:13:\"project_title\";s:10:\"Codecanyon\";s:11:\"project_url\";s:18:\"www.codecanyon.net\";s:20:\"project_hidden_image\";s:10:\"img-03.jpg\";}i:3;a:3:{s:13:\"project_title\";s:12:\"Graphicriver\";s:11:\"project_url\";s:20:\"www.graphicriver.net\";s:20:\"project_hidden_image\";s:10:\"img-04.jpg\";}i:4;a:3:{s:13:\"project_title\";s:9:\"Photodune\";s:11:\"project_url\";s:17:\"www.photodune.net\";s:20:\"project_hidden_image\";s:10:\"img-05.jpg\";}i:5;a:3:{s:13:\"project_title\";s:11:\"Audiojungle\";s:11:\"project_url\";s:19:\"www.audiojungle.net\";s:20:\"project_hidden_image\";s:10:\"img-06.jpg\";}}', NULL, NULL, NULL, NULL, 'Pioneer Aerial Applicators 886 W St Clair St Minden, NE 68959', '-98.9599245786666', '40.4894003885342', 'a.jpg', 'b.jpg', 'male', 'Python Senior DevOps at ABCL', 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim laborum. Seden utem perspiciatis undesieu omnis voluptatem accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventore veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos aquist ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor sitem ameteism conctetur adipisci velit sedate quianon.\r\nLaborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-25 05:48:21', '2021-02-25 05:48:21', NULL, NULL, NULL, NULL),
(27, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-29 16:15:47', '2021-11-29 16:15:47', NULL, NULL, NULL, NULL),
(29, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-30 01:26:30', '2021-11-30 01:26:30', NULL, NULL, NULL, NULL),
(30, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-30 01:29:56', '2021-11-30 01:29:56', NULL, NULL, NULL, NULL),
(31, 31, NULL, NULL, 'Basic', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-09 07:13:46', '2021-12-09 07:20:44', NULL, NULL, NULL, 'a:1:{i:0;a:1:{s:3:\"url\";N;}}'),
(32, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-16 19:19:43', '2021-12-16 19:19:43', NULL, NULL, NULL, NULL),
(33, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-16 23:47:04', '2021-12-16 23:47:04', NULL, NULL, NULL, NULL),
(34, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-22 14:02:44', '2021-12-22 14:02:44', NULL, NULL, NULL, NULL),
(35, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-22 14:06:01', '2021-12-22 14:06:01', NULL, NULL, NULL, NULL),
(36, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-23 14:03:51', '2021-12-23 14:03:51', NULL, NULL, NULL, NULL),
(37, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-26 01:09:20', '2021-12-26 01:09:20', NULL, NULL, NULL, NULL),
(38, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-11 01:25:01', '2022-01-11 01:25:01', NULL, NULL, NULL, NULL),
(39, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-11 01:26:29', '2022-01-11 01:26:29', NULL, NULL, NULL, NULL),
(40, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-11 01:56:26', '2022-01-11 01:56:26', NULL, NULL, NULL, NULL),
(41, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-11 02:19:10', '2022-01-11 02:19:10', NULL, NULL, NULL, NULL),
(42, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-11 10:38:31', '2022-01-11 10:38:31', NULL, NULL, NULL, NULL),
(43, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-19 14:40:31', '2022-01-19 14:40:31', NULL, NULL, NULL, NULL),
(44, 45, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-19 14:57:47', '2022-01-19 14:57:47', NULL, NULL, NULL, NULL),
(45, 46, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-19 15:34:51', '2022-01-19 15:34:51', NULL, NULL, NULL, NULL),
(46, 47, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-27 16:55:28', '2022-01-27 16:55:28', NULL, NULL, NULL, NULL),
(47, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-09 03:00:27', '2022-03-09 03:00:27', NULL, NULL, NULL, NULL),
(48, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-09 03:00:27', '2022-03-09 03:00:27', NULL, NULL, NULL, NULL),
(49, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-12 20:45:03', '2022-03-12 20:45:03', NULL, NULL, NULL, NULL),
(50, 51, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-30 14:42:02', '2022-05-30 14:42:02', NULL, NULL, NULL, NULL),
(51, 52, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-01 13:49:28', '2022-06-01 13:49:28', NULL, NULL, NULL, NULL),
(52, 53, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-01 13:51:55', '2022-06-01 13:51:55', NULL, NULL, NULL, NULL),
(53, 54, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-01 13:54:46', '2022-06-01 13:54:46', NULL, NULL, NULL, NULL),
(54, 55, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-01 13:56:42', '2022-06-01 13:56:42', NULL, NULL, NULL, NULL),
(55, 56, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-01 15:46:15', '2022-06-01 15:46:15', NULL, NULL, NULL, NULL),
(56, 57, NULL, 5000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-01 15:47:43', '2022-06-01 15:47:43', NULL, NULL, NULL, NULL),
(57, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-07 19:39:54', '2022-08-07 19:39:54', NULL, NULL, NULL, NULL),
(58, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-09 14:04:50', '2022-09-09 14:04:50', NULL, NULL, NULL, NULL),
(65, 69, 3, NULL, 'independent', 'conversational', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', 'Tester', 'I am a tester one', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-22 09:28:34', '2022-10-22 09:28:34', NULL, NULL, NULL, NULL),
(66, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-26 21:08:37', '2023-01-26 21:08:37', NULL, NULL, NULL, NULL),
(67, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-26 21:36:43', '2023-01-26 21:36:43', NULL, NULL, NULL, NULL),
(68, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-26 21:38:21', '2023-01-26 21:38:21', NULL, NULL, NULL, NULL),
(69, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-26 22:13:12', '2023-01-26 22:13:12', NULL, NULL, NULL, NULL),
(70, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-26 22:13:37', '2023-01-26 22:13:37', NULL, NULL, NULL, NULL),
(71, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-02 20:42:31', '2023-02-02 20:42:31', NULL, NULL, NULL, NULL),
(72, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-18 14:22:07', '2023-02-18 14:22:07', NULL, NULL, NULL, NULL),
(73, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-27 22:43:09', '2023-02-27 22:43:09', NULL, NULL, NULL, NULL),
(74, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-11 12:51:31', '2023-03-11 12:51:31', NULL, NULL, NULL, NULL),
(75, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-01 20:01:23', '2023-11-01 20:01:23', NULL, NULL, NULL, NULL),
(76, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-02 11:49:46', '2023-11-02 11:49:46', NULL, NULL, NULL, NULL),
(77, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-05 06:52:12', '2023-11-05 06:52:12', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `amount` int(11) NOT NULL,
  `completion_time` varchar(191) NOT NULL,
  `attachments` text DEFAULT NULL,
  `hired` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('pending','hired','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paid` enum('pending','completed') DEFAULT NULL,
  `paid_progress` enum('in-progress','completed') NOT NULL DEFAULT 'in-progress',
  `original` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `provider_id`, `job_id`, `content`, `amount`, `completion_time`, `attachments`, `hired`, `status`, `created_at`, `updated_at`, `paid`, `paid_progress`, `original`) VALUES
(39, 21, 204, 'Hello Sir/Mam,\r\n\r\nI can complete task within the time limit. Please initiate chat so we can start working over it.\r\n\r\nThanks,\r\nKai Clarke', 3000, 'monthly', NULL, 1, 'hired', '2022-08-11 12:16:29', '2022-08-13 13:04:56', 'pending', 'in-progress', 3000),
(40, 4, 206, 'Hello This is the test', 24000, 'three_month', NULL, 0, 'pending', '2022-09-05 14:29:31', '2022-09-05 14:29:31', NULL, 'in-progress', 24000),
(41, 21, 203, 'Hello Sir/Mam,\r\n\r\nI can complete this work within a month.', 2200, 'monthly', NULL, 0, 'pending', '2022-11-05 11:40:09', '2023-08-02 21:47:18', NULL, 'in-progress', 2200),
(42, 22, 203, 'Hello Sir,\r\n\r\nI can complete your task within a month. Please initiate chat so we can start working over it', 2200, 'three_month', NULL, 0, 'pending', '2022-11-15 11:42:35', '2022-11-15 11:42:35', NULL, 'in-progress', 2200),
(43, 23, 203, 'Hello there,\r\n\r\nI can start working over your project, please start chat so we can start working over it.', 2300, 'three_month', NULL, 0, 'pending', '2022-11-15 11:54:24', '2022-11-15 11:54:24', NULL, 'in-progress', 2300),
(44, 24, 203, 'Hello there,\r\n\r\nI am looking forward to start working with you', 2000, 'six_month', NULL, 0, 'pending', '2022-11-15 11:58:39', '2022-11-15 11:58:39', NULL, 'in-progress', 2000),
(45, 58, 203, 'I am looking working over it', 1900, 'six_month', NULL, 0, 'pending', '2022-11-15 12:03:57', '2022-11-15 12:03:57', NULL, 'in-progress', 1900),
(46, 22, 219, 'Hello this is the propopal for the job', 1400, 'monthly', NULL, 0, 'pending', '2023-06-20 15:14:27', '2023-06-20 15:14:27', NULL, 'in-progress', 1400),
(47, 23, 219, 'Hello This is the proposal for the broker services', 1450, 'three_month', NULL, 0, 'pending', '2023-06-20 15:16:37', '2023-06-20 15:16:37', NULL, 'in-progress', 1450),
(48, 22, 221, 'This si the test.', 1499, 'monthly', NULL, 0, 'pending', '2023-07-21 10:32:53', '2023-10-04 12:28:19', NULL, 'in-progress', 1500),
(49, 21, 220, 'Hello there,\r\n\r\nI can complete this work in time and in budget.', 13000, 'three_month', 'a:1:{i:0;s:23:\"1691031049-One test.pdf\";}', 0, 'pending', '2023-08-02 21:50:49', '2023-08-02 21:50:49', NULL, 'in-progress', 13000),
(50, 22, 220, 'Hello,\r\n\r\nThis is the test proposal one test', 14000, 'more_than_six', 'a:1:{i:0;s:19:\"1693849579-test.pdf\";}', 0, 'pending', '2023-09-04 12:46:19', '2023-11-01 13:51:09', NULL, 'in-progress', 14000),
(51, 21, 222, 'Hello,\r\n\r\nThis is the test proposal for the kai clarke', 1300, 'three_month', NULL, 0, 'pending', '2023-09-12 10:23:16', '2023-09-18 12:53:09', NULL, 'in-progress', 1400),
(52, 23, 222, 'Hello,\r\n\r\nThis is the proposal from ralph', 1499, 'weekly', NULL, 0, 'pending', '2023-09-18 12:42:29', '2023-09-18 12:42:29', NULL, 'in-progress', 1499),
(53, 22, 222, 'Hello,\r\n\r\nThis is the proposal from Baker', 1359, 'three_month', NULL, 0, 'pending', '2023-09-18 12:44:44', '2023-09-18 12:50:23', NULL, 'in-progress', 1399);

-- --------------------------------------------------------

--
-- Table structure for table `proposal_documents`
--

CREATE TABLE `proposal_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `document` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal_files`
--

CREATE TABLE `proposal_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `file` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  `size` varchar(191) NOT NULL,
  `proposal_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_files`
--

INSERT INTO `proposal_files` (`id`, `name`, `file`, `description`, `size`, `proposal_id`, `created_at`, `updated_at`) VALUES
(1, 'One test.pdf', 'One test_220_1692299358.pdf', 'This is the tester description', '142.79 KB', 49, '2023-08-17 14:09:18', '2023-08-17 14:09:18'),
(2, 'One test_220_1689359177.pdf', 'One test_220_1689359177_220_1692550322.pdf', 'This is the tester description one', '142.79 KB', 49, '2023-08-20 11:52:02', '2023-08-20 11:52:02'),
(3, 'test.pdf', 'test_220_1692551205.pdf', 'This is the tester description two', '142.79 KB', 49, '2023-08-20 12:06:45', '2023-08-20 12:06:45'),
(4, 'test.pdf', 'test_220_1693849661.pdf', 'This is the local files', '69.57 KB', 50, '2023-09-04 12:47:41', '2023-09-04 12:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `providerinvites`
--

CREATE TABLE `providerinvites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `providers` varchar(191) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_types`
--

CREATE TABLE `provider_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_type` varchar(255) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(191) NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `quiz_id`, `created_at`, `updated_at`, `value`) VALUES
(1, 'How many years of experience do you have in MySql?', 1, '2021-02-26 07:01:28', '2021-02-26 07:01:28', 10),
(2, 'Pregunta 1', 5, '2022-01-11 01:38:48', '2022-01-11 01:38:48', 2),
(3, 'Cuantos empleados tiene?', 1, '2022-03-09 03:14:48', '2022-03-09 03:14:48', 30);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `user_id`, `created_at`, `updated_at`, `price`) VALUES
(1, 'RFI1', 4, '2021-02-26 07:01:01', '2022-01-06 00:34:12', 0),
(2, 'RF2', 4, '2021-08-22 03:47:43', '2022-01-06 00:34:01', 0),
(3, 'Certification ITIL 1', 4, '2021-08-22 03:48:11', '2022-01-06 00:34:29', 0),
(4, 'Admin quiz 1', 1, '2022-01-10 15:47:14', '2022-01-10 21:07:48', 100),
(5, 'RF3', 4, '2022-01-11 01:38:15', '2022-01-11 01:38:15', 0),
(6, 'Admin quiz 1', 4, '2022-01-20 17:14:34', '2022-01-20 17:14:34', 0),
(7, 'RFI', 4, '2022-03-09 03:08:50', '2022-03-09 03:08:50', 30);

-- --------------------------------------------------------

--
-- Table structure for table `reply_tickets`
--

CREATE TABLE `reply_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `reason` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  `reportable_id` int(11) NOT NULL,
  `reportable_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `reason`, `description`, `reportable_id`, `reportable_type`, `created_at`, `updated_at`) VALUES
(1, 'service cancel', 'didn&#39;t complete the task', 21, 'App\\Service', '2021-11-20 15:26:49', '2021-11-20 15:26:49'),
(2, 'service cancel', 'not completed the task', 23, 'App\\Service', '2021-11-21 15:03:53', '2021-11-21 15:03:53'),
(4, 'service cancel', 'this is the test', 23, 'App\\Service', '2021-11-22 08:34:31', '2021-11-22 08:34:31'),
(6, 'service cancel', 'changes not accepted', 24, 'App\\Service', '2021-11-26 15:53:40', '2021-11-26 15:53:40'),
(7, 'service cancel', 'changes not accepted', 24, 'App\\Service', '2021-11-26 15:56:46', '2021-11-26 15:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `response_times`
--

CREATE TABLE `response_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `response_times`
--

INSERT INTO `response_times` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, '1 Hour', '1-hour', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, '2 Hours', '2-hours', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, '3 Hours', '3-hours', '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `rating` text NOT NULL,
  `avg_rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_type` enum('job','service') NOT NULL DEFAULT 'job',
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `receiver_id`, `job_id`, `feedback`, `rating`, `avg_rating`, `created_at`, `updated_at`, `project_type`, `service_id`) VALUES
(6, 4, 21, 22, 'It was done wonderfully', 'a:4:{i:0;a:2:{s:6:\"rating\";i:4;s:6:\"reason\";i:1;}i:1;a:2:{s:6:\"rating\";i:5;s:6:\"reason\";i:2;}i:2;a:2:{s:6:\"rating\";i:3;s:6:\"reason\";i:3;}i:3;a:2:{s:6:\"rating\";i:5;s:6:\"reason\";i:4;}}', 4, '2021-11-21 09:25:05', '2021-11-21 09:25:05', 'service', 3),
(9, 4, 21, 118, 'Work was completed as required', 'a:4:{i:0;a:2:{s:6:\"rating\";i:5;s:6:\"reason\";i:1;}i:1;a:2:{s:6:\"rating\";i:5;s:6:\"reason\";i:2;}i:2;a:2:{s:6:\"rating\";i:5;s:6:\"reason\";i:3;}i:3;a:2:{s:6:\"rating\";i:5;s:6:\"reason\";i:4;}}', 5, '2021-12-26 01:21:19', '2021-12-26 01:21:19', 'job', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_options`
--

CREATE TABLE `review_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_options`
--

INSERT INTO `review_options` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'How was my proffesional behaviour?', 'how-was-my-proffesional-behaviour?', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 'How was my quality of work?', 'how-was-my-quality-of-work?', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 'Was I focused to deadline?', 'was-i-focused-to-deadline?', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(4, 'Was it worth it having my services?', 'was-it-worth-it-having-my-services?', '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `role_type` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `role_type`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'web', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 'employer', 'employer', 'web', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 'provider', 'provider', 'web', '2021-02-25 05:48:21', '2021-02-25 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `delivery_time_id` int(11) NOT NULL,
  `response_time_id` int(11) NOT NULL,
  `english_level` enum('basic','conversational','fluent','native','professional') NOT NULL,
  `price` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `address` varchar(191) NOT NULL,
  `longitude` varchar(191) NOT NULL,
  `latitude` varchar(191) NOT NULL,
  `is_featured` text DEFAULT NULL,
  `show_attachments` text DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `code` varchar(191) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `status`, `delivery_time_id`, `response_time_id`, `english_level`, `price`, `description`, `location_id`, `address`, `longitude`, `latitude`, `is_featured`, `show_attachments`, `attachments`, `code`, `views`, `created_at`, `updated_at`) VALUES
(1, 'I Will Develop Ios And Android Mobile App Using React Native', 'i-will-develop-ios-and-android-mobile-app-using-react-native', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562309590-17.jpg\";i:1;s:17:\"1562309590-18.jpg\";i:2;s:41:\"1562309590-Ios And Android Mobile App.jpg\";}', 'K7YLR93Q', 45, '2021-02-25 05:48:21', '2024-10-20 22:12:47'),
(2, 'I Will Create, Fix, Customize, Your WordPress Website', 'i-will-develop-ios-and-android-mobile-app-using-react-native-2', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562309667-08.jpg\";i:1;s:17:\"1562309667-11.jpg\";i:2;s:18:\"1562309667-015.jpg\";}', 'K7YLR93Q', 27, '2021-02-25 05:48:21', '2024-10-20 21:36:18'),
(3, 'I Will Provide Pro SEO Report, Competitor Website Audit And Analysis', 'i-will-develop-ios-and-android-mobile-app-using-react-native-3', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562309752-02.jpg\";i:1;s:17:\"1562309752-03.jpg\";i:2;s:17:\"1562309752-04.jpg\";}', 'K7YLR93Q', 39, '2021-02-25 05:48:21', '2024-10-20 22:13:43'),
(4, 'I Will Do SEO Full On Page And Off Page Optimization For Any Site', 'i-will-develop-ios-and-android-mobile-app-using-react-native-4', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562309822-05.jpg\";i:1;s:17:\"1562309822-06.jpg\";i:2;s:18:\"1562309822-015.jpg\";}', 'K7YLR93Q', 35, '2021-02-25 05:48:21', '2024-10-20 21:37:10'),
(5, 'I Will Edit And Master Your Audiobook For Acx', 'i-will-develop-ios-and-android-mobile-app-using-react-native-5', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562310441-12.jpg\";i:1;s:17:\"1562310441-19.jpg\";i:2;s:17:\"1562310441-20.jpg\";}', 'K7YLR93Q', 29, '2021-02-25 05:48:21', '2024-10-20 21:37:10'),
(6, 'I Will Make Professional Excel And Google Sheets', 'i-will-develop-ios-and-android-mobile-app-using-react-native-6', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562310491-02.jpg\";i:1;s:17:\"1562310491-03.jpg\";i:2;s:17:\"1562310491-16.jpg\";}', 'K7YLR93Q', 29, '2021-02-25 05:48:21', '2024-10-20 21:35:49'),
(7, 'I Will Be Your Ios Developer And Update Old Apps', 'i-will-develop-ios-and-android-mobile-app-using-react-native-7', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562310551-07.jpg\";i:1;s:17:\"1562310551-10.jpg\";i:2;s:17:\"1562310551-11.jpg\";}', 'K7YLR93Q', 34, '2021-02-25 05:48:21', '2024-10-20 22:24:27'),
(8, 'I Will Create Automated Shopify Dropshipping Store', 'i-will-develop-ios-and-android-mobile-app-using-react-native-8', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562310637-04.jpg\";i:1;s:17:\"1562310637-05.jpg\";i:2;s:17:\"1562310637-16.jpg\";}', 'K7YLR93Q', 25, '2021-02-25 05:48:21', '2024-10-20 21:36:30'),
(9, 'I Will Test Your Applications Or Websites For Usability', 'i-will-develop-ios-and-android-mobile-app-using-react-native-9', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562311011-13.jpg\";i:1;s:17:\"1562311011-19.jpg\";i:2;s:41:\"1562311011-Ios And Android Mobile App.jpg\";}', 'K7YLR93Q', 26, '2021-02-25 05:48:21', '2024-10-20 21:37:08'),
(10, 'I Will Write And Publish A Guest Post On Da 80 Dofollow Post', 'i-will-develop-ios-and-android-mobile-app-using-react-native-10', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562311071-03.jpg\";i:1;s:17:\"1562311071-08.jpg\";i:2;s:17:\"1562311071-10.jpg\";}', 'K7YLR93Q', 19, '2021-02-25 05:48:21', '2024-10-20 21:36:03'),
(11, 'I Will Write And Publish A Guest Post On Da 80 Dofollow Post', 'i-will-develop-ios-and-android-mobile-app-using-react-native-11', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562311115-11.jpg\";i:1;s:17:\"1562311115-16.jpg\";i:2;s:17:\"1562311115-20.jpg\";}', 'K7YLR93Q', 31, '2021-02-25 05:48:21', '2024-10-20 21:35:51'),
(12, 'I Will Do Embedded C Coding For Tiva C And Other Microcontrollers', 'i-will-develop-ios-and-android-mobile-app-using-react-native-12', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562311202-06.jpg\";i:1;s:17:\"1562311202-19.jpg\";i:2;s:41:\"1562311202-Ios And Android Mobile App.jpg\";}', 'K7YLR93Q', 25, '2021-02-25 05:48:21', '2024-10-20 21:36:02'),
(13, 'I Will Create Automated Shopify Store For Dropshipping', 'i-will-develop-ios-and-android-mobile-app-using-react-native-13', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:22:\"1562311523-andriod.jpg\";i:1;s:46:\"1562311523-Ios And Android Mobile App copy.jpg\";i:2;s:41:\"1562311523-Ios And Android Mobile App.jpg\";}', 'K7YLR93Q', 19, '2021-02-25 05:48:21', '2024-10-20 21:36:15'),
(14, 'I Will Create, Fix, Customize, Your WordPress Website', 'i-will-develop-ios-and-android-mobile-app-using-react-native-14', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562311602-10.jpg\";i:1;s:17:\"1562311602-14.jpg\";i:2;s:17:\"1562311602-16.jpg\";}', 'K7YLR93Q', 21, '2021-02-25 05:48:21', '2024-10-20 21:35:49'),
(15, 'I Will Test Your Website Or Apps Functionality, Usability And More', 'i-will-develop-ios-and-android-mobile-app-using-react-native-15', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562311698-20.jpg\";i:1;s:22:\"1562311698-andriod.jpg\";i:2;s:46:\"1562311698-Ios And Android Mobile App copy.jpg\";}', 'K7YLR93Q', 26, '2021-02-25 05:48:21', '2024-10-20 21:35:49'),
(16, 'I Will Create Automated Shopify Dropshipping Store, Shopify Website', 'i-will-develop-ios-and-android-mobile-app-using-react-native-16', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:16:\"1562311833-1.jpg\";i:1;s:17:\"1562311833-14.jpg\";i:2;s:18:\"1562311833-015.jpg\";}', 'K7YLR93Q', 18, '2021-02-25 05:48:21', '2024-10-20 21:36:07'),
(17, 'I Will Launch Your Shopify Dropshipping Store', 'i-will-develop-ios-and-android-mobile-app-using-react-native-17', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:16:\"1562312105-2.jpg\";i:1;s:17:\"1562312105-03.jpg\";i:2;s:17:\"1562312105-04.jpg\";}', 'K7YLR93Q', 27, '2021-02-25 05:48:21', '2024-10-20 21:36:04'),
(18, 'I Will Setup 7 Figure Shopify Website Shopify Store', 'i-will-develop-ios-and-android-mobile-app-using-react-native-18', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562312214-19.jpg\";i:1;s:17:\"1562312214-20.jpg\";i:2;s:22:\"1562312214-andriod.jpg\";}', 'K7YLR93Q', 19, '2021-02-25 05:48:21', '2024-10-20 21:36:20'),
(19, 'I Will Redesign Shopify Dropshipping Store To Boost Sales', 'i-will-develop-ios-and-android-mobile-app-using-react-native-19', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562312251-16.jpg\";i:1;s:17:\"1562312251-17.jpg\";i:2;s:17:\"1562312251-18.jpg\";}', 'K7YLR93Q', 20, '2021-02-25 05:48:21', '2024-10-20 21:36:16'),
(20, 'I Will Make A Hybrid Application With Android, Php', 'i-will-develop-ios-and-android-mobile-app-using-react-native-20', 'published', 3, 3, 'fluent', 20, '<p>Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia deserunt mollit anim id est laborum. Seden utem perspiciatis undesieu.</p>\r\n                    <p>Accusantium doque laudantium, totam rem aiam eaqueiu ipsa quae ab illoion inventoren veritatisetm quasitea architecto beataea dictaed quia couuntur magni dolores eos quistm ratione vtatem seque nesnt. Neque porro quamest quioremas ipsum quiatem dolor situe sitem amet conctetur adipisci velit sedate quianon.</p>\r\n                    <div class=\"wt-title\">\r\n                    <h3>Why Should You Hire Me?</h3>\r\n                    </div>\r\n                    <p>Laborum sed ut perspiciatis unde omnis iste natus error sitems voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis etna quasi architecto beatae vitae dictation explicabo. nemo enim ipsam fugit.</p>\r\n                    <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequei porrom quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitn, sed quia nonae numquam eius modi tempora incidunt labore omnis iste natus error sites voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quaem ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseq aeuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', 6, 'test address', '4568', '4512', 'true', 'true', 'a:3:{i:0;s:17:\"1562312303-04.jpg\";i:1;s:17:\"1562312303-07.jpg\";i:2;s:17:\"1562312303-08.jpg\";}', 'K7YLR93Q', 26, '2021-02-25 05:48:21', '2024-10-20 22:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `service_user`
--

CREATE TABLE `service_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `type` enum('seller','employer') NOT NULL DEFAULT 'seller',
  `status` enum('hired','completed','cancelled','pending','published') NOT NULL DEFAULT 'pending',
  `paid` enum('pending','completed') DEFAULT NULL,
  `paid_progress` enum('in-progress','completed') NOT NULL DEFAULT 'in-progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_user`
--

INSERT INTO `service_user` (`id`, `service_id`, `user_id`, `seller_id`, `type`, `status`, `paid`, `paid_progress`) VALUES
(1, 1, 21, 21, 'seller', 'published', NULL, 'in-progress'),
(2, 2, 21, 21, 'seller', 'published', NULL, 'in-progress'),
(3, 3, 21, 21, 'seller', 'published', NULL, 'in-progress'),
(4, 4, 21, 21, 'seller', 'published', NULL, 'in-progress'),
(5, 5, 22, 22, 'seller', 'published', NULL, 'in-progress'),
(6, 6, 22, 22, 'seller', 'published', NULL, 'in-progress'),
(7, 7, 22, 22, 'seller', 'published', NULL, 'in-progress'),
(8, 8, 22, 22, 'seller', 'published', NULL, 'in-progress'),
(21, 1, 4, 21, 'employer', 'cancelled', 'pending', 'in-progress'),
(22, 3, 4, 21, 'employer', 'completed', 'pending', 'in-progress'),
(23, 6, 4, 22, 'employer', 'cancelled', 'pending', 'in-progress'),
(24, 4, 4, 21, 'employer', 'hired', 'pending', 'in-progress');

-- --------------------------------------------------------

--
-- Table structure for table `site_managements`
--

CREATE TABLE `site_managements` (
  `id` int(10) UNSIGNED NOT NULL,
  `meta_key` varchar(191) NOT NULL,
  `meta_value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_managements`
--

INSERT INTO `site_managements` (`id`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 'home_settings', 'a:1:{i:0;a:8:{s:11:\"home_banner\";s:14:\"banner-img.jpg\";s:17:\"home_banner_image\";s:10:\"img-01.png\";s:12:\"banner_title\";s:23:\"Hire expert freelancers\";s:15:\"banner_subtitle\";s:19:\"for any job, Online\";s:18:\"banner_description\";s:101:\"Consectetur adipisicing elit sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim.\";s:10:\"video_link\";s:43:\"https://www.youtube.com/watch?v=B-ph2g5o2K4\";s:11:\"video_title\";s:17:\"See For Yourself!\";s:10:\"video_desc\";s:43:\"How it works & experience the ultimate joy.\";}}', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(2, 'app_desc', '<p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum dolore eu fugiat nulla pariatur lokaim urianewce.</p>\r\n                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumed perspiciatis.</p>', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(3, 'app_android_link', 'https://play.google.com/store/apps/details?id=com.app.amento.worketic', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(4, 'app_ios_link', '#', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(11, 'email_data', 'a:1:{i:0;a:7:{s:10:\"from_email\";s:16:\"info@noreply.com\";s:13:\"from_email_id\";s:16:\"info@noreply.com\";s:11:\"sender_name\";s:6:\"Amento\";s:14:\"sender_tagline\";s:17:\"Your Work Partner\";s:10:\"sender_url\";s:39:\"https://buyniverse.com/\";s:10:\"email_logo\";s:22:\"1555743744-favicon.png\";s:12:\"email_banner\";s:21:\"1555743744-banner.jpg\";}}', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(12, 'section_settings', 'a:1:{i:0;a:12:{s:20:\"home_section_display\";s:4:\"true\";s:10:\"section_bg\";s:21:\"1557484284-banner.jpg\";s:13:\"company_title\";s:16:\"Start As Company\";s:12:\"company_desc\";s:172:\"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum.\";s:11:\"company_url\";s:1:\"#\";s:16:\"freelancer_title\";s:19:\"Start As Freelancer\";s:15:\"freelancer_desc\";s:172:\"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum.\";s:14:\"freelancer_url\";s:1:\"#\";s:19:\"app_section_display\";s:4:\"true\";s:16:\"download_app_img\";s:36:\"1558518016-1557484284-mobile-img.png\";s:9:\"app_title\";s:20:\"Limitless Experience\";s:12:\"app_subtitle\";s:30:\"Roam Around With Your Business\";}}', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(13, 'show-page-1', 'true', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(14, 'show-page-3', '0', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(15, 'access_type', 'both', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(20, 'show-page-7', '0', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(21, 'show-banner-7', '0', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(23, 'show-page-2', '0', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(24, 'show-banner-2', '1', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(25, 'page-banner-2', '1579950098-img-02.jpg', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(26, 'show-page-8', '0', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(27, 'show-banner-8', '0', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(28, 'show-page-9', '0', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(29, 'show-banner-9', '0', '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(50, 'payment_settings', 'a:1:{i:0;a:4:{s:9:\"client_id\";s:36:\"sb-kpy4k5774663@personal.example.com\";s:15:\"paypal_password\";s:80:\"AaT1KCtA9UUrkVvoJ7k-tfYTlvGpBeRfLkUA8nsso2fyErq2LNvQWow3XyyLAbbMJQi8cdIuw8FTgDjY\";s:13:\"paypal_secret\";s:80:\"EOcrgH2EtugqWfroeioJxmwXlMAm9yMFSNpqcswGzA8DVAPEa-ldmv68mH3h3BdD3DQZSR1NAtfGE8wf\";s:14:\"enable_sandbox\";s:5:\"false\";}}', '2021-04-01 07:47:19', '2021-04-01 07:47:19'),
(75, 'project_settings', 'a:1:{s:25:\"enable_completed_projects\";s:4:\"true\";}', '2021-12-25 15:12:45', '2021-12-25 15:12:45'),
(76, 'show-page-5', '0', '2022-01-07 00:58:22', '2022-01-07 00:58:22'),
(77, 'show-banner-5', '0', '2022-01-07 00:58:22', '2022-01-07 00:58:22'),
(78, 'show-page-6', '0', '2022-01-07 00:59:53', '2022-01-07 00:59:53'),
(79, 'show-banner-6', '0', '2022-01-07 00:59:53', '2022-01-07 00:59:53'),
(88, 'footer_settings', 'a:8:{s:11:\"footer_logo\";s:20:\"1554450384-flogo.png\";s:9:\"footer_bg\";s:21:\"1590754782-img-02.jpg\";s:12:\"footer_style\";s:6:\"style1\";s:11:\"description\";s:230:\"Through our marketplace, employers can hire providers to do work in areas such as software development, writing, data entry and design right through to engineering, the sciences, sales and marketing, accounting and legal services.\";s:9:\"copyright\";s:63:\"Copyright © 2019 The Buyniverse, All Right Reserved Amentotech\";s:12:\"menu_title_1\";s:7:\"Company\";s:12:\"menu_pages_1\";a:3:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"4\";}s:5:\"pages\";a:3:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"4\";}}', '2022-06-04 14:23:34', '2022-06-04 14:23:34'),
(90, 'homepage', 'a:1:{s:4:\"home\";s:1:\"5\";}', '2022-06-06 15:40:55', '2022-06-06 15:40:55'),
(92, 'icons', 'a:0:{}', '2022-06-07 14:53:39', '2022-06-07 14:53:39'),
(93, 'search_menu', 'a:1:{i:0;a:2:{s:5:\"title\";s:21:\"Freelancers in Mexico\";s:3:\"url\";s:1:\"#\";}}', '2022-07-28 14:17:06', '2022-07-28 14:17:06'),
(94, 'menu_title', 'Explore More', '2022-07-28 14:17:06', '2022-07-28 14:17:06'),
(95, 'socials', 'a:3:{i:0;a:2:{s:5:\"title\";s:8:\"facebook\";s:3:\"url\";s:1:\"#\";}i:1;a:2:{s:5:\"title\";s:7:\"twitter\";s:3:\"url\";s:1:\"#\";}i:3;a:2:{s:5:\"title\";s:9:\"instagram\";s:3:\"url\";s:1:\"#\";}}', '2022-07-28 14:18:19', '2022-07-28 14:18:19'),
(96, 'settings', 'a:1:{i:0;a:12:{s:5:\"title\";s:10:\"Buyniverse\";s:16:\"connects_per_job\";N;s:12:\"gmap_api_key\";s:39:\"AIzaSyB7Ts0s0dvPVFVa9GIrHxwB6BcJ0THPLak\";s:12:\"chat_display\";s:4:\"true\";s:13:\"enable_loader\";s:4:\"true\";s:13:\"show_earnings\";s:4:\"true\";s:11:\"price_range\";N;s:18:\"enable_theme_color\";s:5:\"false\";s:12:\"header_style\";s:6:\"style1\";s:4:\"logo\";s:19:\"1555333800-logo.png\";s:8:\"language\";s:2:\"en\";s:15:\"body-lang-class\";s:7:\"lang-en\";}}', '2023-01-26 21:03:47', '2023-01-26 21:03:47'),
(97, 'commision', 'a:1:{i:0;a:7:{s:9:\"commision\";s:2:\"10\";s:10:\"min_payout\";s:3:\"250\";s:14:\"payment_method\";a:2:{i:0;s:6:\"paypal\";i:1;s:6:\"stripe\";}s:8:\"currency\";s:3:\"USD\";s:15:\"enable_packages\";s:4:\"true\";s:16:\"employer_package\";s:4:\"true\";s:12:\"payment_mode\";s:5:\"false\";}}', '2023-09-12 11:35:12', '2023-09-12 11:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `approved_by` int(11) DEFAULT NULL,
  `status` enum('appear_globally','appear_user','rejected') NOT NULL DEFAULT 'appear_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`, `user_id`, `admin`, `approved_by`, `status`) VALUES
(1, 'Android', 'android', '', '2021-02-25 05:48:21', '2024-03-21 06:11:49', 1, 1, NULL, 'appear_globally'),
(2, 'API', 'api', '', '2021-02-25 05:48:21', '2024-03-21 06:12:09', 1, 1, NULL, 'appear_globally'),
(4, 'Content Writing', 'content-writing', '', '2021-02-25 05:48:21', '2024-03-21 06:12:22', 1, 1, NULL, 'appear_globally'),
(5, 'CSS', 'css', '', '2021-02-25 05:48:21', '2024-03-21 06:12:40', 1, 1, NULL, 'appear_globally'),
(6, 'Facebook API', 'facebook-api', '', '2021-02-25 05:48:21', '2024-03-21 06:12:56', 1, 1, NULL, 'appear_globally'),
(7, 'Graphic Design', 'graphic-design', '', '2021-02-25 05:48:21', '2024-03-21 06:13:10', 1, 1, NULL, 'appear_globally'),
(8, 'HTML 5', 'html-5', '', '2021-02-25 05:48:21', '2024-03-21 06:13:21', 1, 1, NULL, 'appear_globally'),
(9, 'Java', 'java', '', '2021-02-25 05:48:21', '2024-03-21 06:13:32', 1, 1, NULL, 'appear_globally'),
(10, 'Jquery', 'jquery', '', '2021-02-25 05:48:21', '2024-03-21 06:13:47', 1, 1, NULL, 'appear_globally'),
(11, 'My SQL', 'my-sql', '', '2021-02-25 05:48:21', '2024-03-21 06:13:58', 1, 1, NULL, 'appear_globally'),
(12, 'PHP', 'php', '', '2021-02-25 05:48:21', '2024-03-21 06:14:15', 1, 1, NULL, 'appear_globally'),
(13, 'SEO', 'seo', '', '2021-02-25 05:48:21', '2024-03-21 06:14:49', 1, 1, NULL, 'appear_globally'),
(14, 'Website Design', 'website-design', '', '2021-02-25 05:48:21', '2024-03-21 06:15:03', 1, 1, NULL, 'appear_globally'),
(15, 'WordPress', 'wordpress', '', '2021-02-25 05:48:21', '2024-03-21 06:15:14', 1, 1, NULL, 'appear_globally'),
(16, 'Vuejs', 'vuejs', 'This is vuejs', '2022-01-25 04:33:32', '2024-02-29 06:34:12', 4, 1, 1, 'appear_globally'),
(17, 'Test', 'test', 'One test er', '2024-02-28 05:52:01', '2024-02-28 05:52:01', 1, 1, NULL, 'appear_globally'),
(18, 'Test', 'test-1', 'One test er', '2024-02-28 05:53:02', '2024-02-28 05:53:02', 1, 1, NULL, 'appear_globally'),
(19, 'Test', 'test-2', 'One test er', '2024-02-28 05:55:50', '2024-02-28 05:55:50', 1, 1, NULL, 'appear_globally'),
(20, 'Employer test', 'employer-test', 'This is skill of employer', '2024-02-28 07:12:01', '2024-02-29 06:34:18', 4, 1, 1, 'rejected'),
(21, 'My Test', 'my-test', 'This is my Test One', '2024-06-03 01:09:38', '2024-06-10 11:03:24', 4, 0, NULL, 'appear_user');

-- --------------------------------------------------------

--
-- Table structure for table `skill_user`
--

CREATE TABLE `skill_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `skill_rating` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skill_user`
--

INSERT INTO `skill_user` (`id`, `user_id`, `skill_id`, `skill_rating`, `created_at`, `updated_at`) VALUES
(26, 24, 8, 45, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(27, 24, 10, 45, '2021-02-25 05:48:21', '2021-02-25 05:48:21'),
(29, 21, 10, 14, NULL, NULL),
(30, 21, 11, 89, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_catetories`
--

CREATE TABLE `sub_catetories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category` varchar(191) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_catetories`
--

INSERT INTO `sub_catetories` (`id`, `sub_category`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'cat1', 1, '2021-10-07 12:40:55', '2021-10-07 12:40:55'),
(4, 'cat2', 1, '2021-10-07 12:41:09', '2021-10-07 12:41:09'),
(5, 'cat3', 1, '2021-10-07 12:41:17', '2021-10-07 12:41:17'),
(6, 'cat5', 2, '2021-10-07 12:41:58', '2021-10-07 12:43:14'),
(7, 'cat4', 2, '2021-10-07 12:42:06', '2021-10-07 12:42:34'),
(8, 'cat6', 3, '2021-10-07 12:44:01', '2021-10-07 12:44:01'),
(9, 'cat7', 3, '2021-10-07 12:44:09', '2021-10-07 12:44:09'),
(10, 'cat8', 3, '2021-10-07 12:44:20', '2021-10-07 12:44:20'),
(11, 'cat9', 6, '2021-10-07 12:44:30', '2021-10-07 12:44:30'),
(12, 'cat10', 6, '2021-10-07 12:44:42', '2021-10-07 12:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `sub_job_cats`
--

CREATE TABLE `sub_job_cats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_job_cats`
--

INSERT INTO `sub_job_cats` (`id`, `job_id`, `sub_cat_id`, `created_at`, `updated_at`) VALUES
(29, 116, 2, '2021-12-25 14:33:56', '2021-12-25 14:33:56'),
(30, 116, 5, '2021-12-25 14:33:56', '2021-12-25 14:33:56'),
(31, 116, 7, '2021-12-25 14:33:56', '2021-12-25 14:33:56'),
(32, 116, 12, '2021-12-25 14:33:56', '2021-12-25 14:33:56'),
(33, 117, 2, '2021-12-25 14:38:06', '2021-12-25 14:38:06'),
(34, 117, 5, '2021-12-25 14:38:06', '2021-12-25 14:38:06'),
(35, 117, 7, '2021-12-25 14:38:06', '2021-12-25 14:38:06'),
(36, 117, 12, '2021-12-25 14:38:06', '2021-12-25 14:38:06'),
(37, 118, 6, '2021-12-26 01:09:20', '2021-12-26 01:09:20'),
(38, 118, 7, '2021-12-26 01:09:20', '2021-12-26 01:09:20'),
(39, 119, 4, '2021-12-26 01:26:43', '2021-12-26 01:26:43'),
(40, 119, 5, '2021-12-26 01:26:43', '2021-12-26 01:26:43'),
(41, 119, 7, '2021-12-26 01:26:43', '2021-12-26 01:26:43'),
(42, 120, 2, '2021-12-26 01:30:31', '2021-12-26 01:30:31'),
(43, 121, 6, '2021-12-26 01:43:00', '2021-12-26 01:43:00'),
(44, 122, 2, '2021-12-26 13:38:14', '2021-12-26 13:38:14'),
(45, 122, 4, '2021-12-26 13:38:14', '2021-12-26 13:38:14'),
(46, 123, 2, '2021-12-26 13:51:06', '2021-12-26 13:51:06'),
(47, 124, 6, '2022-01-11 00:00:56', '2022-01-11 00:00:56'),
(48, 125, 7, '2022-01-11 00:06:51', '2022-01-11 00:06:51'),
(49, 126, 7, '2022-01-11 00:34:45', '2022-01-11 00:34:45'),
(50, 127, 11, '2022-01-11 01:56:26', '2022-01-11 01:56:26'),
(51, 128, 2, '2022-01-11 02:15:23', '2022-01-11 02:15:23'),
(52, 129, 6, '2022-01-11 10:38:30', '2022-01-11 10:38:30'),
(53, 130, 11, '2022-03-09 03:00:27', '2022-03-09 03:00:27'),
(54, 131, 1, '2022-04-16 22:26:37', '2022-04-16 22:26:37'),
(55, 131, 0, '2022-04-16 22:26:37', '2022-04-16 22:26:37'),
(56, 132, 4, '2022-04-19 19:35:08', '2022-04-19 19:35:08'),
(57, 133, 1, '2022-05-21 14:56:17', '2022-05-21 14:56:17'),
(58, 134, 1, '2022-05-30 14:59:03', '2022-05-30 14:59:03'),
(59, 135, 1, '2022-06-01 15:50:29', '2022-06-01 15:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `sub_job_skills`
--

CREATE TABLE `sub_job_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `sub_skill_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_job_skills`
--

INSERT INTO `sub_job_skills` (`id`, `job_id`, `sub_skill_id`, `created_at`, `updated_at`) VALUES
(32, 116, 5, '2021-12-25 14:33:56', '2021-12-25 14:33:56'),
(33, 116, 6, '2021-12-25 14:33:56', '2021-12-25 14:33:56'),
(34, 116, 11, '2021-12-25 14:33:56', '2021-12-25 14:33:56'),
(35, 117, 5, '2021-12-25 14:38:06', '2021-12-25 14:38:06'),
(36, 117, 6, '2021-12-25 14:38:06', '2021-12-25 14:38:06'),
(37, 117, 11, '2021-12-25 14:38:06', '2021-12-25 14:38:06'),
(38, 118, 8, '2021-12-26 01:09:20', '2021-12-26 01:09:20'),
(39, 118, 5, '2021-12-26 01:09:20', '2021-12-26 01:09:20'),
(40, 118, 6, '2021-12-26 01:09:20', '2021-12-26 01:09:20'),
(41, 119, 6, '2021-12-26 01:26:43', '2021-12-26 01:26:43'),
(42, 119, 9, '2021-12-26 01:26:43', '2021-12-26 01:26:43'),
(43, 119, 10, '2021-12-26 01:26:43', '2021-12-26 01:26:43'),
(44, 120, 8, '2021-12-26 01:30:31', '2021-12-26 01:30:31'),
(45, 121, 5, '2021-12-26 01:43:00', '2021-12-26 01:43:00'),
(46, 121, 6, '2021-12-26 01:43:00', '2021-12-26 01:43:00'),
(47, 121, 7, '2021-12-26 01:43:00', '2021-12-26 01:43:00'),
(48, 122, 5, '2021-12-26 13:38:14', '2021-12-26 13:38:14'),
(49, 122, 6, '2021-12-26 13:38:14', '2021-12-26 13:38:14'),
(50, 122, 7, '2021-12-26 13:38:14', '2021-12-26 13:38:14'),
(51, 122, 8, '2021-12-26 13:38:14', '2021-12-26 13:38:14'),
(52, 123, 5, '2021-12-26 13:51:06', '2021-12-26 13:51:06'),
(53, 124, 7, '2022-01-11 00:00:56', '2022-01-11 00:00:56'),
(54, 125, 5, '2022-01-11 00:06:51', '2022-01-11 00:06:51'),
(55, 126, 5, '2022-01-11 00:34:45', '2022-01-11 00:34:45'),
(57, 128, 7, '2022-01-11 02:15:23', '2022-01-11 02:15:23'),
(58, 129, 7, '2022-01-11 10:38:30', '2022-01-11 10:38:30'),
(59, 127, 10, '2022-01-11 10:50:48', '2022-01-11 10:50:48'),
(60, 130, 5, '2022-03-09 03:00:27', '2022-03-09 03:00:27'),
(61, 131, 3, '2022-04-16 22:26:37', '2022-04-16 22:26:37'),
(62, 131, 1, '2022-04-16 22:26:37', '2022-04-16 22:26:37'),
(63, 132, 2, '2022-04-19 19:35:08', '2022-04-19 19:35:08'),
(64, 133, 6, '2022-05-21 14:56:17', '2022-05-21 14:56:17'),
(65, 134, 6, '2022-05-30 14:59:03', '2022-05-30 14:59:03'),
(66, 135, 6, '2022-06-01 15:50:29', '2022-06-01 15:50:29'),
(67, 165, 6, '2022-06-28 15:54:32', '2022-06-28 15:54:32'),
(68, 171, 6, '2022-06-29 14:05:37', '2022-06-29 14:05:37'),
(69, 171, 7, '2022-06-29 14:05:52', '2022-06-29 14:05:52'),
(70, 173, 6, '2022-07-20 13:13:22', '2022-07-20 13:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `sub_skills`
--

CREATE TABLE `sub_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_skill` varchar(191) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_skills`
--

INSERT INTO `sub_skills` (`id`, `sub_skill`, `skill_id`, `created_at`, `updated_at`) VALUES
(5, 'skill1', 1, '2021-10-07 12:46:15', '2021-10-07 12:46:15'),
(6, 'skill2', 1, '2021-10-07 12:46:25', '2021-10-07 12:46:25'),
(7, 'skill3', 2, '2021-10-07 12:46:42', '2021-10-07 12:46:42'),
(8, 'skill4', 2, '2021-10-07 12:46:54', '2021-10-07 12:46:54'),
(9, 'skill5', 4, '2021-10-07 12:47:05', '2021-10-07 12:47:05'),
(10, 'skill6', 4, '2021-10-07 12:47:21', '2021-10-07 12:47:21'),
(11, 'skill7', 5, '2021-10-07 12:47:32', '2021-10-07 12:47:32'),
(12, 'skill8', 5, '2021-10-07 12:47:45', '2021-10-07 12:47:45'),
(13, 'skill9', 6, '2021-10-07 12:47:59', '2021-10-07 12:47:59'),
(14, 'skill10', 6, '2021-10-07 12:48:09', '2021-10-07 12:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `description` text NOT NULL,
  `milestone` int(11) DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `priority` int(11) DEFAULT 0,
  `client_visibility` int(11) DEFAULT 0,
  `created_by` int(10) UNSIGNED NOT NULL,
  `assign` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `job_id`, `created_at`, `updated_at`, `status`, `description`, `milestone`, `start_date`, `due_date`, `priority`, `client_visibility`, `created_by`, `assign`) VALUES
(7, 'Tarea 1', 123, '2022-01-11 01:35:48', '2022-01-11 01:35:48', 0, 'Descripción 1', 0, NULL, '2022-01-26', 2, 0, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_users`
--

CREATE TABLE `task_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(191) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lname` varchar(191) NOT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `email`, `role`, `permission`, `job_id`, `created_at`, `updated_at`, `lname`, `added_by`) VALUES
(26, 'Kai', 'freelancer1.worketic@yopmail.com', 'Manager', 1, 116, '2021-12-25 14:34:04', '2021-12-25 14:34:04', 'Clarke', NULL),
(27, 'Kai', 'freelancer1.worketic@yopmail.com', 'Manager', 1, 117, '2021-12-25 14:38:14', '2021-12-25 14:38:14', 'Clarke', NULL),
(28, 'Sadique', 'sadiqueali786@gmail.com', 'Manager', 2, 118, '2021-12-26 01:09:20', '2021-12-26 01:09:20', 'Ali', NULL),
(29, 'Carlitos', 'carlos.padilla@yoipmail.com', 'Manager', 2, 123, '2022-01-11 01:25:06', '2022-01-11 01:25:06', 'Padilla', NULL),
(31, 'team', 'team.member1@yopmail.com', 'Manager', 2, 129, '2022-01-11 10:38:36', '2022-01-11 10:38:36', 'member', NULL),
(32, 'Jhos', 'jhos.perez@yopmail.com', 'Seguimiento', 1, 128, '2022-03-12 20:45:09', '2022-03-12 20:45:09', 'Perez', NULL),
(33, 'Sadique', 'sadiqueali786@gmail.com', 'CEO', 2, 131, '2022-04-16 22:26:37', '2022-04-16 22:26:37', 'Ali', NULL),
(34, 'Sadique', 'sadiqueali786@gmail.com', 'CEO', 1, 132, '2022-04-19 19:35:09', '2022-04-19 19:35:09', 'Ali', NULL),
(35, 'Elon', 'elon@yopmail.com', 'Developer', 1, 201, '2022-08-07 19:40:00', '2022-08-07 19:40:00', 'Watcher', NULL),
(36, 'Juan Carlos', 'juan.gonzalez@en1gm4.com', 'Supervisor', 2, 208, '2023-01-26 21:36:49', '2023-01-26 21:36:49', 'Gonzalez Padilla', NULL),
(41, 'sadi', 'sadi.ali@yopmail.com', 'Demo', 1, 208, '2023-01-26 22:13:18', '2023-01-26 22:13:18', 'Ali', NULL),
(57, 'Some', 'someone@yopmail.com', 'Tester', 1, 224, '2023-11-05 05:27:31', '2023-11-05 05:27:31', 'One', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `badge_id` varchar(191) DEFAULT NULL,
  `expiry_date` varchar(191) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `verification_code` varchar(191) DEFAULT NULL,
  `user_verified` tinyint(4) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_disabled` varchar(191) NOT NULL DEFAULT 'false',
  `nickname` varchar(191) DEFAULT 'nick',
  `role` varchar(191) NOT NULL DEFAULT 'freelancer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `slug`, `email`, `password`, `badge_id`, `expiry_date`, `location_id`, `verification_code`, `user_verified`, `remember_token`, `created_at`, `updated_at`, `is_disabled`, `nickname`, `role`) VALUES
(1, 'chris1', 'evans', 'chris-evans', 'admin.buyniverse@yopmail.com', '$2y$12$62.ZCPoKFwXzxPAReqtli.LH1487xrAAM04oM.5K6j/gDF4ONd2GK', NULL, NULL, NULL, NULL, 1, 'RhIA1IzTQwzoKFcN8DCPrPNTxUkXzEsCDgzfJAbqkIuA89z5GtC4KbUESTYI', '2021-02-25 05:48:20', '2024-06-10 10:56:01', 'false', 'chris', 'admin'),
(4, 'Cooper', 'White', 'cooper-white', 'white.employer@yopmail.com', '$2y$12$msqsmtuzasf00MPfO5BU9.hLwPxUbodW88A0PMsBYc8VZFxu6tdWu', NULL, '2022-08-15 21:29:44', 1, NULL, 1, 'cZIhopqeuI4nlWd9Ok5xt0M7YP7uhHDXFv6DTI20hu4DZhKDQ63eTxTRJe2Y', '2021-02-25 05:48:20', '2024-06-10 12:05:25', 'false', 'cop', 'employer'),
(21, 'Kai', 'Clarke', 'kai-clarke', 'kai.clarke@yopmail.com', '$2y$10$3caJ6KLYFImFDT.pz.CvyekRbo70Fy/6xHQlLYVnwKUKAcNZX.O7K', '1', '2022-08-20 20:48:42', 7, NULL, 1, '8kP0MieDEOxOBI1CpEZUIIA1DcQqXmJIUkFPS2lQNwRvOeSy4TZxolLkgA0I', '2021-02-25 05:48:21', '2024-02-13 20:03:55', 'false', 'kai', 'provider'),
(22, 'Georgia', 'Baker', 'georgia-baker', 'gbaker@yopmail.com', '$2y$10$hfQds7MIQCE0vwyeg/zUPelyf19BruffhCIM5f3gO7BbsRkWxIJUa', '3', '2022-11-25 11:40:43', 7, NULL, 1, '5rSCCuyQIQ13Qt29i62Txkn1SR7dHcBBxAiRVmXMzT5NZHzbdZHQccxnXChN', '2021-02-25 05:48:21', '2022-11-15 11:40:43', 'false', '', 'freelancer'),
(23, 'Ralph', 'Davis', 'ralph-davis', 'ralph.davis@yopmail.com', '$2y$10$ewSUxmqO3jnmhKsciMwhlufN71deUgJcHAFD.kPUPe6wTnMBdKMd6', '3', '2022-11-25 11:44:30', 8, NULL, 1, 'aik5KKC4K11KmNFu26ndvbV9X1NINJgswNWSi0iNWPlxWMydLIaN2DrMqcQO', '2021-02-25 05:48:21', '2022-11-15 11:44:30', 'false', '', 'freelancer'),
(24, 'Alexa', 'Xavier', 'jhon-xavier', 'alexa.xavier@yopmail.com', '$2y$10$aRRqCCm87Swkm5kx49Qmn.yvQaMnLRCXmZl8l/YbFXTJxiA/SeSZO', '3', '2022-11-25 11:56:59', 8, NULL, 1, 'cNYQ3QkRKuzbCbu4srxRsQmfcLqBY8hHuHZcrIxxEOcth2k6VO4KmRfaT12J', '2021-02-25 05:48:21', '2022-11-15 11:56:59', 'false', '', 'freelancer'),
(33, 'jesus', 'jesus', 'jesus-jesus', 'jechaviz@gmail.com', '$2y$10$A/KlNYrfXkNXGcFBnuoKLu.1iXu/BhMRYhNArb.zkPUsKKsiBKxm2', NULL, NULL, NULL, NULL, 1, NULL, '2021-12-16 23:47:04', '2022-11-15 11:59:30', 'false', 'jesus', 'employer'),
(58, 'Elon', 'Watcher', 'elon-watcher', 'elon@yopmail.com', '$2y$10$kKGfJ273L4E9s0dC4DBwhugYAuG9c111n3/gGYYmcJXgfqmRkJJ7S', '3', '2022-11-25 12:01:36', NULL, NULL, 1, NULL, '2022-08-07 19:39:54', '2022-11-15 12:01:36', 'false', 'Elon', 'freelancer'),
(59, 'Sadique', 'Ali', 'sadique-ali', 'sadiqueali786@gmail.com', '$2y$10$uhjGuWl7cHWhYhpGYt8xHOD3RqXdNde3cDGzYgItrxJJkQN2ac47y', NULL, NULL, NULL, NULL, 1, '9IjbNnvocugETDUlJKHsFLNCBsqCjm5ehzAIuNBCJZMsqbrUumu46MVDTCb1', '2022-09-09 14:04:49', '2022-09-09 14:18:30', 'false', 'Sadique', 'employer'),
(69, 'tests', 'one', 'tester-one', 'testerone@yopmail.com', '$2y$10$Cij353TNBu8QPkLq.4ptC.Zvx1zR.UX1G8PEX6Vyr.Sq6Jale8.ha', NULL, NULL, 7, NULL, NULL, NULL, '2022-10-22 09:28:34', '2022-10-22 09:30:10', 'false', 'tester', 'freelancer'),
(70, 'Alexa', 'Jones', 'alexa-jones', 'alexa@yopmail.com', '$2y$10$6I5f1OUmm2nc1MnMLH465OufxHwXTX86krWvRKEcnuNQlo5AST2au', NULL, NULL, NULL, 'SCQC', 0, NULL, '2023-01-26 21:08:37', '2023-01-26 21:08:37', 'false', 'Alexa', 'freelancer'),
(71, 'Juan Carlos', 'Gonzalez Padilla', 'juan-carlos-gonzalez-padilla', 'juan.gonzalez@en1gm4.com', '$2y$10$Zu9EjKJz5h/ZzKb8Ikktme8ZaPyuI1eDpz.K.04Kt0is3XJX.1oUK', NULL, NULL, NULL, NULL, 1, NULL, '2023-01-26 21:36:43', '2023-01-26 21:36:43', 'false', 'Juan Carlos', 'freelancer'),
(72, 'Jorge', 'Becerril', 'jorge-becerril', 'jorge.becerril@yopmail.com', '$2y$10$VF2.eDTaEfU17KQ/pg34EeuQtaCdjfvZ2IF.JpLdV4dmynQvRbwN.', NULL, NULL, NULL, NULL, 1, NULL, '2023-01-26 21:38:21', '2023-01-26 21:47:21', 'false', 'Jorge', 'employer'),
(73, 'sadi', 'Ali', 'sadi-ali', 'sadi.ali@yopmail.com', '$2y$10$DYxljECpJRzOOFgHQhJcZOwL68aKUgwyRETxG3CgJUOWGlbxhbCIe', NULL, NULL, NULL, NULL, 1, NULL, '2023-01-26 22:13:12', '2023-01-26 22:13:12', 'false', 'sadi', 'freelancer'),
(74, 'sadic', 'Ali', 'sadic-ali', 'sadic.ali@yopmail.com', '$2y$10$VqculqOhWN1ZN9GlsfORDOWk8YvCO6BRr92BVgPLTswqcGNEGemGu', NULL, NULL, NULL, NULL, 1, NULL, '2023-01-26 22:13:37', '2023-01-26 22:13:37', 'false', 'sadic', 'freelancer'),
(75, 'Juan', 'Gonzalez', 'juan-gonzalez', 'juan.glz@yopmail.com', '$2y$10$6uxowXzPhjF01lKofsoKfe6oFqI0H1P7fBrWe8rWkNRJwHHg8Uani', NULL, NULL, NULL, NULL, 1, NULL, '2023-02-02 20:42:31', '2023-02-02 20:43:26', 'false', 'Juan', 'employer'),
(76, 'Leo', 'Tolsoy', 'leo-tolsoy', 'leo@yopmail.com', '$2y$10$K8XZOjE1sDz1XyRWEbeIR.0JnMsu2e2xk58gd0bRHTn8eBQPIJnuG', NULL, NULL, NULL, NULL, 1, 'XRgs32zzVewOrpnQinECu3DwUf1grEClJiasAio8Vb5kXrjs9lUjJK2V6llL', '2023-02-18 14:22:07', '2023-02-18 14:25:30', 'false', 'Leo', 'employer'),
(77, 'test', 'aprover', 'test-aprover', 'test.aprover@yopmail.com', '$2y$10$8zHV3p/.vNIqshLOFVTvq.HKDRecS4DOADe.iYaFvDvb1IzEv026K', NULL, NULL, NULL, NULL, 1, NULL, '2023-02-27 22:43:09', '2023-02-27 22:49:34', 'false', 'test', 'employer'),
(78, 'Sadique', 'Ali', 'sadique-ali-1', 'sadiquea@yopmail.com', '$2y$10$gf.e9vEHxFlVaIk6U7FDW.PudoSa/d3YFUZhThHYItIwq.HF0jw7y', NULL, NULL, NULL, NULL, 1, 'g0iIHUnU0xxSdzxeeraYBB5yDfcYjjkahSY7T3lYV1jS1N8sZeNTwxwpy8IJ', '2023-03-11 12:51:31', '2023-03-11 12:54:56', 'false', 'Sadique', 'employer'),
(79, 'Hector', 'Algo', 'hector-algo', 'halgo@yopmail.com', '$2y$10$YQrxDwz7USnzYWLqalia7.k0rLUbJZecPe33fXnkkpGCiPBBVBotO', NULL, NULL, NULL, NULL, 1, NULL, '2023-11-01 20:01:23', '2023-11-01 20:01:23', 'false', 'Hector', 'freelancer'),
(80, 'Some', 'One', 'some-one', 'someone@yopmail.com', '$2y$10$vOOzwxP3ihmz3eYs5napN.TgRmkz8bwtWQubR5uMZrhY9PzY3KN4q', NULL, NULL, NULL, NULL, 1, NULL, '2023-11-02 11:49:46', '2023-11-02 11:49:46', 'false', 'Some', 'freelancer'),
(81, 'Tester', 'Tester', '', 'tester@yopmail.com', '$2y$10$nvls9RzYXHLTy6xjPNvWE.deH.DEmQUkAsL77oED6mJiy/AzJVbgG', NULL, NULL, NULL, NULL, 1, NULL, '2023-11-05 06:52:11', '2023-11-05 06:52:11', 'false', 'nick', 'freelancer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approvers`
--
ALTER TABLE `approvers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_user_id_foreign` (`user_id`);

--
-- Indexes for table `article_categories`
--
ALTER TABLE `article_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_category_article_id_foreign` (`article_id`),
  ADD KEY `article_category_article_category_id_foreign` (`article_category_id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catables`
--
ALTER TABLE `catables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_skills`
--
ALTER TABLE `cat_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatrooms`
--
ALTER TABLE `chatrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_location`
--
ALTER TABLE `child_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_pages`
--
ALTER TABLE `child_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_bids`
--
ALTER TABLE `contest_bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_times`
--
ALTER TABLE `delivery_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disputes`
--
ALTER TABLE `disputes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_types`
--
ALTER TABLE `email_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `english_levels`
--
ALTER TABLE `english_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fteams`
--
ALTER TABLE `fteams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `i_p_n_statuses`
--
ALTER TABLE `i_p_n_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jobs_slug_unique` (`slug`),
  ADD KEY `jobs_user_id_index` (`user_id`);

--
-- Indexes for table `job_chats`
--
ALTER TABLE `job_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_files`
--
ALTER TABLE `job_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_invites`
--
ALTER TABLE `job_invites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_notes`
--
ALTER TABLE `job_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_quizzes`
--
ALTER TABLE `job_quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_skill`
--
ALTER TABLE `job_skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_tickets`
--
ALTER TABLE `job_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langables`
--
ALTER TABLE `langables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_slug_unique` (`slug`);

--
-- Indexes for table `live_contests`
--
ALTER TABLE `live_contests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_contest_participants`
--
ALTER TABLE `live_contest_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_slug_unique` (`slug`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_index` (`user_id`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metas_metable_type_metable_id_index` (`metable_type`,`metable_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `note_users`
--
ALTER TABLE `note_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packages_slug_unique` (`slug`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payouts_user_id_index` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_messages_to`
--
ALTER TABLE `private_messages_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal_documents`
--
ALTER TABLE `proposal_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal_files`
--
ALTER TABLE `proposal_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providerinvites`
--
ALTER TABLE `providerinvites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_types`
--
ALTER TABLE `provider_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `response_times`
--
ALTER TABLE `response_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_index` (`user_id`);

--
-- Indexes for table `review_options`
--
ALTER TABLE `review_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `service_user`
--
ALTER TABLE `service_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_managements`
--
ALTER TABLE `site_managements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skills_slug_unique` (`slug`);

--
-- Indexes for table `skill_user`
--
ALTER TABLE `skill_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_catetories`
--
ALTER TABLE `sub_catetories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_job_cats`
--
ALTER TABLE `sub_job_cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_job_skills`
--
ALTER TABLE `sub_job_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_skills`
--
ALTER TABLE `sub_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_users`
--
ALTER TABLE `task_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_slug_unique` (`slug`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `approvers`
--
ALTER TABLE `approvers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `article_categories`
--
ALTER TABLE `article_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catables`
--
ALTER TABLE `catables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cat_skills`
--
ALTER TABLE `cat_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chatrooms`
--
ALTER TABLE `chatrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `child_location`
--
ALTER TABLE `child_location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `child_pages`
--
ALTER TABLE `child_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_bids`
--
ALTER TABLE `contest_bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `delivery_times`
--
ALTER TABLE `delivery_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `disputes`
--
ALTER TABLE `disputes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `email_types`
--
ALTER TABLE `email_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `english_levels`
--
ALTER TABLE `english_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fteams`
--
ALTER TABLE `fteams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `i_p_n_statuses`
--
ALTER TABLE `i_p_n_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `job_chats`
--
ALTER TABLE `job_chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_files`
--
ALTER TABLE `job_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `job_invites`
--
ALTER TABLE `job_invites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `job_notes`
--
ALTER TABLE `job_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_quizzes`
--
ALTER TABLE `job_quizzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `job_skill`
--
ALTER TABLE `job_skill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `job_tickets`
--
ALTER TABLE `job_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `langables`
--
ALTER TABLE `langables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `live_contests`
--
ALTER TABLE `live_contests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `live_contest_participants`
--
ALTER TABLE `live_contest_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `note_users`
--
ALTER TABLE `note_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `private_messages_to`
--
ALTER TABLE `private_messages_to`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `proposal_documents`
--
ALTER TABLE `proposal_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal_files`
--
ALTER TABLE `proposal_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `providerinvites`
--
ALTER TABLE `providerinvites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `provider_types`
--
ALTER TABLE `provider_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `response_times`
--
ALTER TABLE `response_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `review_options`
--
ALTER TABLE `review_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service_user`
--
ALTER TABLE `service_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `site_managements`
--
ALTER TABLE `site_managements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `skill_user`
--
ALTER TABLE `skill_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sub_catetories`
--
ALTER TABLE `sub_catetories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_job_cats`
--
ALTER TABLE `sub_job_cats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `sub_job_skills`
--
ALTER TABLE `sub_job_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `sub_skills`
--
ALTER TABLE `sub_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task_users`
--
ALTER TABLE `task_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_article_category_id_foreign` FOREIGN KEY (`article_category_id`) REFERENCES `article_categories` (`id`),
  ADD CONSTRAINT `article_category_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

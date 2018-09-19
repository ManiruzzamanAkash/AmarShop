-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2017 at 02:14 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `username`, `description`, `division_id`, `district_id`, `phone`, `is_verified`, `is_company`, `is_admin`, `status`, `ip`, `street_address`, `website`, `latitude`, `langitude`, `rating_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'manirujjamanakash@gmail.com', '$2y$10$3o8QwkajwKqABxa51WzXE.iaWGHTHq/0IYwAFVDuBQyjRnxiWxr5S', 'Maniruzzaman Akash', 'maniruzzaman-akash', NULL, 5, 19, '01951233084', 0, 0, 0, 1, NULL, 'Patuakhali, Bangladesh', NULL, NULL, NULL, 0, 'yjkM1m1AKsj7CbFookpXUTG4QUlPIxS3PIjhDOfU6GtJ2ViJKJwa7x6nHj3X', '2017-11-07 01:41:52', '2017-11-07 01:41:52'),
(2, 'boshundhara@gmail.com', '$2y$10$3o8QwkajwKqABxa51WzXE.iaWGHTHq/0IYwAFVDuBQyjRnxiWxr5S', 'Boshundhara City Complex', 'boshundhara-city', 'Boshundhara City Complex is one of the most largest shopping center in Bangladesh. It has gained the popularity for it\'s high standard products and services to the client.Enjoy marketing', 5, 19, '01951233084', 0, 1, 0, 1, NULL, 'Patuakhali, Bangladesh', 'http://www.bashundhara-city.com/', NULL, NULL, 0, 'doxCceBMd1cXkOSikmYXj1A16GxgRGHaEXqPAAXSa7rAHsUQmkC1aqSNYaR3', '2017-11-07 01:41:52', '2017-11-07 01:41:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

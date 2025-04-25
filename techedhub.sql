-- Database: `techedhub`
--
--
-- Table structure for table `users`
--
--table for user
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) 
 --table for profile
CREATE TABLE profile (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(100),
    `last_name` VARCHAR(100),
    `email` VARCHAR(100),
    `phone` VARCHAR(20),
    `dob` DATE,
    `gender` VARCHAR(10),
    `profile_image` VARCHAR(255)
);

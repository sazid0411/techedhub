-- Database: `techedhub`
--
--
-- Table structure for table `users`
--
--table for user
CREATE TABLE `users` (
  `id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
--   `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` VARCHAR(100),
    `last_name` VARCHAR(100),
    `phone` VARCHAR(20),
    `dob` DATE,
    `gender` VARCHAR(10),
    `profile_image` VARCHAR(255),
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) 
 --table for profile
CREATE TABLE profile (
    `first_name` VARCHAR(100),
    `last_name` VARCHAR(100),
    `phone` VARCHAR(20),
    `dob` DATE,
    `gender` VARCHAR(10),
    `profile_image` VARCHAR(255)
);


-- classes
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- chapters
CREATE TABLE chapters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT,
    title VARCHAR(100),
    FOREIGN KEY (class_id) REFERENCES classes(id)
);

-- topics
CREATE TABLE topics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT,
    title VARCHAR(100),
    video_url TEXT,
    FOREIGN KEY (chapter_id) REFERENCES chapters(id)
);




    CREATE TABLE courses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        class VARCHAR(100) NOT NULL,
        instructor_name VARCHAR(255) NOT NULL,
        total_lectures INT NOT NULL,
        duration VARCHAR(100) NOT NULL,
        level VARCHAR(50) NOT NULL,
        language VARCHAR(50) NOT NULL,
        price DOUBLE(10, 2) NOT NULL,
        thumbnail VARCHAR(500) NOT NULL,
        description TEXT NOT NULL,
        status ENUM('active', 'inactive') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

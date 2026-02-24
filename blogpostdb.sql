

--==================================
--Users Table
--==================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(10) NOT NULL,
    role ENUM('admin', 'author', 'subscriber') NOT NULL 
);

--==================================
--Categories Table
--==================================
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

--==================================
--Posts Table
--==================================
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id INT,
    category_id INT,
    image VARCHAR(255),

    FOREIGN KEY (author_id) REFERENCES users(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE,

    FOREIGN KEY (category_id) REFERENCES categories(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);

--==================================
--Comments Table
--==================================
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL,
    comment TEXT NOT NULL,

    FOREIGN KEY (post_id) REFERENCES posts(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
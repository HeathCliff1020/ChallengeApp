The Database contains the users table described as follows:

CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(320) NOT NULL UNIQUE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO users(username, password, email) VALUES("Heath Cliff", "ThisisCool", "heathcliff1020@gmail.com");

This change is made by Amber to test synching of the project.
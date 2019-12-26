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
This change is made by Amber to test synching of the project. Part 2.

This is a change made by Mukesh to test the synching of the project.


Added a column in database specifying weather the user has verified his email of not.


ALTER TABLE users ADD is_verified INTEGER;

Case sensitibe sql search :-

Select * from a_table where attribute = 'k' COLLATE Latin1_General_CS_AS 


Add the hash filed in the database for the email verification

ALTER TABLE users ADD hash VARCHAR(100);


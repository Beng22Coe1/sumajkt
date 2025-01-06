CREATE TABLE users(
	id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    second_name VARCHAR(100),
    last_name VARCHAR(100),
    role VARCHAR(20),
    email VARCHAR(100),
    phone VARCHAR(20)
);

CREATE TABLE products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    path VARCHAR(250),
    description VARCHAR(500)
);
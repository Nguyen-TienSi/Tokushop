CREATE DATABASE tokushop;

CREATE TABLE category1 (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    is_displayed TINYINT(1) NOT NULL
);

CREATE TABLE category2 (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    is_displayed TINYINT(1) NOT NULL
);

CREATE TABLE product (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    category1_id INT NOT NULL,
    category2_id INT NOT NULL,
    description TEXT,
    represent_img TEXT,
    otherImgs TEXT,
    import_date DATE NOT NULL,
    is_displayed TINYINT(1) NOT NULL,
    FOREIGN KEY (category1_id) REFERENCES category1(id),
    FOREIGN KEY (category2_id) REFERENCES category2(id)
);

CREATE TABLE `user` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    role ENUM('customer', 'admin') NOT NULL,
    name VARCHAR(255),
    phone VARCHAR(10) UNIQUE,
    email VARCHAR(255) UNIQUE,
    address VARCHAR(255),
    is_locked TINYINT(1) NOT NULL
);

CREATE TABLE cart (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    fake_user_id VARCHAR(255) NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    choose_date DATE,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);

CREATE TABLE `order` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(10) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    note TEXT,
    create_date DATE NOT NULL,
    update_date DATE,
    order_state ENUM('Chờ xác nhận', 'Đã xác nhận', 'Đã hủy') NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE order_item (
    order_id INT NOT NULL,
    product_id INT NOT NULL, 
    quantity INT,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES `order`(id),
    FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);

CREATE TABLE slideshow (
    id INT PRIMARY KEY AUTO_INCREMENT,
    img TEXT NOT NULL,
    title VARCHAR(255) NOT NULL,
    is_displayed TINYINT(1) NOT NULL
);

CREATE TABLE contact (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_id INT NULL,
    request TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES `user`(id)
);

CREATE TABLE coupon (
    id INT PRIMARY KEY AUTO_INCREMENT,
    coupon_code VARCHAR(255) NOT NULL,
    discount DECIMAL(10, 2) NOT NULL,
    is_valid TINYINT(1) NOT NULL
);

INSERT INTO category1 (category_name, is_displayed) VALUES
('Khác', 1),
('Gaoranger', 1),
('Hurricanger', 1),
('Abaranger', 1),
('Dekaranger', 1),
('Magiranger', 1),
('Boukenger', 1),
('Gekiranger', 1),
('Go-Onger', 1),
('Shinkenger', 1),
('Goseiger', 1),
('Gokaiger', 1);

INSERT INTO category2 (category_name, is_displayed) VALUES
('New seal', 1),
('Fullbox', 1),
('Có lỗi', 1);
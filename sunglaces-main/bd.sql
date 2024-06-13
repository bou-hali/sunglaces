CREATE DATABASE optitrend;

USE optitrend;

CREATE TABLE Clients (
    client_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    address VARCHAR(255),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Suppliers (
    supplier_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    address VARCHAR(255),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Admins (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE Products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Brands (
    idbrand INT PRIMARY KEY AUTO_INCREMENT,
    idp INT,
    designation VARCHAR(100) NOT NULL,
    FOREIGN KEY (idp) REFERENCES Products(product_id) ON DELETE CASCADE
);

CREATE TABLE Categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    name VARCHAR(100) NOT NULL
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE,
);



CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT,
    order_date DATE NOT NULL,
    status VARCHAR(50) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    address VARCHAR(255) NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Clients(client_id) ON DELETE CASCADE
);

CREATE TABLE Order_Details (
    order_detail_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE
);

CREATE TABLE Purchase_Orders (
    purchase_order_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    supplier_id INT,
    purchase_price DECIMAL(10, 2) NOT NULL,
    purchase_date DATE NOT NULL,
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (supplier_id) REFERENCES Suppliers(supplier_id) ON DELETE CASCADE
);

CREATE TABLE Purchase_Order_Details (
    purchase_order_detail_id INT PRIMARY KEY AUTO_INCREMENT,
    purchase_order_id INT,
    quantity INT NOT NULL,
    FOREIGN KEY (purchase_order_id) REFERENCES Purchase_Orders(purchase_order_id) ON DELETE CASCADE
);

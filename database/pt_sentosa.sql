CREATE DATABASE IF NOT EXISTS pt_sentosa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pt_sentosa;

DROP TABLE IF EXISTS invoice_items;
DROP TABLE IF EXISTS invoices;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS suppliers;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS units;

CREATE TABLE units (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	description TEXT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE suppliers (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(30) NOT NULL,
	name VARCHAR(150) NOT NULL,
	address TEXT NOT NULL,
	city VARCHAR(100) NOT NULL,
	phone VARCHAR(50) NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE customers (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(30) NOT NULL,
	name VARCHAR(150) NOT NULL,
	address TEXT NOT NULL,
	city VARCHAR(100) NOT NULL,
	contact_person VARCHAR(100) NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	role VARCHAR(50) NOT NULL DEFAULT 'admin',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE products (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(30) NOT NULL,
	name VARCHAR(150) NOT NULL,
	unit_id INT UNSIGNED NOT NULL,
	default_price DECIMAL(15,2) NOT NULL DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_products_unit FOREIGN KEY (unit_id) REFERENCES units(id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE invoices (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	invoice_no VARCHAR(50) NOT NULL,
	invoice_date DATE NOT NULL,
	supplier_id INT UNSIGNED NOT NULL,
	customer_id INT UNSIGNED NOT NULL,
	purchasing_name VARCHAR(100) NOT NULL,
	recipient_name VARCHAR(100) NOT NULL,
	notes TEXT NULL,
	total_quantity DECIMAL(15,2) NOT NULL DEFAULT 0,
	total_unit_price DECIMAL(15,2) NOT NULL DEFAULT 0,
	grand_total DECIMAL(15,2) NOT NULL DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_invoices_supplier FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_invoices_customer FOREIGN KEY (customer_id) REFERENCES customers(id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE invoice_items (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	invoice_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	unit_id INT UNSIGNED NULL,
	quantity DECIMAL(15,2) NOT NULL DEFAULT 0,
	price DECIMAL(15,2) NOT NULL DEFAULT 0,
	total_price DECIMAL(15,2) NOT NULL DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT fk_items_invoice FOREIGN KEY (invoice_id) REFERENCES invoices(id)
		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_items_product FOREIGN KEY (product_id) REFERENCES products(id)
		ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_items_unit FOREIGN KEY (unit_id) REFERENCES units(id)
		ON UPDATE CASCADE ON DELETE SET NULL
);

INSERT INTO units (id, name, description) VALUES
	(1, 'Pcs', 'Satuan Pieces'),
	(2, 'Dus', 'Satuan Dus'),
	(3, 'Liter', 'Satuan Liter');

INSERT INTO suppliers (id, code, name, address, city, phone) VALUES
	(1, 'SUP01', 'PT. Bhinneka Sangkuriang Transport', 'Jl. Cokelat Selatan IV 121A, Cisaranten Kidul, Kec. Gedebage', 'Bandung, Jawa Barat 40252', '022-000000');

INSERT INTO customers (id, code, name, address, city, contact_person) VALUES
	(1, 'CUS01', 'PT. Sentosa', 'Jl. Bypass Cirebon', 'Cirebon', 'Robert');

INSERT INTO users (id, name, username, password, role) VALUES
	(1, 'Administrator', 'admin', '$2y$12$8XSRUsaY49IVY2U2wuOn8.QCz0zRh2GUlDz24aeeLn7tAXk64K2w6', 'admin');

INSERT INTO products (id, code, name, unit_id, default_price) VALUES
	(1, 'PR01', 'Ban Luar', 1, 2300000),
	(2, 'PR02', 'Baut Ukuran 18', 2, 110000),
	(3, 'PR03', 'Oli Mesin', 3, 125000);

INSERT INTO invoices (id, invoice_no, invoice_date, supplier_id, customer_id, purchasing_name, recipient_name, notes, total_quantity, total_unit_price, grand_total) VALUES
	(1, '034/TD/XI/2024', '2024-06-25', 1, 1, 'Ilham', 'Robert', 'Data awal berdasarkan gambar soal.', 34, 2535000, 25925000);

INSERT INTO invoice_items (invoice_id, product_id, unit_id, quantity, price, total_price) VALUES
	(1, 1, 1, 10, 2300000, 23000000),
	(1, 2, 2, 5, 110000, 550000),
	(1, 3, 3, 19, 125000, 2375000);
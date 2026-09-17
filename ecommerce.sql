CREATE DATABASE IF NOT EXISTS course_ecommerce;
USE course_ecommerce;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(500) NOT NULL,
    category VARCHAR(50) NOT NULL
);

ALTER TABLE products MODIFY image VARCHAR(500) NOT NULL;

DELETE FROM products;
ALTER TABLE products AUTO_INCREMENT = 1;

INSERT INTO products (name, description, price, image, category) VALUES
('Nova Laptop', 'Lightweight laptop for study, browsing, and everyday work.', 899.00, 'https://images.unsplash.com/photo-1657524433787-a30cefc92661?auto=format&fit=crop&w=1000&q=80', 'Computers'),
('Pulse Headphones', 'Comfortable over-ear headphones with a clean modern design.', 129.50, 'https://images.unsplash.com/photo-1505740106531-4243f3831c78?auto=format&fit=crop&w=1000&q=80', 'Audio'),
('Slate Keyboard', 'Compact mechanical keyboard designed for a clean desk setup.', 74.99, 'https://images.unsplash.com/photo-1678269985929-1bfe9d332d2c?auto=format&fit=crop&w=1000&q=80', 'Accessories'),
('Orbit Mouse', 'Wireless mouse with a smooth shape for comfortable daily use.', 39.90, 'https://images.unsplash.com/photo-1746276584066-7ee8c5e742e0?auto=format&fit=crop&w=1000&q=80', 'Accessories'),
('Focus Camera', 'Digital camera for photos, travel, and creative projects.', 549.00, 'https://images.unsplash.com/photo-1596717650633-95b4970c7883?auto=format&fit=crop&w=1000&q=80', 'Cameras'),
('Echo Speaker', 'Portable wireless speaker for music at home or on the go.', 89.00, 'https://images.unsplash.com/photo-1612795146974-84dbe538f4a4?auto=format&fit=crop&w=1000&q=80', 'Audio'),
('Edge Phone', 'Smartphone with a bright display and a modern minimalist body.', 699.00, 'https://images.unsplash.com/photo-1541591708423-9001fe827349?auto=format&fit=crop&w=1000&q=80', 'Phones'),
('Time Smartwatch', 'Simple smartwatch for notifications and everyday activity.', 199.00, 'https://images.unsplash.com/photo-1648999954500-83f969151b96?auto=format&fit=crop&w=1000&q=80', 'Wearables');

/*========== USERS TABLE ==========*/
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    mobile VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at DATETIME NOT NULL
);

/*========== PASSWORD RESET TABLE ==========*/
CREATE TABLE IF NOT EXISTS password_reset (
    email VARCHAR(255) PRIMARY KEY,
    token_hash CHAR(64) NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at DATETIME NOT NULL
);

/*========== PRICING TABLE TABLE ==========*/
CREATE TABLE IF NOT EXISTS pricing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cloth_type VARCHAR(50) NOT NULL UNIQUE,
    price DECIMAL(10,2) DEFAULT 0.00,
    last_updated DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO pricing (cloth_type, price) VALUES
('Topwear', 40.00),
('Bottomwear', 50.00),
('Outerwear', 90.00),
('Traditional Wear', 180.00),
('Bedding', 100.00),
('Accessories', 30.00)
ON DUPLICATE KEY UPDATE cloth_type = cloth_type;

/*========== LAUNDRY REQUESTS TABLE ==========*/
CREATE TABLE IF NOT EXISTS laundry_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    mobile VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pickup_date DATE,
    pickup_time VARCHAR(20),
    pickup_address TEXT,
    delivery_address TEXT,
    additional_details TEXT,
    payment VARCHAR(20),
    total DECIMAL(10,2),
    status ENUM('pending','processing','completed','cancelled') DEFAULT 'pending',
    notification ENUM('unseen','seen') DEFAULT 'unseen',
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

/*========== LAUNDRY REQUESTS ITEMS TABLE ==========*/
CREATE TABLE IF NOT EXISTS laundry_request_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT NOT NULL,
    item_name VARCHAR(50) NOT NULL,
    item_price DECIMAL(10,2) DEFAULT 0.00,
    item_qty INT DEFAULT 0,
    item_total DECIMAL(10,2) DEFAULT 0.00,

    FOREIGN KEY (request_id) REFERENCES laundry_requests(request_id) ON DELETE CASCADE
);
# Database Schema Documentation

## Overview

Sierra Shop uses a MySQL database with UTF-8 encoding. The schema is designed to support e-commerce operations with proper relationships and constraints.

## Tables

### users
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);
```

### roles
```sql
CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    permissions TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### products
```sql
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    sale_price DECIMAL(10,2),
    stock INT NOT NULL DEFAULT 0,
    category_id INT,
    image VARCHAR(255),
    status ENUM('active', 'inactive', 'deleted') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
```

### categories
```sql
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    parent_id INT,
    description TEXT,
    image VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES categories(id)
);
```

### orders
```sql
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
    shipping_address TEXT NOT NULL,
    billing_address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### order_items
```sql
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
```

### comments
```sql
CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    content TEXT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    status ENUM('pending', 'approved', 'spam') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
```

### slides
```sql
CREATE TABLE slides (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255),
    sort_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Relationships

### User Related
- users → roles (Many-to-One)
- users → orders (One-to-Many)
- users → comments (One-to-Many)

### Product Related
- products → categories (Many-to-One)
- products → order_items (One-to-Many)
- products → comments (One-to-Many)

### Order Related
- orders → users (Many-to-One)
- orders → order_items (One-to-Many)
- order_items → products (Many-to-One)

## Indexes

### Primary Keys
- All tables have auto-incrementing primary key `id`

### Foreign Keys
- roles: role_id in users
- categories: category_id in products, parent_id in categories
- products: product_id in order_items, comments
- orders: order_id in order_items
- users: user_id in orders, comments

### Additional Indexes
- users: username, email (UNIQUE)
- products: slug (UNIQUE)
- categories: slug (UNIQUE)
- orders: user_id, status
- comments: product_id, user_id

## Constraints

### Data Integrity
- Foreign key constraints on all relationships
- NOT NULL constraints on critical fields
- UNIQUE constraints on usernames, emails, and slugs
- CHECK constraints on ratings (1-5)

### Enums
- product status: active, inactive, deleted
- order status: pending, processing, shipped, delivered, cancelled
- payment status: pending, paid, failed
- comment status: pending, approved, spam

## Maintenance

### Backup
```sql
mysqldump -u [user] -p [database] > backup.sql
```

### Optimization
```sql
ANALYZE TABLE [table_name];
OPTIMIZE TABLE [table_name];
```

### Common Queries

1. Get Product with Category:
```sql
SELECT p.*, c.name as category_name 
FROM products p 
LEFT JOIN categories c ON p.category_id = c.id 
WHERE p.id = ?;
```

2. Get Order with Items:
```sql
SELECT o.*, oi.*, p.name as product_name 
FROM orders o 
JOIN order_items oi ON o.id = oi.order_id 
JOIN products p ON oi.product_id = p.id 
WHERE o.id = ?;
```

3. Get Product Ratings:
```sql
SELECT AVG(rating) as avg_rating, COUNT(*) as total_ratings 
FROM comments 
WHERE product_id = ? AND status = 'approved';
```

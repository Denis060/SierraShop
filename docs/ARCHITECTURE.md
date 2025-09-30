# Architecture Guide

## Overview

Sierra Shop is built on a custom MVC (Model-View-Controller) framework designed for e-commerce applications. This guide explains the system architecture and design patterns used.

## Directory Structure

```
admin/          # Admin panel components
  controllers/  # Admin control logic
  models/       # Data models for admin
  views/        # Admin interface templates
  database/     # Database schema and backups
  themes/       # Admin UI assets

content/        # Frontend components
  controllers/  # Frontend control logic
  models/       # Frontend data models
  views/        # Frontend templates

lib/            # Core framework
  config/       # Configuration files
  functions.php # Helper functions
  model.php     # Base model class
  counter.php   # Statistics tracking
  
public/         # Public assets
  css/         # Stylesheets
  js/          # JavaScript files
  img/         # Images
  upload/      # User uploads

vendor/         # Dependencies
```

## Core Components

### MVC Pattern

1. **Models (`admin/models/, content/models/`)**
   - Handle data and business logic
   - Interact with database
   - Validate data
   - Example: `products.php`, `orders.php`

2. **Views (`admin/views/, content/views/`)**
   - Present data to users
   - Handle layout and templating
   - No business logic
   - Example: `product/list.php`, `order/detail.php`

3. **Controllers (`admin/controllers/, content/controllers/`)**
   - Process user input
   - Coordinate model and view
   - Handle routing
   - Example: `ProductController.php`, `OrderController.php`

### Core Classes

1. **Base Model (`lib/model.php`)**
   - Database connection handling
   - Basic CRUD operations
   - Query building
   - Data validation

2. **Functions (`lib/functions.php`)**
   - Utility functions
   - Helper methods
   - Common operations

3. **Configuration (`lib/config/`)**
   - Database settings
   - Application parameters
   - Environment variables

## Data Flow

1. Request Flow:
   ```
   User Request → index.php → Controller → Model → Database
                                       ↓
                                     View
                                       ↓
                                   Response
   ```

2. Controller Processing:
   - URL routing
   - Input validation
   - Authentication
   - Model coordination
   - View selection

3. Model Operations:
   - Data validation
   - Business rules
   - Database operations
   - Data formatting

4. View Rendering:
   - Template processing
   - Data presentation
   - Asset inclusion

## Security Features

1. **Authentication**
   - Session management
   - Password hashing
   - Role-based access

2. **Data Protection**
   - Input sanitization
   - SQL injection prevention
   - XSS protection
   - CSRF tokens

3. **File Security**
   - Upload validation
   - File type checking
   - Directory protection

## Extension Points

1. **Models**
   - Extend base Model class
   - Add custom validation
   - Implement business logic

2. **Controllers**
   - Add new route handlers
   - Implement new features
   - Custom authentication

3. **Views**
   - Create new templates
   - Modify layouts
   - Add components

## Best Practices

1. **Code Organization**
   - Follow MVC pattern
   - Use meaningful names
   - Document classes/methods
   - Keep controllers thin

2. **Security**
   - Validate all input
   - Use prepared statements
   - Implement CSRF protection
   - Sanitize output

3. **Performance**
   - Cache when possible
   - Optimize queries
   - Minimize database calls
   - Use proper indexes

## Further Reading

- [Database Schema](DATABASE.md)
- [API Documentation](API.md)
- [Security Guide](SECURITY.md)
- [Contributing Guide](CONTRIBUTING.md)

# API Documentation

## Overview

Sierra Shop provides a set of internal APIs for frontend-backend communication. This document details the available endpoints, request/response formats, and authentication requirements.

## Authentication

### Admin Authentication

```php
POST /admin.php/login
```

Request:
```json
{
    "username": "admin",
    "password": "password"
}
```

Response:
```json
{
    "status": "success",
    "token": "jwt_token_here",
    "user": {
        "id": 1,
        "username": "admin",
        "role": "administrator"
    }
}
```

### Customer Authentication

```php
POST /login
```

Request:
```json
{
    "email": "user@example.com",
    "password": "password"
}
```

Response:
```json
{
    "status": "success",
    "token": "jwt_token_here",
    "user": {
        "id": 123,
        "email": "user@example.com",
        "name": "John Doe"
    }
}
```

## Product Management

### List Products

```php
GET /admin.php/products
```

Parameters:
- page (int): Page number
- limit (int): Items per page
- category (int): Category ID
- search (string): Search term

Response:
```json
{
    "status": "success",
    "data": {
        "items": [
            {
                "id": 1,
                "name": "Product Name",
                "price": 99.99,
                "stock": 100,
                "category_id": 1
            }
        ],
        "total": 150,
        "page": 1,
        "pages": 15
    }
}
```

### Create Product

```php
POST /admin.php/products
```

Request:
```json
{
    "name": "New Product",
    "price": 99.99,
    "description": "Product description",
    "category_id": 1,
    "stock": 100
}
```

### Update Product

```php
PUT /admin.php/products/{id}
```

Request:
```json
{
    "name": "Updated Name",
    "price": 149.99,
    "stock": 200
}
```

### Delete Product

```php
DELETE /admin.php/products/{id}
```

## Order Management

### List Orders

```php
GET /admin.php/orders
```

Parameters:
- page (int)
- limit (int)
- status (string)
- customer (int)

Response:
```json
{
    "status": "success",
    "data": {
        "items": [
            {
                "id": 1,
                "customer_id": 123,
                "total": 299.97,
                "status": "pending",
                "created_at": "2024-01-20 12:00:00"
            }
        ],
        "total": 50,
        "page": 1,
        "pages": 5
    }
}
```

### Update Order Status

```php
PUT /admin.php/orders/{id}/status
```

Request:
```json
{
    "status": "processing"
}
```

## Customer Management

### List Customers

```php
GET /admin.php/customers
```

Parameters:
- page (int)
- limit (int)
- search (string)

Response:
```json
{
    "status": "success",
    "data": {
        "items": [
            {
                "id": 123,
                "name": "John Doe",
                "email": "john@example.com",
                "created_at": "2024-01-01 00:00:00"
            }
        ],
        "total": 1000,
        "page": 1,
        "pages": 100
    }
}
```

## Error Responses

All endpoints may return the following error responses:

### Authentication Error
```json
{
    "status": "error",
    "code": "AUTH_ERROR",
    "message": "Invalid credentials"
}
```

### Validation Error
```json
{
    "status": "error",
    "code": "VALIDATION_ERROR",
    "errors": {
        "field": ["Error message"]
    }
}
```

### Not Found
```json
{
    "status": "error",
    "code": "NOT_FOUND",
    "message": "Resource not found"
}
```

### Server Error
```json
{
    "status": "error",
    "code": "SERVER_ERROR",
    "message": "Internal server error"
}
```

## Rate Limiting

- API requests are limited to 1000 per hour per IP address
- Authentication endpoints are limited to 5 attempts per minute

## Best Practices

1. Always include authentication token in header:
   ```
   Authorization: Bearer <token>
   ```

2. Use proper HTTP methods:
   - GET for retrieving data
   - POST for creating
   - PUT for updating
   - DELETE for removing

3. Handle errors appropriately

4. Implement proper caching strategies

5. Use HTTPS for all API calls

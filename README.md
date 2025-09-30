# SierraShop - Modern E-commerce Platform
### Enhanced PHP MVC E-commerce Solution

SierraShop is a modern, secure, and feature-rich e-commerce platform built with PHP MVC architecture.
Originally based on NEW-MVC-SHOP, a free e-commerce project by SaloneTek, this enhanced version includes:
- **Enhanced security features** with improved authentication and authorization
- **Modern UI/UX design** with fully English interface
- **Improved email system** with automatic SMTP failover
- **Enhanced accessibility** and user experience
- **Comprehensive documentation** and setup guides
- **Performance optimizations** and code improvements
- **Complete internationalization** from Vietnamese to English

# 1. Configuration requirements
> - Web Server: Apache
> - Version PHP >= 8.0
> - Composer >= 2.0
> - OpenSSL PHP Extension
> - [Composer](https://getcomposer.org/download/) (Please install composer before running this project).
> - MySQL >= 8.0 (or MariaDB >= 10.0)

# 2. Technology
- Pure PHP language

# 3. Key Features & Recent Improvements

## 3.1 Frontend Features
```
✅ Shopping cart with persistent storage
✅ Customer login and registration system
✅ Product catalog with categories and search
✅ Product details with multiple images
✅ Customer feedback and review system
✅ Order tracking and management
✅ Responsive design for all devices
✅ SEO-optimized pages
✅ Secure checkout process
✅ Password reset functionality with email verification
```

## 3.2 Backend Admin Features
```
✅ Complete admin dashboard in English
✅ User role management (Admin/Moderator/User)
✅ Product management (CRUD operations)
✅ Category management system
✅ Order processing and tracking
✅ Customer feedback management
✅ User account management
✅ Database backup functionality
✅ Media gallery management
✅ Template and content management
✅ Comment moderation system
```

## 3.3 Recent Enhancements
```
🔧 Email System Improvements:
   - Automatic SMTP failover mechanism
   - Multiple email provider support
   - Enhanced error handling and logging
   
🌐 Complete Interface Translation:
   - Full Vietnamese to English translation
   - Consistent terminology throughout
   - Professional admin interface
   
🔒 Security Enhancements:
   - Improved authentication system
   - Better error handling
   - Enhanced validation
   
📱 User Experience:
   - Modernized admin interface
   - Improved navigation
   - Better responsive design
```

# 4. Download Database

This is the path to the database file for you to download: [`/admin/database/***.sql`](https://github.com/Denis060/SierraShop/tree/main/admin/database)

Create a new database on **PHPMyAdmin** at your server, then import the .sql file that you just downloaded.

# 5. Quick Start Guide

Clone the project to your computer:

```bash
git clone https://github.com/Denis060/SierraShop.git
cd SierraShop
```

Copy the .env.example file to .env:

```bash
cp .env.example .env
```

Run composer install:

```bash
composer install
```

# 6. Installation instructions

After running the above command, you need to edit the following information in the **.env** file:

## 6.1 Edit Config

You need to change the path in the '**.env**' file to match the location of this source code on your server and must match the domain you registered.

```dotenv
PATH_URL=/
PATH_URL_IMG=public/upload/images/
PATH_URL_IMG_PRODUCT=public/upload/products/
```

> **Note:**
> 
> The path of the config file that is using these environment variables is located at: [`/lib/config/config.php`](https://github.com/Denis060/SierraShop/tree/main/lib/config/config.php)

## 6.2 Edit Connect Database

You need to change the connection information and import sql file to the database after you have cloned my repository so that the website can work.

This is the path to the sql file for you to import to your database:
[`/admin/database/***.sql`](https://github.com/Denis060/SierraShop/tree/main/admin/database)

And change the connection information to match your database in .env file:

```dotenv
DB_HOST=db_server
DB_PORT=3306
DB_USER=root
DB_PASS=root
DB_NAME=new_mvc_shop_db
```

> **Note:**
>
> The path of the database config file that is using these environment variables is located at: [`/lib/config/database.php`](https://github.com/Denis060/SierraShop/tree/main/lib/config/database.php)

## 6.3 Edit .htaccess

Change RewriteBase - Recommend the path that matches your host address.

So we will have:
```
RewriteBase /
```

---

> **Note**: This applies to the case where your project is in a subfolder, and you want it accessible from a subpath URL.
>
>**EXAMPLE**:
>```
>http://localhost/new-mvc-shop/
>``` 
> So we will have:
> ```
> RewriteBase /new-mvc-shop/
> ```

## 6.4 Email Configuration (Enhanced)

> **Enhanced Email System with Automatic Failover**
> 
SierraShop now includes an improved email system with automatic failover support for better reliability.

Update the following information in the **.env** file:

```dotenv
# Primary SMTP Configuration
SMTP_HOST=smtp.gmail.com
SMTP_PORT=465
SMTP_UNAME=your_primary_email@gmail.com
SMTP_PWORD=your_app_password

# Fallback SMTP Configuration (Optional but recommended)
SMTP_HOST_FALLBACK=smtp-mail.outlook.com
SMTP_PORT_FALLBACK=587
SMTP_UNAME_FALLBACK=your_backup_email@outlook.com
SMTP_PWORD_FALLBACK=your_backup_password
```

### Key Features:
- **Automatic Failover**: If primary SMTP fails, system automatically tries fallback
- **Enhanced Security**: TLS encryption and secure authentication
- **Better Error Handling**: Detailed logging for troubleshooting
- **Multiple Provider Support**: Gmail, Outlook, and other SMTP providers

**Gmail Setup Tips:**
1. Enable 2-factor authentication
2. Generate app-specific password: https://support.google.com/accounts/answer/185833
3. Use the app password as SMTP_PWORD

> **Note:**
>
> The enhanced email configuration files are located at:
> - Primary config: [`/lib/config/sendmail.php`](lib/config/sendmail.php)
> - Email helper: [`/lib/email_helper.php`](lib/email_helper.php)

# 7. Install with Docker (Optional)

> Note: 
> 
> **Please skip this section if you have already installed the project in the above section.**

If you want to run this project with Docker, you can edit .env file and use the following command:

Please edit the following information in the **.env** file:

(Please set ports for **MYSQL_PORT, PHPMYADMIN_PORT, APP_PORT, SSL_PORT** and not duplicate with other ports)

**Example:**

```dotenv
APP_NAME=nms

APP_PORT=85
SSL_PORT=443 # (optional)

MYSQL_PORT=3307
MYSQL_USER=root
MYSQL_ROOT_PASS=root
MYSQL_DB=new-mvc-shop
MYSQL_PASS=root

PHPMYADMIN_PORT=8081
PHPMYADMIN_UPLOAD_LIMIT=2048M
```

## 7.1 Installation with bash script:

If your OS is **Linux**, you can use the bash script to easily run the project with Docker.

```bash
bash install.sh
```

---

If not, please follow the instructions below.

## 7.2 Installation with commands:

Run the following command:

```bash
docker compose up -d
```

After running the above command, you need to install the composer package for the project.

```bash
docker compose run --rm -w /var/www/html server composer install
```

Finally, you need to import the database file into the database container.

# 8. Demo & Default Accounts

## Live Demo
- **Frontend**: Coming Soon (SierraShop Demo)
- **Backend Admin**: Coming Soon (SierraShop Admin Demo)

## Default Login Accounts

> **_Default accounts for testing (please change in production)_**
> 
> ```
> Regular User:
>     username: testna      | email: test@gmail.com        | password: 123456789
>     username: tanhongitii | email: meowwww@gmail.com.com | password: 123456789
> 
> Moderator:
>     username: eyteyt      | email: moderator@gmail.com   | password: 12345678
> 
> Administrator:
>     username: admin       | email: admin@gmail.com       | password: 1234567890
>     username: admin3      | email: admin3@gmail.com      | password: 123456789
> ```

⚠️ **Security Notice**: Change all default passwords before deploying to production!

# Demo Images

**SierraShop Homepage**

![Image](https://imgur.com/rncleZ0.png)

---

**Product Catalog**

![Image](https://imgur.com/ExdAptJ.png)

---

**Enhanced Admin Dashboard (Now in English)**

![Image](https://imgur.com/xOpAmb4.png)

![Image](https://imgur.com/u8lXnsz.png)

---

# 9. Changelog & Improvements

## Version 2.0 (Latest)
- ✅ **Complete Interface Translation**: Full Vietnamese to English localization
- ✅ **Enhanced Email System**: Automatic SMTP failover with multiple provider support
- ✅ **Security Improvements**: Better authentication and error handling
- ✅ **Admin Interface Modernization**: Professional English admin panel
- ✅ **Code Quality**: Improved documentation and code structure
- ✅ **User Experience**: Better navigation and responsive design

## Previous Features
- ✅ PHP MVC Architecture
- ✅ Shopping Cart System
- ✅ User Management
- ✅ Product & Category Management
- ✅ Order Processing
- ✅ Feedback System
- ✅ Database Backup Tools

---

# 10. Contributing

We welcome contributions to SierraShop! Please feel free to submit issues, feature requests, or pull requests.

## Development Guidelines
1. Follow PSR coding standards
2. Write clear commit messages
3. Test your changes thoroughly
4. Update documentation as needed

---

# 11. License & Support

## Support the Project
If you find SierraShop useful, consider supporting the original project:
<p align="center">
    <a href="https://www.paypal.me/tanhongcom" target="_blank"><img src="https://img.shields.io/badge/Donate-PayPal-green.svg" data-origin="https://img.shields.io/badge/Donate-PayPal-green.svg" alt="PayPal Support"></a>
</p>

<p align="center">
     <img src="https://img.shields.io/packagist/l/doctrine/orm.svg" data-origin="https://img.shields.io/packagist/l/doctrine/orm.svg" alt="license">
</p>

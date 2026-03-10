# MY-PHP-JON
My PHP rental application

A lightweight PHP rental property listing site designed to run on shared cPanel hosting.

---

## Features

- Property listing page with availability badges
- Contact form (saves messages to the database)
- Clean front-controller router via `.htaccess`
- Ready for cPanel + MySQL deployment

---

## Deploying to cPanel

### 1. Upload files
Upload all project files to your domain's `public_html` folder using **cPanel > File Manager** or via FTP/SFTP.

### 2. Create a MySQL database
1. Go to **cPanel > MySQL Databases**.
2. Create a new database (e.g. `myuser_rentals`).
3. Create a new database user and assign it **All Privileges** on that database.

### 3. Import the schema
1. Go to **cPanel > phpMyAdmin**.
2. Select your database and click **Import**.
3. Upload `config/schema.sql`.

### 4. Configure the application
Edit **`config/db.php`** and update the four constants:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'myuser_rentals');   // your cPanel username + database name
define('DB_USER', 'myuser_dbuser');    // your cPanel database user
define('DB_PASS', 'your_password');
```

Edit **`config/config.php`** and set your domain:
```php
define('BASE_URL', 'https://yourdomain.com');
```

### 5. Enable HTTPS (recommended)
1. Install a free SSL certificate via **cPanel > SSL/TLS** or **AutoSSL**.
2. Uncomment the HTTPS redirect lines in `.htaccess`.

### 6. Verify
Visit `https://yourdomain.com` — you should see the rental home page.

---

## Directory Structure

```
MY-PHP-JON/
├── .htaccess            # URL routing & security rules
├── index.php            # Front controller
├── config/
│   ├── config.php       # App constants (BASE_URL, timezone, etc.)
│   ├── db.php           # Database connection (PDO)
│   └── schema.sql       # Database schema + sample data
├── includes/
│   ├── header.php       # Shared HTML header
│   └── footer.php       # Shared HTML footer
├── pages/
│   ├── home.php         # Home / featured properties
│   ├── listings.php     # Full property listings with filter
│   └── contact.php      # Contact form
└── assets/
    └── css/
        └── style.css    # Main stylesheet
```

---

## Requirements

- PHP 7.4 or later (PHP 8.x recommended)
- MySQL 5.7 / MariaDB 10.3 or later
- Apache with `mod_rewrite` enabled (standard on all cPanel hosts)

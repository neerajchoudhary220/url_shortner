# URL Shortener Service

A **Laravel 12**-based URL shortening service with company management, user roles, and an invitation system.  

### Prerequisites
- PHP 8.2+
- Composer 2.0+
- MySQL 5.7+/MariaDB 10.3+

## 📦 Installation Process

### Step 1: Install Dependencies
Run the following command in your project root to install dependencies:

```
composer install
# or
composer update
```

### Step 2: Publish Spatie Configuration
```
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### Step 3: .env Configuration

#### Update Database Credentials
Edit your `.env` file with your database configuration:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortener
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

#### Update Mail Credentials

```
MAIL_MAILER=smtp
MAIL_HOST=your_mail_host (e.g., sandbox.smtp.mailtrap.io)
MAIL_PORT=2525
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
```

### Step 4: Clear Application Cache
```
php artisan config:clear
php artisan optimize:clear
```

### Step 5: Migrate and Seed Database
```
php artisan migrate --seed
```

### Step 6: Serve the Project
```
php artisan serve
```

---

## 🧑‍💼 Super Admin Credentials

Use the following credentials to log in as a Super Admin:

- **Email**: `superadmin@gmail.com`
- **Password**: `123456789`

---

## 🚀 Features

### ✅ User Roles
- **Super Admin**: Manages all companies and users.
- **Admin**: Manages users and URLs within their company.
- **Member**: Can create and manage their own short URLs.

### 🔐 Authentication
- Custom authentication system (No Laravel Breeze/Jetstream).
- Registration is available via invitation only.

### 🔗 URL Management
- Create and manage short URLs.
- Track click counts.
- Role-based access control for URLs.
- Public redirection functionality.

### 🏢 Company Management
- Support for multiple companies.
- Users and URLs are managed on a per-company basis.

---

## 🔧 Installed Package

- **[Spatie Laravel-Permission](https://spatie.be/docs/laravel-permission)** — Used for managing user roles and permissions.

---

## 📝 License

This project is open-source and free to use for educational and commercial purposes.
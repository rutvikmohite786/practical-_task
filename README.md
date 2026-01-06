# User Management System

A Laravel 12 application with AJAX-based CRUD operations for managing users.

## Installation Steps

### 1. Install PHP Dependencies

```bash
composer install
```

### 2. Install Node Dependencies

```bash
npm install
```

### 3. Build Frontend Assets

```bash
npm run build
```

### 4. Environment Configuration

Copy the environment file:

```bash
copy .env.example .env
```

Update `.env` with your database credentials:

```env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Migrations and Seeders

```bash
php artisan migrate:fresh --seed
```

### 7. Start Development Server

```bash
php artisan serve
```

Visit: **http://127.0.0.1:8000**

## Default Login Credentials

```
Email: admin@example.com
Password: password
```

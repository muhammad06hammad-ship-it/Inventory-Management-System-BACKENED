# Inventory Management System - Backend (Laravel API + Views)

## System Requirements
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js >= 18 (for asset compilation)

## Installation Steps

### 1. Install PHP dependencies
```bash
composer install
```

### 2. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database credentials:
```
DB_DATABASE=inventory_management
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 3. Run Migrations and Seeders
```bash
php artisan migrate --seed
```

### 4. Start the Application
```bash
php artisan serve
```

The application will be available at: http://localhost:8000

---

## Default Login Credentials

| Role  | Email                  | Password  |
|-------|------------------------|-----------|
| Admin | admin@inventory.com    | admin123  |
| Staff | staff@inventory.com    | staff123  |

---

## Features
- **Authentication**: Login/Logout with session management
- **Role-Based Access Control**: Admin and Staff roles via middleware
- **Product Management** (Admin only): CRUD with SKU, category, unit, min stock
- **Supplier Management** (Admin only): CRUD with contact details
- **User Management** (Admin only): Create/edit/delete user accounts
- **Stock In**: Record incoming stock from suppliers
- **Stock Out**: Record outgoing stock with low-stock validation
- **Reports**:
  - Current stock levels with low-stock alerts
  - Stock movement history with filters
  - Stock summary by product and date range
- **AJAX**: Live stock level lookup on transaction forms

## Middleware
- `auth` – Protects all routes (only logged-in users)
- `admin` – Restricts product, supplier, and user management to Admin role

## Database Tables
- `users` – User accounts with roles
- `categories` – Product categories
- `products` – Products with SKU, unit, minimum stock
- `suppliers` – Supplier contact information
- `stock_transactions` – All stock in/out movements

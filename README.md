# Warehouse Management System

Laravel + Bootstrap 5 warehouse admin panel based on the supplied IT313 project documentation.

## Included
- Dashboard metrics: Users, Products, Posts, Views
- Product CRUD: SKU, name, category, price, stock quantity, description
- Low-stock and out-of-stock badges
- Category CRUD
- User management with Admin / Editor / Viewer roles and Active / Inactive status
- Announcement/content CRUD with Draft / Published status and view counts
- Recent activity log
- Responsive dark-navy sidebar + violet Bootstrap styling
- SQLite default for the easiest setup; MySQL configuration is included in `.env.example`

The supplied document describes Laravel, MySQL, React, Tailwind and Bootstrap. This implementation uses **Laravel + Blade + Bootstrap** instead of React/Tailwind because the requested build specifically asks for Bootstrap and an easy-to-run CRUD application. The functional scope follows the document: inventory, users/roles, announcements, dashboard metrics, and exclusions such as barcode scanner hardware and payment checkout.

## Requirements
- PHP 8.2+
- Composer
- Browser

## Fast setup (SQLite)
1. Extract this project.
2. Open a terminal in the project folder.
3. Run:

```bash
composer install
copy .env.example .env
php -r "file_put_contents('database/database.sqlite','');"
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

On macOS/Linux replace `copy .env.example .env` with `cp .env.example .env`.

Open: http://127.0.0.1:8000

### Demo accounts
- Admin: `admin@warehouse.test` / `password`
- Editor: `editor@warehouse.test` / `password`
- Viewer: `viewer@warehouse.test` / `password`

## MySQL setup
Create a database named `warehouse`, then edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=warehouse
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan migrate --seed
php artisan serve
```

## Role behavior
- Admin: full access, including user management.
- Editor: inventory/category/announcement management.
- Viewer: read-only inventory/announcement access.

## Documentation alignment
The system follows the supplied documentation's sections and terminology: Warehouse Management System, inventory management, SKU/pricing/stock/category tracking, Admin/Editor/Viewer roles, Active/Inactive status, content management, dashboard metrics, dark navy sidebar, violet active states, Bootstrap, Laravel and MySQL-compatible persistence.

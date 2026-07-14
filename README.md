# 🛒 TokoOnline - E-Commerce Website

Aplikasi **E-Commerce** berbasis **Laravel 13** dengan fitur lengkap untuk customer dan admin panel.

---

## 📋 Daftar Fitur

### 👤 Customer
| Fitur | Keterangan |
|-------|-----------|
| **Login & Register** | Autentikasi session-based dengan validasi |
| **Daftar Produk** | Grid produk dengan kategori, search, pagination |
| **Detail Produk** | Informasi lengkap, quantity picker, produk terkait |
| **Keranjang Belanja** | CRUD item, update quantity, subtotal real-time |
| **Checkout** | Form alamat, kota, kode pos, telepon, catatan |
| **Pesanan Saya** | Riwayat pesanan dengan status dan invoice |

### 🔧 Admin Panel
| Fitur | Route | Keterangan |
|-------|-------|-----------|
| Dashboard | `/admin` | Statistik (produk, pesanan, user, revenue, grafik) |
| Kelola Produk | `/admin/products` | CRUD + upload gambar (storage) |
| Kelola Kategori | `/admin/categories` | CRUD + proteksi hapus (jika masih punya produk) |
| Kelola Pesanan | `/admin/orders` | Lihat semua + update status (pending/processing/completed/cancelled) |

---

## 🏗️ Struktur Kode

```
ecommerce/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php          # Login/Register/Logout
│   │   │   ├── ProductController.php       # Daftar & detail produk (public)
│   │   │   ├── CartController.php          # CRUD keranjang
│   │   │   ├── OrderController.php         # Checkout & pesanan
│   │   │   └── Admin/
│   │   │       ├── AdminController.php     # Dashboard statistik
│   │   │       ├── ProductController.php   # CRUD produk admin
│   │   │       ├── CategoryController.php  # CRUD kategori
│   │   │       └── OrderController.php     # Kelola pesanan
│   │   └── Middleware/
│   │       └── AdminMiddleware.php         # Cek role admin
│   └── Models/
│       ├── User.php                        # is_admin, cartItems, orders
│       ├── Product.php                     # category, scopes, imageUrl
│       ├── Category.php                    # products, auto-slug
│       ├── CartItem.php                    # user, product
│       ├── Order.php                       # user, items, auto-invoice
│       └── OrderItem.php                   # order, product
├── resources/views/
│   ├── layouts/app.blade.php               # Layout utama (Vite + Tailwind)
│   ├── components/admin/sidebar.blade.php  # Sidebar reusable
│   ├── auth/                               # login, register
│   ├── products/                           # index (dgn kategori & search), show
│   ├── cart/                               # index (responsive)
│   ├── orders/                             # checkout, index, show
│   └── admin/
│       ├── dashboard.blade.php             # Dashboard statistik
│       ├── products/                       # index, create, edit
│       ├── categories/                     # index, create, edit
│       └── orders/                         # index, show
├── routes/
│   └── web.php                             # 32 routes (16 public + 16 admin)
├── database/
│   ├── migrations/                         # 11 migration files
│   └── seeders/DatabaseSeeder.php          # 1 admin + 5 kategori + 12 produk
└── config/
    └── database.php                        # MySQL connection config
```

### Pola yang Digunakan

| Pola | Implementasi |
|------|-------------|
| **MVC** | Models, Controllers, Views terpisah |
| **Route Grouping** | Prefix (`/admin`, `/cart`) + middleware (`auth`, `guest`, `admin`) |
| **Route Model Binding** | Implicit binding untuk semua resource |
| **Named Routes** | Semua route punya nama (`products.index`, `admin.orders.show`) |
| **Blade Components** | `x-admin.sidebar` reusable dengan props `active` |
| **Eloquent ORM** | Relationships, query scopes, accessors, model events |
| **Database Transactions** | Order creation dengan rollback on failure |
| **File Storage** | Upload gambar ke `storage/app/public/products` |
| **Middleware Kustom** | `AdminMiddleware` untuk role-based access |
| **Auto-generate** | Slug kategori & invoice number via model `creating` event |

---

## 🗄️ Database Schema

### Entity Relationship

```
users ──┐
        ├── cart_items ─── products ─── categories
        │
        └── orders ─── order_items ─── products
```

### Tables

| Table | Key Columns |
|-------|-------------|
| **users** | id, name, email, password, **is_admin**, timestamps |
| **categories** | id, **name**, **slug** (unique), description, timestamps |
| **products** | id, **category_id** (FK), name, description, price, stock, image, timestamps |
| **cart_items** | id, **user_id** (FK), **product_id** (FK), quantity, timestamps |
| **orders** | id, **user_id** (FK), **invoice** (unique), total, status, shipping_address, city, postal_code, phone, notes, timestamps |
| **order_items** | id, **order_id** (FK), **product_id** (FK), quantity, price, timestamps |

---

## 🚀 Instalasi & Setup

### Prasyarat

- PHP ^8.3
- Composer
- Node.js & npm
- MySQL (via Laragon)

### Langkah Instalasi

```bash
# 1. Clone project
cd D:\kerjaan\joki\tes\ecommerce

# 2. Install PHP dependencies
composer install

# 3. Copy environment file
copy .env.example .env
# atau: php -r "file_exists('.env') || copy('.env.example', '.env');"

# 4. Generate app key
php artisan key:generate

# 5. Buat database di MySQL
# Buka Laragon > Start MySQL > Open HeidiSQL
# Buat database baru: ecommerce

# 6. Konfigurasi .env (sudah diatur)
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3307
# DB_DATABASE=ecommerce
# DB_USERNAME=root
# DB_PASSWORD=

# 7. Run migration & seeder
php artisan migrate:fresh --seed

# 8. Install JS dependencies
npm install

# 9. Build assets
npm run build

# 10. Create storage symlink
php artisan storage:link
```

### Menjalankan Aplikasi

Akses via **Laragon**:
- Buka Laragon > Start All
- Buka browser: `http://localhost:81`

Atau via Artisan:
```bash
php artisan serve --port=81
```

---

## 🔐 Akun Default

| Role | Email | Password |
|------|-------|----------|
| **Admin** | `admin@tokoonline.com` | `admin123` |
| **User** | Register sendiri | - |

### Seed Data

- **1** Admin user
- **5** Kategori: Elektronik, Aksesoris, Audio, Penyimpanan, Perangkat Gaming
- **12** Produk sample: Laptop Gaming, Smartphone, Headphone, Mouse, Keyboard, Monitor, Tablet, Smartwatch, Kamera, Speaker, Flash Drive, External SSD

---

## 🧭 Daftar Route

### Public (Customer)

| Method | Route | Nama | Controller |
|--------|-------|------|------------|
| GET | `/` | `products.index` | ProductController@index |
| GET | `/products` | `products.index` | ProductController@index |
| GET | `/products/{product}` | `products.show` | ProductController@show |
| GET | `/login` | `login` | AuthController@showLogin |
| POST | `/login` | - | AuthController@login |
| GET | `/register` | `register` | AuthController@showRegister |
| POST | `/register` | - | AuthController@register |
| POST | `/logout` | `logout` | AuthController@logout |
| GET | `/cart` | `cart.index` | CartController@index |
| POST | `/cart` | `cart.store` | CartController@store |
| PUT | `/cart/{cartItem}` | `cart.update` | CartController@update |
| DELETE | `/cart/{cartItem}` | `cart.destroy` | CartController@destroy |
| GET | `/checkout` | `checkout` | OrderController@checkout |
| POST | `/orders` | `orders.store` | OrderController@store |
| GET | `/orders` | `orders.index` | OrderController@index |
| GET | `/orders/{order}` | `orders.show` | OrderController@show |

### Admin

| Method | Route | Nama | Controller |
|--------|-------|------|------------|
| GET | `/admin` | `admin.dashboard` | AdminController@dashboard |
| GET | `/admin/products` | `admin.products.index` | Admin\ProductController@index |
| GET | `/admin/products/create` | `admin.products.create` | Admin\ProductController@create |
| POST | `/admin/products` | `admin.products.store` | Admin\ProductController@store |
| GET | `/admin/products/{product}/edit` | `admin.products.edit` | Admin\ProductController@edit |
| PUT | `/admin/products/{product}` | `admin.products.update` | Admin\ProductController@update |
| DELETE | `/admin/products/{product}` | `admin.products.destroy` | Admin\ProductController@destroy |
| GET | `/admin/categories` | `admin.categories.index` | Admin\CategoryController@index |
| GET | `/admin/categories/create` | `admin.categories.create` | Admin\CategoryController@create |
| POST | `/admin/categories` | `admin.categories.store` | Admin\CategoryController@store |
| GET | `/admin/categories/{category}/edit` | `admin.categories.edit` | Admin\CategoryController@edit |
| PUT | `/admin/categories/{category}` | `admin.categories.update` | Admin\CategoryController@update |
| DELETE | `/admin/categories/{category}` | `admin.categories.destroy` | Admin\CategoryController@destroy |
| GET | `/admin/orders` | `admin.orders.index` | Admin\OrderController@index |
| GET | `/admin/orders/{order}` | `admin.orders.show` | Admin\OrderController@show |
| PUT | `/admin/orders/{order}/status` | `admin.orders.status` | Admin\OrderController@updateStatus |

---

## 🎨 Teknologi

| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| **Laravel** | 13.x | Framework PHP |
| **Tailwind CSS** | 4.x | Styling & UI |
| **Vite** | 8.x | Asset bundler |
| **MySQL** | - | Database via Laragon (port 3307) |
| **PHP** | ^8.3 | Backend |
| **Blade** | - | Template engine |

---

## 📂 Fitur Detail

### Kategori Produk
- Sidebar filter kategori di halaman produk
- Auto-generate slug dari nama kategori
- Proteksi hapus jika kategori masih memiliki produk

### Search Produk
- Pencarian berdasarkan nama dan deskripsi
- Query string preserved dengan `withQueryString()`
- Bisa dikombinasikan dengan filter kategori

### Upload Gambar
- Upload file ke `storage/app/public/products/`
- Format: JPEG, PNG, WebP (maks 2MB)
- Otomatis hapus gambar lama saat update/delete
- Akses via `storage` symlink

### Invoice Number
- Auto-generate format: `INV/YYYYMMDD/XXXX`
- Unique constraint di database
- Ditampilkan di semua halaman pesanan

### Cart Items
- Update quantity dengan tombol +/- 
- Responsive layout (table di desktop, card di mobile)
- Badge notifikasi di navbar
- Unique constraint (user_id + product_id) mencegah duplikasi

---

## 🧪 Testing

```bash
php artisan test
```

---

## 📄 Lisensi

MIT License - bebas digunakan untuk keperluan belajar dan pengembangan.

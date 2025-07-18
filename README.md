#  🌾 Daffa Tani POS

A modern and simple **Point of Sale (POS) system** for agricultural shops, built using **Laravel 12**, **Tailwind CSS**, **Laravel Breeze**, **Spatie Permission**, and more.

---

## 🚀 Features

- ✅ Authentication with Laravel Breeze
- ✅ Role-based access control using Spatie Laravel Permission
- ✅ Category & Product management
- ✅ Real-time stock tracking
- ✅ Sales transaction system with receipt (PDF)
- ✅ Sales history view with detailed filtering
- ✅ Monthly Sales Reports (PDF)
- ✅ Monthly sales Products Report (PDF)
- ✅ Interactive Dashboard with sales charts using Chart.js

---

## 📦 Tech Stack

| Layer        | Technology                         |
|--------------|-------------------------------------|
| Backend      | Laravel 12                          |
| Frontend     | Blade + Tailwind CSS                |
| Auth         | Laravel Breeze                      |
| Permissions  | Spatie Laravel-Permission           |
| PDF Export   | Barryvdh DomPDF                     |
| Charting     | Chart.js                            |
| Database     | MySQL                               |

---

## 📂 Folder Structure Highlights

- `app/Models`: Eloquent models (Product, Category, Sale, etc.)
- `resources/views`: Blade templates
- `routes/web.php`: Web routes
- `app/Http/Controllers`: All controller logic

---

## 📸 Screenshots

> Dashboard with chart
    <img width="1919" height="897" alt="image" src="https://github.com/user-attachments/assets/6e2f97d8-1456-47c7-89f5-dc83d73155dd" />

> Product list
    <img width="1919" height="897" alt="image" src="https://github.com/user-attachments/assets/0f41e93b-9ba4-4561-bf6a-c516134d9673" />

> Sales History (cashier view)
    <img width="1919" height="969" alt="image" src="https://github.com/user-attachments/assets/d16267ee-9ef4-492b-b056-2098658cbf70" />

> Create Sale (cashier view)
    <img width="1919" height="967" alt="image" src="https://github.com/user-attachments/assets/3803dd1b-c6ea-46b5-ab49-012cf4c3d250" />

 
> Sale Details (cashier view)
    <img width="1919" height="969" alt="image" src="https://github.com/user-attachments/assets/4141a25a-638b-4c35-92ec-7e73fdf2f595" />

> Receipt PDF
    <img width="1919" height="897" alt="image" src="https://github.com/user-attachments/assets/baa53ef0-a3fe-4c62-938a-69a509a54d65" />

> Sales Report View
    <img width="1918" height="896" alt="image" src="https://github.com/user-attachments/assets/69fced3d-8a66-47d3-bfe8-f0f31cff16fb" />

> Sales Report PDF
    <img width="1919" height="897" alt="image" src="https://github.com/user-attachments/assets/7bc239d1-4d56-4d13-af95-9bfcb0bef249" />

> Sales Product Report PDF
    <img width="1919" height="896" alt="image" src="https://github.com/user-attachments/assets/219b2cb1-d95b-4773-8540-d90e3da77915" />




---

## 📈 Reports & Dashboard

- **Sales Chart**: Monitor monthly sales on dashboard using Chart.js.
- **PDF Reports**:
  - Monthly Sales Report
  - Monthly Sales Products
  - Printable Receipts

---

## 🧰 Installation

```bash
# Clone the repo
git clone https://github.com/daffahammam/pos-daffatani.git
cd pos-daffatani

# Install dependencies
composer install
npm install && npm run build

# Copy .env and configure
cp .env.example .env
php artisan key:generate

# Set up database
php artisan migrate --seed

# Run the server
php artisan serve

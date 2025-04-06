# iqac
Laravel Filament Admin panel for IQAC

# Laravel Project Setup

Follow the steps below to set up and run the Laravel project on your local machine.

---
First clone the Laravel project
Then follow the steps below:

## 🛠️ Setup Instructions

1. **Change to the project directory:**

   cd iqac/Laravel

2. **Install PHP dependencies using Composer:**

   composer install

3. **Copy `.env.example` to `.env` and configure your environment:**

   cp .env.example .env

   Then open the `.env` file and update your database credentials:

   DB_DATABASE=your_database_name  
   DB_USERNAME=your_database_username  
   DB_PASSWORD=your_database_password

   or you may use sqlite for local database ( Tips: use sqlite extension to view your database )

4. **Run the database migrations:**

   php artisan migrate

5. **Generate the application key:**

   php artisan key:generate

6. **Start the development server:**

   php artisan serve

---

Now you can access your Laravel app at: http://localhost:8000 🚀

This project use Filament Admin panel, which can be access at http://localhost:8000/admin

---

Enamullah Moatasim
ID: 7
Department: Information System

Book Registration and Viewing - Laravel Lab

This solution continues the existing Laravel Authentication Lab project.

Requirements:
- Laravel 12
- PHP 8.2 or newer
- XAMPP MySQL
- Bootstrap 5 via CDN

Setup:
1. Use the existing Laravel authentication project from Lab-06.
2. Create a database named it_auth_lab if it does not already exist.
3. Update database credentials in .env.
4. Copy each file's contents into the Laravel path shown by its filename.
5. Run:
   php artisan config:clear
   php artisan migrate
   php artisan route:list
   php artisan serve
6. Open http://127.0.0.1:8000 and sign in.

All solution files are kept together in one folder for easier upload. Filenames identify their Laravel destination.

Do not run migrate:fresh on a database containing data you need to keep.

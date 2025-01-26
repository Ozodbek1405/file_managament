<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## O'rnatish ketma-ketligi
1. git clone https://github.com/Ozodbek1405/file_managament.git
2. cd file_managament
3. composer update
4. copy .env.example .env
5. .env faylni sozlang
   DB_CONNECTION=pgsql
   DB_HOST=your_host
   DB_PORT=5432
   DB_DATABASE=your_db_name
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password
6. php artisan migrate
7. php artisan db:seed --class=RolePermissionSeeder
8. php artisan jwt:secret
9. php artisan serve

## ROLE ADMIN
admin@example.com
password123

## ROLE MODERATOR
moderator@example.com 
password123

## ROLE USER
user@example.com
password123



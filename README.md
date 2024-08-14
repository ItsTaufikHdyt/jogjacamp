## Instalasi Menggunakan Docker
Silahkan Isi Terlebih Dahulu deb.env dan .env
docker compose up -d
docker compose exec php bash 
composer install
chmod -R 777 /var/www/storage
jika menggunakan linux
*sudo chown -R user-laptop:user-laptop ./jogjacamp
php artisan key:generate 
php artisan migrate
php artisan db:seed
*php artisan serve
silahkan buka http://localhost atau *http://localhost:8000

## Instalasi Menggunakan Xampp atau Laragon
Silahkan isi .env
kemudian simpan file kedalam htdocs atau www
composer install
php artisan key:generate 
php artisan migrate
php artisan db:seed
*php artisan serve
silahkan buka http://localhost atau *http://localhost:8000

## Queue & Notification
silahkan sesuikan di file .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"

jalankan 
php artisan queue:restart
php artisan queue:work


## CRUD Categori
Silahkan Buka http://localhost/categories atau http://localhost:8000/categories 
Logic Codenya di sini menggunakan Repository Pattern, Ada di dalam folder repositories

## API
Dokumentasi Api Menggunakan Swagger yang bisa dilihat di
http://localhost/api/documentation#/Category
untuk mempublish swagger
php artisan vendor:publish pilih nomer 7
untuk mengenerate
php artisan l5-swagger:generate
api endpoint
GET /api/categories (index)
POST /api/categories (store)
GET /api/categories/{category} (show)
PUT/PATCH /api/categories/{category} (update)
DELETE /api/categories/{category} (destroy)

## Test Code
php artisan test 
php artisan test --coverage-html=reports
Untuk Melihat Hasil Report ada di dalam folder reports





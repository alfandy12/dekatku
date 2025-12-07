🛠 Panduan Instalasi Lengkap

Dokumen ini berisi panduan teknis mendetail untuk menginstal dan menjalankan aplikasi ini di lingkungan lokal (Local Environment).

📋 Persyaratan Sistem (Server Requirements)

Sebelum memulai, pastikan server atau komputer lokal Anda memenuhi spesifikasi berikut (sesuai standar Laravel terbaru):

PHP >= 8.1 / 8.2

Composer (Dependency Manager)

Node.js & NPM (Untuk compile aset frontend)

Database: MySQL 5.7+ / MariaDB 10.3+ / PostgreSQL / SQL Server

Ekstensi PHP Wajib

Pastikan ekstensi PHP berikut aktif di php.ini Anda:

BCMath PHP Extension

Ctype PHP Extension

Fileinfo PHP Extension

JSON PHP Extension

Mbstring PHP Extension

OpenSSL PHP Extension

PDO PHP Extension

Tokenizer PHP Extension

XML PHP Extension

🚀 Langkah-langkah Instalasi

1. Kloning Repositori

Unduh kode sumber ke direktori lokal Anda.

git clone [https://github.com/username-anda/nama-project.git](https://github.com/username-anda/nama-project.git)
cd nama-project


2. Instalasi Dependensi Backend (Composer)

Instal semua pustaka PHP yang didefinisikan di composer.json.

composer install


Catatan: Jika Anda berada di lingkungan produksi (live server), gunakan: composer install --optimize-autoloader --no-dev

3. Konfigurasi Environment Variable

Salin file konfigurasi contoh.

cp .env.example .env


Buka file .env dan atur koneksi database Anda. Contoh untuk MySQL:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=password_database_anda


4. Generate App Key

Buat kunci enkripsi unik untuk aplikasi.

php artisan key:generate


5. Setup Database

Jalankan migrasi untuk membuat struktur tabel.

php artisan migrate

# Jika Anda ingin mengisi data dummy/awal:
php artisan migrate --seed


6. Instalasi Dependensi Frontend (NPM)

Instal dan compile aset CSS/JS (menggunakan Vite/Mix).

npm install
npm run build


Untuk mode pengembangan (hot reload), gunakan npm run dev di terminal terpisah.

7. Symlink Storage (Penting untuk Upload File)

Agar file yang diupload ke folder storage/app/public bisa diakses via browser.

php artisan storage:link


8. Jalankan Server

Aplikasi siap dijalankan.

php artisan serve


Akses di: http://localhost:8000

🔧 Troubleshooting & Izin Folder (Linux/macOS)

Jika Anda mengalami error Permission denied saat menulis log atau upload file, atur izin folder berikut:

# Ubah owner ke user web server (biasanya www-data atau _www)
sudo chown -R www-data:www-data storage bootstrap/cache

# Atau atur permission chmod
chmod -R 775 storage
chmod -R 775 bootstrap/cache


Masalah Umum:

Error "Vite manifest not found":

Pastikan Anda sudah menjalankan npm run build.

Error "Class ... not found":

Coba jalankan composer dump-autoload.

Error Database Connection:

Pastikan Database Server (MySQL/Postgres) sudah menyala.

Pastikan nama database di .env sudah sesuai dengan yang Anda buat di PHPMyAdmin/TablePlus.

🐳 Instalasi Menggunakan Laravel Sail (Docker)

Jika Anda lebih suka menggunakan Docker, Anda bisa melewati langkah instalasi PHP/Composer/MySQL manual di atas dan langsung menggunakan Sail:

Clone repo.

Masuk ke folder project.

Jalankan perintah berikut (asumsi Docker Desktop sudah berjalan):

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs


Salin .env example ke .env.

Jalankan container:

./vendor/bin/sail up -d


Generate key & migrate:

./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate

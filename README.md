## Laravel Kurulumu

composer install

## NPM Paketlerinin Kurulumu

npm install

## Veritabanı ve Mailtrap Bilgilerinin Ayarlanması

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"

## .env İçindeki APP_KEY'i Oluşturma

php artisan key:generate

## Veritabanı Tabloları Oluşturulurken Seeder'ın Çalıştırılması

php artisan migrate --seed

## Storage Klasörü Oluşturma

php artisan storage:link

## Oauth-private ve Oauth-public Keylerin ve Personel Access Client Oluşturulması

php artisan passport:install
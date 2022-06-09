This is a lunch booking system. This system helps user to make entry by clicking one button instead of making entry in book, it will also help Admin to count filter records.

Rerquirements:-

composer-version >= 2.2.7 
php-version >= 7.4.3, 
Laravel-version >=8.0.0, 
Microsoft-graph >=1.64, 
Yajra/Laravel-datatables-buttons = 4.13, 
Yajra/Laravel-datatables-oracle = 9.20, 
Darkaonline/l5-Swagger = 8.3, 
Fruitcake/laravel-cors = 2.0, 
Guzzlehttp/guzzle = 7.4, 
Laravel/sanctum = 2.11, 
Laravel/tinker = 2.5, 
Laravel/ui = 3.4

Installation:-

Clone project using git clone project-name
Go to the folder application using cd command on your cmd or terminal
Run composer install on your cmd or terminal
Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
Run php artisan migrate
Run php artisan db:seed

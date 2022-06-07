This is a lunch booking system.
This system helps user to make entry by clicking one button instead of making entry in book, it will also help Admin to count filter records.

Rerquirements:-


> > > > > > > 2f158ecc85443057cea45db0b68a2cfb98b9715d
> > > > > > > composer-version >= 2.2.7
> > > > > > > php-version >= 7.4.3,
> > > > > > > Laravel-version >=8.0.0,
> > > > > > > Microsoft-graph >=1.64,
> > > > > > > Yajra/Laravel-datatables-buttons = 4.13,
> > > > > > > Yajra/Laravel-datatables-oracle = 9.20,
> > > > > > > Darkaonline/l5-Swagger = 8.3,
> > > > > > > Fruitcake/laravel-cors = 2.0,
> > > > > > > Guzzlehttp/guzzle = 7.4,
> > > > > > > Laravel/sanctum = 2.11,
> > > > > > > Laravel/tinker = 2.5,
> > > > > > > Laravel/ui = 3.4

Installation:-

    1. Clone project using git clone project-name
    2. Go to the folder application using cd command on your cmd or terminal
    3. Run composer install on your cmd or terminal
    4. Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt        Windows or cp .env.example .env if using terminal, Ubuntu
    5. Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
    6. Run php artisan key:generate
    7. Run php artisan migrate
    8. Run php artisan db:seed

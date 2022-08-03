
## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository
    
    git clone https://github.com/Munirkhuja/test_ioyandasoz.git
    
Switch to the repo folder

    cd test_ioyandasoz

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    php artisan passport:install

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## command list
    git clone https://github.com/Munirkhuja/test_ioyandasoz.git
    cd test_ioyandasoz
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan passport:install
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the OrderSeeder,DatabaseSeeder and set the property values as per your requirement

    database/seeders/OrderSeeder.php
    database/seeders/DatabaseSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
Run the Assigned driver for all order where status entry   

    php artisan order:assigned


# Code overview

## Dependencies

- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) - For help find error
- [fruitcake/laravel-cors](https://github.com/fruitcake/laravel-cors) - For handling Cross-Origin Resource Sharing (CORS)
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) - For makes it easy to send HTTP requests and trivial to integrate with web services

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Models` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the api controllers
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all routes defined in web.php file

## Environment variables

- `.env` - Environment variables can be set in this file


-`OAUTH_PWD_GRANT_CLIENT_ID=`

-`OAUTH_PWD_GRANT_CLIENT_SECRET=`

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------
## License

Licensed under the [MIT License](http://opensource.org/licenses/MIT).

Copyright © 2022 [Munirjon Dodojonov](https://www.linkedin.com/in/munirjon-dodojonov-6b070422b)


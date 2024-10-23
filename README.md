## About app

---

-   simplified RESTful API for managing `Products` and `Orders` in a small e-commerce system

1. Database Design & Migrations:
2. Data Structures & Algorithms:
3. Laravel Features:
4. RESTful API:
5. Security:
6. Testing:

## How to get started

---

## Installation

    git clone or download project
    take copy of .env.example to .env
    run composer install
    php artisan key:generate

_/_ create database with name of your choice >>>> in .env file

-   run php artisan migrate command through your terminal to publish all tables on database
-   run php artisan db:seed to fill users, categories and products tables with some records
-   seeding will provide you with two credential for user (user@example.com, password)

## Role Priviliges (Authentication)

-   login with user credentials (using login endpoint to get access token) and accordingly get access to authorized routes

# features

-   user can logon
-   view and search (filter products) with name , category, price reanges
-   view product details
-   create order
-   also (create/ update) product, it coould be for role admin later
-   send email notification to admin with each place order action

## Tools Used

-   php
-   laravel
-   mysql
-   phpunit
-   git bash
-   composer

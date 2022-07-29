<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<p align="center">
<img src="https://www.seyedrezabazyar.com/fa/files/2018/03/snappfood.png" width="150">
</p>

# Snapp Food
## About
This is a sample of snapp food that has three parts of super admin,seller and customer. 
seller and super admin is SSG but customer part is Restful API
## Used packages
- Breeze (seller and super admin authentication)
- Sanctum (customer authentication)
- Laravel-Chart
- Laravel-Excel
## Installation
> **Note:** First of all create **snappfood** database
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
## Roles
### Super Admin
#### Login
You can sign in as a super admin with these information:
- Email: admin@gmail.com
- Password: 12345678
#### Features
- Restauarnt categories (CRUD)
- Food categories (CRUD)
- Discounts (CRUD)
- Manage comments that sellers request to delete them
### Seller
#### Sample Login
- Email: seller@gmail.com
- Password: 12345678
#### Features
- Food menu (CRUD)
- Set schedule time
- Edit restaurant general information settings
- See foods comments and reply to them
- Analyze financial reports and charts of restaurant
- Analyze Orders history of restaurant
### Customer
#### Sample Login
- Email: customer@gmail.com
- Password: 12345678
#### Features
- Add and update address and set address as activate address
- See food menu and general information of near restaurants
- Card (CRUD) + Pay card
- Post comments and read them

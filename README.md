# ShopBanhang

## Overview

ShopBanhang is an e-commerce web application built with Laravel 11 and PHP 8.2. It provides a complete online store experience with product management, category and brand administration, customer-facing storefront pages, and an admin dashboard.

## Key Features

- Admin management for products, categories, brands, and discounts
- Product listing, details, and image management
- Category and brand organization for easier shopping
- Customer-facing storefront and backend admin interface
- Session-based messages and redirects for basic user flow
- Vite-powered frontend asset build with modern tooling

## Technology Stack

- PHP 8.2
- Laravel 11
- MySQL / database driven with Laravel migrations
- Vite for frontend asset bundling
- PHPMailer for email functionality
- PHPUnit for testing

## Project Structure

- `app/` - application controllers, models, providers
- `config/` - Laravel configuration files
- `database/` - migrations, factories, seeders
- `public/` - public assets and frontend/backend compiled resources
- `resources/` - view templates, CSS, and JavaScript source
- `routes/` - web routes and console commands
- `tests/` - automated application tests

## Setup

1. Install PHP and Composer
2. Copy `.env.example` to `.env`
3. Run `composer install`
4. Generate application key: `php artisan key:generate`
5. Configure database settings in `.env`
6. Run migrations: `php artisan migrate`
7. Install frontend dependencies if needed and build assets:
   - `npm install`
   - `npm run build`
8. Start the application: `php artisan serve`

## Notes

This application is designed as a Laravel e-commerce demo with admin and storefront functionality. It can be extended with authentication, payment integration, and more advanced shopping cart features.

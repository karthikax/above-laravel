## Above Laravel

### Features
* User Data Model
* User Model Migration
* Facebook Login
* Google OAuth Login
* Functional + Testable
* UI using Bootstrap
* OAuth Credentials in Config File
* Config Can use `.env` file

### Installation
* Run following commands:
```
git clone https://github.com/karthikax/above-laravel.git
cd above-laravel
composer install
cp .env.example .env
php artisan key:generate
```
* Now Open `.env` file.
* Enter database credentials.
* Enter Facebook and Google API credentials
* Run `php artisan migrate`

### Serve
* Run `php artisan serve`


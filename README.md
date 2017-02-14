# Laravel Email Confirmation Package

## Requirements
- Laravel 5.4+ (Uses markdown email notifications)
- App\User and Auth from the Box will be used. No other Auth methods is supported!
- App\User must be Notifiable;

## Installation
```
composer require "in-the-beam/laravel-email-confirmation"
```
Add Service Provider to `config/app.php`
```
    ITB\LEC\LECServiceProvider::class,
```
Add Traits to:
`App\User.php`
```
//...
use ITB\LEC\Traits\LECUserTrait;
//...
class User 
{
//....
    use LECUserTrait;
//....
}

```
Publich configuration
```
php artisan vendor:publish --provider="ITB\LEC\Providers\LECServiceProvider" --tag="config"
```
Publish Views (if You plan to modify it)
```
php artisan vendor:publish --provider="ITB\LEC\Providers\LECServiceProvider" --tag="views"
```
Publish Lang (if You plan to modify it)
```
php artisan vendor:publish --provider="ITB\LEC\Providers\LECServiceProvider" --tag="lang"
```
OR PUBLISH ALL-IN-ONE
```
php artisan vendor:publish --provider="ITB\LEC\Providers\LECServiceProvider"
```
then
```
php artisan migrate
```
Registering event listener for registering the new user which sends an confirmation email
`app\Providers\EventServiceProvider.php`
```
protected $listen = [
//....
    'Illuminate\Auth\Events\Registered' => [
        'ITB\LEC\Listeners\LECRegisteredUserListener',
    ],
//....
];

```
# Under Apache 2.0 License !

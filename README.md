# Laravel Email Confirmation Package

## Features
- Post-registration E-Mail confirmation
- Middleware trap to catch Users with unconfirmed E-Mail (see below)
- Re-send confirmation letter page
- User-friemdly confirmation / repeat letter pages (for authenticated user - substitute the correct values of hash/email)
- Flexible configuration for route prefixex

## Milestones
- Google re-Captcha
- Enable/Disable entire package through configuration

## Requirements
- Laravel 5.4+ (May use markdown email notifications)
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
Unconfirmed E-Mail catch (Middleware trap)
in `app\Http\Kernel.php` add route middleware
```
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // .....
        'LEC.catchUnconfirmedEmail' => \ITB\LEC\Middleware\LECCatchUnconfirmed::class,
        // .....
    ];

```
change `routes/web.php` as follow
```
Auth::routes();
Route::group( ['middleware' => [ 'web', 'LEC.catchUnconfirmedEmail' ] ], function()
{
    //....
    // Your Routes is here
    //....
});
```
Now all requests (Authenticated users only!) will be checked for confirmed E-Mail and trapped to "/confirm/warning" page
You can copy LECCatchUnconfirmed.php Middleware to any other place and append your condition as you wish. Dont forget to define new middleware :)

Enjoy!

# MIT License

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

### Laravel setup

```
composer create-project laravel/laravel laravel-11-mini-crm
```

### Starter kit - Breeze

```
composer require laravel/breeze --dev
php artisan breeze:install
// Blade with Alpine
```

###### split default name into first name and last name in users table

-   Change name to first_name in users migrations and new column last_name
-   Change is register blade form as well.

```
php artisan migrate:fresh
```

-   changes in users factory as well

```
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
```

```
php artisan db:seed
```

#### User CRUD

-   create resource usercontroller

```
php artisan make:controller UserController --resource --model=User
```

#### Roles and permissions

-   Spatie Laravel-permission package for roles and permissions
    URL: https://spatie.be/docs/laravel-permission/v6/installation-laravel
    Git repository : https://github.com/spatie/laravel-permission

##### Installation

```
 composer require spatie/laravel-permission
 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
 php artisan migrate

```

-   Add the necessary trait to your User model:

```
 // The User model requires this trait
use HasRoles;
```

-   Create your Enum object for use with Roles and/or Permissions.

```
php artisan make:enum RolesEnum
```

-   Create role seeder.

```
php artisan make:seeder RoleSeeder
```

-   call it in database seeder

```
$this->call(RoleSeeder::class);
```

-   Factory Callbacks
    In User factory to assign user roles to all users from user factory

```
https://laravel.com/docs/11.x/eloquent-factories#factory-callbacks
```

```
        /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::USER);
        });
    }
```

-   Create admin user in database seeder and assign role admin to it.
-   Sync Permissions To A Role

```
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->syncRoles(RolesEnum::ADMIN);
```

-   Run run migration fresh seed command

```
php artisan migrate:fresh --seed
```
- Add role directive to show users only to admin role
```
                    @hasrole(\App\RolesEnum::ADMIN)
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        {{ __('Users') }}
                    </x-nav-link>
                    @endhasrole
```
- only admin access user curd links
- Using Middleware in Routes and Controllers
```
    Route::resource('users', UserController::class)->middleware('role:'. RolesEnum::ADMIN);
```
- Package Middleware
- In Laravel 11 open ```/bootstrap/app.php``` and register them there:
```
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
```
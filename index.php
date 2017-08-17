<?php
/*
|--------------------------------------------------------------------------
| Include autoloaders
|--------------------------------------------------------------------------
|
| Lumen autoload is required to get the tool work
|
*/
require_once 'vendor/lumen/autoload.php';

use Laravel\Lumen\Application;

/*
|--------------------------------------------------------------------------
| Enviroment config file intantiation
|--------------------------------------------------------------------------
| @see https://lumen.laravel.com/docs/configuration#environment-configuration
*/
try {
    (new \Dotenv\Dotenv(\app\ApiApp::LUMEN_PATH, \app\ApiApp::LUMEN_ENV_FILENAME))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Application(
    realpath(__DIR__)
);


// Disable default monolog logging (/storage/logs/lumen.log)
$app->configureMonologUsing(function (Monolog\Logger $monolog) {
    return $monolog;
});


/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    handlers\ErrorHandler::class
);


/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Define controllers folder & routes file path
|--------------------------------------------------------------------------
*/
$app->group(
    [
        'namespace' => 'controllers',
        'prefix' => \app\ApiApp::getBaseUrl()
    ],
    function (Application $app) {
        require __DIR__ . '/routes.php';
    }
);

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$app->run();

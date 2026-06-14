<?php

declare(strict_types=1);

define('BASE_URL', rtrim(
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
    . dirname($_SERVER['SCRIPT_NAME']),
    '/'
));

spl_autoload_register(function (string $class): void {
    
    $prefix   = 'App\\';
    $baseDir  = __DIR__ . '/src/';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file     = $baseDir . str_replace('\\', '/', $relative) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

session_start();

use App\Core\Router;

$router = new Router();

$router->add('home',     'PublicController', 'home');
$router->add('services', 'PublicController', 'services');
$router->add('gallery',  'PublicController', 'gallery');
$router->add('contact',  'PublicController', 'contact');
$router->add('404',      'PublicController', 'notFound');

$router->add('admin-login',  'AdminController', 'login');
$router->add('admin-logout', 'AdminController', 'logout');

$router->add('admin-dashboard',      'AdminController', 'dashboard',      true);

$router->add('admin-services',       'AdminController', 'servicesList',   true);
$router->add('admin-service-create', 'AdminController', 'serviceCreate',  true);
$router->add('admin-service-edit',   'AdminController', 'serviceEdit',    true);
$router->add('admin-service-delete', 'AdminController', 'serviceDelete',  true);

$router->add('admin-gallery',        'AdminController', 'galleryList',    true);
$router->add('admin-gallery-create', 'AdminController', 'galleryCreate',  true);
$router->add('admin-gallery-edit',   'AdminController', 'galleryEdit',    true);
$router->add('admin-gallery-delete', 'AdminController', 'galleryDelete',  true);

$router->add('admin-messages',       'AdminController', 'messagesList',   true);
$router->add('admin-message-read',   'AdminController', 'messageRead',    true);
$router->add('admin-message-delete', 'AdminController', 'messageDelete',  true);

$router->dispatch();

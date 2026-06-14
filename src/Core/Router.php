<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    
    private array $routes = [];

    
    public function add(string $page, string $controller, string $action, bool $auth = false): void
    {
        $this->routes[$page] = [
            'controller' => $controller,
            'action'     => $action,
            'auth'       => $auth,
        ];
    }

    
    public function dispatch(): void
    {
        $page = $_GET['page'] ?? 'home';
        $page = preg_replace('/[^a-zA-Z0-9_\-]/', '', $page); 

        if (!isset($this->routes[$page])) {
            $page = '404';
        }

        $route = $this->routes[$page] ?? $this->routes['404'];

        
        if ($route['auth'] && !Auth::isLoggedIn()) {
            header('Location: index.php?page=admin-login');
            exit;
        }

        $controllerClass = 'App\\Controllers\\' . $route['controller'];
        $action          = $route['action'];

        if (!class_exists($controllerClass)) {
            die('Controller neexistuje: ' . htmlspecialchars($controllerClass));
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            die('Metóda neexistuje: ' . htmlspecialchars($action));
        }

        $controller->$action();
    }
}

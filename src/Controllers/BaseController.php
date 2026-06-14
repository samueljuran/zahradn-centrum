<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class BaseController
{
    
    protected function render(string $view, array $data = []): void
    {
        
        extract($data);

        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die('View nenájdený: ' . htmlspecialchars($viewPath));
        }

        require $viewPath;
    }

    
    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    
    protected function post(string $key, string $default = ''): string
    {
        return htmlspecialchars(trim($_POST[$key] ?? $default), ENT_QUOTES, 'UTF-8');
    }

    
    protected function get(string $key, string $default = ''): string
    {
        return htmlspecialchars(trim($_GET[$key] ?? $default), ENT_QUOTES, 'UTF-8');
    }
}

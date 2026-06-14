<?php

declare(strict_types=1);

namespace App\Core;

class Auth
{
    private const SESSION_KEY = 'admin_logged_in';
    private const USER_KEY    = 'admin_username';

    
    public static function isLoggedIn(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION[self::SESSION_KEY]) && $_SESSION[self::SESSION_KEY] === true;
    }

    
    public static function login(string $username): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_regenerate_id(true); 
        $_SESSION[self::SESSION_KEY] = true;
        $_SESSION[self::USER_KEY]    = $username;
    }

    
    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
    }

    
    public static function getUsername(): string
    {
        return $_SESSION[self::USER_KEY] ?? '';
    }
}

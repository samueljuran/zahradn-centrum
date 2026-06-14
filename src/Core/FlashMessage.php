<?php

declare(strict_types=1);

namespace App\Core;

class FlashMessage
{
    private const SESSION_KEY = '_flash';

    
    public static function set(string $type, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[self::SESSION_KEY] = [
            'type'    => $type,
            'message' => $message,
        ];
    }

    
    public static function get(): ?array
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION[self::SESSION_KEY])) {
            return null;
        }

        $flash = $_SESSION[self::SESSION_KEY];
        unset($_SESSION[self::SESSION_KEY]);
        return $flash;
    }

    
    public static function has(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION[self::SESSION_KEY]);
    }
}

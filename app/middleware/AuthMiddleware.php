<?php

class AuthMiddleware
{
    public static function is_authenticated()
    {
        session_start();
        if (!isset($_SESSION['jwt'])) {
            header('Location: /base');
            exit();
        }
    }

    public function is_not_authenticated()
    {
        session_start();
        if (isset($_SESSION['jwt'])) {
            header('Location: /home');
            exit();
        }
    }
}

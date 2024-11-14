<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use \Firebase\JWT\JWT;

class BaseController extends Controller
{
    private $userModel;

    public function __construct()
    {
        session_start();
        $this->userModel = new User();
    }
    public function index()
    {
        if (isset($_SESSION['jwt'])) {
            header('Location: /home');
            exit();
        }
        $this->renderView('base/index');
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->findUser($username);

        if ($user && password_verify($password, $user['password'])) {
            $jwt = $this->generateJwt($user);

            session_start();
            $_SESSION['jwt'] = $jwt;

            header('Location: /home');
            exit();
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('Location: /base');
        exit();
    }

    private function generateJwt($user)
    {
        $secret_key = 'cowSecret123';
        $issuer = 'localhost';
        $algorithm = 'HS256';

        $issued_at = time();
        $expiration_time = $issued_at + 3600;

        $payload = array(
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "iss" => 'localhost',
            "data" => array(
                "id" => $user['id'],
                "username" => $user['username']
            )
        );

        $jwt = JWT::encode($payload, $secret_key, $algorithm);

        return $jwt;
    }
}

<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class UserController extends Controller
{
    private $userModel;
    public function __construct()
    {
        AuthMiddleware::is_authenticated();
        $this->userModel = new User();
    }
    public function index()
    {
        $users = $this->userModel->getUsers();
        $this->renderView('user/index', ['users' => $users]);
    }

    public function create()
    {
        $url = '/user/store';
        $type = 'create';

        $this->renderView('/user/form', ['url' => $url, 'type' => $type]);
    }

    public function store()
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        if (empty($username)) {
            echo "Username are required.";
            return;
        } else if (empty($password)) {
            echo "Password are required.";
            return;
        }

        $result = $this->userModel->save($username, $email, $password_hashed);

        if ($result) {
            echo "User added successfully!";
        } else {
            echo "Failed to add user.";
        }
    }
}

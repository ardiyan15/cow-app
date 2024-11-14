<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class HomeController extends Controller {

    public function __construct()
    {
        AuthMiddleware::is_authenticated();
    }
    public function index() {
        $title = "Home Page";
        $this->renderView('home/index', ['title' => $title]);
    }

    public function detail(){
        $title = "Detail Page";
        $this->renderView('home/detail', ['title' => $title]);
    }
}

<?php

// Define the base directory for controllers
define('CONTROLLER_PATH', __DIR__ . '/../app/controllers/');

// Get the URI and trim any slashes
$uri = trim($_SERVER['REQUEST_URI'], '/');

// Split the URI into parts
$uriParts = explode('/', $uri);

// Determine the controller and method (default to HomeController and index method)
$controllerName = isset($uriParts[0]) && $uriParts[0] ? ucfirst($uriParts[0]) . 'Controller' : 'HomeController';
$method = isset($uriParts[1]) && $uriParts[1] ? $uriParts[1] : 'index';

// Construct the controller file path
$controllerFile = CONTROLLER_PATH . $controllerName . '.php';

// Check if the controller file exists
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Instantiate the controller
    $controller = new $controllerName();
    
    // Check if the method exists in the controller
    if (method_exists($controller, $method)) {
        // Call the method dynamically
        $controller->$method();
    } else {
        // If the method does not exist, show a 404 error
        echo "404 - Method '$method' not found in $controllerName.";
    }
} else {
    // If the controller file does not exist, show a 404 error
    echo "404 - Controller '$controllerName' not found.";
}
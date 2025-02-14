<?php
require_once '../app/Controllers/EventController.php';

// Define available routes and their corresponding controllers/methods
$routes = [
    'listEvents' => ['controller' => 'EventController', 'method' => 'listEvents'],
    'viewEvent' => ['controller' => 'EventController', 'method' => 'viewEventDetails'],
    'addEvent' => ['controller' => 'EventController', 'method' => 'addEvent'],
];

// Get the requested action, default to 'listEvents'
$action = $_GET['action'] ?? 'listEvents';

// Check if the requested action exists in the routes
if (isset($routes[$action])) {
    $controllerName = $routes[$action]['controller'];
    $method = $routes[$action]['method'];

    // Dynamically instantiate the correct controller
    $controller = new $controllerName();

    // Remove `action` from $_GET, leaving only parameters
    unset($_GET['action']);
    $params = array_values($_GET); // Get remaining query parameters as indexed array

    // Call the controller method with dynamic parameters
    call_user_func_array([$controller, $method], $params);
} else {
    http_response_code(404);
    echo "404 - Page Not Found";
}

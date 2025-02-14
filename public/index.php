<?php
require_once '../app/Controllers/EventController.php';

/*
* E.g.: http://localhost:8000/index.php?action=viewEvent&id=df5d68f3-a21c-4f2a-bcd6-21320fb58f87
* action = 'viewEvent'
* id = 'df5d68f3-a21c-4f2a-bcd6-21320fb58f87'
* will match EventController at line 23.
*/

// Define routes and their actions/methods
$routes = [
    'listEvents' => ['controller' => 'EventController', 'method' => 'listEvents'],
    'viewEvent' => ['controller' => 'EventController', 'method' => 'viewEventDetails'],
    'addEvent' => ['controller' => 'EventController', 'method' => 'addEvent'],
];

// Get the requested action, if empty go to index page and 'listEvents'.
$action = $_GET['action'] ?? 'listEvents';

// Check if the requested action exists in the routes
if (isset($routes[$action])) {
    $controllerName = $routes[$action]['controller'];
    $method = $routes[$action]['method'];

    // Dynamically instantiate the correct controller
    $controller = new $controllerName();

    // Remove 'action' from $_GET, leaving only the parameters
    unset($_GET['action']);
    $params = array_values($_GET); // Get remaining query parameters as indexed array

    // Call the controller method with dynamic parameters
    call_user_func_array([$controller, $method], $params);
} else {
    http_response_code(404);
    echo "404 - Page Not Found";
}

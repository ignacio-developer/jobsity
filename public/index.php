<?php

require_once '../app/Controllers/EventController.php';

$controller = new EventController();

// Simple routing based on `action` GET parameter
$action = $_GET['action'] ?? 'listEvents';

if ($action === 'viewEvent' && isset($_GET['id'])) {
    $controller->viewEventDetails($_GET['id']);
} elseif ($action === 'addEvent') {
    $controller->addEvent();
}  else {
    $controller->listEvents();
}

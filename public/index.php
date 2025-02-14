<?php

require_once '../app/Controllers/EventController.php';

$controller = new EventController();

// Simple routing based on `action` GET parameter
$action = $_GET['action'] ?? 'listEvents';

if ($action === 'viewEvent' && isset($_GET['id'])) {
    $controller->viewEventDetails($_GET['id']);
} else {
    $controller->listEvents();
}

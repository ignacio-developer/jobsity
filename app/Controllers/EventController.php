<?php
require_once '../app/Models/Event.php';

class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new Event();
    }

    public function listEvents() {
        $events = $this->eventModel->getAllEvents();
        require '../app/Views/events.php'; // Pass data to the view
    }

    public function viewEventDetails($eventId) {
        $event = $this->eventModel->getEventById($eventId);
        require '../app/Views/event_details.php'; // Load event details view
    }

    public function addEvent() {
        $error = "";
        $success = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $startDate = trim($_POST['startDate'] ?? '');
            $endDate = trim($_POST['endDate'] ?? '');
            
            if (empty($title) || empty($description) || empty($startDate) || empty($endDate)) {
                $error = "All fields are required.";
            } elseif (new DateTime($startDate) > new DateTime($endDate)) {
                $error = "Start date cannot be after the end date.";
            } else {
                $result = $this->eventModel->createEvent($title, $description, $startDate, $endDate);
                
                if ($result) {
                    $success = "Event successfully added!";
                } else {
                    $error = "Failed to add event. Please try again.";
                }
            }
        }
        require '../app/Views/add_event.php';
    }
}


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
        //print_r($event);
        //return;
        require '../app/Views/event_details.php'; // Load event details view
    }
}

<?php
require_once '../app/CivicPlusAPI.php';

class Event extends CivicPlusAPI {
    public function getAllEvents() {
        $response = $this->makeRequest(API_BASE . "/Events");
        return $response->items ?? []; // Ensure items array is returned
    }

    public function getEventById($eventId) {
        return $this->makeRequest(API_BASE . "/Events/$eventId");
    }

    public function createEvent($title, $description, $startDate, $endDate) {
        $data = [
            'title' => $title,
            'description' => $description,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        return $this->makeRequest(API_BASE . "/Events", 'POST', $data);
    }
}

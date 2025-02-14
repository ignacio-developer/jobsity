<?php
// CivicPlusAPI.php - API Client Class
require_once 'config.php';

class CivicPlusAPI {
    private $token;

    public function __construct() {
        $this->loadToken();
    }

    private function authenticate() {
        $url = API_BASE . "/Auth";
        $data = [
            'clientId' => CLIENT_ID,
            'clientSecret' => CLIENT_SECRET
        ];
        
        $response = $this->makeRequest($url, 'POST', $data, false);
        if ($response && isset($response->access_token)) {
            $this->token = $response->access_token;
            $_SESSION['api_token'] = $this->token;
            $_SESSION['token_expires'] = time() + 2592000; // Token valid for 30 days
        } else {
            die('Authentication failed.');
        }
    }

    private function loadToken() {
        if (!empty($_SESSION['api_token']) && !empty($_SESSION['token_expires']) && time() < $_SESSION['token_expires']) {
            $this->token = $_SESSION['api_token'];
        } else {
            $this->authenticate();
        }
    }

    protected function makeRequest($url, $method = 'GET', $data = [], $auth = true) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $headers = ['Content-Type: application/json'];
        if ($auth && $this->token) {
            $headers[] = 'Authorization: Bearer ' . $this->token;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        curl_close($ch);

        //print_r($response);

        return json_decode($response);
    }
}
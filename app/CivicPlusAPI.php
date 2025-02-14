<?php

// config.php - Configuration file for API settings
define('CLIENT_ID', '906f1e8f-61b3-4c67-89df-b992950d59bc');
define('CLIENT_SECRET', '3ewzvs00d6k8kspfnbkawmjqxb07mrbxicpbfdcbj5ix');
define('API_BASE', 'https://interview.civicplus.com/906f1e8f-61b3-4c67-89df-b992950d59bc/api');

// CivicPlusAPI.php - API Client Class
//require_once 'config.php';

class CivicPlusAPI {
    private $token;

    public function __construct() {
        $this->authenticate();
    }

    private function authenticate() {
        $url = API_BASE . "/Auth";
        $data = [
            'clientId' => CLIENT_ID,
            'clientSecret' => CLIENT_SECRET
        ];
        
        $response = $this->makeRequest($url, 'POST', $data, false);
        if ($response && isset($response->access_token)) {
            //print_r($response);
            $this->token = $response->access_token;
        } else {
            die('Authentication failed.');
        }
    }

    public function getToken() {
        return $this->token;
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
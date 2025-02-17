<?php
require_once '../app/helpers.php'; // Load helper function for environment vars.
loadEnv(); // Load environment variables.

class CivicPlusAPI {
    private $token;

    public function __construct() {
        $this->loadToken();
    }

    private function authenticate() {
        $url = $_ENV['API_BASE'] . "/Auth";
        $data = [
            'clientId' => $_ENV['CLIENT_ID'],
            'clientSecret' => $_ENV['CLIENT_SECRET']
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
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            
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
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);
    
            if ($curlError) {
                throw new Exception("cURL error: " . $curlError);
            }
    
            if ($httpCode >= 400) {
                throw new Exception("API request failed with status code $httpCode: " . json_encode($response));
                /* e.g: 
                 * 1. invalid auth token will respond: Please check your that Authorization was provided. 
                 * TheHTTP status code of the response was not expected (401). 
                 * 2. invalid end-point will respond: Endpoint not found (404). 
                */
            }
    
            return json_decode($response);
        } catch (Exception $e) {
            error_log("API Request Error: " . $e->getMessage());
            return null; // Return null or handle errors accordingly
        }
    }
}
<?php
function loadEnv($file = '../.env') {
    if (!file_exists($file)) {
        die("Missing .env file.");
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
            putenv("$key=$value"); //Makes it available via getenv()
        }
    }
}

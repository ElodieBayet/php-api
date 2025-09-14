<?php

declare(strict_types=1);

/** Class Autoloader */
require './vendor/matrix/Autoloader.php';
Autoloader::register(
    [
        'Matrix' => 'vendor',
    ],
    '.'
);

/** Start Processus */
use Matrix\Foundation\HttpCore;

try {
    $core = new HttpCore;
} catch (\Exception $e) {
    if ($_SERVER['SERVER_NAME'] === 'php-api.local') {
        echo "Root ::\r\n" . $e->getMessage();
        exit;
    }
    header('Location: /unavailable.php', true, 307);
    exit;
}

/** @var Response $response */
$response = $core->handle();
$response->send();
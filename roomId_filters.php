<?php

$roomId = filter_input(
    INPUT_GET,
    'roomId',
    FILTER_VALIDATE_INT,
    ["options" => ["min_range" => 1]]
);

if (!$roomId) {
    http_response_code(400);
    echo "<h1>Bad request</h1>";
    die;
}

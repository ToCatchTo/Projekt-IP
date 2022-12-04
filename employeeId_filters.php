<?php

$employeeId = filter_input(
    INPUT_GET,
    'employeeId',
    FILTER_VALIDATE_INT,
    ["options" => ["min_range" => 1]]
);

if (!$employeeId) {
    http_response_code(400);
    echo "<h1>Bad request</h1>";
    die;
}
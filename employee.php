<?php
    include "employeeId_filters.php";
    require_once "inc/db_connect.inc.php";

    $query = 'SELECT employee.`name`, employee.`surname`, employee.`job`, employee.`wage`, employee.`room` FROM `employee` JOIN `room` WHERE `employee_id`= :employeeId';
    $query2 = 'SELECT DISTINCT r.`name` FROM `employee` e JOIN `key` k ON k.employee = e.`employee_id` JOIN `room` r ON r.`room_id` = e.`room` WHERE e.`employee_id` = :employeeId';
    $query3 = 'SELECT e.`name`, e.`surname`, r.`name` as `placeName`, k.`room`, r.`room_id` FROM `employee` e JOIN `key` k ON e.`employee_id` = k.`employee` JOIN `room` r ON r.`room_id` = k.`room` WHERE e.`employee_id` = :employeeId';

    $employeeInfoStmt = $pdo->prepare($query);
    $workplaceStmt = $pdo->prepare($query2);
    $roomKeysStmt = $pdo->prepare($query3);

    $employeeInfoStmt->execute(['employeeId' => $employeeId]);
    $workplaceStmt->execute(['employeeId' => $employeeId]);
    $roomKeysStmt->execute(['employeeId' => $employeeId]);

    if ($employeeInfoStmt->rowCount() === 0)
    {
        http_response_code(404);
        echo "<h1>Not found</h1>";
        die;
    }

    $employeeInfo = $employeeInfoStmt->fetch();
    $workplace = $workplaceStmt->fetch();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Karta osoby: <?php echo $employeeInfo->surname . " " . $employeeInfo->name[0] . "." ?></title>
    <style>
        .text_dec_none
        {
            text-decoration: none;
            color: #337ab7
        }
        .margin_style
        {
            margin-right: 15px;
        }
    </style>
</head>
    <body>
        <?php

            echo "<h1><b>Karta osoby: </b><i>{$employeeInfo->surname} {$employeeInfo->name[0]}.</i></h1>";
            echo "<div><b class='margin_style'>Jméno</b> {$employeeInfo->name}</div>";
            echo "<div><b class='margin_style'>Příjmení</b> {$employeeInfo->surname}</div>";
            echo "<div><b class='margin_style'>Pozice</b> {$employeeInfo->job}</div>";
            echo "<div><b class='margin_style'>Mzda</b> {$employeeInfo->wage} </div>";
            echo "<div><b class='margin_style'>Místnost</b><a class='text_dec_none' href='room.php?roomId={$employeeInfo->room}'>{$workplace->name}</a> </div>";
            echo "<div><b class='margin_style'>Klíče: </b></div>";
            while($roomKeys = $roomKeysStmt->fetch())
            {
                echo "<div><a class='text_dec_none' href='room.php?roomId={$roomKeys->room_id}'>{$roomKeys->placeName}</a></div>";
            }
            echo "<div><a class='text_dec_none' href='rooms.php?sort=name_down'>← Zpátky</a></div>";
        ?>
    </body>
</html>


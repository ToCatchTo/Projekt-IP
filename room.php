<?php

    include "roomId_filters.php";
    require_once "inc/db_connect.inc.php";

    $query = 'SELECT e.`name`, r.`name` AS `workplace`, e.`surname`, e.`job`, r.`phone`, r.`no`, e.`wage` FROM `employee` e JOIN `room` r ON r.`room_id` = e.`room` WHERE `room_id`= :roomId';
    $avgWage = 'SELECT AVG(e.`wage`) AS "avg" FROM `employee` e JOIN `room` r ON r.`room_id` = e.`room` WHERE `room_id`= :roomId';
    $people = 'SELECT e.`name`, e.`surname`, e.`employee_id` FROM `employee` e JOIN `room` r ON r.`room_id` = e.`room` WHERE `room_id`= :roomId';
    $keys = 'SELECT e.`name`, e.`surname`, e.`employee_id` FROM `employee` e JOIN `key` k ON k.employee = e.`employee_id` WHERE k.`room` = :roomId';

    $stmt = $pdo->prepare($query);
    $stmt2 = $pdo->prepare($avgWage);
    $stmt3 = $pdo->prepare($people);
    $stmt4 = $pdo->prepare($keys);

    $stmt->execute(['roomId' => $roomId]);
    $stmt2->execute(['roomId' => $roomId]);
    $stmt3->execute(['roomId' => $roomId]);
    $stmt4->execute(['roomId' => $roomId]);

    $room = $stmt->fetch();
    $wage = $stmt2->fetch();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Karta místnosti č. <?php echo $room->no ?></title>
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
            echo "<h1>Místnost č. {$room->no}</h1>";
            echo "<div><b class='margin_style'>Číslo</b>{$room->no}</div>";
            echo "<div><b class='margin_style'>Název</b> {$room->workplace}</div>";
            echo "<div><b class='margin_style'>Telefon</b> {$room->phone}</div>";
            echo "<div><b class='margin_style''>Lidé:</b> </div>";
            while($row = $stmt3->fetch())
            {
                echo "<div><a class='text_dec_none' href='employee.php?employeeId={$row->employee_id}'>{$row->surname} {$row->name[0]}.</a></div>";
            }
            echo "<div><b class='margin_style'>Průměrná mzda</b> {$wage->avg}</div>";
            echo "<div><b class='margin_style'>Klíče:</b> </div>";
            while($row = $stmt4->fetch())
            {
                echo "<div><a class='text_dec_none' href='employee.php?employeeId={$row->employee_id}'>{$row->surname} {$row->name[0]}.</a></div>";
            }
            echo "<div><a class='text_dec_none' href='rooms.php?sort=name_down'>← Zpátky</a></div>";
        ?>
    </body>
</html>

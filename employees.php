<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <title>Seznam zaměstnanců</title>
</head>
<body class="container">
<?php

require_once "inc/db_connect.inc.php";

$order = "";
$sort = 'surname_down';

include "order_employeeId.php";

$stmt = $pdo->query('SELECT employee.`name`, room.`name` AS `workplace`, employee.`surname`, employee.`job`, room.`phone`, employee.`employee_id` FROM `employee` JOIN `room` ON room.`room_id` = employee.`room`' . $order);

if ($stmt->rowCount() == 0) {
    echo "Záznam neobsahuje žádná data";
}
else
{
    echo "<h1 style='margin-bottom: 20px'>Seznam zaměstnanců</h1>";
    echo "<table class='table table-striped'>";
    //todo dodělat zabarvování šipek
    echo "<tr><th>Jméno <a style='text-decoration: none' href='employees.php?sort=surname_down'>↑</a><a style='text-decoration: none' href='employees.php?sort=surname_up'>↓</a></th><th>Místnost <a style='text-decoration: none' href='employees.php?sort=workplace_down'>↑</a><a style='text-decoration: none' href='employees.php?sort=workplace_up'>↓</a></th><th>Telefon <a style='text-decoration: none' href='employees.php?sort=phone_down'>↑</a><a style='text-decoration: none' href='employees.php?sort=phone_up'>↓</a></th><th>Pozice <a style='text-decoration: none' href='employees.php?sort=job_down'>↑</a><a style='text-decoration: none' href='employees.php?sort=job_up'>↓</a></th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td><a style='text-decoration: none' href='employee.php?employeeId={$row->employee_id}'>{$row->surname} {$row->name[0]}</a></td>";
        echo "<td>{$row->workplace}</td>";
        echo "<td>{$row->phone}</td>";
        echo "<td>{$row->job}</td>";
        echo "</tr>";
    }
    echo "</table>";
}
echo "<div><a style='text-decoration: none' href='db-browser.php'>←</a></div>";
unset($stmt);

?>
</body>
</html>

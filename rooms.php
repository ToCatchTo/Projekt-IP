<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <!-- Bootstrap-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <title>Seznam místností</title>
        <style>
            .text_dec_none
            {
                text-decoration: none;
            }
        </style>
    </head>
    <body class="container">
        <?php

        require_once "inc/db_connect.inc.php";
        $order = "";
        $sort = 'name_down';
        include "order_rooms.php";

        $stmt = $pdo->query('SELECT `room_id`, `name`, `no`, `phone` FROM `room`' . $order);

        if ($stmt->rowCount() == 0) {
            echo "Záznam neobsahuje žádná data";
        }
        else
        {
            echo "<h1 style='margin-bottom: 20px'>Seznam místností</h1>";
            echo "<table class='table table-striped'>";
            //todo dodělat zabarvování šipek
            echo "<tr>
                <th>Název <a class='text_dec_none' href='rooms.php?sort=name_down'>↑</a><a class='text_dec_none' href='rooms.php?sort=name_up'>↓</a></th>
                <th>Číslo <a class='text_dec_none' href='rooms.php?sort=no_down'>↑</a><a class='text_dec_none' href='rooms.php?sort=no_up'>↓</a></th>
                <th>Telefon <a class='text_dec_none' href='rooms.php?sort=phone_down'>↑</a><a class='text_dec_none' href='rooms.php?sort=phone_up'>↓</a></th>
                </tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td><a class='text_dec_none' href='room.php?roomId={$row->room_id}'>{$row->name}</a></td>";
                echo "<td>{$row->no}</td>";
                echo "<td>{$row->phone}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        echo "<div ><a class='text_dec_none' href='db-browser.php'>←</a></div>";
        unset($stmt);
        ?>
    </body>
</html>
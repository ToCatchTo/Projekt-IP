<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <!-- Bootstrap-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <title>Seznam místností</title>
        <style>
            .title
            {
                margin-bottom: 20px;
            }
            .text_dec_none
            {
                text-decoration: none;
            }
        </style>
    </head>
    <body class="container">
        <?php

        require_once "inc/db_connect.inc.php";

        echo "<h1 class='title' '>Seznam místností</h1>";
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<td><a class='text_dec_none' href='rooms.php?sort=name_down'>Seznam místností</a></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><a class='text_dec_none' href='employees.php?sort=surname_down'>Seznam Zaměstnanců</a></td>";
        echo "</tr>";
        echo "</table>";
        unset($stmt);

        ?>
    </body>
</html>

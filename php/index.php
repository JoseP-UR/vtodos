<?php
    header('Access-control-allow-origin: *');

    require('./connection.php');

    $db = new Connection('localhost', 'root', '', 'todos');

    var_dump($db);
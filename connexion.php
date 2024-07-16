<?php
    try {
        $cnx = new PDO("mysql:localhost=host;dbname=todolist", "root", "");
    } catch (PDOException $e) {
        echo $e;
    }
?>
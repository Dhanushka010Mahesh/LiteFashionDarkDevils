<?php

try {
    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DBNAME", "darkDevils");

    $connection = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";", USER, PASS);
} catch (PDOException $e) {
    echo $E->getMessage();
}

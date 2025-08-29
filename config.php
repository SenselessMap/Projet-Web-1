<?php
// config.php

$host = "sql111.infinityfree.com";    // MySQL hostname de InfinityFree pas mysql
$dbname = "if0_39451327_projetweb1"; //  db name
$username = "if0_39451327";          //  MySQL username
$password = "IL4OVE5PIZ3ZA1";       //IL4OVE5PIZ3ZA1

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

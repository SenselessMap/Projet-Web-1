<?php
// config.php

$host = "sql111.infinityfree.com";  
$dbname = "if0_39451327_projetweb1";    
$username = "if0_39451327";  
$password = "superpizza1337"; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

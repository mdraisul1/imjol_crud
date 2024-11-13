<?php

$host = "localhost";
$user = "root";
$pass = "password";
$dbname = "imjol_job";

$dns = "mysql:host=$host;dbname=$dbname";
try {
    $pdo = new PDO($dns, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database connection success!..";
} catch (Exception  $th) {
    echo "Database Connection Fail!" . $th->getMessage();
}

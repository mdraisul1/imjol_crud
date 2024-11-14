<?php

$host = "localhost";
$user = "root";
$pass = "password";
$dbname = "imjol_job";

$dns = "mysql:host=$host;dbname=$dbname";
try {
    $pdo = new PDO($dns, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database connection successful!..<br>";

    // SQL to create the 'application' table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS application (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        web_name VARCHAR(255) NOT NULL,
        position VARCHAR(255) NOT NULL,
        company_name VARCHAR(255) NOT NULL,
        salary DECIMAL(10, 2) NOT NULL,
        status VARCHAR(50) NOT NULL,
        job_link TEXT NOT NULL,
        date DATE NOT NULL
    )";

    // Execute the SQL to create the table
    $pdo->exec($sql);
    // echo "Table 'jobs' created successfully or already exists.<br>";

} catch (Exception $th) {
    echo "Database Connection Failed! " . $th->getMessage();
}

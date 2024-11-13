<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // Retrieve form data
    $website_name = $_POST['web_name'];
    $position = $_POST['position'];
    $company_name = $_POST['company_name'];
    $salary = $_POST['salary'];
    $status = $_POST['status'];
    $job_link = $_POST['job_link'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO application(web_name, position, company_name, salary, status, job_link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        // Execute the query with the provided values
        $stmt->execute([$website_name, $position, $company_name, $salary, $status, $job_link]);
        //successful submission
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error inserting data: " . $e->getMessage();
    }
} else {
    echo "No data inserted.";
}

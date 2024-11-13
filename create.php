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

    
} else {
    echo "No data inserted.";
}

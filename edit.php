<?php 

require 'config/database.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM application WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($application);
    // echo "<pre>";
    // Check if the record is not found
    if (!$data ) {
        die("Record not found!");
    }
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $website_name = $_POST['web_name'];
    $position = $_POST['position'];
    $company_name = $_POST['company_name'];
    $salary = $_POST['salary'];
    $status = $_POST['status'];
    $job_link = $_POST['job_link'];

    // Corrected SQL query
    $updateSql = "UPDATE application SET web_name = ?, position = ?, company_name = ?, salary = ?, status = ?, job_link = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateSql);
    
   
}
    



?>



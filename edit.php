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





?>



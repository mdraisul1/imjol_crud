<?php 

require 'config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM application WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$id]);
        header("Location: index.php"); // Redirect to the main page
        exit();
    } catch (PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
    }
} else {
    echo "No record selected to delete.";
}




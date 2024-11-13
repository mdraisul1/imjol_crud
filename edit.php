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
    
    try {
        // Bind parameters including the id
        $updateStmt->execute([$website_name, $position, $company_name, $salary, $status, $job_link, $id]);
        header("Location: index.php");
    } catch (PDOException $th) {
        echo "Record not updated: " . $th->getMessage();
    }
}
    



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job Application</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/edit.css">
</head>
<body>
    <div class="container-width mt-5">
        <h4>Edit Job Application</h4>
        <form action="edit.php?id=<?php echo $data['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="websiteName" class="form-label">Website Name</label>
                <input type="text" class="form-control" name="web_name" value="<?php echo $data ['web_name'] ?>">
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" name="position" value="<?php echo $data ['position'] ?>">
            </div>
            <div class="mb-3">
                <label for="companyName" class="form-label">Company Name</label>
                <input type="text" class="form-control" name="company_name" value="<?php echo $data ['company_name'] ?>">
            </div>
            <div class="mb-3">
                <label for="salaryExpectations" class="form-label">Salary Expectations</label>
                <input type="text" class="form-control" name="salary" value="<?php echo $data ['salary'] ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status">
                    <option value="Not Replied" <?php echo ($data ['status'] == 'Not Replied') ? 'selected' : ''; ?>>Not Replied</option>
                    <option value="In Progress" <?php echo ($data ['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Replied" <?php echo ($data ['status'] == 'Replied') ? 'selected' : ''; ?>>Replied</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jobPostLink" class="form-label">Job Post Link</label>
                <input type="url" class="form-control" name="job_link" value="<?php echo $data ['job_link'] ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>


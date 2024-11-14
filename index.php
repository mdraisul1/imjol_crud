<?php
require 'config/database.php';

// Fetch all data from the database
$sql = "SELECT * FROM application ORDER BY date DESC, id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group applications by date
$groupedData = [];
foreach ($data as $entry) {
    $date = $entry['date'];
    $groupedData[$date][] = $entry;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4>Job Application Form</h4>
        <input type="text" class="form-control w-25" id="searchInput" placeholder="Search...">
    </div>
    <form action="create.php" method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Website Name</th>
                    <th>Position</th>
                    <th>Company Name</th>
                    <th>Salary Expectations</th>
                    <th>Status</th>
                    <th>Job Post Link</th>
                </tr>
            </thead>
            <tbody>
                <tr class="im-table">
                    <td><input type="text" class="form-control" name="web_name" placeholder="LinkedIn" required></td>
                    <td><input type="text" class="form-control" name="position" placeholder="Position" required></td>
                    <td><input type="text" class="form-control" name="company_name" placeholder="Company Name" required></td>
                    <td><input type="text" class="form-control" name="salary" placeholder="Salary Expectations" required></td>
                    <td class="im-select">
                        <select class="form-control" name="status" required>
                            <option value="Not Replied">Not Replied</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Replied">Replied</option>
                        </select>
                    </td>
                    <td><input type="url" class="form-control" name="job_link" placeholder="Job Post Link" required></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Display applications grouped by date -->
<?php 
$counter = 0; 
$initialLimit = 1; 

foreach ($groupedData as $date => $entries): 
    $counter++; 
?>
    <div class="container mt-4 table-container" style="display: <?php echo $counter <= $initialLimit ? 'block' : 'none'; ?>">
        <div class="text-center my-3">
            <h5><?php echo date('d M Y', strtotime($date)); ?></h5>
        </div>
        <table class="table table-bordered searchable">
            <thead>
                <tr>
                    <th>S/L</th>
                    <th>Website Name</th>
                    <th>Position</th>
                    <th>Company Name</th>
                    <th>Salary Expectations</th>
                    <th>Status</th>
                    <th>Job Post Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entries as $index => $entry): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($entry['web_name']); ?></td>
                    <td><?php echo htmlspecialchars($entry['position']); ?></td>
                    <td><?php echo htmlspecialchars($entry['company_name']); ?></td>
                    <td><?php echo htmlspecialchars($entry['salary']); ?></td>
                    <td><?php echo htmlspecialchars($entry['status']); ?></td>
                    <td><a href="<?php echo htmlspecialchars($entry['job_link']); ?>" target="_blank"><?php echo htmlspecialchars($entry['job_link']); ?></a></td>
                    <td class="action-btns">
                        <a href="edit.php?id=<?php echo $entry['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $entry['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>

<!-- "Load More" Button -->
<div class="container text-center mt-3">
    <button id="loadMoreBtn" class="btn btn-primary">Load More</button>
</div>

<!-- Bootstrap JavaScript -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Search Filter Script and Load More Script -->
<script>
document.getElementById('searchInput').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let tables = document.querySelectorAll('.table-container');
    
    tables.forEach(tableContainer => {
        let rows = tableContainer.querySelectorAll('.searchable tbody tr');
        let matchFound = false;
        
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = '';
                matchFound = true;
            } else {
                row.style.display = 'none';
            }
        });
        
        tableContainer.style.display = matchFound ? '' : 'none';
    });
});

document.getElementById('loadMoreBtn').addEventListener('click', function() {
    let hiddenTables = document.querySelectorAll('.table-container[style*="display: none"]');
    
    if (hiddenTables.length > 0) {
        hiddenTables[0].style.display = 'block';
        if (hiddenTables.length === 1) {
            this.style.display = 'none'; // Hide button when no more tables are left
        }
    }
});
</script>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>

    <!-- bootstrap css link  -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- style css link  -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container mt-5">
        <h4>Job Application Form</h4>
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
                        <td>
                            <input type="text" class="form-control" name="web_name" id="websiteName" placeholder="LinkedIn" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="position" id="position" placeholder="Position" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="company_name" id="companyName" placeholder="Company Name" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="salary" id="salaryExpectations" placeholder="Salary Expectations">
                        </td>
                        <td>
                            <select class="form-control im-select" name="status" id="status">
                                <option value="Not Replied">Not Replied</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Replied">Replied</option>
                            </select>
                        </td>
                        <td>
                            <input type="url" class="form-control" name="job_link" id="jobPostLink" placeholder="Job Post Link" required>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Second Table -->
    <div class="container mt-4">
        <!-- Date -->
        <div class="text-center my-3">
            <h5>23 Jun 2024</h5>
        </div>
        <table class="table table-bordered">
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
               
            </tbody>
        </table>
    </div>

    <!-- bootstrap js link  -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

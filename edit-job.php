<?php
session_start(); // Start the session
require_once '../job_portal4/database/connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the job details from the form submission
    $jobId = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $requirements = $_POST['requirements'];

    // Prepare and execute the update statement
    $updateSql = "UPDATE jobs SET title = ?, company = ?, location = ?, description = ?, salary = ?, requirements = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssssi", $title, $company, $location, $description, $salary, $requirements, $jobId);

    if ($updateStmt->execute()) {
        // Redirect to the dashboard with a success message
        header("Location: dashboard.php?success=Job updated successfully.");
        exit;
    } else {
        // Redirect back to the edit page with an error message
        header("Location: edit-job.php?error=Failed to update job.");
        exit;
    }
} else {
    // If the request method is not POST, redirect to the edit job page
    header("Location: edit-job.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Edit Job Listing</h1>
    <form method="POST" action="edit-job.php">
        <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['id']); ?>">

        <label for="title">Job Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required>

        <label for="company">Company:</label>
        <input type="text" id="company" name="company" value="<?php echo htmlspecialchars($job['company']); ?>" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($job['location']); ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($job['description']); ?></textarea>

        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary" value="<?php echo htmlspecialchars($job['salary']); ?>" required>

        <label for="requirements">Requirements:</label>
        <textarea id="requirements" name="requirements" required><?php echo htmlspecialchars($job['requirements']); ?></textarea>

        <button type="submit">Update Job</button>
        <a href="dashboard.php">Cancel</a>
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $title = $_POST['title'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $employer = $_POST['employer'];
    $qualification = $_POST['qualification'];

    // Simulate updating job process
    // In real application, you would update the job details in the database

    echo "<p>Job with ID $job_id has been updated to title '$title', located in $location with a salary of $salary by $employer requiring $qualification.</p>";
}
?>

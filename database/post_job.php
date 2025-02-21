<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $employer = $_POST['employer'];
    $qualification = $_POST['qualification'];

    // Simulate posting job process
    // In real application, you would insert the job into the database

    echo "<p>Job titled '$title' located in $location has been posted with a salary of $salary by $employer requiring $qualification.</p>";
}
?>

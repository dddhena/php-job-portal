<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];

    // Simulate deleting job process
    // In real application, you would delete the job from the database

    echo "<p>Job with ID $job_id has been deleted.</p>";
}
?>

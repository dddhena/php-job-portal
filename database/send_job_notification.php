<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidate_name = $_POST['candidate_name'];
    $job_id = $_POST['job_id'];
    $message = $_POST['message'];

    // Simulate sending job notification process
    // In real application, you would send the notification to the candidate

    echo "<p>Notification sent to $candidate_name for job ID $job_id. Message: $message</p>";
}
?>

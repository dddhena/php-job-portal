<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application_id = $_POST['application_id'];
    $message = $_POST['message'];

    // Simulate notifying HR process
    // In real application, you would send the notification to HR

    echo "<p>Notification for application ID $application_id has been sent to HR. Message: $message</p>";
}
?>

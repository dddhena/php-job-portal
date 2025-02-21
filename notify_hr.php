<?php
// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'abraham';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = $conn->real_escape_string($_POST['application_id']);
    $message = $conn->real_escape_string($_POST['message']);
    $sender_role = 'hiring_manager';

    $sql = "INSERT INTO notifications (application_id, message, is_read, sender_role) VALUES ('$application_id', '$message', 0, '$sender_role')";

    if ($conn->query($sql) === TRUE) {
        echo 'Notification sent successfully';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notify HR</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 300px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; }
        input, textarea { width: 100%; padding: 10px; margin: 5px 0; }
        button { padding: 10px; background-color: #007BFF; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Notify HR</h2>
        <form method="post" action="notify_HR.php">
            <label for="application_id">Application ID:</label>
            <input type="text" id="application_id" name="application_id" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Notify HR</button>
        </form>
    </div>
</body>
</html>

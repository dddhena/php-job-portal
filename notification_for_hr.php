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

$sql = "SELECT application_id, message, created_at FROM notifications WHERE sender_role = 'hiring_manager' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>HR Notifications</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <h2>HR Notifications</h2>
        <table>
            <tr>
                <th>Application ID</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<tr><td>' . $row['application_id']. '</td><td>' . $row['message']. '</td><td>' . $row['created_at']. '</td></tr>';
                }
            } else {
                echo '<tr><td colspan="3">No notifications found</td></tr>';
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>

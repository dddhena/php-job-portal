<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 50%;
        }
        .container h1 {
            margin-bottom: 20px;
        }
        .notification {
            background-color: #e9e9e9;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            text-align: left;
        }
        .unread {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Notifications</h1>
        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'abraham');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Function to update message count
        function updateMessageCount($conn) {
            $sql = "SELECT COUNT(*) as count FROM notifications WHERE is_read = 0";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['count'];
        }

        // Update message count
        $messageCount = updateMessageCount($conn);

        // SQL query to fetch notifications
        $sql = "SELECT id, candidate_name, job_id, message, is_read FROM notifications";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $class = $row["is_read"] ? "" : "unread";
                echo "<div class='notification $class'>";
                echo "<p><strong>Candidate Name:</strong> " . $row["candidate_name"] . "</p>";
                echo "<p><strong>Job ID:</strong> " . $row["job_id"] . "</p>";
                echo "<p><strong>Message:</strong> " . $row["message"] . "</p>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                if (!$row["is_read"]) {
                    echo "<button type='submit' name='mark_read'>Mark as Read</button>";
                }
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No notifications available.</p>";
        }

        // Mark notification as read
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mark_read'])) {
            $id = $_POST['id'];
            $sql = "UPDATE notifications SET is_read = 1 WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                // Update message count after marking as read
                $messageCount = updateMessageCount($conn);
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $conn->close();
        ?>
        <p><strong>Unread Messages:</strong> <?php echo $messageCount; ?></p>
    </div>
</body>
</html>

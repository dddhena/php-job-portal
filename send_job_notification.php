<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Job Notification</title>
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
        .container input[type="text"], .container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Send Job Notification</h1>
        <form method="POST" action="">
            <input type="text" name="candidate_name" placeholder="Candidate Name" required>
            <input type="text" name="job_id" placeholder="Job ID" required>
            <textarea name="message" placeholder="Message" required></textarea>
            <button type="submit" name="send_notification">Send Notification</button>
        </form>
        <?php
        if (isset($_POST['send_notification'])) {
            $candidate_name = $_POST['candidate_name'];
            $job_id = $_POST['job_id'];
            $message = $_POST['message'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'abraham');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to insert notification
            $sql = "INSERT INTO notifications (candidate_name, job_id, message) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sis", $candidate_name, $job_id, $message);

            if ($stmt->execute()) {
                echo "<p>Notification sent successfully.</p>";
            } else {
                echo "<p>Error sending notification: " . $conn->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Feedback</title>
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
        }
        .container h1 {
            margin-bottom: 20px;
        }
        .container input,
        .container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .container button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
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
        <h1>Provide Feedback</h1>
        <form method="post" action="">
            <label for="candidate_name">Candidate Name:</label>
            <input type="text" id="candidate_name" name="candidate_name" required>

            <label for="job_id">Job ID:</label>
            <input type="text" id="job_id" name="job_id" required>

            <label for="message">Feedback:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $candidate_name = $_POST['candidate_name'];
            $job_id = $_POST['job_id'];
            $message = $_POST['message'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'abraham');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to insert feedback into notification table
            $sql = "INSERT INTO notifications (candidate_name, job_id, message, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sis", $candidate_name, $job_id, $message);

            if ($stmt->execute()) {
                echo "Feedback submitted successfully!";
            } else {
                echo "Error submitting feedback: " . $conn->error;
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

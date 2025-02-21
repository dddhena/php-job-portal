<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Job</title>
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
        .container input[type="text"] {
            width: 80%;
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
        <h1>Delete Job</h1>
        <form method="POST" action="">
            <input type="text" name="job_id" placeholder="Job ID" required>
            <button type="submit" name="delete">Delete Job</button>
        </form>
        <?php
        if (isset($_POST['delete'])) {
            $job_id = $_POST['job_id'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'abraham');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to delete job
            $sql = "DELETE FROM jobs WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $job_id);

            if ($stmt->execute()) {
                echo "<p>Job deleted successfully.</p>";
            } else {
                echo "<p>Error deleting job: " . $conn->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

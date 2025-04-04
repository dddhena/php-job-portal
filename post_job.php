<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Job</title>
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
        <h1>Post Job</h1>
        <form method="POST" action="">
            <input type="text" name="job_title" placeholder="Job Title" required>
            <input type="text" name="company" placeholder="Company" required>
            <input type="text" name="location" placeholder="Location" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="salary" placeholder="Salary" required>
            <textarea name="requirements" placeholder="Requirements" required></textarea>
            <button type="submit" name="post_job">Post Job</button>
        </form>
        <?php
        if (isset($_POST['post_job'])) {
            $job_title = $_POST['job_title'];
            $company = $_POST['company'];
            $location = $_POST['location'];
            $description = $_POST['description'];
            $salary = $_POST['salary'];
            $requirements = $_POST['requirements'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'abraham');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to insert job
            $sql = "INSERT INTO jobs (job_title, company, location, description, salary, requirements) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $job_title, $company, $location, $description, $salary, $requirements);

            if ($stmt->execute()) {
                echo "<p>Job posted successfully.</p>";
            } else {
                echo "<p>Error posting job: " . $conn->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

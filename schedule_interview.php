<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Scheduling</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], input[type="number"], input[type="date"], input[type="time"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Schedule an Interview</h1>
        <form action="" method="post">
            <label for="candidateName">Candidate Name:</label>
            <input type="text" id="candidateName" name="candidateName" required>
            <label for="jobId">Job ID:</label>
            <input type="number" id="jobId" name="jobId" required>
            <label for="interviewDate">Interview Date:</label>
            <input type="date" id="interviewDate" name="interviewDate" required>
            <label for="interviewTime">Interview Time:</label>
            <input type="time" id="interviewTime" name="interviewTime" required>
            <input type="submit" name="scheduleInterview" value="Schedule Interview">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["scheduleInterview"])) {
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "abraham";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get form data
        $candidateName = $conn->real_escape_string($_POST["candidateName"]);
        $jobId = $conn->real_escape_string($_POST["jobId"]);
        $interviewDate = $conn->real_escape_string($_POST["interviewDate"]);
        $interviewTime = $conn->real_escape_string($_POST["interviewTime"]);

        // SQL query to insert data
        $sql = "INSERT INTO interviews (candidate_name, job_id, interview_date, interview_time) VALUES ('$candidateName', '$jobId', '$interviewDate', '$interviewTime')";

        if ($conn->query($sql) === TRUE) {
            echo "Interview scheduled successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>

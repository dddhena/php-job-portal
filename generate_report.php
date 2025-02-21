<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        select, input[type="file"], input[type="submit"] {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Generate Report</h1>
        <form action="generate_report.php" method="post" enctype="multipart/form-data">
            <label for="reportType">Report Type:</label>
            <select name="reportType" id="reportType">
                <option value="user_activity">User Activity</option>
                <option value="system_performance">System Performance</option>
                <option value="financial_report">Financial Report</option>
            </select>
            <br>
            <label for="fileUpload">Upload File:</label>
            <input type="file" name="fileUpload" id="fileUpload" required>
            <br>
            <input type="submit" value="Generate Report">
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reportType = $_POST['reportType'];
    $file = $_FILES['fileUpload'];

    // Check if file was uploaded without errors
    if ($file['error'] == 0) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Define upload directory
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move uploaded file to the upload directory
        $filePath = $uploadDir . basename($fileName);
        if (move_uploaded_file($fileTmpName, $filePath)) {
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'abraham');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to insert report details
            $sql = "INSERT INTO report (report_type, file_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $reportType, $fileName);

            if ($stmt->execute()) {
                echo "File uploaded and report details saved successfully.<br>";
                echo "Generating $reportType report...<br>";

                // Implement report generation logic here
                // For example, read the file and process data based on $reportType

            } else {
                echo "Error saving report details: " . $conn->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>

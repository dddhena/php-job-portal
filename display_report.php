<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Reports</h1>
    <table>
        <thead>
            <tr>
                <th>Report Type</th>
                <th>File Name</th>
                <th>Uploaded At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'abraham');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch reports
            $sql = "SELECT report_type, file_name, uploaded_at FROM report";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["report_type"] . '</td>';
                    echo '<td>' . $row["file_name"] . '</td>';
                    echo '<td>' . $row["uploaded_at"] . '</td>';
                    echo '<td><a href="uploads/' . $row["file_name"] . '" target="_blank">View</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='4'>No reports available.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>

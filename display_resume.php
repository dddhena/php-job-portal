<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Staff | Manage Employee Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 40px;
            margin: 0;
        }

        main {
            padding: 40px;
        }

        h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }

        .employee-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .employee-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .employee-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .employee-card h3 {
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .employee-card p {
            color: #666;
        }

        .employee-card a {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        .employee-card a:hover {
            background-color: #45a049;
        }

        /* Footer Section */
        footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }  
    </style>
</head>
<body>
    <header>
        <h1>HR Staff | Manage Employee Info</h1>
    </header>

    <main>
        <section id="employee-info">
            <h2>Employee Information</h2>
            <div class="employee-info">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'abraham');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to fetch employee info
                $sql = "SELECT name, email, phone, skills, resume FROM employee_info";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="employee-card">';
                        echo '<h3>' . $row["name"] . '</h3>';
                        echo '<p><strong>Email:</strong> ' . $row["email"] . '</p>';
                        echo '<p><strong>Phone:</strong> ' . $row["phone"] . '</p>';
                        echo '<p><strong>Skills:</strong> ' . $row["skills"] . '</p>';
                        echo '<a href="resumes/' . $row["resume"] . '" target="_blank">Read Resume</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No employee information available.</p>";
                }

                $conn->close();
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Dire Dawa Development Association. All rights reserved.</p>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker | DDDA</title>
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

        h3 {
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        p {
            color: #666;
        }

        /* Job Listings Section */
        .job-listings {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .job {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .job:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .job a {
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

        .job a:hover {
            background-color: #45a049;
        }

        /* Profile Form */
        form {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
        }

        form label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
        }

        form input, form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }

        /* Resources Section */
        #resources ul {
            list-style-type: none;
            padding: 0;
        }

        #resources li {
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        #resources li:hover {
            background-color: #f1f1f1;
        }

        #resources li a {
            color: #4CAF50;
            font-weight: bold;
            text-decoration: none;
        }

        #resources li a:hover {
            text-decoration: underline;
        }

        /* Notifications Section */
        .notifications-section {
            padding: 20px;
            margin-top: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .notification {
            padding: 15px;
            background-color: #f9f9f9;
            margin-bottom: 15px;
            border-left: 5px solid #4CAF50;
            border-radius: 8px;
        }

        .notification p {
            margin: 0;
            color: #333;
        }

        /* Notification and Message Button Styles */
        .notification-button, .message-button {
            position: fixed;
            top: 30px;
            z-index: 1000;
        }

        .notification-button {
            right: 90px;
        }

        .message-button {
            right: 30px;
        }

        .notification-button button, .message-button button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .notification-button button:hover, .message-button button:hover {
            background-color: #0056b3;
        }

        .notification-button .notification-count, .message-button .message-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            font-size: 14px;
            border-radius: 50%;
            padding: 5px 10px;
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
    <!-- Notification Button (Top Right Corner) -->
    <div class="notification-button">
        <button onclick="window.location.href='read_notification.php'">
            <i class="fas fa-bell"></i> <span class="notification-count">3</span>
        </button>
    </div>

    <!-- Message Button (Top Right Corner) -->
    <div class="message-button">
        <button onclick="window.location.href='read_notification.php'">
            <i class="fas fa-comment"></i> <span class="message-count">2</span>
        </button>
    </div>

    <header>
        <h1>Welcome to the DDDA Job Seeker Portal</h1>
    </header>

    <main>
        <!-- Notifications Section (Initially hidden) -->
        <section id="notifications" class="notifications-section" style="display: none;">
            <h2>Notifications</h2>
            <div class="notification">
                <p><strong>New!</strong> Job opening for "Program Coordinator" has been added. Deadline: January 15, 2024.</p>
            </div>
            <div class="notification">
                <p><strong>Reminder!</strong> Application for "Administrative Assistant" closes on January 20, 2024.</p>
            </div>
        </section>

        <!-- Job Listings Section -->
        <section id="job-listings">
            <h2>Available Job Listings</h2>
            <div class="job-listings">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'abraham');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to fetch jobs
                $sql = "SELECT job_title, company, location, description, salary FROM jobs";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="job">';
                        echo '<h3>' . $row["job_title"] . '</h3>';
                        echo '<p><strong>Description:</strong> ' . $row["description"] . '</p>';
                        echo '<p><strong>Location:</strong> ' . $row["location"] . '</p>';
                        echo '<p><strong>Salary:</strong> ' . $row["salary"] . '</p>';
                        echo '<a href="#create-profile" class="btn">Apply Now</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No job listings available.</p>";
                }

                $conn->close();
                ?>
            </div>
        </section>

        <!-- Create Profile Section -->
        <section id="create-profile">
            <h2>Create Your Profile</h2>
            <form action="job_seeker.php" method="POST" enctype="multipart/form-data">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="resume">Upload Resume:</label>
                <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>

                <label for="skills">Skills:</label>
                <textarea id="skills" name="skills" rows="4" placeholder="E.g., Project Management, Data Analysis"></textarea>

                <button type="submit" name="submit_profile">Submit Profile</button>
            </form>
            <?php
            if (isset($_POST['submit_profile'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $skills = $_POST['skills'];
                $resume = $_FILES['resume']['name'];
                $resume_tmp = $_FILES['resume']['tmp_name'];
                if (!file_exists('resumes')) {
                    mkdir('resumes', 0777, true);
                }
                
                // Save the resume file to the server
                
                
                // Save the resume file to the server
                move_uploaded_file($resume_tmp, "resumes/" . $resume);


                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'abraham');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to insert employee info
                $sql = "INSERT INTO employee_info (name, email, phone, skills, resume) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $name, $email, $phone, $skills, $resume);

                if ($stmt->execute()) {
                    echo "<p>Profile submitted successfully.</p>";
                } else {
                    echo "<p>Error submitting profile: " . $conn->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </section>

        <!-- Resources Section -->
        <section id="resources">
            <h2>Resources for Job Seekers</h2>
            <ul>
                <li><a href="#">Resume Writing Tips</a></li>
                <li><a href="#">Interview Preparation</a></li>
                <li><a href="#">Career Guidance</a></li>
                <li><a href="#">Available Training Programs</a></li>
            </ul>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials">
            <h2>Success Stories</h2>
            <blockquote>
                <p>"Thanks to DDDA, I found my dream job as a project manager!"</p>
                <cite>- Ahmed, Dire Dawa</cite>
            </blockquote>
            <blockquote>
                <p>"The resources provided here helped me excel in my job interviews."</p>
                <cite>- Sara, Ethiopia</cite>
            </blockquote>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Dire Dawa Development Association. All rights reserved.</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>

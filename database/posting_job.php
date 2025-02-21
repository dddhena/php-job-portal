<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.html");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $job_title = trim($_POST['job_title']);
    $job_description = trim($_POST['job_description']);
    $job_location = trim($_POST['job_location']);
    $job_salary = trim($_POST['job_salary']);
    $company_name = trim($_POST['company_name']);

    // Basic validation
    if (empty($job_title) || empty($job_description) || empty($job_location) || empty($job_salary) || empty($company_name)) {
        echo "All fields are required.";
        exit;
    }

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "employee_info"; // Your database name

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert job into the jobs table
    $sql = "INSERT INTO jobs (job_title, job_description, job_location, job_salary, company_name) 
            VALUES ('$job_title', '$job_description', '$job_location', '$job_salary', '$company_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New job posted successfully!";
        header("Location: current_jobs.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

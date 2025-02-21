<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employe_info";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$age = $_POST['age'];
$skills = $_POST['skills'];
$job_title = $_POST['job_title'];  // Selected job from the form
$resume = $_FILES['resume']['name'];

// Check age
if ($age < 10) {
    die("Age must be greater than 10.");
}

// Resume upload handling
$target_dir = "uploads/";
$target_file = $target_dir . basename($resume);

if (move_uploaded_file($_FILES['resume']['tmp_name'], $target_file)) {
    echo "The file " . basename($resume) . " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

// Insert into database
$job_salary = 0;
if ($job_title == 'Job1') {
    $job_salary = 50000;
} elseif ($job_title == 'Job2') {
    $job_salary = 60000;
} // Add other jobs and their salaries as needed

// Prepare SQL
$sql = "INSERT INTO employee_info (first_name, last_name, age, skills, job_title, salary, resume)
        VALUES ('$first_name', '$last_name', '$age', '$skills', '$job_title', '$job_salary', '$resume')";

if ($conn->query($sql) === TRUE) {
    echo "Application submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
